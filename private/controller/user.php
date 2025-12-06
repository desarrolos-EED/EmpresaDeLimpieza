<?php
if(isset($_POST) && !empty($_POST)){
    // Incluir el archivo de conexión
    require_once 'conexion.php';
    // Obtener y sanitizar los datos del formulario
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashear la contraseña
    $email = htmlspecialchars($_POST['email']);

    try {
        // Preparar la consulta SQL para insertar un nuevo usuario
        $stmt = $conn->prepare("SELECT sp_insertuser(:username, :password, :mail)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':mail', $email);

        // Ejecutar la consulta
        $stmt->execute();

        // Redirigir o mostrar un mensaje de éxito
        header("Location: ../../view/adminDashboard.php?success=success user added");
        exit();

    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        die("Error al agregar usuario: " . $e->getMessage());
    }
}else if (isset($_GET['deleteid'])) {
    // Incluir el archivo de conexión
    require_once 'conexion.php';
    // Obtener y sanitizar el ID del usuario a eliminar
    $userId = intval($_GET['deleteid']);

    try {
        // Preparar la consulta SQL para eliminar el usuario
        $stmt = $conn->prepare("SELECT sp_deleteuser(:id_user)");
        $stmt->bindParam(':id_user', $userId);

        // Ejecutar la consulta
        $stmt->execute();

        // Redirigir o mostrar un mensaje de éxito
        header("Location: ../../view/adminDashboard.php?success=success user deleted");
        exit();

    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else if (isset($_GET["reviewId"])) {
        // Incluir el archivo de conexión
    require_once 'conexion.php';
    // Obtener y sanitizar el ID del usuario a eliminar
    $id_review = (int)$_GET['reviewId'];

    try {
        // Preparar la consulta SQL para eliminar el usuario
        $stmt = $conn->prepare("SELECT sp_deletereview(:id_review)");
        $stmt->bindParam(':id_review', $id_review, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Redirigir o mostrar un mensaje de éxito
        header("Location: ../../view/adminDashboard.php?success=success review deleted");
        exit();

    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else if (isset($_GET["galeryId"])) {
        // Incluir el archivo de conexión
    require_once 'conexion.php';
    // Obtener y sanitizar el ID del usuario a eliminar
    $galeryId = (int)$_GET['galeryId'];

    try {
        // Preparar la consulta SQL para eliminar el usuario
        $query = "SELECT sp_deletereview(".$galeryId.")";
        $stmt = $conn->prepare($query);
        // Ejecutar la consulta
        $stmt->execute();

        // Redirigir o mostrar un mensaje de éxito
        header("Location: ../../view/adminDashboard.php?success=success galery deleted");
        exit();

    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        die("Error al eliminar usuario: " . $e->getMessage());
    }
} else {
    // Si no se enviaron datos, redirigir al formulario
    header("Location: ../../view/adminDashboard.php");
    exit();
}
?>