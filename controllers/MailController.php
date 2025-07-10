<?php
// Cargar Composer's autoloader
require '../vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarEmail($pdfContent, $datosEmpresa) {
    // Instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor de correo SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Servidor SMTP de Gmail
        $mail->SMTPAuth   = true;
        $mail->Username   = 'digitalizacion.andanatura@gmail.com'; // Tu dirección de correo Gmail
        $mail->Password   = 'tbjm japs jdxd lmwa'; // Tu contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remitente
        $mail->setFrom('digitalizacion.andanatura@gmail.com', 'Andanatura');
        

        // Destinatarios
        // $mail->addAddress('jcampos@andanatura.org'); // Correo Julio (SE COMENTA PARA NO ENVIARLO Y QUE TODOS PUEDAN LLENAR FORMULARIO)
        $mail->addAddress($datosEmpresa["correoContacto"]); // Mail cargado por el usuario

        // Contenido del email
        $mail->isHTML(true);  // Configurar formato HTML

        $mail->Subject = 'AceleraPyme - Resultado test - ' . $datosEmpresa["nombreEmpresa"];
        $mail->Body = '
        <div style="font-family: Arial, sans-serif; color: black;">
            <b>EMPRESA:</b> ' . $datosEmpresa["nombreEmpresa"] . '<br>
            <b>PERSONA DE CONTACTO:</b> ' . $datosEmpresa["nombreContacto"] . ' ' . $datosEmpresa["apellidoContacto"] . '<br>
            <b>E-MAIL:</b> <span style="color: black;">' . $datosEmpresa["correoContacto"] . '</span><br>
            <b>TELEFONO DE CONTACTO:</b> <span style="color: black;">' . $datosEmpresa["telefonoContacto"] . '</span>
        </div>';
        
        $mail->AltBody = '<b>Resultados test</b>.';

        // Adjuntar el PDF generado
        $mail->addStringAttachment($pdfContent, 'resultado_test_'.$datosEmpresa["nombreEmpresa"].'.pdf', 'base64', 'application/pdf');
        
        // Enviar el correo
        if ($mail->send()) {
            echo 'El correo ha sido enviado con éxito';
            return true; // Retornar true si el correo fue enviado
        } else {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
            return false; // Retornar false si hubo un error
        }
    } catch (Exception $e) {
        // Captura de errores
        echo "Error al enviar el correo: {$e->getMessage()}";
        return false; // Retornar false en caso de excepción
    }
}
