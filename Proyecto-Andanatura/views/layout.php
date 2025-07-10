<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Andanatura</title>
    <link rel="stylesheet" href="../public/build/css/app.css">
</head>
<body>
    
    <?php
    $currentPath = $_SERVER['REQUEST_URI'];

    if (strpos($currentPath, 'acelerapyme/test') !== false) {
        $logoPath = '../public/build/img/acelerapyme_logo.jpg'; // Imagen para acelerapyme
    } elseif (strpos($currentPath, '/ruralpyme/test') !== false) {
        $logoPath = '../public/build/img/ruralpyme_logo.jpg'; // Imagen para ruralpyme
    } else {
        $logoPath = '../public/build/img/ruralpyme_logo.jpg'; // Imagen por defecto
    }
    ?>

    <header class="header <?php echo $inicio ? 'inicio' : '';?>">
        <div class="logo">
            <!-- Mostrar la imagen correcta según la URL -->
            <img src="<?php echo $logoPath; ?>" alt="Logotipo correspondiente">
        </div>
    </header>
    
    <?php echo "$contenido"; ?>
    
    <footer class="footer seccion">
        <p class="copyright">ANDANATURA - Todos los derechos Reservados <?php echo date("Y") ?> &copy;</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/build/js/bundle.min.js"></script>
        
</body>
</html>
