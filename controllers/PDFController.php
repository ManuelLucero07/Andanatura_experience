<?php
// Mostrar errores para desarrollo (quita en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function generarPDF($datosEmpresa, $suma, $mensaje, $preguntas, $puntajes, $temas) {
    $options = new Options();
    $options->set('defaultFont', 'Courier');
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);

    // Ruta del logo según URL
    $currentPath = $_SERVER['REQUEST_URI'];

    if (strpos($currentPath, 'acelerapyme/test') !== false) {
        $logoPath = '../public/build/img/acelerapyme_logo.jpg';
    } elseif (strpos($currentPath, '/ruralpyme/test') !== false) {
        $logoPath = '../public/build/img/ruralpyme_logo.jpg';
    } else {
        $logoPath = '../public/build/img/ruralpyme_logo.jpg';
    }

    if (!file_exists($logoPath)) {
        die('El archivo de la imagen no existe: ' . $logoPath);
    }

    $imageData = base64_encode(file_get_contents($logoPath));
    $src = 'data:image/jpeg;base64,' . $imageData;

    $html = '
    <style>
        @font-face {
            font-family: "Montserrat";
            src: url("../fonts/Montserrat-Regular.ttf") format("truetype");
        }
        body {
            padding-top: 150px;
            font-family: "Montserrat", sans-serif;
        }
        .fixed-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            z-index: -1;
        }
        .content {
            padding-left: 0;
            padding-right: 30px;
        }
        .preguntas {
            font-family: "Montserrat", sans-serif;
        }
    </style>

    <div class="fixed-image">
        <img src="' . $src . '" alt="Logo" style="width: 100%; height: auto; position:fixed;">
    </div>';

    $html .= '<div class="content">';
    $html .= '<h1 style="text-align: center; margin-bottom: -3rem;">Resultados test - ' . htmlspecialchars(reset($datosEmpresa)) . '</h1>';
    $html .= '<h2 style="text-align: center;"></h2><ol class="preguntas"><br>';

    $html .= '<h2>MADUREZ DIGITAL: RESULTADO DEL TEST</h2>';
    $html .= '<table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">';
    $html .= '<thead><tr><th>Tema</th><th>Resultado</th></tr></thead><tbody>';

    foreach ($temas as $index => $tema) {
        $puntaje = isset($suma[$index]) ? htmlspecialchars($suma[$index] . " (" . $suma[$index + 8] . ")") : 'No disponible';
        $html .= '<tr><td>' . htmlspecialchars($tema) . '</td><td>' . $puntaje . '</td></tr>';
    }

    $html .= '</tbody></table>';
    $html .= '<br> <p style="text-align: justify;">' . $mensaje . '</p>';
    $html .= '<h4>Recomendaciones por bloque</h4>';
    $html .= '<p style="text-align: justify;">' . $suma[7] . '</p>';

    $preguntasYResultados = '';
    $cantidadPreguntas = count($preguntas);

    for ($i = 0; $i < $cantidadPreguntas; $i++) {
        switch ($i) {
            case 0: $preguntasYResultados .= '<h2>' . $temas[0] . '</h2>'; break;
            case 6: $preguntasYResultados .= '<h2>' . $temas[1] . '</h2>'; break;
            case 9: $preguntasYResultados .= '<h2>' . $temas[2] . '</h2>'; break;
            case 16: $preguntasYResultados .= '<h2 style="margin-top: 5px;">' . $temas[3] . '</h2>'; break;
            case 26: $preguntasYResultados .= '<h2 style="margin-top: 10px;">' . $temas[4] . '</h2>'; break;
            case 30: $preguntasYResultados .= '<h2>' . $temas[5] . '</h2>'; break;
        }
        $pregunta = htmlspecialchars($preguntas[$i]);
        $puntaje = $puntajes["pregunta" . $i];
        $preguntasYResultados .= '<li>' . $pregunta . ' <br>Nivel: <b>' . $puntaje . '</b></li><br>';
    }

    $html .= '<h2> SUS RESPUESTAS AL TEST</h2>';
    $html .= $preguntasYResultados;
    $html .= '</ol></div>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Agregar paginación
    $canvas = $dompdf->getCanvas();
    $canvas->page_text(540, 795, "{PAGE_NUM}", 'Helvetica', 10, array(0.4, 0.4, 0.4));

    $pdfContent = $dompdf->output();

    $enviado = enviarEmail($pdfContent, $datosEmpresa);

    if ($enviado === true) {
        mostrarPDF($pdfContent, $datosEmpresa);
    } else {
        // Aquí podrías manejar el error sin imprimir directamente, o mostrar mensaje en la vista
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: '<span class=\"my-custom-content\">El envío falló. Por favor inténtelo de nuevo más tarde.</span>',
                    confirmButtonText: 'Aceptar',
                    width: '600px',
                    padding: '1em',
                    customClass: {
                        title: 'my-custom-title',
                        confirmButton: 'my-custom-button'
                    }
                });
            });
        </script>";
    }
}

function mostrarPDF($pdfContent, $datosEmpresa) {
    if (ob_get_length()) {
        ob_end_clean();
    }

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="resultado_test_' . $datosEmpresa["nombreEmpresa"] . '.pdf"');
    echo $pdfContent;
    exit;
}
