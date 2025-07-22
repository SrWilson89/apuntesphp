<?php
// Ruta al archivo donde guardaremos los datos de la encuesta
$dataFile = 'data.json';

// --- Función para leer los datos actuales ---
function readSurveyData($filePath) {
    if (file_exists($filePath) && filesize($filePath) > 0) {
        $json = file_get_contents($filePath);
        return json_decode($json, true);
    }
    // Inicializar con valores por defecto si el archivo no existe o está vacío
    return [
        'opcion1' => 0,
        'opcion2' => 0,
        'opcion3' => 0,
        'opcion4' => 0
    ];
}

// --- Función para guardar los datos (incrementar un voto) ---
function saveSurveyData($filePath, $data) {
    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
}

// --- Lógica para procesar el voto ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'])) {
    $currentData = readSurveyData($dataFile);
    $votedOption = $_POST['vote'];

    if (array_key_exists($votedOption, $currentData)) {
        $currentData[$votedOption]++;
        saveSurveyData($dataFile, $currentData);
        // Redirigir para evitar re-envío del formulario al recargar
        header('Location: index.php?voted=true');
        exit();
    }
}

// Leer los datos más recientes para mostrar la encuesta y el gráfico
$surveyResults = readSurveyData($dataFile);

// Preparar los datos para Chart.js
$labels = ['Opción A', 'Opción B', 'Opción C', 'Opción D'];
$dataPoints = array_values($surveyResults); // Obtener solo los valores numéricos
$backgroundColors = [
    'rgba(255, 99, 132, 0.7)', // Rojo
    'rgba(54, 162, 235, 0.7)', // Azul
    'rgba(255, 206, 86, 0.7)', // Amarillo
    'rgba(75, 192, 192, 0.7)'  // Verde
];
$borderColors = [
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta Interactiva con Gráficos</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>¿Cuál es tu color favorito?</h1>
        <p class="description">Selecciona una de las opciones y ve los resultados en tiempo real.</p>

        <?php if (!isset($_GET['voted'])): // Muestra el formulario si aún no ha votado ?>
            <div class="survey-form">
                <form method="POST" action="index.php">
                    <div class="radio-group">
                        <input type="radio" id="opcion1" name="vote" value="opcion1" required>
                        <label for="opcion1">Opción A: Rojo</label><br>

                        <input type="radio" id="opcion2" name="vote" value="opcion2" required>
                        <label for="opcion2">Opción B: Azul</label><br>

                        <input type="radio" id="opcion3" name="vote" value="opcion3" required>
                        <label for="opcion3">Opción C: Amarillo</label><br>

                        <input type="radio" id="opcion4" name="vote" value="opcion4" required>
                        <label for="opcion4">Opción D: Verde</label><br>
                    </div>
                    <button type="submit" class="vote-button">Votar</button>
                </form>
            </div>
        <?php else: ?>
            <p class="thank-you-message">¡Gracias por tu voto! Aquí están los resultados actuales:</p>
        <?php endif; ?>

        <div class="chart-area">
            <canvas id="surveyChart"></canvas>
        </div>

        <div class="controls">
            <a href="index.php" class="refresh-button">Ver Resultados Actualizados</a>
            <a href="index.php?reset_data=true" class="reset-button">Reiniciar Encuesta</a>
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
        // Datos PHP pasados a JavaScript
        const labels = <?php echo json_encode($labels); ?>;
        const dataPoints = <?php echo json_encode($dataPoints); ?>;
        const backgroundColors = <?php echo json_encode($backgroundColors); ?>;
        const borderColors = <?php echo json_encode($borderColors); ?>;

        // Crear el gráfico usando Chart.js
        const ctx = document.getElementById('surveyChart').getContext('2d');
        const surveyChart = new Chart(ctx, {
            type: 'bar', // Puedes cambiar a 'pie', 'doughnut', etc.
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Votos',
                    data: dataPoints,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // Asegura que los ticks del eje Y sean enteros
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Oculta la leyenda si no es necesaria para un gráfico de barras simple
                    },
                    title: {
                        display: true,
                        text: 'Resultados de la Encuesta',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>

<?php
// --- Lógica para reiniciar los datos (solo para desarrollo) ---
if (isset($_GET['reset_data']) && $_GET['reset_data'] === 'true') {
    // Restablecer el archivo data.json a su estado inicial
    $initialData = [
        'opcion1' => 0,
        'opcion2' => 0,
        'opcion3' => 0,
        'opcion4' => 0
    ];
    saveSurveyData($dataFile, $initialData);
    header('Location: index.php'); // Redirigir para limpiar el parámetro reset_data
    exit();
}
?>