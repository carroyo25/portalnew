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
                    <p><a href="#" class="enlace_opcion"><img src="../img/home.svg" class="icono_anterior">Inicio</a></p>
                </div>
                <div class="left_side_acordeon">
                    <p>Procesos</p>
                    </br>
                    <div id="acordeon">
                        <div class="link"><a href="#" class="enlace_opcion"><img src="../img/document.svg" class="icono_anterior"> Gestión de Documentos</a><img src="../img/caret-down.svg" class="link_arrow"></div>
                        <div class="link"><a href="#" class="enlace_opcion"><img src="../img/service.svg" class="icono_anterior"> Bienestar Social</a><img src="../img/caret-down.svg" class="link_arrow"></div>
                        <div class="link"><a href="#" class="enlace_opcion"><img src="../img/book.svg" class="icono_anterior"> Reglamentos</a><img src="../img/caret-down.svg" class="link_arrow"></div>
                        <div class="link"><a href="#" class="enlace_opcion"><img src="../img/laws.svg" class="icono_anterior"> Otras Normas y Disposiciones</a><img src="../img/caret-down.svg" class="link_arrow"></div>
                        <div class="link"><a href="#" class="enlace_opcion"><img src="../img/academic.svg" class="icono_anterior"> Capacitación</a><img src="../img/caret-down.svg" class="link_arrow"></div>
                    </div>
                </div>
                <div class="close_session">
                    <p><a href="#" class="enlace_opcion"><img src="../img/logout.svg" class="icono_anterior">Cerrar Sesión</a></p>
                </div>
            </div>
        </section>
        <section class="rigth_side">
            <div class="rigth_side_header">
                <div class="document_rrhh">
                    <a href="#">Hoja de Movimiento</a>
                </div>
                <div class="info">
                    <div class="info_header">
                        <div class="notify1">C</div>
                        <div class="notify2">N</div>
                        <div class="notify3">A</div>
                        <div class="notify4">O</div>
                    </div>
                    <div class="info_user">
                        Usuario_ejemplo
                        <div class="user_img">
                            OC
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="work_area_rigth_side">
                <div class="load_external">

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