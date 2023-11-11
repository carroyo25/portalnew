<?php
    $random = rand(0,999999);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Registro</title>

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/login.css?v<?php echo $random; ?>">

</head>
<body>
    <div class="modal_mensaje" id="mensaje__sistema">
        <span id="mensaje_texto" class="span_mensaje"></span>
    </div>
    <div class="wrap">
        <div class="wrap_header">
            <div class="wrap_header_logo">
                    
            </div>
            <div class="wrap_header_title">
                <span>Portal de Gestión de Recursos Humanos</span>
            </div> 
        </div>
        <div class="wrap_body">
            <div class="login_container">
                <h1 class="login_title">Registro</h1>
                <form action="">
                    <div class="group">      
                        <input type="text" id="user_mail" name="user_mail" class="login_input" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="place_label">Correo Electrónico</label>
                    </div>
                    <div class="group">      
                        <input type="text" id="user_code" name="user_code" class="login_input" required autocomplete>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="place_label">Codigo Trabajador</label>
                        <a href="#" class="icon_login" id="register_help">
                            <img src="../img/question.svg" class="icon_img" id="eye_icon">
                        </a>
                    </div>
                    <button id="boton_login" class="button_login">Registrar</button>
                </form>
            </div>
        </div>
        <div class="wrap_footer">
            <h1>footer</h1>
        </div>
    </div>
    <script src="../js/constantes.js?v<?php echo $random; ?>"></script>
    <script src="../js/funciones.js?v<?php echo $random; ?>"></script>
    <script src="../js/register.js?v<?php echo $random; ?>"></script>
</body>
</html>