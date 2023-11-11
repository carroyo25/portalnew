<?php
    $random = rand(0,999999);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Clave</title>

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
                    <h1 class="login_title">Cambiar Clave</h1>
                    <form action="">
                        <div class="group">      
                            <input type="text" id="user_doc" name="user_doc" class="login_input" required value="20036250">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="place_label">N° Documento</label>
                        </div>
                        <div class="group">      
                            <input type="text" id="user_mail" name="user_mail" class="login_input"  required value="caarroyo@hotmail.com">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="place_label">Correo Electrónico</label>
                        </div>
                        <div class="group">      
                            <input type="password" id="user_password" name="user_password" class="login_input" required autocomplete>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="place_label">Contraseña</label>
                            <a href="#" class="icon_login" id="password_eye">
                                <img src="../img/eye-closed-svgrepo-com.svg" class="icon_img" id="eye_icon">
                            </a>
                        </div>
                        <div class="group">      
                            <input type="password" id="user_retype_password" name="user_retype_password" class="login_input" required autocomplete>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="place_label">Repetir Contraseña</label>
                            <a href="#" class="icon_login" id="password_eye_retype">
                                <img src="../img/eye-closed-svgrepo-com.svg" class="icon_img" id="eye_icon_retype">
                            </a>
                        </div>
                        
                        <div id="password_force" class="gradient_animation">
                            <p id="password_message">Escriba su clave</p>
                        </div>
 
                        <button id="boton_login" class="button_login">Enviar</button>
                    </form>
                </div>
            </div>
            <div class="wrap_footer">
                <h1>footer</h1>
            </div>
        </div>
    <script src="../js/constantes.js?v<?php echo $random; ?>"></script>
    <script src="../js/funciones.js?v<?php echo $random; ?>"></script>
    <script src="../js/changepass.js?v<?php echo $random; ?>"></script>
</body>
</html>