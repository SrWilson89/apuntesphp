<?php
// ===========================================
// ARCHIVO COMPLETO DE EJERCICIOS DE FUNCIONES
// ===========================================

/**
 * 1. Función que recibe un nombre y devuelve un saludo
 */
function saludar($nombre) {
    return "Hola, $nombre";
}

/**
 * 2. Función que imprime las tablas de multiplicar del 1 al 9
 */
function tablasMultiplicar() {
    for ($i = 1; $i <= 9; $i++) {
        echo "<h3>Tabla del $i</h3>";
        echo "<ul>";
        for ($j = 1; $j <= 10; $j++) {
            echo "<li>$i x $j = " . ($i * $j) . "</li>";
        }
        echo "</ul>";
    }
}

/**
 * 3. Función que calcula el factorial de un número
 */
function factorial($n) {
    if ($n <= 1) {
        return 1;
    }
    return $n * factorial($n - 1);
}

/**
 * 4. Función que calcula el área de un rectángulo
 */
function areaRectangulo($base, $altura) {
    return $base * $altura;
}

/**
 * 5. Función que convierte Celsius a Fahrenheit
 */
function celsiusToFahrenheit($celsius) {
    return ($celsius * 9/5) + 32;
}

/**
 * 6. Función que calcula el promedio de un array de números
 */
function promedio($numeros) {
    if (empty($numeros)) {
        return 0;
    }
    return array_sum($numeros) / count($numeros);
}

/**
 * 7. Función que determina si un string es palíndromo
 */
function esPalindromo($texto) {
    $texto = strtolower(preg_replace('/[^a-z0-9]/', '', $texto));
    return $texto == strrev($texto);
}

/**
 * 8. Función que imprime una lista numerada de nombres
 */
function listaNumerada($nombres) {
    echo "<ol>";
    foreach ($nombres as $nombre) {
        echo "<li>$nombre</li>";
    }
    echo "</ol>";
}

/**
 * 9. Función con parámetro opcional
 */
function funcionOpcional($parametro = "Valor por defecto") {
    echo "<p>$parametro</p>";
}

/**
 * 10. Función recursiva que imprime un intervalo de números
 */
function imprimirIntervalo($inicio, $fin) {
    if ($inicio <= $fin) {
        echo "$inicio ";
        imprimirIntervalo($inicio + 1, $fin);
    }
}

