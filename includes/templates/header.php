<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/"><img src="/build/img/logo.svg" alt="logotipo"/></a> 

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono-menu">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/anuncios">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/admin">Admin</a>
                        <?php endif; ?>
                        <?php if($auth): ?>
                            <a href="/cerrar-sesion">Cerrar session</a>
                        <?php endif; ?>
                    </nav>
                </div>

            </div>
            <?php if ($inicio) :?>
         <h1>Venta de casas y departamentos Exclusivos de lujo</h1>
            <?php endif; ?>
        </div> <!--Cierre de la barra-->

      
    </header>