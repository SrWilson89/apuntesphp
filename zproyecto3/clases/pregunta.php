<?php
class pregunta {
    public $id_pregunta;
    public $pregunta;
    public $respuestas;
    public $correcta;

    //propiedad genérica
    private $filename = "preguntas.txt";

    /**
     * Constructor de la clase Pregunta.
     * @param int|null $id_pregunta El ID de la pregunta. Puede ser null si es una nueva pregunta.
     * @param string $pregunta El texto de la pregunta.
     * @param array $respuestas Un array con las posibles respuestas.
     * @param int $correcta El índice (0-basado) de la respuesta correcta dentro del array $respuestas.
     */
    function __construct (
        $id_pregunta, // Anotación: Para PHP 7.1+ se puede tipar como ?int para indicar que puede ser null o int.
        string $pregunta,
        array $respuestas,
        int $correcta
    ){
        // Anotación: Es una buena práctica inicializar todas las propiedades en el constructor.
        $this->id_pregunta = $id_pregunta;
        $this->pregunta = $pregunta;
        $this->respuestas = $respuestas;
        $this->correcta = $correcta;
    }

    /**
     * Guarda la pregunta en el archivo de texto.
     * Asigna un ID si la pregunta es nueva (id_pregunta es null).
     *
     * Anotación importante: La forma actual de asignar el ID (contando todas las preguntas)
     * puede llevar a IDs duplicados si se borran preguntas o si se manejan concurrentemente.
     * Para un sistema más robusto, se debería considerar un método de ID único
     * (UUIDs, autoincrementales en BD, o un contador persistente).
     * Para este archivo plano, el enfoque actual es simple pero tiene limitaciones.
     */
    function save(){
        // Anotación: Se podría hacer una validación aquí para asegurar que la pregunta y respuestas son válidas antes de guardar.
        if ($this->id_pregunta === null) // Anotación: Usar === (identidad) en lugar de == para verificar si es realmente null y no solo falso.
        {
            // Anotación: El método getLastId() está contando el número total de líneas/objetos en el archivo.
            // Si el archivo ya tiene 10 preguntas (IDs del 0 al 9), la siguiente será la 10.
            // Esto es funcional para este caso, pero como se mencionó, no es infalible para IDs únicos.
            $this->id_pregunta = $this->getLastId();
        }

        // Anotación: Es crucial manejar los errores de apertura de archivo de forma robusta.
        // `or die()` detendrá la ejecución del script, lo cual no es ideal en producción.
        // Se recomienda usar un bloque try-catch o una verificación con `if` y retornar falso/true.
        $myfile = fopen($this->filename, "a");
        if (!$myfile) {
            // Anotación: En un entorno real, se registraría el error y se notificaría al usuario de forma amigable.
            error_log("Error: No se pudo abrir el archivo " . $this->filename . " para escritura.");
            return false; // Indicamos que la operación falló.
        }

        fwrite($myfile, $this->toJSON() . "\n"); // Anotación: Asegurarse de añadir un salto de línea para que cada pregunta esté en una línea separada.
        fclose($myfile);
        return true; // Indicamos que la operación fue exitosa.
    }

    /**
     * Convierte el objeto Pregunta a una cadena JSON.
     * @return string La representación JSON del objeto.
     */
    function toJSON(){
        // Anotación: json_encode por defecto convierte las propiedades públicas.
        // Si hubiera propiedades privadas que necesiten ser incluidas, se puede implementar la interfaz JsonSerializable.
        return json_encode($this);
    }

    /**
     * Obtiene el último ID disponible basándose en el número de preguntas existentes.
     * Anotación: Esto asume que los IDs son secuenciales y no hay huecos.
     * Es una forma sencilla para un archivo plano.
     * @return int El siguiente ID disponible.
     */
    function getLastId(): int{
        // Anotación: Se debe tener cuidado con `getAll()` ya que lee todo el archivo.
        // Para archivos muy grandes, esto podría ser ineficiente.
        // Una alternativa sería mantener un contador de ID en un archivo separado o en la primera línea del archivo.
        return count($this->getAll());
    }

