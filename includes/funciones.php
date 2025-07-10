<?php


define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER["DOCUMENT_ROOT"] . '/imagenes/');


function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) {
    $s = htmlspecialchars($html);
    return $s;
}

function obtenerTextoResultante(int $total) {

    // Devuelve el texto correcto dependiendo el resultado total

    $mensajeAlta = "<html> Alta Madurez Digital (150-185 puntos): \n
    Descripción: Su empresa se encuentra en un nivel avanzado de madurez digital. Tiene una infraestructura tecnológica sólida, con acceso equitativo a dispositivos y conectividad. Se aprovechan las tecnologías emergentes, como inteligencia artificial y análisis de datos, y los empleados están bien capacitados en habilidades digitales. Hay un compromiso claro con la seguridad y el cumplimiento de normativas, y se asegura que todos los empleados, incluso los que trabajan en áreas remotas, tienen el acceso necesario a la infraestructura digital. \n
    <b>Recomendaciones generales: </b>  \n
    o Mantén las actualizaciones continuas de infraestructura y formación digital. \n
    o Sigue explorando e implementando nuevas tecnologías para mantener la ventaja competitiva. \n
    o Refuerza la cultura de ciberseguridad y revisa constantemente los protocolos. \n
    o Revisa el plan estratégico para atraer y retener talento digital, asegurándote de adaptarlo a las nuevas tendencias tecnológicas. <br><br><br></html>";

    $mensajeMedia = "Madurez Digital Media (100-149 puntos): \n
    Descripción: Su empresa tiene una buena base tecnológica, pero hay áreas de mejora. Aunque ya existe un acceso adecuado a tecnologías digitales y un enfoque en automatización y análisis de datos, algunas partes de la empresa pueden no estar completamente alineadas. Puede que haya disparidades entre empleados en términos de acceso a la tecnología o formación, o que la empresa no esté utilizando al máximo las nuevas tecnologías. \n
    <b>Recomendaciones generales: </b>  \n
    o Fortalece la formación en habilidades digitales para los empleados, asegurando que los que tienen menos experiencia también reciban entrenamiento. \n
    o Revisa la infraestructura de conectividad, sobre todo para empleados en áreas remotas. \n
    o Evalúa la implementación de tecnologías emergentes y sistemas de automatización en áreas donde aún no se han integrado. \n
    o Refuerza los protocolos de seguridad digital, asegurando que estén actualizados y bien implementados. \n
    o Mejora el uso de herramientas colaborativas y de marketing digital para maximizar la eficiencia operativa y la visibilidad online.";

    $mensajeBaja = "Baja Madurez Digital (Menos de 100 puntos): \n
    Descripción: Su empresa tiene un bajo nivel de madurez digital. Esto significa que existen muchas áreas críticas que necesitan atención, como la infraestructura tecnológica, la capacitación en habilidades digitales, la seguridad cibernética, y la equidad en el acceso a herramientas digitales. La empresa puede estar enfrentando dificultades para adaptarse al entorno digital actual, lo que podría afectar su competitividad y eficiencia. \n
    <b>Recomendaciones generales: </b>  \n
    o Realiza inversiones inmediatas en infraestructura tecnológica y conectividad para asegurar que todos los empleados tengan acceso adecuado. \n
    o Implementa un plan integral de formación en habilidades digitales para todo el personal. \n
    o Refuerza las medidas de seguridad digital, instalando y actualizando sistemas de protección como firewalls, antivirus y herramientas de monitoreo. \n
    o Introduce sistemas de automatización y análisis de datos para mejorar la eficiencia en la toma de decisiones. \n
    o Explora la adopción de tecnologías emergentes que pueden traer ventajas competitivas. \n
    o Revisa el cumplimiento de las normativas de protección de datos, como el GDPR, y asegúrate de implementar medidas de seguridad para proteger los datos de los clientes.";


    if ($total >= 150 && $total <= 185) {
        $mensaje = $mensajeAlta;
    }

    elseif ($total >= 100 && $total <= 149) {
        $mensaje = $mensajeMedia;

    }
    else {
        $mensaje = $mensajeBaja;
    }

    $mensajeConSaltos = nl2br($mensaje);

    $mensajeFinal = 'Su nivel de madurez digital se sitúa en ' . $total . ' de un total de 185. <br />' . $mensajeConSaltos;
    return $mensajeFinal;

}


