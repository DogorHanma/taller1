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
</head>
<body>
    <header>
    <h1>Menu de acciones</h1>
        <nav>
            <ul>
                <li><a href="Ejercicio_1.php">Punto 1</a></li>
                <li><a href="p2.php">Punto 2</a></li>
                <li><a href="p3.php">Punto 3</a></li>
                <li><a href="p4.php">Punto 4</a></li>
                <li><a href="p5.php">Punto 5</a></li>
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


