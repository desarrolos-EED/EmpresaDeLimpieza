<?php
$host = 'localhost';
$port = '5432'; // Puerto por defecto de PostgreSQL
$dbname = 'db_ellenclena';
$user = 'postgres'; // Usuario por defecto
$password = 'administrador';

// Cadena de conexión DSN (Data Source Name)
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    // Crear una nueva instancia de PDO
    $conn = new PDO($dsn, $user, $password);
    
    // Configuración para reportar errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "¡Conexión a PostgreSQL exitosa!";

} catch (PDOException $e) {
    // Si la conexión falla, se captura el error
    die("Error de conexión: " . $e->getMessage());
}
//esto se ponfra feo
?>