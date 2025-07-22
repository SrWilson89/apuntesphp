<?php
// Establecer una cookie
echo "<h3>Estableciendo una cookie (user = John Doe):</h3>";
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 día
?>
<html>
<body>

<?php
echo "<h4>Comprobando si la primera cookie está establecida:</h4>";
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie '" . $cookie_name . "' NO está establecida!" . "<br>";
} else {
    echo "Cookie '" . $cookie_name . "' SÍ está establecida!" . "<br>";
    echo "Valor es: " . $_COOKIE[$cookie_name] . "<br>";
}
?>

</body>
</html>

<?php
// Actualizar el valor de la cookie
echo "<h3>Actualizando el valor de la cookie (user = Alex Porter):</h3>";
$cookie_name = "user";
$cookie_value = "Alex Porter";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>
<html>
<body>

<?php
echo "<h4>Comprobando si la cookie actualizada está establecida (puede que necesites recargar para ver el cambio):</h4>";
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie '" . $cookie_name . "' NO está establecida!" . "<br>";
} else {
    echo "Cookie '" . $cookie_name . "' SÍ está establecida!" . "<br>";
    echo "Valor es: " . $_COOKIE[$cookie_name] . "<br>";
}
?>

</body>
</html>

<?php
// Eliminar una cookie
echo "<h3>Eliminando la cookie 'user':</h3>";
// Establece la fecha de expiración en el pasado
setcookie("user", "", time() - 3600, "/"); // Se añade el path para asegurar la eliminación
?>
<html>
<body>

<?php
echo "Cookie 'user' ha sido eliminada." . "<br>";
?>

</body>
</html>

<?php
// Comprobar si las cookies están habilitadas en el navegador
echo "<h3>Comprobando si las cookies están habilitadas en el navegador:</h3>";
setcookie("test_cookie", "test", time() + 3600, '/');
?>
<html>
<body>

<?php
// Se requiere una recarga de la página para que la cookie 'test_cookie' sea accesible en $_COOKIE
// Para una comprobación más fiable, esta parte debería estar en una página separada o después de una redirección.
echo "<h4>Recargando para comprobar si las cookies están habilitadas...</h4>";
?>
<a href="?check_cookies=true">Haz clic aquí para comprobar</a>

<?php
if(isset($_GET['check_cookies']) && count($_COOKIE) > 0) {
    echo "Cookies están habilitadas." . "<br>";
} elseif (isset($_GET['check_cookies']) && count($_COOKIE) == 0) {
    echo "Cookies están deshabilitadas." . "<br>";
} else {
    echo "Por favor, haz clic en el enlace de arriba para comprobar el estado de las cookies." . "<br>";
}
?>

</body>
</html>