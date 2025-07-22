<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demostración de Expresiones Regulares en PHP (PCRE)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 900px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #0056b3; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 30px; }
        h3 { color: #007bff; margin-top: 20px; }
        pre { background-color: #e9e9e9; padding: 15px; border-radius: 5px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; font-family: "Courier New", Courier, monospace; }
        .code-block { background-color: #f0f0f0; border-left: 4px solid #6c757d; padding: 10px 15px; margin-bottom: 15px; }
        .result { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin-top: 10px; }
        .warning { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; padding: 10px; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Demostración de Funciones de Expresiones Regulares en PHP (PCRE)</h1>
        <p>Las expresiones regulares son secuencias de caracteres que forman un patrón de búsqueda. PHP utiliza las funciones PCRE (Perl Compatible Regular Expressions), que son muy potentes y flexibles.</p>
        <p class="warning"><strong>Importante:</strong> Todas las funciones PCRE requieren que el patrón esté delimitado por un carácter (ej. <code>/patron/</code>, <code>#patron#</code>, <code>~patron~</code>). Los modificadores (como <code>i</code> para insensible a mayúsculas/minúsculas) se colocan después del delimitador final.</p>

        <h2>1. <code>preg_match()</code> - Buscar la primera coincidencia</h2>
        <p>Realiza una búsqueda de una expresión regular y devuelve <code>1</code> si se encuentra una coincidencia, <code>0</code> si no, o <code>false</code> en caso de error. Las coincidencias capturadas se guardan en un array opcional.</p>
        <?php
        $string = "El número de teléfono es 123-456-7890. También un email: info@example.com.";
        $pattern = '/\d{3}-\d{3}-\d{4}/'; // Busca un patrón de número de teléfono
        echo "<h3>Ejemplo: Buscar un número de teléfono</h3>";
        echo "<p><strong>Cadena:</strong> <code>" . htmlspecialchars($string) . "</code></p>";
        echo "<p><strong>Patrón:</strong> <code>" . htmlspecialchars($pattern) . "</code></p>";
        echo "<div class=\"code-block\"><pre><code>\$matches = [];\nif (preg_match(\$pattern, \$string, \$matches)) {\n    echo \"Se encontró una coincidencia:\\n\";\n    print_r(\$matches);\n} else {\n    echo \"No se encontró ninguna coincidencia.\\n\";\n}</code></pre></div>";

        $matches = [];
        echo "<div class=\"result\">";
        if (preg_match($pattern, $string, $matches)) {
            echo "Se encontró una coincidencia:<br>";
            echo "<pre>"; print_r($matches); echo "</pre>";
        } else {
            echo "No se encontró ninguna coincidencia.<br>";
        }
        echo "</div>";
        ?>

        <h2>2. <code>preg_match_all()</code> - Buscar todas las coincidencias</h2>
        <p>Realiza una búsqueda de todas las coincidencias de una expresión regular en una cadena. Devuelve el número total de coincidencias encontradas.</p>
        <?php
        $string = "Mi email es user@domain.com y el tuyo es test@sub.co.uk. otro: invalid-email.";
        $pattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/'; // Busca patrones de email
        echo "<h3>Ejemplo: Extraer todos los emails</h3>";
        echo "<p><strong>Cadena:</strong> <code>" . htmlspecialchars($string) . "</code></p>";
        echo "<p><strong>Patrón:</strong> <code>" . htmlspecialchars($pattern) . "</code></p>";
        echo "<div class=\"code-block\"><pre><code>\$all_matches = [];\n\$count = preg_match_all(\$pattern, \$string, \$all_matches);\n\nif (\$count > 0) {\n    echo \"Se encontraron {\$count} coincidencias:\\n\";\n    print_r(\$all_matches[0]); // [0] contiene todas las coincidencias completas\n} else {\n    echo \"No se encontraron coincidencias.\\n\";\n}</code></pre></div>";

        $all_matches = [];
        $count = preg_match_all($pattern, $string, $all_matches);
        echo "<div class=\"result\">";
        if ($count > 0) {
            echo "Se encontraron {$count} coincidencias:<br>";
            echo "<pre>"; print_r($all_matches[0]); echo "</pre>"; // all_matches[0] contiene todas las coincidencias completas
        } else {
            echo "No se encontraron coincidencias.<br>";
        }
        echo "</div>";
        ?>

        <h2>3. <code>preg_replace()</code> - Reemplazar coincidencias</h2>
        <p>Realiza una búsqueda de una expresión regular y reemplaza todas las coincidencias encontradas con una cadena de reemplazo.</p>
        <?php
        $string = "Hola mundo, hola PHP, hola a todos.";
        $pattern = '/hola/i'; // Busca "hola" (insensible a mayúsculas/minúsculas)
        $replacement = 'ADIÓS';
        echo "<h3>Ejemplo: Reemplazar una palabra</h3>";
        echo "<p><strong>Cadena:</strong> <code>" . htmlspecialchars($string) . "</code></p>";
        echo "<p><strong>Patrón:</strong> <code>" . htmlspecialchars($pattern) . "</code> (modificador 'i' para insensible a mayúsculas/minúsculas)</p>";
        echo "<p><strong>Reemplazo:</strong> <code>" . htmlspecialchars($replacement) . "</code></p>";
        echo "<div class=\"code-block\"><pre><code>\$new_string = preg_replace(\$pattern, \$replacement, \$string);\necho \"Cadena modificada: {\$new_string}\\n\";</code></pre></div>";

        $new_string = preg_replace($pattern, $replacement, $string);
        echo "<div class=\"result\">";
        echo "Cadena modificada: <code>" . htmlspecialchars($new_string) . "</code><br>";
        echo "</div>";
        ?>

        <h2>4. <code>preg_split()</code> - Dividir una cadena por un patrón</h2>
        <p>Divide una cadena en un array de subcadenas usando una expresión regular como delimitador.</p>
        <?php
        $string = "manzana,naranja;pera fresa";
        $pattern = '/[,; ]/'; // Divide por coma, punto y coma o espacio
        echo "<h3>Ejemplo: Dividir una cadena de frutas</h3>";
        echo "<p><strong>Cadena:</strong> <code>" . htmlspecialchars($string) . "</code></p>";
        echo "<p><strong>Patrón:</strong> <code>" . htmlspecialchars($pattern) . "</code></p>";
        echo "<div class=\"code-block\"><pre><code>\$fruits = preg_split(\$pattern, \$string);\nprint_r(\$fruits);</code></pre></div>";

        $fruits = preg_split($pattern, $string);
        echo "<div class=\"result\">";
        echo "Array resultante:<br>";
        echo "<pre>"; print_r($fruits); echo "</pre>";
        echo "</div>";
        ?>

        <h2>5. <code>preg_grep()</code> - Filtrar un array por un patrón</h2>
        <p>Devuelve las entradas de un array que coinciden con una expresión regular.</p>
        <?php
        $words = ["php", "Python", "JavaScript", "Perl", "java"];
        $pattern = '/^P/i'; // Palabras que empiezan con 'P' o 'p'
        echo "<h3>Ejemplo: Filtrar palabras que empiezan con 'P'</h3>";
        echo "<p><strong>Array:</strong> <code>" . htmlspecialchars(json_encode($words)) . "</code></p>";
        echo "<p><strong>Patrón:</strong> <code>" . htmlspecialchars($pattern) . "</code></p>";
        echo "<div class=\"code-block\"><pre><code>\$filtered_words = preg_grep(\$pattern, \$words);\nprint_r(\$filtered_words);</code></pre></div>";

        $filtered_words = preg_grep($pattern, $words);
        echo "<div class=\"result\">";
        echo "Array filtrado:<br>";
        echo "<pre>"; print_r($filtered_words); echo "</pre>";
        echo "</div>";
        ?>

        <h2>6. <code>preg_replace_callback()</code> - Reemplazar con una función de callback</h2>
        <p>Realiza una búsqueda de una expresión regular y reemplaza las coincidencias utilizando el resultado de una función de callback.</p>
        <?php
        $text = "Hoy es 15 de Octubre de 2024. Mañana será 16 de Octubre de 2024.";
        $pattern = '/\d{4}/'; // Buscar años de 4 dígitos
        echo "<h3>Ejemplo: Incrementar años encontrados en 1</h3>";
        echo "<p><strong>Cadena:</strong> <code>" . htmlspecialchars($text) . "</code></p>";
        echo "<p><strong>Patrón:</strong> <code>" . htmlspecialchars($pattern) . "</code></p>";
        echo "<div class=\"code-block\"><pre><code>\$new_text = preg_replace_callback(\$pattern,\n    function (\$matches) {\n        return (int)\$matches[0] + 1;\n    },\n    \$text\n);\necho \"Cadena modificada: {\$new_text}\\n\";</code></pre></div>";

        $new_text = preg_replace_callback(
            $pattern,
            function ($matches) {
                return (int)$matches[0] + 1;
            },
            $text
        );
        echo "<div class=\"result\">";
        echo "Cadena modificada: <code>" . htmlspecialchars($new_text) . "</code><br>";
        echo "</div>";
        ?>

        <h2>Modificadores Comunes de Expresiones Regulares</h2>
        <ul>
            <li><code>i</code> (PCRE_CASELESS): Insensible a mayúsculas y minúsculas.</li>
            <li><code>m</code> (PCRE_MULTILINE): Permite que `^` y `$` coincidan con el inicio/fin de cada línea (no solo de la cadena completa).</li>
            <li><code>s</code> (PCRE_DOTALL): Permite que el punto (`.`) coincida con saltos de línea.</li>
            <li><code>U</code> (PCRE_UNGREEDY): Invierte la 'codicia' de los cuantificadores (haciéndolos no codiciosos por defecto).</li>
            <li><code>x</code> (PCRE_EXTENDED): Permite espacios en blanco y comentarios dentro del patrón para mayor legibilidad.</li>
            <li><code>A</code> (PCRE_ANCHORED): El patrón debe coincidir solo al principio de la cadena.</li>
            <li><code>D</code> (PCRE_DOLLAR_ENDONLY): El `$` solo coincide con el final de la cadena.</li>
            <li><code>u</code> (PCRE_UTF8): Trata el patrón y la cadena como UTF-8. Es muy importante para trabajar con caracteres no ASCII.</li>
        </ul>

        <h2>Ejemplo de Modificador <code>u</code> (UTF-8)</h2>
        <?php
        $string_utf8 = "El café está frío. Ciudad: Düsseldorf.";
        $pattern_utf8_bad = '/\b\w+\b/i'; // Sin modificador 'u', puede fallar con caracteres especiales
        $pattern_utf8_good = '/\b\p{L}+\b/u'; // Con modificador 'u' y \p{L} para cualquier letra Unicode
        echo "<h3>Ejemplo: Coincidencia con caracteres UTF-8</h3>";
        echo "<p><strong>Cadena:</strong> <code>" . htmlspecialchars($string_utf8) . "</code></p>";
        echo "<p><strong>Patrón sin 'u':</strong> <code>" . htmlspecialchars($pattern_utf8_bad) . "</code></p>";
        echo "<div class=\"code-block\"><pre><code>preg_match_all(\$pattern_utf8_bad, \$string_utf8, \$matches_bad);\nprint_r(\$matches_bad[0]);</code></pre></div>";
        $matches_bad = [];
        preg_match_all($pattern_utf8_bad, $string_utf8, $matches_bad);
        echo "<div class=\"result\">Resultado sin 'u' (puede omitir 'café', 'Düsseldorf'): <pre>"; print_r($matches_bad[0]); echo "</pre></div>";

        echo "<p><strong>Patrón con 'u' y <code>\\p{L}</code>:</strong> <code>" . htmlspecialchars($pattern_utf8_good) . "</code></p>";
        echo "<div class=\"code-block\"><pre><code>preg_match_all(\$pattern_utf8_good, \$string_utf8, \$matches_good);\nprint_r(\$matches_good[0]);</code></pre></div>";
        $matches_good = [];
        preg_match_all($pattern_utf8_good, $string_utf8, $matches_good);
        echo "<div class=\"result\">Resultado con 'u' (correcto): <pre>"; print_r($matches_good[0]); echo "</pre></div>";
        ?>

    </div>

</body>
</html>