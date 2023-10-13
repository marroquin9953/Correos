<?php
// Conexión a la base de datos (reemplaza estos valores con los tuyos)
$host = 'nombre_de_tu_host';
$usuario = 'tu_usuario';
$contrasena = 'tu_contraseña';
$base_de_datos = 'nombre_de_tu_base_de_datos';

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta a la base de datos para obtener los clientes
$query = "SELECT * FROM clients WHERE correo != ''";
$result = $conexion->query($query);

if ($result->num_rows > 0) {
    // Directorio de salida para las páginas estáticas
    $outputDirectory = 'paginas_estaticas';

    // Asegurarse de que el directorio de salida exista
    if (!is_dir($outputDirectory)) {
        mkdir($outputDirectory, 0755, true);
    }

    while ($row = $result->fetch_assoc()) {
        // Generar contenido HTML estático para cada cliente
        $clientHTML = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='utf-8'>
    <title>{$row['cliente']}</title>
</head>
<body>
    <h1>{$row['cliente']}</h1>
    <p>Email: {$row['correo']}</p>
    <!-- Más contenido HTML aquí -->
</body>
</html>
        ";

        // Nombre del archivo de salida
        $outputFileName = "{$outputDirectory}/{$row['cliente']}.html";

        // Guardar el contenido HTML en el archivo
        file_put_contents($outputFileName, $clientHTML);
    }

    echo "Páginas HTML estáticas generadas con éxito.";
} else {
    echo "No se encontraron clientes en la base de datos.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
