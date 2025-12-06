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
    $result = $stmt->fetchAll();
    $login = (count($result) > 0);
    if($login){
        $_SESSION['user'] = $user;
        header("Location: ../../view/adminDashboard.php");
    } else {
        header("Location: ../../view/admin.html?error=1");
    }
} else {
    header("Location: ../../index.html");
}   
?>