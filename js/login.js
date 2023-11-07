(function() {
    const $boton_show_password = document.getElementById('password_eye');
    const $boton_login = document.getElementById('boton_login');
    const $user_login = document.getElementById('user_login');
    const $user_password = document.getElementById('user_password');
    const $icon_img = document.getElementById('eye_icon');

    $icon_img.onclick = (e) => {
        e.preventDefault();
    
        if ( $icon_img.src == URLactual+"img/eye-closed-svgrepo-com.svg") {
            $icon_img.src="img/eye-svgrepo-com.svg";
            $user_password.type = "text";
        }else {
            $icon_img.src="img/eye-closed-svgrepo-com.svg";
            $user_password.type = "password";
        }

        return false;
    }

    $boton_login.onclick = (e) => {
        e.preventDefault();

        try {
            if ($user_login.value === "") throw new Error("Ingrese su usuario");
            if ($user_password.value === "") throw new Error("Ingrese su Clave");

            const formData = new FormData();
            formData.append('funcion','login');
            formData.append('username', $user_login.value);
            formData.append('password', $user_password.value);

            fetch ('inc/login.inc.php',{
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.respuesta) {
                    window.location = data.pagina;
                }else{
                    mostrarMensaje(data.mensaje,data.clase);
                    window.location = data.pagina;
                }
            })
            .catch(error => {
                console.error(error);
            })
        } catch (error) {
            mostrarMensaje(error,"msj_error");
        }

        return false;
    }
})();