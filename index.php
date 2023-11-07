<?php
    $random = rand(0,999999);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/login.css?v<?php echo $random; ?>">
</head>
<body>
    <div class="modal_mensaje" id="mensaje__sistema">
        <span id="mensaje_texto" class="span_mensaje">Vamos a ver si lo muestra</span>
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
                <h1 class="login_title">Bienvenido</h1>
                <form action="">
                <div class="group">      
                        <input type="text" id="user_login" name="user_login" class="login_input" required  value="caarroyo">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="place_label">Nombre</label>
                    </div>
                    <div class="group">      
                        <input type="password" id="user_password" name="user_password" class="login_input" required autocomplete value="ghostman2502">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="place_label">Contraseña</label>
                        <a href="#" class="icon_login" id="password_eye">
                            <img src="img/eye-closed-svgrepo-com.svg" class="icon_img" id="eye_icon">
                        </a>
                    </div>
                    <div>
                        <a href="#" class="login_link">¿Olvidates tu contraseña?</a>
                    </div>
                    <button id="boton_login" class="button_login">Ingresar</button>
                </form>
            </div>
        </div>
        <div class="wrap_footer">
            <h1>footer</h1>
        </div>
    </div>
    <script src="js/constantes.js?v<?php echo $random; ?>"></script>
    <script src="js/funciones.js?v<?php echo $random; ?>"></script>
    <script src="js/login.js?v<?php echo $random; ?>"></script>
</body>
</html>