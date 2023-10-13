<?php
// Conexión a la base de datos (si es necesario)
include('config.php');

// Directorio de salida para las páginas estáticas
$directorioSalida = 'paginas_estaticas';

// Asegurarse de que el directorio de salida exista
if (!is_dir($directorioSalida)) {
    mkdir($directorioSalida, 0755, true);
}

// Consulta a la base de datos o lógica para obtener datos (si es necesario)
$QueryInmuebleDetalle = ("SELECT * FROM clients WHERE correo !=''");
$resultadoInmuebleDetalle = mysqli_query($con, $QueryInmuebleDetalle);

while ($dataClientes = mysqli_fetch_array($resultadoInmuebleDetalle)) {
    // Generar contenido HTML estático
    $contenidoHTML = '
    <!DOCTYPE html>
    <html lang="es">
      <head>
        <!-- Encabezado HTML, estilos, metadatos, etc. -->
      </head>
      <body>
        <!-- Contenido HTML estático basado en tus datos dinámicos -->
        <h1>' . $dataClientes['cliente'] . '</h1>
        <p>Correo electrónico: ' . $dataClientes['correo'] . '</p>
        <!-- Otros elementos HTML y estilos -->
      </body>
    </html>
    ';

    // Nombre del archivo de salida (puedes usar una estructura de nombres personalizada)
    $nombreArchivo = $directorioSalida . '/' . $dataClientes['cliente'] . '.html';

    // Guardar el contenido HTML en el archivo de salida
    file_put_contents($nombreArchivo, $contenidoHTML);
}

// Cierre de la conexión a la base de datos (si es necesario)
// ...

echo 'Páginas HTML estáticas generadas con éxito.';
?>
