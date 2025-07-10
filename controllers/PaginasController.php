<?php

namespace Controllers;

use MVC\Router;

require 'PDFController.php';
require 'MailController.php';

use Classes\Paginacion;
use GuzzleHttp\Psr7\ServerRequest;

class PaginasController {
    public static function index(Router $router) {  
        
        // Definir los temas o secciones
        $temas = [
            '1. ACCESO A LA INFRAESTRUCTURA DIGITAL',
            '2. DISPONIBILIDAD PRESUPUESTARIA',
            '3. HABILIDADES DIGITALES',
            '4. USO EFECTIVO DE LA TECNOLOGÍA',
            '5. DESIGUALDADES DIGITALES',
            '6. SEGURIDAD DIGITAL Y CUMPLIMIENTO REGULATORIO'
        ];
        
        // Definir las preguntas
        $preguntas = [
            // Preguntas de la Sección 1
            "¿Cómo calificaría la disponibilidad de dispositivos digitales (computadoras, teléfonos móviles, tabletas) en su lugar de trabajo?",
            "¿Cuentan los empleados con acceso constante a internet de alta velocidad en la oficina?",
            "¿El acceso a la tecnología digital está disponible en todas las áreas de la empresa?",
            "¿Se actualizan sus sistemas y software regularmente para asegurar un buen rendimiento?",
            "¿Los empleados tienen acceso remoto seguro a los sistemas de la empresa (por ejemplo, mediante VPNs o trabajo en la nube)?",
            "¿Tienen planes para prevenir fallos en la infraestructura digital, como copias de seguridad o planes de recuperación ante desastres?",
            
            // Preguntas de la Sección 2
            "¿Su empresa puede invertir en tecnologías digitales modernas sin afectar significativamente otros presupuestos?",
            "¿Su empresa se asegura de que los costes de conectividad (internet de alta velocidad) sean accesibles para todos los empleados, incluidos aquellos que trabajan desde áreas remotas?",
            "¿La empresa ofrece apoyo o subsidios para que los empleados obtengan dispositivos o servicios de internet para trabajar desde casa?",

            // Preguntas de la Sección 3
            "¿Cómo calificaría el nivel general de habilidades digitales (conocimiento tecnológico) de los empleados en su empresa?",
            "¿La empresa ofrece capacitación continua para mejorar las habilidades digitales de los empleados (como cursos de software, ciberseguridad, programación)?", 
            "¿Los empleados son capaces de resolver problemas tecnológicos cotidianos sin necesidad de recurrir constantemente al soporte técnico?",
            "¿Su empresa ofrece formación regular en habilidades digitales básicas (como uso del correo electrónico, redes sociales, mensajería)?",
            "¿Utilizan herramientas de formación online (e-learning) para el desarrollo del personal?",
            "¿El equipo directivo está bien informado sobre transformación digital y tendencias tecnológicas para guiar la innovación en la empresa?",
            "¿Existe un plan estratégico para atraer y retener talento digital en la empresa? ¿Consideran el nivel de habilidades digitales en la selección y retención de empleados?",
            
            // Preguntas de la Sección 4
            "¿Los empleados utilizan regularmente herramientas digitales colaborativas (como Microsoft Teams, Google Workspace, Slack) para trabajar en equipo?",
            "¿La empresa utiliza servicios digitales para tareas cotidianas como facturación electrónica, firmas digitales o plataformas de comercio electrónico?",
            "¿Su empresa vende productos o servicios online mediante sistemas de comercio electrónico?",
            "¿Usan estrategias de marketing digital (SEO, SEM, redes sociales) para atraer clientes y mejorar la presencia online?",
            "¿La empresa utiliza tecnología digital para mejorar la toma de decisiones, como análisis de datos o software de gestión empresarial?",
            "¿Tienen sistemas digitales que automatizan procesos y tareas repetitivas (por ejemplo, CRM, ERP, automatización de marketing)?",
            "¿Utilizan sistemas de análisis de datos (Big Data, Analytics) para mejorar la toma de decisiones?",
            "¿Han adoptado tecnologías emergentes como inteligencia artificial, blockchain o internet de las cosas (IoT) en sus operaciones?",
            "¿Utilizan herramientas de inteligencia artificial para personalizar productos o servicios, o mejorar la atención al cliente?",
            "¿Su empresa usa plataformas colaborativas en la nube para gestionar y almacenar datos?",

            // Preguntas de la Sección 5
            "¿Existen diferencias significativas en el acceso a la tecnología entre los empleados que trabajan en áreas urbanas y aquellos que trabajan en áreas rurales o remotas?",
            "¿Su empresa asegura que todos los empleados, independientemente de su edad o nivel educativo, reciban la misma formación y acceso a herramientas digitales?",
            "¿Cree que la tecnología está integrada de manera equitativa en todos los departamentos de la empresa?",
            "¿La empresa ofrece programas de formación para ayudar a los empleados con menos habilidades digitales a mejorar y cerrar las brechas?",

            // Preguntas de la Sección 6
            "¿Conocen y cumplen con las regulaciones de protección de datos (como el GDPR)?",
            "¿Su empresa cuenta con sistemas de protección, como antivirus, firewall y herramientas de monitoreo de ciberseguridad?",
            "¿Realizan auditorías de ciberseguridad para identificar vulnerabilidades en sus sistemas?",
            "¿Tienen un protocolo de actuación en caso de ataques o incidentes de ciberseguridad?",
            "¿Han implementado medidas de seguridad para proteger los datos personales de los clientes, como la encriptación o anonimización?",
            "¿Su empresa utiliza los servicios de administración electrónica (como facturación electrónica y trámites digitales con la administración pública)?",
            "¿Su empresa interactúa con los servicios de administración electrónica para trámites fiscales y regulatorios de manera digital?"
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datosEmpresa = array_slice($_POST, 37, 5);
            $puntajes = array_map('strval',array_slice($_POST, 0, 37));;
            $suma = sumarResultados($puntajes);
            $mensaje = obtenerTextoResultante($suma[6]);


            generarPDF($datosEmpresa, $suma, $mensaje, $preguntas, $puntajes, $temas);
        }
        

        // Renderizar la vista con las preguntas paginadas
        $router->render('paginas/test', [
            'preguntas' => $preguntas,
            'temas' => $temas
        ]);
    }
}
