<?php
$host = 'srv865.hstgr.io';
$port = '3306'; // Puerto por defecto de MySQL

// Datos confirmados por tu imagen
$username = "u831665975_dev_ellenclean";     
$dbname = "u831665975_db_ellenclean";    

// ¡IMPORTANTE! Asegúrate de que esta sea la contraseña correcta.
$password = "D3v_Ell3nC7e"; 

// Crear la conexión
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// echo "¡Conexión a Hostinger BD exitosa!";

// $conn->close();
?>
