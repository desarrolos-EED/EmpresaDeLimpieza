<?php
if(isset($_POST) && !empty($_POST)){
    session_start();
    
    // Incluir la conexión MySQLi
    include_once('./conexion.php'); 
    
    $user = $_POST['user'];
    $pass = $_POST['password'];
    
    // 1. Declarar la variable para recibir el parámetro de SALIDA (OUT)
    // MySQLi necesita que la variable se defina antes de ser vinculada
    $result_out_var = null; 

    // 2. Consulta con 3 marcadores de posición
    $sql = "CALL sp_login(?, ?, @p_resultado)"; 
    // NOTA: Para parámetros OUT en MySQLi, a menudo es más fácil usar una variable de sesión de MySQL (@p_resultado)
    // y luego seleccionarla, en lugar de vincular la tercera '?' directamente.

    // 3. Preparar la primera sentencia (CALL)
    if ($stmt = $conn->prepare($sql)) {
        
        // Vincular solo los 2 parámetros de ENTRADA (IN)
        $stmt->bind_param("ss", $user, $pass); 
        
        // Ejecutar el CALL. Esto procesa el login y establece el valor en @p_resultado.
        if ($stmt->execute()) {
            
            // Cerrar el statement del CALL
            $stmt->close();
            
            // 4. Obtener el valor de la variable de SALIDA (@p_resultado)
            $result_query = $conn->query("SELECT @p_resultado AS resultado");
            
            if ($result_query) {
                $result_user = $result_query->fetch_assoc();
                $resultado = $result_user['resultado'] ?? null; 
                
                // 5. Procesar el resultado
                if($resultado === 'OK'){
                    $_SESSION['user'] = $user;
                    header("Location: ../../view/adminDashboard.php");
                    exit();
                } else {
                    // El valor devuelto indica fallo
                    header("Location: ../../view/admin.html?error=Username or password error");
                    exit();
                }

            } else {
                // Error al seleccionar la variable OUT
                error_log("Error al seleccionar @p_resultado: " . $conn->error);
                header("Location: ../../view/admin.html?error=Internal server error (Select Error)");
                exit();
            }

        } else {
            // Error en la ejecución del CALL
            error_log("Error en la ejecución del CALL: " . $stmt->error);
            $stmt->close();
            header("Location: ../../view/admin.html?error=Execution Error");
            exit();
        }

    } else {
        // Error al preparar la consulta
        error_log("Error al preparar la consulta MySQLi: " . $conn->error);
        header("Location: ../../view/admin.html?error=Internal server error (Prepare Error)");
        exit();
    }
    
    $conn->close();

} else {
    header("Location: ../../index.html");
    exit();
}
?>