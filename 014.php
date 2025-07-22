<?php
// Iniciar la sesión para establecer variables
echo "<h2>1. Estableciendo variables de sesión:</h2>";
echo "Las variables de sesión se establecen en el servidor después de que se carga la página." . "<br>";
echo "Para ver estas variables, necesitarás recargar la página o navegar a otra página que inicie la sesión." . "<br>";
session_start(); // Siempre debe ir al principio del script
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Variables de sesión 'favcolor' (verde) y 'favanimal' (gato) establecidas." . "<br>";
?>

</body>
</html>

<hr>

<?php
// Iniciar la sesión para leer variables establecidas previamente
echo "<h2>2. Leyendo variables de sesión:</h2>";
echo "Las variables de sesión se leen del servidor en esta solicitud." . "<br>";
echo "Si es la primera carga después de establecerlas, verás los valores predeterminados." . "<br>";
echo "Si recargas después de establecerlas, verás los valores actuales de la sesión." . "<br>";
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
echo "El color favorito es: " . (isset($_SESSION["favcolor"]) ? $_SESSION["favcolor"] : "No establecido") . ".<br>";
echo "El animal favorito es: " . (isset($_SESSION["favanimal"]) ? $_SESSION["favanimal"] : "No establecido") . ".<br>";
?>

</body>
</html>

<hr>

<?php
// Iniciar la sesión para imprimir todas las variables
echo "<h2>3. Imprimiendo todas las variables de sesión:</h2>";
echo "Esto mostrará el contenido actual del array \$_SESSION." . "<br>";
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
print_r($_SESSION);
echo "<br>";
?>

</body>
</html>

<hr>

<?php
// Iniciar la sesión para cambiar una variable
echo "<h2>4. Cambiando una variable de sesión:</h2>";
echo "Cambiando el valor de 'favcolor' a 'yellow'." . "<br>";
echo "Para ver el cambio reflejado, necesitarás otra recarga." . "<br>";
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// to change a session variable, just overwrite it
$_SESSION["favcolor"] = "yellow";
echo "Variable 'favcolor' cambiada a 'yellow'." . "<br>";
echo "Estado actual de \$_SESSION después del cambio:" . "<br>";
print_r($_SESSION);
echo "<br>";
?>

</body>
</html>

<hr>

<?php
// Iniciar la sesión para eliminar variables
echo "<h2>5. Eliminando todas las variables de sesión y destruyendo la sesión:</h2>";
echo "Esta acción vaciará \$_SESSION y destruirá la sesión en el servidor." . "<br>";
echo "Para confirmar la eliminación, recarga la página después de esto." . "<br>";
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();
echo "Todas las variables de sesión han sido eliminadas (session_unset())." . "<br>";

// destroy the session
session_destroy();
echo "La sesión ha sido destruida (session_destroy())." . "<br>";
echo "Ahora, si recargas, no deberías ver ninguna variable de sesión establecida." . "<br>";
?>

</body>
</html>