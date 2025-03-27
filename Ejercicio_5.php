<?php
class DecimalToBinary {
    private $decimal;
    
    public function __construct($decimal) {
        $this->decimal = $decimal;
    }
    
    public function convert() {
        return decbin($this->decimal);
    }
}
$binario = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['number']) && is_numeric($_POST['number'])) {
        $decimal = (int) $_POST['number'];
        $convertir = new DecimalToBinary($decimal);
        $binario = $convertir->convert();
        $_SESSION['binary'] = $binario;
    } else {
        $error = "Por favor, ingrese un número válido.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binario</title>
    <link rel="stylesheet" href="recursos/Ejercicio_5.css">
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
    <h1>Binario</h1>
    <p>Conversor de decimal a binario</p>
    <form action="" method="POST">
        <label for="number">Ingrese un número entero:</label>
        <input type="number" id="number" name="number" required>
        <button type="submit">Convertir a Binario</button>
    </form>

    <?php if ($binario !== null): ?>
        <h2>Resultado: <?php echo $binario; ?></h2>
    <?php elseif ($error !== null): ?>
        <h2><?php echo $error; ?></h2>
    <?php endif; ?>
</body>
</html>