<?php
// Incluye el archivo de autoload de Composer
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function enviarCorreo($email, $nombre, $mensaje){

// Datos de configuración del correo
$destinatario_email = 'andinoduglas95@gmail.com';
$destinatario_nombre = 'Nombre del Usuario';
$asunto_correo = 'Registro Exitoso - ' . date('d/m/Y H:i:s');
$cuerpo_html = '<h1>¡Registro Exitoso!</h1><p>Gracias por usar nuestro sistema. Tus datos han sido guardados.</p>';
$cuerpo_texto_plano = 'Registro Exitoso. Gracias por usar nuestro sistema.';


$mail = new PHPMailer(true); // Inicializa PHPMailer

try {
    // 1. Configuración del Servidor SMTP de Brevo
    $mail->isSMTP();
    $mail->Host       = 'smtp-relay.brevo.com';    // <--- REEMPLAZA ESTE HOST SI ES NECESARIO
    $mail->SMTPAuth   = true;
    
    // Credenciales obtenidas de Brevo (SMTP y API)
    // $mail->Username   = '9ba94b001@smtp-brevo.com'; // <--- TU EMAIL
    $mail->Username   = '9ba94b001@smtp-brevo.com'; // <--- TU EMAIL
    $mail->Password   = 'B4rKjcC6sk2GmHgv';       // <--- TU CLAVE SMTP (NO ES TU CONTRASEÑA DE ACCESO)
    
    // Configuración de seguridad y puerto (usa 587 con STARTTLS si 465 falla)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587; // Puerto estándar para STARTTLS
    $mail->CharSet    = 'UTF-8';

    // 2. Remitente
    // *IMPORTANTE: El correo 'setFrom' debe estar registrado y validado en Brevo para poder enviar.
    $mail->setFrom('9ba94b001@smtp-brevo.com', 'desarrollos eed');
    
    // 3. Destinatario
    $mail->addAddress($destinatario_email, $destinatario_nombre);

    // 4. Contenido
    $mail->isHTML(true);
    $mail->Subject = $asunto_correo;
    $mail->Body    = $cuerpo_html;
    $mail->AltBody = $cuerpo_texto_plano;

    // 5. Envío
    $mail->send();
    echo 'El mensaje se envió correctamente a ' . $destinatario_email;

} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error del Mailer: {$mail->ErrorInfo}";
}
}

?>