function sumarResultados($numeros) {

    
    $numerosEtapaUno = array_map('strval', array_slice($numeros, 0, 6));
    $puntajeUno = array_sum($numerosEtapaUno);
    $recomendacionesUno = "";

    if ($puntajeUno >= 24 && $puntajeUno <= 30) {
        $nivelEtapaUno = "Alto";
        $recomendacionesUno = "<b>1. Acceso a la Infraestructura Digital (Máximo: 30 puntos)</b>\n
        Porque obtuviste una puntuación alta (24-30 puntos), significa que la empresa ha invertido en una infraestructura sólida, con dispositivos adecuados, conexión rápida, sistemas actualizados y acceso remoto seguro, junto con planes de contingencia.\n
        Recomendaciones:\n
        o Sigue actualizando la infraestructura: Continúa invirtiendo en nuevas tecnologías como el 5G y actualizaciones de hardware y software.\n
        o Explora tecnologías de vanguardia: Investiga sobre nuevas tecnologías como la computación cuántica (que promete revolucionar la capacidad de procesamiento de datos ) o redes de alta velocidad (como el 5G o incluso el futuro 6G ) para seguir mejorando.\n
        o Mejora la experiencia del usuario: Monitorea la satisfacción de los empleados con las herramientas digitales y ajusta lo necesario para una mejor experiencia.\n\n
        ";
    }
    elseif ($puntajeUno >= 15 && $puntajeUno <= 23) {
        $nivelEtapaUno = "Moderado";
        $recomendacionesUno = "<b>1. Acceso a la Infraestructura Digital (Máximo: 30 puntos)</b>\n
        Porque obtuviste una puntuación moderada (15-23 puntos), esto indica que aunque la empresa tiene acceso a infraestructura digital, existen algunos problemas, como acceso limitado a dispositivos, calidad de conexión, actualización de sistemas o seguridad en el acceso remoto.\n
        Recomendaciones:\n
        o Revisa la distribución de dispositivos: Asegúrate de que todos los empleados, ya sea en la oficina o en remoto, tengan los dispositivos necesarios.\n
        o Mejora la conectividad: Evalúa la calidad del internet en diferentes áreas y garantiza que sea rápida y estable para evitar cuellos de botella.\n
        o Mantén actualizaciones constantes: Asegura que los sistemas y software se actualicen de forma periódica para mejorar rendimiento y seguridad.\n
        o Refuerza el acceso remoto seguro: Fortalece el acceso remoto con VPNs y asegúrate de que todos los empleados tengan acceso a los sistemas necesarios.\n\n
        ";
    }
    else {
        $nivelEtapaUno = "Bajo";
        $recomendacionesUno = "<b>1. Acceso a la Infraestructura Digital (Máximo: 30 puntos)</b>\n
        Porque obtuviste una puntuación baja (0-14 puntos), esto indica que los empleados no tienen acceso adecuado a dispositivos digitales, internet rápido o acceso remoto seguro. Además, los sistemas y el software no se actualizan con regularidad, y no hay planes de contingencia en caso de fallos.\n
        Recomendaciones:\n
        o Mejora la conectividad: Invierte en internet de alta velocidad y redes 5G para asegurar una conexión adecuada tanto en la oficina como para empleados remotos.\n
        o Actualiza la tecnología: Mantén los sistemas y software al día para evitar problemas de seguridad y rendimiento.\n
        o Asegura un acceso remoto seguro: Implementa VPNs y plataformas en la nube para que los empleados puedan trabajar desde cualquier lugar de manera segura.\n
        o Diseña planes de contingencia: Crea estrategias para enfrentar posibles fallos en la infraestructura y para recuperar desastres, como copias de seguridad automáticas. \n
        o Porque obtuviste una puntuación moderada (15-23 puntos), esto indica que aunque la empresa tiene acceso a infraestructura digital, existen algunos problemas, como acceso limitado a dispositivos, calidad de conexión, actualización de sistemas o seguridad en el acceso remoto.\n\n
        ";
    }


    $numerosEtapaDos = array_map('strval',array_slice($numeros, 6, 3));
    $puntajeDos = array_sum($numerosEtapaDos);
    $recomendacionesDos = "";

    if ($puntajeDos >= 12 && $puntajeDos <= 15) {
        $nivelEtapaDos = "Alto";
        $recomendacionesDos = "<b>2. Disponibilidad presupuestaria (Máximo: 15 puntos)</b>\n
        Porque obtuviste una puntuación alta (12-15 puntos), esto indica que los costes de conectividad y dispositivos son asequibles para toda la plantilla, incluyendo los empleados remotos.\n
        Recomendaciones:\n
        o Monitorea continuamente los costes: Revisa regularmente los costes tecnológicos para asegurarte de que siguen siendo razonables.\n
        o Mantén las subvenciones y ayudas: Sigue ofreciendo apoyo financiero para dispositivos y conectividad, ajustando según sea necesario.\n
        o Optimiza el retorno de inversión: Evalúa constantemente si las inversiones en conectividad y tecnología son eficientes y efectivas.\n\n\n\n\n
        ";
    }
    elseif ($puntajeDos >= 8 && $puntajeDos <= 11) {
        $nivelEtapaDos = "Moderado";
        $recomendacionesDos = "<b>2. Disponibilidad presupuestaria (Máximo: 15 puntos)</b>\n
        Porque obtuviste una puntuación moderada (8-11 puntos), esto sugiere que la empresa ha hecho avances para que los costes tecnológicos sean accesibles, pero algunos empleados remotos podrían no recibir suficiente apoyo financiero.\n
        Recomendaciones:\n
        o Optimiza la inversión en conectividad: Si algunos empleados tienen problemas con la conexión a internet, ofrece mayor apoyo financiero o descuentos en servicios.\n
        o Subsidios adicionales para dispositivos: Considera otorgar más ayudas para que los empleados puedan adquirir los dispositivos necesarios para trabajar.\n
        o Evalúa el retorno de inversión: Asegúrate de que los gastos tecnológicos aporten valor a la empresa y busca formas de mejorar la eficiencia sin comprometer la calidad.\n\n\n\n\n
        ";
    }
    else {
        $nivelEtapaDos = "Bajo";
        $recomendacionesDos = "<b>2. Disponibilidad presupuestaria (Máximo: 15 puntos)</b>\n
        Porque obtuviste una puntuación baja (0-7 puntos), esto sugiere que los costes de conectividad y dispositivos tecnológicos no son accesibles para todos los empleados, especialmente para quienes trabajan en áreas remotas. Además, la empresa no proporciona suficientes apoyos financieros para el trabajo remoto.\n
        Recomendaciones:\n
        o Subvenciones para conectividad: Proporciona ayuda financiera para que los empleados puedan acceder a internet rápido, especialmente en zonas rurales.\n
        o Apoyo en la compra de dispositivos: Ofrece subsidios o préstamos para que los empleados adquieran los dispositivos necesarios para trabajar eficientemente desde casa.\n
        o Revisa los costes tecnológicos: Evalúa los gastos relacionados con la tecnología para garantizar que no sean una carga para los empleados o la empresa.\n\n\n\n\n
        ";
    }


    $numerosEtapaTres = array_map('strval',array_slice($numeros, 9, 7));
    $puntajeTres = array_sum($numerosEtapaTres);
    $recomendacionesTres = "";

    if ($puntajeTres >= 28 && $puntajeTres <= 35) {
        $nivelEtapaTres = "Alto";
        $recomendacionesTres = "<b>3. Habilidades Digitales (Máximo: 35 puntos)</b>\n
        Porque obtuviste una puntuación alta (28-35 puntos), esto indica que la empresa ofrece capacitación continua y efectiva tanto a empleados como a directivos, asegurando que todos están bien preparados para el uso de herramientas digitales.\n
        Recomendaciones:\n
        o Fomenta el aprendizaje avanzado: Ofrece programas de formación en tecnologías emergentes como inteligencia artificial, blockchain, y automatización avanzada.\n
        o Promueve la innovación interna: Fomenta proyectos innovadores entre los empleados usando sus nuevas habilidades.\n
        o Asegura la retención de talento: Refuerza los programas de desarrollo profesional y sigue atrayendo talento digital mediante estrategias que incentiven la mejora continua de habilidades.\n\n
        ";
    }
    elseif ($puntajeTres >= 18 && $puntajeTres <= 27) {
        $nivelEtapaTres = "Moderado";
        $recomendacionesTres = "<b>3. Habilidades Digitales (Máximo: 35 puntos)</b>\n
        Porque obtuviste una puntuación moderada (18-27 puntos), esto indica que la empresa ha hecho avances en la formación digital de los empleados, pero aún existen brechas en el nivel de habilidades o capacitación.\n
        Recomendaciones:\n
        o Mejora la formación continua: Aumenta la frecuencia y diversidad de las capacitaciones, enfocándote en áreas como ciberseguridad y análisis de datos. \n
        o Ofrece capacitación avanzada: Complementa las competencias básicas con habilidades avanzadas, como programación o automatización, para preparar a los empleados ante nuevos desafíos tecnológicos.\n
        o Forma a los líderes digitales: Capacita al equipo directivo en las últimas tendencias tecnológicas para que puedan liderar de manera efectiva.\n
        o Revisa la estrategia de retención de talento: Evalúa los planes de atracción y retención de talento digital para asegurarte de que se alinean con las necesidades actuales.\n\n
        ";
    }
    else {
        $nivelEtapaTres= "Bajo";
        $recomendacionesTres = "<b>3. Habilidades Digitales (Máximo: 35 puntos)</b>\n
        Porque obtuviste una puntuación baja (0-17 puntos), esto indica que los empleados carecen de competencias digitales esenciales, la empresa no ofrece suficiente formación, y el equipo directivo no está bien preparado en transformación digital. También puede faltar un plan para atraer y retener talento con habilidades digitales.\n
        Recomendaciones:\n
        o Programas de formación: Implementa capacitaciones regulares para que los empleados adquieran habilidades digitales, desde básicas hasta avanzadas.\n
        o Fortalece el liderazgo digital: Capacita al equipo directivo para que puedan liderar la transformación digital.\n
        o Atrae y retén talento digital: Desarrolla estrategias específicas para atraer y retener empleados con habilidades digitales, incluyendo planes de desarrollo profesional.\n\n
        ";
    }


    $numerosEtapaCuatro = array_map('strval',array_slice($numeros, 16, 10));
    $puntajeCuatro = array_sum($numerosEtapaCuatro);
    $recomendacionesCuatro = "";

    if ($puntajeCuatro >= 42 && $puntajeCuatro <= 50) {
        $nivelEtapaCuatro = "Alto";
        $recomendacionesCuatro = "<b>4. Uso Efectivo de la Tecnología (Máximo: 50 puntos)</b>\n
        Porque obtuviste una puntuación alta (42-50 puntos), esto indica que la empresa está utilizando de manera óptima las herramientas digitales, incluyendo la automatización, comercio electrónico, análisis de datos y marketing digital.\n
        Recomendaciones:\n
        o Explora tecnologías avanzadas: Sigue investigando sobre tecnologías emergentes como inteligencia artificial avanzada, aprendizaje automático, análisis predictivo o la automatización robótica.\n
        o Expande el uso de análisis de datos: Utiliza los datos para predecir tendencias, personalizar servicios y productos, y mejorar la toma de decisiones estratégicas.\n
        o Consolida tu ecosistema digital: Expande tu presencia online y explora nuevas plataformas para aumentar tu visibilidad.\n\n
        ";
    }
    elseif ($puntajeCuatro >= 28 && $puntajeCuatro <= 41) {
        $nivelEtapaCuatro = "Moderado";
        $recomendacionesCuatro = "<b>4. Uso Efectivo de la Tecnología (Máximo: 50 puntos)</b>\n
        Porque obtuviste una puntuación moderada (28-41 puntos), esto refleja que la empresa está usando algunas herramientas digitales, pero todavía hay áreas por mejorar.\n
        Recomendaciones:\n
        o Amplía el uso de herramientas colaborativas: Si ya usas algunas plataformas digitales, expándelas a más áreas de la empresa para mejorar la colaboración y productividad. \n
        o Automatiza más procesos: Evalúa qué otras áreas pueden beneficiarse de la automatización para reducir tareas repetitivas y mejorar la eficiencia.\n
        o Aumenta el uso del análisis de datos: Extiende el uso de Big Data y análisis en más departamentos para mejorar la toma de decisiones.\n
        o Expande el comercio electrónico y marketing digital: Si ya vendes productos o servicios online, explora nuevas formas de mejorar tu presencia online con estrategias más avanzadas de marketing digital.\n\n
        ";
    }
    else {
        $nivelEtapaCuatro= "Bajo";
        $recomendacionesCuatro = "<b>4. Uso Efectivo de la Tecnología (Máximo: 50 puntos)</b>\n
        Porque obtuviste una puntuación baja (0-27 puntos), esto indica que no se están utilizando las herramientas digitales de manera eficiente. Esto puede incluir falta de automatización, comercio electrónico, análisis de datos o marketing digital.\n
        Recomendaciones:\n
        o Implementa herramientas colaborativas: Introduce plataformas como Zoom o Google Workspace para mejorar la colaboración y el trabajo en equipo.\n
        o Automatiza procesos: Adopta herramientas como CRM o ERP para mejorar la eficiencia y reducir la carga de trabajo manual.\n
        o Comercio electrónico y marketing digital: Si aún no lo has hecho, empieza a utilizar el comercio electrónico y el marketing digital (SEO, SEM, redes sociales) para mejorar tu presencia online.\n
        o Análisis de datos: Implementa herramientas de análisis de datos para tomar decisiones más informadas.\n\n
        ";
    }


    $numerosEtapaCinco = array_map('strval',array_slice($numeros, 26, 4));
    $puntajeCinco = array_sum($numerosEtapaCinco);
    $recomendacionesCinco = "";

    if ($puntajeCinco >= 16 && $puntajeCinco <= 20) {
        $nivelEtapaCinco = "Alto";
        $recomendacionesCinco = "<b>5. Desigualdades Digitales (Máximo: 20 puntos)</b>\n
        Porque obtuviste una puntuación alta (16-20 puntos), esto refleja que la empresa ha logrado eliminar las desigualdades en el acceso a la tecnología y las herramientas digitales.\n
        Recomendaciones:\n
        o Mantén la equidad digital: Asegura que las nuevas contrataciones y expansiones también reflejen acceso equitativo a la tecnología.\n
        o Ofrece programas continuos de inclusión digital: Continúa brindando apoyo y formación a los empleados con menos experiencia tecnológica para asegurar que todos estén alineados.\n
        o Mide el impacto de la inclusión digital: Evalúa cómo las iniciativas de equidad digital han mejorado la productividad y satisfacción de los empleados.\n\n
        ";
    }
    elseif ($puntajeCinco >= 10 && $puntajeCinco <= 15) {
        $nivelEtapaCinco = "Moderado";
        $recomendacionesCinco = "<b>5. Desigualdades Digitales (Máximo: 20 puntos)</b>\n
        Porque obtuviste una puntuación moderada (10-15 puntos), esto sugiere que aunque se han realizado esfuerzos para reducir las desigualdades digitales, aún persisten diferencias.\n
        Recomendaciones:\n
        o Promueve la equidad digital: Asegura que todos los empleados tengan acceso a la tecnología necesaria para trabajar, sin importar su ubicación o nivel educativo.\n
        o Cierra la brecha de formación: Ofrece programas adicionales de formación para aquellos que necesiten mejorar sus competencias digitales. \n
        o Distribuye la tecnología de manera equitativa: Revisa cómo se distribuyen los recursos tecnológicos para garantizar que no haya áreas de la empresa rezagadas.\n\n
        ";
    }
    else {
        $nivelEtapaCinco = "Bajo";
        $recomendacionesCinco = "<b>5. Desigualdades Digitales (Máximo: 20 puntos)</b>\n
        Porque obtuviste una puntuación baja (0-9 puntos), esto indica que hay grandes diferencias en el acceso a la tecnología y la formación digital entre empleados de distintas áreas o con diferentes niveles de formación.\n
        Recomendaciones:\n
        o Reduce la brecha digital: Asegura que todos los empleados tengan acceso equitativo a la tecnología, sin importar su ubicación o nivel educativo.\n
        o Ofrece formación inclusiva: Proporciona capacitación a todos los empleados, asegurando que aquellos con menos habilidades digitales reciban apoyo adicional.\n
        o Revisa la equidad tecnológica: Asegúrate de que todos los departamentos tengan acceso equitativo a la tecnología.\n\n
        ";
    }


    $numerosEtapaSeis = array_map('strval',array_slice($numeros, 30, 7));
    $puntajeSeis = array_sum($numerosEtapaSeis);
    $recomendacionesSeis = "";

    if ($puntajeSeis >= 26 && $puntajeSeis <= 35) {
        $nivelEtapaSeis = "Alto";
        $recomendacionesSeis = "<b>6. Seguridad Digital y Cumplimiento Regulatorio (Máximo: 35 puntos)</b>\n
        Porque obtuviste una puntuación alta (26-35 puntos), esto refleja que la empresa tiene sólidas medidas de seguridad y cumple con las normativas de protección de datos, como el GDPR.\n
        Recomendaciones:\n
        o Innovación en ciberseguridad: Invierte en tecnologías más avanzadas como la inteligencia artificial para detectar amenazas o el uso de Blockchain para garantizar la integridad de los datos.\n
        o Monitorea y actualiza constantemente: Asegúrate de que los sistemas de seguridad se mantengan actualizados ante nuevas amenazas. Considera realizar simulaciones de ataques para probar la seguridad.\n
        o Cumple con normativas internacionales: Evalúa si estás preparado para cumplir con otras regulaciones de protección de datos que puedan afectar a tu industria.\n
        o Fomenta una cultura de seguridad: Realiza campañas internas de concienciación para asegurar que todos los empleados están alineados con las mejores prácticas de ciberseguridad.\n\n\n\n\n
        ";
    }
    elseif ($puntajeSeis >= 15 && $puntajeSeis <= 25) {
        $nivelEtapaSeis= "Moderado";
        $recomendacionesSeis = "<b>6. Seguridad Digital y Cumplimiento Regulatorio (Máximo: 35 puntos)</b>\n
        Porque obtuviste una puntuación moderada (15-25 puntos), esto indica que la empresa tiene algunas medidas de ciberseguridad, pero puede haber lagunas en la ejecución de auditorías o en el cumplimiento normativo.\n
        Recomendaciones:\n
        o Mejora la ciberseguridad: Refuerza los sistemas de protección e implementa herramientas adicionales para detectar vulnerabilidades.\n
        o Aumenta la frecuencia de auditorías: Si las auditorías no son regulares, implementa un plan para revisarlas más a menudo y corregir fallos.\n
        o Actualiza los protocolos de seguridad: Asegúrate de que todos los empleados conozcan los protocolos de seguridad y cómo actuar en caso de ataque.\n
        o Cumple con las normativas: Refuerza el cumplimiento de leyes de protección de datos como el GDPR y capacita al personal en el manejo de información sensible.\n\n\n\n\n
        ";
    }
    else {
        $nivelEtapaSeis = "Bajo";
        $recomendacionesSeis = "<b>6. Seguridad Digital y Cumplimiento Regulatorio (Máximo: 35 puntos)</b>\n
        Porque obtuviste una puntuación baja (0-14 puntos), esto refleja que la empresa no tiene suficientes medidas de protección cibernética, como firewalls o antivirus, y no se realizan auditorías de ciberseguridad con regularidad. Además, puede faltar cumplimiento de regulaciones como el GDPR.\n
        Recomendaciones:\n
        o Fortalece la ciberseguridad: Implementa soluciones como firewalls, antivirus y herramientas de monitoreo para prevenir ciberataques.\n
        o Realiza auditorías periódicas: Lleva a cabo auditorías de ciberseguridad para detectar y corregir vulnerabilidades.\n
        o Crea protocolos ante incidentes: Desarrolla planes para actuar rápidamente ante incidentes de seguridad, incluyendo políticas claras de protección de datos.\n
        o Cumple con las normativas: Asegúrate de cumplir con regulaciones como el GDPR y capacita al personal en el manejo seguro de la información.\n\n\n\n\n
        ";
    }

    $resultados = [];
    $recomendacionPorBloque = $recomendacionesUno . $recomendacionesDos . $recomendacionesTres . $recomendacionesCuatro . $recomendacionesCinco . $recomendacionesSeis;

    array_push($resultados, $nivelEtapaUno);
    array_push($resultados, $nivelEtapaDos);
    array_push($resultados, $nivelEtapaTres);
    array_push($resultados, $nivelEtapaCuatro);
    array_push($resultados, $nivelEtapaCinco);
    array_push($resultados, $nivelEtapaSeis);

    $sumaTotal = $puntajeUno + $puntajeDos + $puntajeTres + $puntajeCuatro + $puntajeCinco + $puntajeSeis;
    array_push($resultados, $sumaTotal);

    $mensajeConSaltos = nl2br($recomendacionPorBloque);

    array_push($resultados, $mensajeConSaltos);

    // DEVUELVO TAMBIEN EL PUNTAJE TOTAL DE CADA ETAPA
    array_push($resultados, $puntajeUno);
    array_push($resultados, $puntajeDos);
    array_push($resultados, $puntajeTres);
    array_push($resultados, $puntajeCuatro);
    array_push($resultados, $puntajeCinco);
    array_push($resultados, $puntajeSeis);


    return $resultados;

}
