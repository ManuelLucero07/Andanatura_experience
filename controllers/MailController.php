<?php
// Cargar Composer's autoloader
require '../vendor/autoload.php'; // Ajusta la ruta según tu estructura

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarEmail($pdfContent, $datosEmpresa) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'digitalizacion.andanatura@gmail.com';
        $mail->Password   = 'tbjm japs jdxd lmwa'; // Usa contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remitente
        $mail->setFrom('digitalizacion.andanatura@gmail.com', 'Andanatura');

        // Destinatario
        $mail->addAddress($datosEmpresa["correoContacto"]);

        // Configuración contenido
        $mail->isHTML(true);
        $mail->Subject = 'AceleraPyme - Resultado test - ' . $datosEmpresa["nombreEmpresa"];
        $mail->Body = '
            <div style="font-family: Arial, sans-serif; color: black;">
                <b>EMPRESA:</b> ' . $datosEmpresa["nombreEmpresa"] . '<br>
                <b>PERSONA DE CONTACTO:</b> ' . $datosEmpresa["nombreContacto"] . ' ' . $datosEmpresa["apellidoContacto"] . '<br>
                <b>E-MAIL:</b> <span style="color: black;">' . $datosEmpresa["correoContacto"] . '</span><br>
                <b>TELEFONO DE CONTACTO:</b> <span style="color: black;">' . $datosEmpresa["telefonoContacto"] . '</span>
            </div>';
        $mail->AltBody = '<b>Resultados test</b>.';

        // Adjuntar PDF (cadena en memoria)
        $mail->addStringAttachment($pdfContent, 'resultado_test_' . $datosEmpresa["nombreEmpresa"] . '.pdf', 'base64', 'application/pdf');

        // Enviar correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Error al enviar el correo: {$e->getMessage()}";
    }
}
