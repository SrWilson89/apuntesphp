<?php
// ... Tu código PHP existente ...
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu Página</title>
    <style>
        /* Estilos CSS para el footer */
        .project-footer {
            background-color: #282c34; /* Color de fondo oscuro */
            color: #ffffff; /* Color del texto */
            padding: 20px 0;
            text-align: center;
            border-top: 1px solid #444; /* Borde superior sutil */
            margin-top: 50px; /* Espacio superior para separarlo del contenido */
            font-family: Arial, sans-serif;
            position: relative; /* Asegura que el footer se mantenga al final */
            bottom: 0;
            width: 100%;
        }

        .project-footer nav ul {
            list-style: none; /* Elimina los puntos de la lista */
            padding: 0;
            margin: 0;
            display: flex; /* Para poner los elementos en línea */
            flex-wrap: wrap; /* Permite que los elementos salten de línea en pantallas pequeñas */
            justify-content: center; /* Centra los elementos */
            gap: 15px; /* Espacio entre los enlaces */
        }

        .project-footer nav ul li {
            display: inline-block; /* Para navegadores más antiguos, aunque flexbox ya lo hace */
        }

        .project-footer nav ul li a {
            color: #61dafb; /* Color azul claro para los enlaces */
            text-decoration: none; /* Elimina el subrayado */
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease; /* Transición suave al pasar el ratón */
            font-weight: bold;
        }

        .project-footer nav ul li a:hover {
            background-color: #61dafb; /* Cambia el fondo al pasar el ratón */
            color: #282c34; /* Cambia el color del texto al pasar el ratón */
        }

        .project-footer .copyright {
            margin-top: 15px;
            font-size: 0.9em;
            color: #aaaaaa;
        }
    </style>
</head>
<body>

    <footer class="project-footer">
        <nav>
            <ul>
                <li><a href="/repo/3raya/index.php">3 en Raya</a></li>
                <li><a href="/repo/ajedrez/index.php">Ajedrez</a></li>
                <li><a href="/repo/calculadora/index.php">Calculadora</a></li>
                <li><a href="/repo/contrasena/index.php">Contraseña</a></li>
                <li><a href="/repo/encuestagrafico/index.php">Encuesta Gráfico</a></li>
                <li><a href="/repo/hundirflota/index.php">Hundir la Flota</a></li>
                <li><a href="/repo/listatodo/index.php">Lista de Tareas</a></li>
            </ul>
        </nav>
        <p class="copyright">&copy; <?php echo date("Y"); ?> Mis Proyectos. Todos los derechos reservados.</p>
    </footer>

</body>
</html>