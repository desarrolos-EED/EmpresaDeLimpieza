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
}
?>