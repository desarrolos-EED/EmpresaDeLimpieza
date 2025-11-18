<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos POST
    $nombre = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    // $mensaje = trim(filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_SPECIAL_CHARS));
    $mensaje = trim('Aplicación de trabajo recibida de ' . $nombre);

    if (empty($nombre) || empty($email) || empty($mensaje)) {
        die("Error: Todos los campos son obligatorios.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Email inválido.");
    }

    // Validar archivo si existe
    if (!empty($_FILES['archivo']['name'])) {
        // validar tipo, tamaño, etc.
    }

    include './sendmail.php';
    $email = 'andinoduglas95@gmail.com'; // Destinatario fijo
    $mensaje = 'Solicitud de empleo recibida de ' . $nombre . ' con email ' . $email;
    enviarCorreo($email, $nombre, $mensaje);
    // enviarCorreo();
    // header("Location: ../../view/jobs.html");
}
?>