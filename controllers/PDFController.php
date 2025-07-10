<?php
// Activa la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function generarPDF($datosEmpresa, $suma, $mensaje, $preguntas, $puntajes, $temas) {
    // Opciones para configurar DOMPDF
    $options = new Options();
    $options->set('defaultFont', 'Courier');
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true); // Habilitar acceso a recursos remotos (para imágenes locales)

    $dompdf = new Dompdf($options);


    $currentPath = $_SERVER['REQUEST_URI'];

    if (strpos($currentPath, 'acelerapyme/test') !== false) {
        $logoPath = '../public/build/img/acelerapyme_logo.jpg'; // Logo para acelerapyme
    } elseif (strpos($currentPath, '/ruralpyme/test') !== false) {
        $logoPath = '../public/build/img/ruralpyme_logo.jpg'; // Logo para ruralpyme
    } else {
        $logoPath = '../public/build/img/ruralpyme_logo.jpg'; // Logo por defecto
    }

    // Verificar si el archivo existe
    if (!file_exists($logoPath)) {
        die('El archivo de la imagen no existe: ' . $logoPath);
    }

    // Convertir la imagen a base64
    $imageData = base64_encode(file_get_contents($logoPath));
    $src = 'data:image/jpeg;base64,' . $imageData;

    // Cargar el contenido HTML
    $html = '
    <style>
        @font-face {
            font-family: "Montserrat";
            src: url("../fonts/Montserrat-Regular.ttf") format("truetype");
        }
        body {
            padding-top: 150px; /* Espacio para el contenido debajo de la imagen */
            font-family: "Montserrat", sans-serif; /* Cambia a la fuente deseada */
        }
        .fixed-image {
            position: fixed; /* Fijo en la parte superior */
            top: 0;
            left: 0;
            width: 100%;
            height: 100px; /* Altura del encabezado */
            z-index: -1; /* Detrás del contenido */
        }
        .content {
            padding-left: 0; 
            padding-right: 30px;
        }
        .preguntas { /* Estilo para las preguntas */
            font-family: "Montserrat", sans-serif;
        }
    </style>

    <div class="fixed-image">
        <img src="' . $src . '" alt="Logo" style="width: 100%; height: auto; position:fixed;">
    </div>';

    // Contenedor para el contenido principal
    $html .= '<div class="content">'; // Añadir margen superior
    $html .= '<h1 style="text-align: center; margin-bottom: -3rem;">Resultados test - ' . htmlspecialchars(reset($datosEmpresa)) . '</h1>';
    $html .= '<h2 style="text-align: center;"></h2><ol class="preguntas"><br>'; // Cambiado <ul> a <ol>

    // Generar la tabla con temas y puntajes
    $html .= '<h2>MADUREZ DIGITAL: RESULTADO DEL TEST</h2>';
    $html .= '<table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">';
    $html .= '<thead><tr><th>Tema</th><th>Resultado</th></tr></thead><tbody>';

    // Usar foreach para llenar la tabla
    foreach ($temas as $index => $tema) {
        $puntaje = isset($suma[$index]) ? htmlspecialchars($suma[$index] . " (" . $suma[$index + 8] . ")") : 'No disponible';
        $html .= '<tr><td>' . htmlspecialchars($tema) . '</td><td>' . $puntaje . '</td></tr>';
    }

    $html .= '</tbody></table>'; // Cerrar la tabla
    // Asegurarse de que el mensaje use la misma fuente
    $html .= '<br> <p style="text-align: justify;">' . ($mensaje) . '</p>';

    //Recomendaciones por bloque
    $html .= '<h4>Recomendaciones por bloque</h4>';
    $html .= '<p style="text-align: justify;">' . ($suma[7]) . '</p>';

    // Inicializar una variable para almacenar las preguntas y resultados
    $preguntasYResultados = '';

    // Asegúrate de que $preguntas y $puntajes tengan la misma longitud
    $cantidadPreguntas = count($preguntas);

    // Recorre cada pregunta y su puntaje correspondiente
    for ($i = 0; $i < $cantidadPreguntas; $i++) {

        switch ($i) {
            case 0:
                $preguntasYResultados .= '<h2>' . $temas[0] . '</h2>';
                break;
            case 6:
                $preguntasYResultados .= '<h2>' . $temas[1] . '</h2>';
                break;
            case 9:
                $preguntasYResultados .= '<h2>' . $temas[2] . '</h2>';
                break;
            case 16:
                $preguntasYResultados .= '<h2 style="margin-top: 5px;">  ' . $temas[3] . '</h2>';
                break;
            case 26:
                $preguntasYResultados .= '<h2 style="margin-top: 10px;">' . $temas[4] . '</h2>';
                break;
            case 30:
                $preguntasYResultados .= '<h2>' . $temas[5] . '</h2>';
                break;
            default:
                break;
        }
        
        $pregunta = htmlspecialchars($preguntas[$i]);
        $puntaje = $puntajes["pregunta" . $i];

        // Concatenar cada resultado a la variable
        $preguntasYResultados .= '<li>' . $pregunta . ' <br>Nivel: <b>' . $puntaje . '</b></li><br>';
    }

    // Añadir los resultados a HTML después del bucle
    $html .= '<h2> SUS RESPUESTAS AL TEST</h2>';
    $html .= $preguntasYResultados;
    $html .= '</ol>'; // Cambiado </ul> a </ol>

    $html .= '</div>'; // Cerrar el contenedor

    // Cargar el contenido HTML en DOMPDF
    $dompdf->loadHtml($html);

    // Configurar el tamaño de papel y la orientación
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $dompdf->render();

    // Añadir paginación al PDF
    $canvas = $dompdf->getCanvas();
    $canvas->page_text(540, 795, "{PAGE_NUM}", 'Helvetica', 10, array(0.4, 0.4, 0.4));


    // Obtener el contenido del PDF generado
    $pdfContent = $dompdf->output();

    // Llamar a la función para enviar el correo con el PDF en memoria
    $enviado = enviarEmail($pdfContent, $datosEmpresa);

     // Mostrar el PDF en el navegador solo si se envió el correo
     if ($enviado) {
         mostrarPDF($pdfContent, $datosEmpresa);
        } else {
        // Prepara un mensaje de error
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: '<span class= my-custom-content>El envío falló. Por favor intentelo de nuevo mas tarde.</span>',
                confirmButtonText: 'Aceptar',
                width: '600px', // Ajusta el ancho a tu preferencia
                padding: '1em', // Agrega un poco de relleno para mejorar el aspecto
                customClass: {
                    title: 'my-custom-title', // Clase personalizada para el título
                    confirmButton: 'my-custom-button' // Clase personalizada para el botón
                }
            });
            });
        </script>";
        }
}

function mostrarPDF($pdfContent, $datosEmpresa) {
    if (ob_get_length()) {
        ob_end_clean(); // Limpiar el buffer de salida si hay algo
    }

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="resultado_test_' . $datosEmpresa["nombreEmpresa"] . '.pdf"');
    echo $pdfContent;
    exit; // Termina la ejecución del script después de mostrar el PDF
}
?>
