<?php
class pregunta {
    public $id_pregunta;
    public $pregunta;
    public $respuestas;
    public $correcta;

    //propiedad genérica
    private $filename = "preguntas.txt";

    function __construct (
        $id_pregunta,
        string $pregunta,
        array $respuestas,
        int $correcta
    ){
        $this->id_pregunta = $id_pregunta;
        $this->pregunta = $pregunta;
        $this->respuestas = $respuestas;
        $this->correcta = $correcta;

    }

    function save(){
        if ($this->id_pregunta == null)
        {
            $this->id_pregunta = $this->getLastId();
        }

        $myfile = fopen($this->filename, "a") or die ("Unable to open file");
        fwrite($myfile, $this->toJSON()."\n");
        fclose($myfile);

    }

    function toJSON(){
        return json_encode($this);
    }


    function getLastId():int{
        return count ($this->getAll());

    }


    function getAll() : array {
        $salida = array();


        if (!file_exists($this->filename))
        {
            return $salida;
        }

        // Obtener el tamaño del archivo
        $fileSize = filesize($this->filename);

        // Si el archivo está vacío, no hay nada que leer, así que devolvemos un array vacío
        if ($fileSize === 0) {
            return $salida;
        }

        //1.Abrir el archivo con permisos de lectura línea por línea
        $myfile = fopen($this->filename, "r") or die("Unable to open file!");
        //echo fgets($myfile);
        $lineas = array();
        if ($myfile) {
            // Usa $fileSize como el segundo argumento de fgets.
            // Es buena práctica añadir 1 para asegurar que fgets lea la línea completa,
            // incluyendo el carácter de nueva línea, si es el caso.
            while (($buffer = fgets($myfile, $fileSize + 1)) !== false) {
                $lineas[] = $buffer;
            }
            if (!feof($myfile)) {
            echo "Error: fgets() falló\n";
            }
            fclose($myfile);
        }

        //2. Descodificar de JSON a objeto
        //Imprimir el archivo línea a línea
        foreach ($lineas as $key => $value) {

            //MAL Detrás del IF no puede ir un ";"
            if(json_decode($value) != null)
            {
                $obj = json_decode($value);

                $item = new pregunta(
                    $obj->id_pregunta,
                    $obj->pregunta,
                    (array) $obj->respuestas,
                    $obj->correcta
                );

                $salida[] = $item;
            }
        }
        return $salida;
    }
}
?>
