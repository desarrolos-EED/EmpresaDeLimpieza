<?php
if(isset($_POST) && !empty($_POST)){
    session_start();
    include 'conexion.php';
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $sql = "SELECT sp_login(:user, :pass)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
    $result_user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    $resultado = $result_user[0]['sp_login'];
    if($resultado === 'True'){
        $_SESSION['user'] = $user;
        header("Location: ../../view/adminDashboard.php");
    } else {
        header("Location: ../../view/admin.html?error=Username or password error");
    }
} else {
    header("Location: ../../index.html");
}   
?>