<?php
    // Mi primera línea de php
    echo "My first PHP script!<br>";

    // Mostrar la versión del php en ejecución
    echo phpversion()."<br>";

    //Definición e inicilización de variables
    $color = "ROJO";
    echo "Mi color es: ".$color."<br>"; //Este es mi comentario
    
    //Variables
    $x = 5; //integer
    $y = "John"; //string

    //Salida de variables
    $txt = "W3Schools.com";
    echo "<br>I love $txt!";

    $txt = "W3Schools.com";
    echo "<br>I love " . $txt . "!";

    $x = 5;
    $y = 4;
    echo "<br>".$x + $y."<br>";

    //Tipo datos PHP
    /*
    String -> Cadena de texto
    Integer -> Número entero
    Float (floating point numbers - also called double) -> Decimales
    Boolean -> TRUE/FALSE
    Array -> Colección de datos
    Object -> Objetos
    NULL -> Nulo
    Resource -> Recursos
    */

    //Averiguar el tipo de variable
    $x = 5;
    var_dump($x);
    echo "<br>";
    $y = "5";
    var_dump($y);
    echo "<br>";
    $y = "5555555";
    var_dump($y);

    //Múltiples variables
    $i = $j = $z = 0;

    //Nivel variables
    /*
    local (función) -> Sólo existe en función
    local (archivo) -> Sólo existe en documento
    global -> Existen en todo el sistema
    static -> Son variables inmutables
    */
    //Ejemplo variable global
    $x = 5; // global scope

    function myTest() {
        // using x inside this function will generate an error
        echo "<p>Variable x inside function is: $x</p>";
    }
    myTest();

    echo "<p>Variable x outside function is: $x</p>";

    //Ejemplo local
    function myTest2() {
        $q = 7; // local scope
        echo "<p>Variable x inside function is: $q</p>";
    }
    myTest2();

    // using x outside the function will generate an error
    echo "<p>Variable x outside function is: $q</p>";

    //Ejemplo variable global
    $x1 = 5;
    $y1 = 10;

    function myTest3() {
        global $x1, $y1;
        $y1 = $x1 + $y1;
    }

    myTest3();
    echo $y1; // outputs 15

    // Estáticas
    function myTest4() {
        static $x2 = 0;
        echo "<br>Salida myTest4: ".$x2;
        $x2++;
    }

    myTest4();
    myTest4();
    myTest4();

    //Print
    print "Hello";
    //same as:
    print("Hello");

    //Resumen de impresion
    /*
    echo();
    var_dump();
    print();
    */

    //Definir array
    echo "<br>";
    $cars = array(); //Array vacío
    $cars = array(2,3,6,4,8);
    $cars = array(2.4, 8.7, 6.9, 4.1);
    $cars = array("Volvo","BMW","Toyota"); //Array inicilizado
    var_dump($cars);
    echo "<br>";
    echo $cars;
    echo "<br>";
    print($cars);

    //Definición de clases
    /**En programación estructurada, instanciar una clase significa crear un 
     * objeto a partir de una definición de clase. Es decir, tomar una plantilla 
     * (la clase) y generar una copia funcional (el objeto) que puede ser utilizada
     * en el programa.  */
    //Encapsulación de variables, métodos y funciones en una clase
    class Car {
        public $color_clase;
        public $model_clase;
        private $matricula = "4785TGR";

        public function __construct($color_input, $model_input) {
            $this->color_clase = $color_input;
            $this->model_clase = $model_input;
        }
    
        public function message() {
            return "My car is a " . $this->color_clase . " " . $this->model_clase . "!";
        }

        public function getColor() {
            return $this->color_clase;
        }

        public function getMatricula() {
            return $this->matricula;
        }

        public function setColor($color_setcolor) {
            $this->color_clase = $color_setcolor;
        }
    }

    //Instanciar una clase Car
    $myCar = new Car("red", "Volvo");
    echo "<br><br>";
    var_dump($myCar);
    //Salida esperada: object(Car)#1 (2) { ["color_clase"]=> string(3) "red" ["model_clase"]=> string(5) "Volvo" }

    //Llamar a la función message() de la clase Car
    $mensaje = $myCar->message();
    echo "<br><br>";
    var_dump($mensaje);
    //Salida esperada: string(22) "My car is a red Volvo!"

    //Obtener el color mediante la función get
    echo "<br><br>";
    var_dump($myCar->getColor());
    //Salida esperada: string(3) "red"

    //Función de salto de línea
    function salto($imprimir = "") {
        return "<br><br>".$imprimir;
    }

    //Obtener el color directamente (porque es público)
    echo salto();
    var_dump($myCar->color_clase);
    //Salida esperada: string(3) "red"

    //Obtener el matrícula directamente (es privada)
    //echo salto();
    //var_dump($myCar->matricula);

    //Obtener la matrícula (privada) desde función (pública)
    echo salto();
    var_dump($myCar->getMatricula());
    //Resultado esperado: string(7) "4785TGR"

    //Cambiar el color de la clase a través de una función
    //1) Tengo un coche ($myCar) con red y Volvo
    //2) Seteo el color a azul (lo cambio)
    echo salto();
    var_dump("Color antiguo: ".$myCar->color_clase);
    echo salto("Cambiando color...");
    $myCar->setColor("Azul");
    echo salto();
    var_dump("Color nuevo: ".$myCar->color_clase);

    //Función salto
    //Sin parámetro de entrada
    echo salto(); //Sólo retornorá un salto de línea

    //Con parámetro de entrada
    echo salto("Mi nuevo texto"); //Restornará un salto de línea más el texto que
    //le he indicado

    //Imprimir el color con función salto
    echo salto("Mi color es: ".$myCar->color_clase);

    //Cast (convertir variable de tipo)
    //Ej. de número a string
    $miNumero = 6; //Ahora es un integer
    echo salto();
    var_dump($miNumero);
    //Salida esperada: int(6)
    $miNumero = (string) $miNumero; //Convertir a string -> Ahora es un string
    echo salto();
    var_dump($miNumero);
    //Salida esperada: string(1) "6"
?>
