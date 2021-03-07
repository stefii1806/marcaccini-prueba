<?php

require("class.phpmailer.php");
require("class.smtp.php");


$nombre = $_POST["nombre"];
$email = $_POST["mail"];
$telefono = $_POST["telefono"];
$mensaje = $_POST["mensaje"];

$destinatario = "steelframe@mymintegral.com.ar";

$smtpHost = "mail.mymintegral.com.ar";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "steelframe@mymintegral.com.ar";  // Mi cuenta de correo
$smtpClave = "3jebzJStK3rtKF9";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 587; 
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $mail; // Email desde donde env�o el correo.
$mail->FromName = $nombre;
$mail->AddAddress($destinatario); // Esta es la direcci�n a donde enviamos los datos del formulario

$mail->Subject = "Consulta desde Marcaccini Steel Frame"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "
<html> 

<body> 

<h1>Nuevo mensaje desde el formulario de contacto</h1>

<p>Informacion enviada por el usuario de la web:</p>

<p>Nombre: {$nombre}</p>

<p>Email: {$email}</p>

<p>Teléfono: {$telefono}</p>

<p>mensaje: {$mensaje}</p>

</body> 

</html>

<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n ";


$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);


$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    echo "El correo fue enviado correctamente. Muchas gracias por comunicarse con nosotros.";} 
    else {
    echo "Ocurrió un error inesperado. Por favor, intente nuevamente.";
    exit();
}
?>