<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos POST
    $parametros = array(
        "name" => isset($_POST['name']) ? trim(filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) : '',
        "mail" => isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '',
        "phone" => isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : ''
    );
    // Aquí puedes agregar la lógica para guardar los datos en la base de datos
    
    // Validar que los campos no estén vacíos
    if(empty($parametros['name']) || empty($parametros['mail']) || empty($parametros['phone'])){
        die("Error: Todos los campos son obligatorios.");
    }

    // Validar formato de email
    if(!filter_var($parametros['mail'], FILTER_VALIDATE_EMAIL)){
        die("Error: El email no es válido.");
    }

    include './conexion.php';
    try {
        $sql = "select sp_insertJobs(:name, :mail, :phone)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $parametros['name'], PDO::PARAM_STR);
        $stmt->bindParam(':mail', $parametros['mail'], PDO::PARAM_STR);
        $stmt->bindParam(':phone', $parametros['phone'], PDO::PARAM_STR);
        $stmt->execute();

        $resultado_out = $stmt->fetchColumn();

        if ($resultado_out && $resultado_out === 'true') {
            header("Location: ../../view/jobs.html?success=true");
            exit();
        } else {
            header("Location: ../../view/jobs.html?error=true");
            exit();
        }
    } catch (PDOException $e) {
        die("Error al enviar la reseña: " . $e->getMessage());
    }
    // Redirigir de vuelta a la página de ofertas de trabajo

}
?>