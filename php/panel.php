<?php
    $random = rand(0,999999);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Portal - RRHH SEPCON</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/portal.css?v<?php echo $random; ?>">
</head>
    <div class="wrap">
        <section class="left_side">
            <div class="left_side_logo">
                <img src="../img/logo.png" alt="">
            </div>
            <div class="left_side_options">
                <div class="left_side_home">
                    <img src="../img/inicio.svg">
                    <a href="#" class="enlace_opcion">Inicio</a>
                </div>
                <div class="menu_acordeon">
                    <p class="title__acordeon">Procesos</p>
                    <nav class="nav">
                        <ul class="list">
                            <li class="list__item">
                                <div class="list__button list__button--click">
                                    <img src="../img/file.svg" class="list__img">
                                    <a href="#" class="nav__link">Gestión de Documentos</a>
                                    <img src="../img/arrow.svg" class="list__arrow">
                                </div>
                                <ul class="list__show">
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Boletas de Pago</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Certificados de Trabajo</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Constancia de CTS</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Constancia de Utilidades</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Perfil de Trabajo</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Solicitudes/Consultas</a></li>
                                </ul>
                            </li>

                            <li class="list__item list__item--click">
                                <div class="list__button list__button--click">
                                    <img src="../img/service.svg" class="list__img">
                                    <a href="#" class="nav__link">Bienestar Social</a>
                                    <img src="../img/arrow.svg" class="list__arrow">
                                </div>
                                <ul class="list__show">
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Planes de Salud</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Noticias</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Boletín de Salud</a></li>
                                </ul>
                            </li>

                            <li class="list__item">
                                <div class="list__button">
                                    <img src="../img/document.svg" class="list__img">
                                    <a href="#" class="nav__link">Reglamentos</a>
                                </div>
                            </li>

                            <li class="list__item list__item--click">
                                <div class="list__button list__button--click">
                                    <img src="../img/inbox.svg" class="list__img">
                                    <a href="#" class="nav__link">Otras Normas y Disposiciones</a>
                                    <img src="../img/arrow.svg" class="list__arrow">
                                </div>
                                <ul class="list__show">
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Pólitica Salarial</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Código de Etica</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">PSPC Inv. y sanción del Hostigamiento Sexual</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Política de Alcohol y Drogas</a></li>
                                    <li class="list__inside"><a href="#" class="nav__link nav__link--inside">Boletín AFP/ONP</a></li>
                                </ul>
                            </li>

                            <li class="list__item">
                                <div class="list__button">
                                    <img src="../img/teach.svg" class="list__img">
                                    <a href="#" class="nav__link">Capacitación</a>
                                </div>
                            </li>

                            <li class="list__item">
                                <div class="list__button">
                                    <img src="../img/elementor.svg" class="list__img">
                                    <a href="#" class="nav__link">Area Legal</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="close_session">
                    <img src="../img/logout.svg">
                    <a href="#" class="enlace_opcion">Cerrar Sesión</a>
                </div>
            </div>
        </section>
        <section class="rigth_side">
            <div class="rigth_side_header">
                <div class="document_rrhh">
                    <div class="file_options">
                        <img src="../img/file.svg" alt="">
                        <a href="#" class="enlace_blanco">Hoja de Movimiento</a>
                    </div>
                </div>
                <div class="info">
                    <div class="info_header">
                        <div class="notify">
                            <img src="../img/email.svg" alt="">
                            <a href="#" class="notify__number">1</a>
                        </div>
                        <div class="notify">
                            <img src="../img/bell.svg" alt="">
                            <a href="#" class="notify__number">1</a>
                        </div>
                    </div>
                    <div class="info_user">
                        Usuario_ejemplo
                        <div class="user_img">
                            <img src="../img/user.svg" class="user__icon">
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="work_area_rigth_side">
                <div class="load_external">
                    <?php include_once( '../php/noticias.php' ); ?>
                </div>
            </div>
        </section>
    </div>
<body>
    <script src="../js/constantes.js?v<?php echo $random; ?>"></script>
    <script src="../js/funciones.js?v<?php echo $random; ?>"></script>
    <script src="../js/portal.js?v<?php echo $random; ?>"></script>
</body>
</html>