    /**
     * Recupera todas las preguntas del archivo de texto.
     * Cada línea del archivo se espera que sea un objeto JSON de una pregunta.
     * @return array Un array de objetos Pregunta.
     */
    function getAll(): array {
        $salida = array(); // Anotación: Inicializar el array de salida es una buena práctica.

        if (!file_exists($this->filename)) {
            return $salida; // Anotación: Si el archivo no existe, no hay preguntas, así que se devuelve un array vacío.
        }

        // Anotación: `filesize()` devuelve el tamaño en bytes. Leer el archivo línea por línea es mejor que leer todo de golpe si es muy grande.
        // Obtener el tamaño del archivo
        $fileSize = filesize($this->filename);

        // Si el archivo está vacío, no hay nada que leer, así que devolvemos un array vacío
        if ($fileSize === 0) { // Anotación: Verificación correcta para archivo vacío.
            return $salida;
        }

        // 1. Abrir el archivo con permisos de lectura línea por línea
        // Anotación: `or die()` debe ser reemplazado por un manejo de errores más elegante.
        $myfile = fopen($this->filename, "r");
        if (!$myfile) {
            error_log("Error: No se pudo abrir el archivo " . $this->filename . " para lectura.");
            return $salida; // Devolver array vacío en caso de error.
        }

        $lineas = array();
        // Anotación: fgets($myfile, $fileSize + 1) es una forma ineficiente de leer línea por línea.
        // fgets sin el segundo argumento (o con un valor pequeño como 4096) lee hasta el salto de línea o EOF.
        // Leer el archivo completo con `file()` o `file_get_contents()` y luego explotar por líneas es a menudo más simple
        // para archivos no extremadamente grandes, o simplemente iterar con `fgets` sin el tamaño máximo.
        if ($myfile) { // Anotación: Esta verificación `if ($myfile)` es redundante porque ya se hizo arriba.
            // Corrección: Leer línea por línea de forma más eficiente.
            while (($buffer = fgets($myfile)) !== false) { // Anotación: fgets() por sí solo lee una línea hasta el final o el límite de memoria por defecto.
                $lineas[] = $buffer;
            }
            if (!feof($myfile)) {
                // Anotación: Este mensaje de error se mostrará en el navegador, lo cual no es ideal.
                // Es mejor registrarlo en un log de errores o usar excepciones.
                error_log("Error: fgets() falló inesperadamente al leer " . $this->filename . "\n");
            }
            fclose($myfile);
        }

        // 2. Descodificar de JSON a objeto
        foreach ($lineas as $value) { // Anotación: No es necesario `$key => $value` si no se usa `$key`.
            // MAL Detrás del IF no puede ir un ";"
            // Anotación: ¡Correcto! Un punto y coma `;` después de un `if` termina la sentencia `if`.
            // Esto significa que el bloque de código `{}` siempre se ejecutaría independientemente de la condición.
            // Corrección: Eliminar el punto y coma.
            $obj = json_decode($value);
            if ($obj !== null) { // Anotación: Verificar si la decodificación JSON fue exitosa. `json_decode` devuelve null en caso de error.
                // Anotación: Es buena práctica verificar si todas las propiedades esperadas existen en $obj
                // antes de intentar acceder a ellas, especialmente si el JSON podría estar mal formado.
                // Por ejemplo: `if (isset($obj->id_pregunta, $obj->pregunta, ...))`

                $item = new pregunta(
                    $obj->id_pregunta,
                    $obj->pregunta,
                    (array) $obj->respuestas, // Anotación: La conversión explícita a (array) es correcta si $obj->respuestas es un objeto JSON o un array.
                    $obj->correcta
                );

                $salida[] = $item;
            } else {
                // Anotación: Si json_decode falla, es útil registrar la línea que causó el problema.
                error_log("Error al decodificar JSON en línea: " . $value);
            }
        }
        return $salida;
    }
}
?>