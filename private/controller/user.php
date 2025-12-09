<?php
if(isset($_POST) && !empty($_POST)){
    require_once 'conexion.php';
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = htmlspecialchars($_POST['email']);

    try {
        $stmt = $conn->prepare("CALL sp_insertuser(:username, :password, :mail)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':mail', $email);
        $stmt->execute();

        header("Location: ../../view/adminDashboard.php?success=success user added");
        exit();

    } catch (PDOException $e) {
        die("Error al agregar usuario: " . $e->getMessage());
    }
} else if (isset($_GET['deleteid'])) {
    require_once 'conexion.php';
    $userId = intval($_GET['deleteid']);

    try {
        $stmt = $conn->prepare("CALL sp_deleteuser(:id_user)");
        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: ../../view/adminDashboard.php?success=success user deleted");
        exit();

    } catch (PDOException $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else if (isset($_GET["reviewId"])) {
    require_once 'conexion.php';
    $id_review = (int)$_GET['reviewId'];

    try {
        $stmt = $conn->prepare("CALL sp_togglereviewstatus(:id_review)");
        $stmt->bindParam(':id_review', $id_review, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: ../../view/adminDashboard.php?success=success review deleted");
        exit();

    } catch (PDOException $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else if (isset($_GET["galeryId"])) {
    require_once 'conexion.php';
    $galeryId = (int)$_GET['galeryId'];

    try {
        $stmt = $conn->prepare("CALL sp_deletereview(:galeryId)");
        $stmt->bindParam(':galeryId', $galeryId, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: ../../view/adminDashboard.php?success=success galery deleted");
        exit();

    } catch (PDOException $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else {
    header("Location: ../../view/adminDashboard.php");
    exit();
}
?>
