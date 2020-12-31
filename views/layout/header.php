<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Hotel</title>
        <link rel="stylesheet" type="text/css" href="<?=base_url?>/styles/css/styles.css?v=<?php echo(rand()); ?>"/>
    </head>

    <body>
        <!-- Cabecera -->
        <header id="header">
            <?php if(!isset($_SESSION['identity'])): ?>
                <a href="<?=base_url?>user/login_view" class="button_session">Iniciar sesión</a>
            <?php else: ?>
                <a href="<?=base_url?>user/logout" class="button_session">Cerrar sesión</a>
            <?php endif; ?>
            
            <nav class="menu">
                <ul>
                    <li>
                        <a href="<?=base_url?>">Inicio</a>
                    </li>

                    <li>
                        <a href="#">Habitaciones</a>
                    </li>

                    <li>
                        <a href="#">Contactanos</a>
                    </li>

                <?php if(isset($_SESSION['identity'])): ?>
                    <li class="menu_revert">
                        <a href="<?=base_url?>user/index">Mi perfil</a>
                    </li>
                <?php endif; ?>
                </ul>
            </nav>

            <div class="logo">
                <h1>Hotel</h1>
            </div>
        </header>

        <!-- Contenido de la página -->
        <section id="content">