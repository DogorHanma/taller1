<?php
class AcronymGenerador {
    public static function convertir($frase) {
        $frase_limpia = preg_replace('/[^a-zA-Z0-9\-\s]/', '', $frase);
        $palabras = preg_split('/[\s\-]+/', $frase_limpia);
        $acronimo = strtoupper(implode('', array_map(fn($palabra) => $palabra[0], $palabras)));
        return $acronimo;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $frase_ingresada = $_POST['frase'] ?? '';
    $resultado = AcronymGenerador::convertir($frase_ingresada);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Acrónimos</title>
    <link rel="stylesheet" href="recursos/Ejercicio_1.css">
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
    <h2>Generador de Acrónimos</h2>
    <form method="post">
        <label for="frase">Ingrese una frase:</label>
        <input type="text" id="frase" name="frase" required> 
        <button type="submit">Convertir</button>
    </form>
    
    <?php if (isset($resultado)) : ?>
        <h3>Resultado: <?php echo htmlspecialchars($resultado); ?></h3>
    <?php endif; ?>
</body>
</html>


