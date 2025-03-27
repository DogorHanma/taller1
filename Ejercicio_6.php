<!DOCTYPE html>
<html>
<head>
    <title>Construcción de Árbol Binario</title>
    <link rel="stylesheet" type="text/css" href="recursos/Ejercicio_6.css">
</head>
<body>
    <header>
        <h1>Menu de acciones</h1>
        <nav>
            <ul>
                <li><a href="Ejercicio_1.php">Ejercicio 1</a></li>
                <li><a href="Ejercicio_2.php">Ejercicio 2</a></li>
                <li><a href="Ejercicio_3.php">Ejercicio 3</a></li>
                <li><a href="Ejercicio_4.php">Ejercicio 4</a></li>
                <li><a href="Ejercicio_5.php">Ejercicio 5</a></li>
                <li><a href="Ejercicio_6.php">Ejercicio 6</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>Ingrese los recorridos del árbol</h2>
        <form method="post">
            <label>Preorden:</label>
            <input type="text" name="preorden" placeholder="Ejemplo: A,B,D,E,C" required>
            <label>Inorden:</label>
            <input type="text" name="inorden" placeholder="Ejemplo: D,B,E,A,C" required>
            <button type="submit">Construir Árbol</button>
        </form>

        <div id="tree-container">
            <svg id="tree-svg" width="500" height="400"></svg>
        </div>

        <?php
        class Nodo {
            public $valor;
            public $izquierda;
            public $derecha;
            
            public function __construct($valor) {
                $this->valor = $valor;
                $this->izquierda = null;
                $this->derecha = null;
            }
        }

        function construirArbol($preorden, $inorden) {
            if (empty($preorden) || empty($inorden)) return null;

            $raizValor = array_shift($preorden);
            $raiz = new Nodo($raizValor);
            
            $pos = array_search($raizValor, $inorden);
            $izquierdaInorden = array_slice($inorden, 0, $pos);
            $derechaInorden = array_slice($inorden, $pos + 1);
            
            $izquierdaPreorden = array_slice($preorden, 0, count($izquierdaInorden));
            $derechaPreorden = array_slice($preorden, count($izquierdaInorden));
            
            $raiz->izquierda = construirArbol($izquierdaPreorden, $izquierdaInorden);
            $raiz->derecha = construirArbol($derechaPreorden, $derechaInorden);
            
            return $raiz;
        }

        function generarSVG($nodo, $x, $y, $dx, $dy, &$svg) {
            if ($nodo == null) return;
            
            static $id = 1;
            $currentId = $id++;
            
            if ($nodo->izquierda) {
                $leftX = $x - $dx;
                $leftY = $y + $dy;
                $svg .= "<line x1='$x' y1='$y' x2='$leftX' y2='$leftY' stroke='black'/>";
                generarSVG($nodo->izquierda, $leftX, $leftY, $dx / 2, $dy, $svg);
            }
            
            if ($nodo->derecha) {
                $rightX = $x + $dx;
                $rightY = $y + $dy;
                $svg .= "<line x1='$x' y1='$y' x2='$rightX' y2='$rightY' stroke='black'/>";
                generarSVG($nodo->derecha, $rightX, $rightY, $dx / 2, $dy, $svg);
            }
            
            $svg .= "<circle cx='$x' cy='$y' r='15' fill='lightblue' stroke='black' stroke-width='2'/>
                     <text x='$x' y='".($y+5)."' text-anchor='middle' font-size='12px' font-family='Arial' fill='black'>$nodo->valor</text>";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $preorden = explode(",", str_replace(" ", "", $_POST["preorden"]));
            $inorden = explode(",", str_replace(" ", "", $_POST["inorden"]));
            
            $arbol = construirArbol($preorden, $inorden);
            
            $svg = "";
            generarSVG($arbol, 250, 50, 100, 70, $svg);
            echo "<script>document.getElementById('tree-svg').innerHTML = `$svg`;</script>";
        }
        ?>
    </div>
</body>
</html>