// ===========================================
// EJEMPLOS DE USO DE LAS FUNCIONES
// ===========================================
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicios de Funciones en PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        section { margin-bottom: 30px; border-bottom: 1px solid #ccc; padding-bottom: 20px; }
        h2 { color: #2c3e50; }
    </style>
</head>
<body>
    <h1>Ejercicios de Funciones en PHP</h1>

    <section>
        <h2>1. Función de Saludo</h2>
        <?php echo "<p>" . saludar("María") . "</p>"; ?>
    </section>

    <section>
        <h2>2. Tablas de Multiplicar</h2>
        <?php tablasMultiplicar(); ?>
    </section>

    <section>
        <h2>3. Factorial de un Número</h2>
        <?php echo "<p>Factorial de 5: " . factorial(5) . "</p>"; ?>
    </section>

    <section>
        <h2>4. Área de un Rectángulo</h2>
        <?php echo "<p>Área (base=5, altura=3): " . areaRectangulo(5, 3) . "</p>"; ?>
    </section>

    <section>
        <h2>5. Conversión Celsius a Fahrenheit</h2>
        <?php echo "<p>25°C = " . celsiusToFahrenheit(25) . "°F</p>"; ?>
    </section>

    <section>
        <h2>6. Promedio de Números</h2>
        <?php echo "<p>Promedio de [10, 20, 30]: " . promedio([10, 20, 30]) . "</p>"; ?>
    </section>

    <section>
        <h2>7. Palíndromo</h2>
        <?php 
        $frase = "Anita lava la tina";
        echo "<p>'$frase' es palíndromo? " . (esPalindromo($frase) ? 'Sí' : 'No') . "</p>";
        ?>
    </section>

    <section>
        <h2>8. Lista Numerada</h2>
        <?php listaNumerada(["Manzana", "Banana", "Naranja"]); ?>
    </section>

    <section>
        <h2>9. Parámetro Opcional</h2>
        <?php 
        funcionOpcional();
        funcionOpcional("Valor personalizado");
        ?>
    </section>

    <section>
        <h2>10. Intervalo Recursivo</h2>
        <p>Intervalo de 3 a 7: <?php imprimirIntervalo(3, 7); ?></p>
    </section>
</body>
</html>

<!-- ## Análisis de Lenguajes de Programación: PHP y JavaScript

---

### Lenguaje: PHP

**Pros:**
* **Facilidad de Aprendizaje:** Es relativamente sencillo para principiantes, especialmente para el desarrollo web.
* **Amplia Comunidad y Documentación:** Cuenta con una comunidad muy grande y una vasta cantidad de recursos, tutoriales y documentación.
* **Integración con Bases de Datos:** Excelente y optimizado para trabajar con bases de datos como MySQL, siendo la base de muchos CMS.
* **Grandes Proyectos y CMS:** Soporte robusto para sistemas de gestión de contenido (CMS) populares como WordPress, Joomla y Drupal.
* **Coste:** Generalmente es de bajo coste o gratuito en términos de hosting y herramientas.
* **Rendimiento Mejorado:** Las versiones recientes (PHP 7.x y 8.x) han mejorado significativamente el rendimiento.

**Contras:**
* **Solo Servidor:** Principalmente se ejecuta en el lado del servidor, por lo que no puede manejar la interactividad directa en el navegador sin la ayuda de JavaScript.
* **Inconsistencias en Sintaxis (versiones antiguas):** Las versiones más antiguas tenían algunas inconsistencias en la sintaxis de las funciones, aunque esto ha mejorado.
* **Gestión de Dependencias:** Aunque ha mejorado con Composer, la gestión de dependencias y la estructura de proyectos pueden ser menos intuitivas para algunos en comparación con otros ecosistemas.
* **Percepción:** A veces tiene una percepción negativa debido a las malas prácticas de codificación en proyectos antiguos o mal estructurados.

**Puntuación Final: 8/10**
(Es un lenguaje muy sólido y maduro para el desarrollo web del lado del servidor, con una gran adopción y evolución continua. Su capacidad para potenciar el 80% de la web es una prueba de su eficacia.)

---

### Lenguaje: JavaScript

**Pros:**
* **Versatilidad (Full-Stack):** Puede ejecutarse tanto en el lado del cliente (navegador) como en el lado del servidor (Node.js), lo que permite a los desarrolladores usar un único lenguaje para todo el stack.
* **Interactividad Frontend:** Es el lenguaje esencial para crear interfaces de usuario dinámicas y altamente interactivas en el navegador.
* **Gran Ecosistema:** Cuenta con un ecosistema enorme de frameworks y librerías (React, Angular, Vue, Express.js, etc.) que aceleran el desarrollo.
* **Comunidad Muy Activa:** Una de las comunidades de desarrollo más grandes y activas, con constantes innovaciones.
* **Aplicaciones Multiplataforma:** Con herramientas como React Native o Electron, se puede usar para desarrollar aplicaciones móviles y de escritorio.
* **Rendimiento:** Node.js es muy eficiente para operaciones de E/S (entrada/salida) y aplicaciones en tiempo real.

**Contras:**
* **Curva de Aprendizaje (Ecosistema):** Aunque el lenguaje en sí no es extremadamente complejo, el rápido cambio y la gran cantidad de herramientas, frameworks y librerías pueden ser abrumadores para los principiantes.
* **Gestión de Dependencias (Node_modules):** El directorio `node_modules` puede volverse muy grande y pesado.
* **Manejo Asíncrono (complejidad):** Aunque las promesas y `async/await` han mejorado esto, el manejo de operaciones asíncronas puede ser un desafío para los nuevos desarrolladores.
* **Naturaleza "Permisiva":** En sus inicios, era menos estricto con los tipos y errores, lo que podía llevar a código con bugs difíciles de depurar (aunque TypeScript ayuda mucho con esto).

**Puntuación Final: 9/10**
(Su capacidad para dominar tanto el frontend como el backend, junto con su enorme ecosistema y la demanda en el mercado, lo convierten en una opción extremadamente potente y versátil para casi cualquier tipo de aplicación moderna.)

--- -->