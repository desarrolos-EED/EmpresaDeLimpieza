<?php
if($_SERVER['REQUEST_METHOD'] === "GET"){
    include './conexion.php';
    try {
        $sql = "SELECT * from tbl_imgs where status = true";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($reviews);
    } catch (PDOException $e) {
        die("Error al obtener las reseñas: " . $e->getMessage());
    }
}else if($_SERVER["REQUEST_METHOD"] === "POST"){
    include './conexion.php';
    try {
        if (!isset($_FILES['imageFile']) || $_FILES['imageFile']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("No se envió imagen o hubo un error");
        }
        
        $uploadDir = '../../assets/galery/';
        $fileName = basename($_FILES['imageFile']['name']);
        $filePath = $uploadDir . $fileName;
        if (!move_uploaded_file($_FILES['imageFile']['tmp_name'], $filePath)) {
            throw new Exception("Error al mover el archivo");
        }else{
            $sql = "INSERT INTO tbl_imgs (path_img, comments) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(["../assets/galery/".$fileName, $_POST['imageTitle']]);
            
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Imagen guardada']);
            header("Location: ../../view/adminDashboard.php?success=success image added");
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

}else{
        header("Location: ../../index.php");
    exit();
}
?>