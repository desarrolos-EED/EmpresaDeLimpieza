<?php
if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST)){
    $parametros = array(
        "name" => isset($_POST['name']) ? trim(filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) : '',
        "mail" => isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '',
        "message" => isset($_POST['message']) ? trim(strip_tags($_POST['message']), FILTER_SANITIZE_FULL_SPECIAL_CHARS) : ''
    );

    // Validar que los campos no estén vacíos
    if(empty($parametros['name']) || empty($parametros['mail']) || empty($parametros['message'])){
        die("Error: Todos los campos son obligatorios.");
    }

    // Validar formato de email
    if(!filter_var($parametros['mail'], FILTER_VALIDATE_EMAIL)){
        die("Error: El email no es válido.");
    }

    include './conexion.php';
    try {
        $sql = "CALL sp_insertreview(?, ?, ?, @output);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $parametros['name'], $parametros['mail'], $parametros['message']);
        $stmt->execute();

        $stmt->close();
        
        $resultado = $conn->query("SELECT @output as resultado_out");
        $resultado_out = $resultado->fetch_assoc()['resultado_out'] ?? null;
        if ($resultado_out && $resultado_out === 'true') {
            header("Location: ../../view/review.html?success=true");
            exit();
        } else {
            header("Location: ../../view/review.html?error=true");
            exit();
        }
    } catch (PDOException $e) {
        die("Error al enviar la reseña: " . $e->getMessage());
    }
}
if($_SERVER['REQUEST_METHOD'] === "GET"){
    include './conexion.php';
    try {
        $sql = "SELECT * from tbl_review 
        WHERE STATUS = TRUE 
        ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $reviews = $stmt->get_result();
        $reviews = $reviews->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode(['datos' => $reviews]);
    } catch (PDOException $e) {
        die("Error al obtener las reseñas: " . $e->getMessage());
    }
}
?>