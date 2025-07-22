<?php
session_start();

$tasksFile = 'tasks.json';

// --- Funciones para manejar el archivo JSON de tareas ---

function getTasks($filePath) {
    if (file_exists($filePath) && filesize($filePath) > 0) {
        $json = file_get_contents($filePath);
        return json_decode($json, true);
    }
    return []; // Devuelve un array vacío si el archivo no existe o está vacío
}

function saveTasks($filePath, $tasks) {
    file_put_contents($filePath, json_encode($tasks, JSON_PRETTY_PRINT));
}

// --- Lógica de Procesamiento de Solicitudes ---

// Inicializar tareas si no existen en la sesión
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = getTasks($tasksFile);
}

$tasks = &$_SESSION['tasks']; // Usar referencia para trabajar directamente con la sesión

$message = ''; // Para mensajes al usuario

// Añadir nueva tarea
if (isset($_POST['action']) && $_POST['action'] === 'add' && !empty($_POST['task_text'])) {
    $newTask = [
        'id' => uniqid(), // ID único para cada tarea
        'text' => htmlspecialchars($_POST['task_text']),
        'completed' => false // Por defecto, no realizada
    ];
    $tasks[] = $newTask;
    saveTasks($tasksFile, $tasks);
    $message = 'Tarea añadida con éxito.';
    header('Location: index.php'); // Redirigir para evitar re-envío del formulario
    exit();
}

// Editar tarea
if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['task_id']) && !empty($_POST['task_text'])) {
    foreach ($tasks as &$task) { // Usar referencia para modificar el array directamente
        if ($task['id'] === $_POST['task_id']) {
            $task['text'] = htmlspecialchars($_POST['task_text']);
            break;
        }
    }
    saveTasks($tasksFile, $tasks);
    $message = 'Tarea actualizada con éxito.';
    header('Location: index.php');
    exit();
}

// Marcar/Desmarcar como realizada
if (isset($_GET['action']) && ($_GET['action'] === 'toggle' || $_GET['action'] === 'undo') && isset($_GET['id'])) {
    foreach ($tasks as &$task) {
        if ($task['id'] === $_GET['id']) {
            $task['completed'] = !($task['completed']); // Invierte el estado
            $message = 'Estado de la tarea cambiado.';
            break;
        }
    }
    saveTasks($tasksFile, $tasks);
    header('Location: index.php');
    exit();
}

// Borrar tarea
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    // Filtrar la tarea a borrar
    $tasks = array_filter($tasks, fn($task) => $task['id'] !== $_GET['id']);
    // Reindexar el array después de filtrar (opcional pero buena práctica)
    $tasks = array_values($tasks);
    saveTasks($tasksFile, $tasks);
    $message = 'Tarea eliminada con éxito.';
    header('Location: index.php');
    exit();
}

// Cargar las tareas más recientes para mostrar
// Esto ya está manejado por la referencia $tasks = &$_SESSION['tasks'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Mi Lista de Tareas</h1>

        <?php if (!empty($message)): ?>
            <p class="info-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <form id="task-form" method="POST" action="index.php">
            <input type="hidden" name="action" id="form-action" value="add">
            <input type="hidden" name="task_id" id="form-task-id" value="">
            <input type="text" name="task_text" id="task-input" placeholder="Añadir nueva tarea..." required>
            <button type="submit" id="form-submit-button">Añadir Tarea</button>
        </form>

        <div class="task-list">
            <?php if (empty($tasks)): ?>
                <p class="no-tasks">¡No tienes tareas aún! Añade una.</p>
            <?php else: ?>
                <?php foreach ($tasks as $task): ?>
                    <div class="task-item <?php echo $task['completed'] ? 'completed' : 'pending'; ?>" data-id="<?php echo $task['id']; ?>">
                        <span class="task-text"><?php echo $task['text']; ?></span>
                        <div class="task-actions">
                            <button class="edit-btn" title="Editar">✏️</button>
                            <?php if ($task['completed']): ?>
                                <a href="?action=undo&id=<?php echo $task['id']; ?>" class="undo-btn" title="Deshacer">↩️</a>
                            <?php else: ?>
                                <a href="?action=toggle&id=<?php echo $task['id']; ?>" class="complete-btn" title="Marcar como realizada">✔️</a>
                            <?php endif; ?>
                            <button class="delete-btn" title="Eliminar">🗑️</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
        // En 3raya/index.php, ajedrez/index.php, etc.

        // ... Tu código PHP

        // Incluir el footer.php que está un nivel arriba
        include '../footer.php';

        // O, si quieres asegurarte de que solo se incluya una vez y parar la ejecución si no se encuentra:
        // require_once '../footer.php';
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const taskInput = document.getElementById('task-input');
            const formAction = document.getElementById('form-action');
            const formTaskId = document.getElementById('form-task-id');
            const formSubmitButton = document.getElementById('form-submit-button');

            // --- Funcionalidad de Edición ---
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', (event) => {
                    const taskItem = event.target.closest('.task-item');
                    const taskId = taskItem.dataset.id;
                    const taskTextSpan = taskItem.querySelector('.task-text');
                    const currentText = taskTextSpan.textContent;

                    // Rellenar el formulario para editar
                    taskInput.value = currentText;
                    formAction.value = 'edit';
                    formTaskId.value = taskId;
                    formSubmitButton.textContent = 'Actualizar Tarea';
                    taskInput.focus(); // Poner el foco en el input

                    // Desplazarse al inicio de la página para ver el formulario
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });

            // --- Funcionalidad de Confirmación de Borrado ---
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', (event) => {
                    const taskItem = event.target.closest('.task-item');
                    const taskId = taskItem.dataset.id;
                    const taskText = taskItem.querySelector('.task-text').textContent;

                    if (confirm(`¿Estás seguro de que quieres borrar la tarea "${taskText}"?`)) {
                        window.location.href = `?action=delete&id=${taskId}`;
                    }
                });
            });

            // --- Limpiar formulario después de enviar (si aplica) ---
            // Esto es más para UX si el usuario usa el botón Añadir/Actualizar
            // Las redirecciones de PHP ya limpian el estado del formulario en recargas.
            // Puedes añadir una lógica aquí si quieres limpiar el input después de editar
            // sin recargar la página completamente (requeriría AJAX).
        });
    </script>
</body>
</html>