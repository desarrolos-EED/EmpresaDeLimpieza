<?php
if (isset($_POST) && !empty($_POST)) {
    require_once 'conexion.php';
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = htmlspecialchars($_POST['email']);

    try {
        $stmt = $conn->prepare("CALL sp_insertuser(?,?,?,@p_resultado)");
        $stmt->bind_param("sss", $username, $password,$email);
        $stmt->execute();
        $stmt->close();
        $stmt = $conn->query("SELECT @p_resultado AS resultado");
    
        $result = $stmt->fetch_assoc();
        if ($result) {
            $outcome = $result['resultado'];
            if ($outcome !== 'true') {
                header("Location: ../../view/adminDashboard.php?error=Error adding user");
                exit();
            }
        } else {
            header("Location: ../../view/adminDashboard.php?error=Error retrieving addition result");   
        }

        header("Location: ../../view/adminDashboard.php?success=Success user added");
        exit();

    } catch (PDOException $e) {
        die("Error al agregar usuario: " . $e->getMessage());
    }
} else if (isset($_GET['deleteid'])) {
    require_once 'conexion.php';
    $userId = intval($_GET['deleteid']);

    try {
        $stmt = $conn->prepare("CALL sp_deleteuser(?, @p_resultado)");
        $stmt->bind_Param('s', $userId);
        $stmt->execute();
        $stmt->close();
        $stmt = $conn->query("SELECT @p_resultado AS resultado");
        $result = $stmt->fetch_assoc();
        if ($result) {
            $outcome = $result["resultado"];
            if ($outcome !== 'true') {
                header("Location: ../../view/adminDashboard.php?error=Error deleting user");
                exit();
            }
        } else {
            header("Location: ../../view/adminDashboard.php?error=Error retrieving deletion result");
            exit();
        }


        header("Location: ../../view/adminDashboard.php?success=Success user deleted");
        exit();

    } catch (PDOException $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else if (isset($_GET["reviewId"])) {
    require_once 'conexion.php';
    $id_review = (int) $_GET['reviewId'];

    try {
        $stmt = $conn->prepare("CALL sp_togglereviewstatus(?, @p_resultado)");
        $stmt->bind_Param('s', $id_review);
        $stmt->execute();
        $stmt->close();
        $stmt = $conn->query("SELECT @p_resultado AS resultado");
        $result = $stmt->fetch_assoc();
        if ($result) {
            $outcome = $result['resultado'];
            if ($outcome !== 'true') {
                header("Location: ../../view/adminDashboard.php?error=Error toggling review status");
                exit();
            }
        } else {
            header("Location: ../../view/adminDashboard.php?error=Error retrieving toggle result");
            exit();
        }
        header("Location: ../../view/adminDashboard.php?success=Success review update");
        exit();

    } catch (PDOException $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else if (isset($_GET["galeryId"])) {
    require_once 'conexion.php';
    $galeryId = (int) $_GET['galeryId'];

    try {
        $stmt = $conn->prepare("CALL sp_deletereview(?, @p_resultado)");
        $stmt->bind_Param('s', $galeryId);
        $stmt->execute();
        $stmt->close();
        $stmt = $conn->query("SELECT @p_resultado AS resultado");
        $result = $stmt->fetch_assoc();
        if ($result) {
            $outcome = $result['resultado'];
            if ($outcome !== 'true') {
                header("Location: ../../view/adminDashboard.php?error=Error deleting gallery");
                exit();
            }
        } else {
            header("Location: ../../view/adminDashboard.php?error=Error retrieving deletion result");
            exit();
        }
        header("Location: ../../view/adminDashboard.php?success=Success galery update");
        exit();

    } catch (PDOException $e) {
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else {
    header("Location: ../../view/adminDashboard.php");
    exit();
}
?>