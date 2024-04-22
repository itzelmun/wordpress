<?php
// Obtener los valores de las variables de entorno
$endpoint = getenv('WORDPRESS_DB_HOST');
$database = getenv('WORDPRESS_DB_NAME');
$user = getenv('WORDPRESS_DB_USER');
$password = getenv('WORDPRESS_DB_PASSWORD');

// Conectarse a la base de datos
$link = mysqli_connect($endpoint, $user, $password, $database);

// Verificar la conexión
if (!$link) {
    die('Could not connect: ' . mysqli_error());
}

echo 'Connected successfully';

// Cerrar la conexión
mysqli_close($link);
?>
