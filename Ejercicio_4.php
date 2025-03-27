<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Conjuntos</title>
    <link rel="stylesheet" type="text/css" href="recursos/Ejercicio_4.css">
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
        <h2>Ingrese dos conjuntos de números separados por comas</h2>
        <form method="post">
            <input type="text" name="conjuntoA" placeholder="Ejemplo: 1, 2, 3, 4" required>
            <input type="text" name="conjuntoB" placeholder="Ejemplo: 3, 4, 5, 6" required>
            <button type="submit">Calcular</button>
        </form>
    
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            function procesar_conjunto($entrada) {
                return array_unique(array_filter(array_map('intval', explode(',', trim($entrada))), 'is_numeric'));
            }

            $conjuntoA = procesar_conjunto($_POST["conjuntoA"]);
            $conjuntoB = procesar_conjunto($_POST["conjuntoB"]);

            $union = array_unique(array_merge($conjuntoA, $conjuntoB));
            $interseccion = array_values(array_intersect($conjuntoA, $conjuntoB));
            $diferencia_A_B = array_values(array_diff($conjuntoA, $conjuntoB));
            $diferencia_B_A = array_values(array_diff($conjuntoB, $conjuntoA));

            echo "<div class='resultados'>";
            echo "<h3>Resultados:</h3>";
            echo "<p><strong>Unión:</strong> " . implode(", ", $union) . "</p>";
            echo "<p><strong>Intersección:</strong> " . (empty($interseccion) ? "No hay elementos en común" : implode(", ", $interseccion)) . "</p>";
            echo "<p><strong>Diferencia A - B:</strong> " . (empty($diferencia_A_B) ? "No hay elementos únicos en A" : implode(", ", $diferencia_A_B)) . "</p>";
            echo "<p><strong>Diferencia B - A:</strong> " . (empty($diferencia_B_A) ? "No hay elementos únicos en B" : implode(", ", $diferencia_B_A)) . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>