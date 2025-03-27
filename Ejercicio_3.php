<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Estadísticas</title>
    <link rel="stylesheet" type="text/css" href="recursos/Ejercicio_3.css">
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
        <h2>Ingrese una serie de números separados por comas</h2>
        <form method="post">
            <input type="text" name="numeros" placeholder="Ejemplo: 1, 2, 3, 4.5, 5" required>
            <button type="submit">Calcular</button>
        </form>
    
        <?php
        function calcular_moda($numeros) {
            if (empty($numeros)) {
                return "N/A";
            }
            
            $numeros_str = array_map('strval', $numeros); 
            $frecuencias = array_count_values($numeros_str);
            $max_frecuencia = max($frecuencias);
            
            if ($max_frecuencia == 1) {
                return "No hay moda, ningún número se repite";
            }
            
            $moda = array_keys($frecuencias, $max_frecuencia);
            return implode(", ", $moda);
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $entrada = trim($_POST["numeros"]);
            if (empty($entrada)) {
                echo "<p style='color:red;'>Por favor, ingrese números válidos.</p>";
            } else {
                $numeros = array_filter(array_map('floatval', explode(',', $entrada)), 'is_numeric');
                sort($numeros);
                
                if (count($numeros) > 0) {
                    $promedio = array_sum($numeros) / count($numeros);
                    $n = count($numeros);
                    $mediana = ($n % 2 == 0) ? ($numeros[$n/2 - 1] + $numeros[$n/2]) / 2 : $numeros[floor($n/2)];
                    $moda = calcular_moda($numeros);
                    
                    echo "<div class='resultados'>";
                    echo "<h3>Resultados:</h3>";
                    echo "<p><strong>Promedio:</strong> " . number_format($promedio, 2) . "</p>";
                    echo "<p><strong>Mediana:</strong> " . number_format($mediana, 2) . "</p>";
                    echo "<p><strong>Moda:</strong> " . $moda . "</p>";
                    echo "</div>";
                } else {
                    echo "<p style='color:red;'>No se ingresaron números válidos.</p>";
                }
            }
        }
        ?>
    </div>
</body>
</html>
</html>