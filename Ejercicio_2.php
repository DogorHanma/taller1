<?php
function fibonacci($n) {
    $fib = [0, 1];
    for ($i = 2; $i < $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }
    return implode(", ", array_slice($fib, 0, $n));
}

function factorial($n) {
    $fact = 1;
    for ($i = 1; $i <= $n; $i++) {
        $fact *= $i;
    }
    return $fact;
}

$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = intval($_POST['number']);
    $operation = $_POST['operation'];
    
    if ($operation == "fibonacci") {
        $result = "Sucesión de Fibonacci: " . fibonacci($number);
    } elseif ($operation == "factorial") {
        $result = "Factorial: " . factorial($number);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Serie De Fibonacci / Factorial</title>
</head>
<body>
    <h2>Calculadora Serie De Fibonacci / Factorial</h2>
    <form method="post">
        <label for="number">Ingrese un número:</label>
        <input type="number" name="number" id="number" required min="1">
        <br>
        <label for="operation">Seleccione la operación:</label>
        <select name="operation" id="operation" required>
            <option value="fibonacci">Sucesión de Fibonacci</option>
            <option value="factorial">Factorial</option>
        </select>
        <br>
        <button type="submit">Calcular</button>
    </form>
    
    <?php if ($result): ?>
        <h3>Resultado:</h3>
        <p><?php echo $result; ?></p>
    <?php endif; ?>
</body>
</html>