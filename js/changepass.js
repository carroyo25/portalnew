(function(){
    const $boton_login = document.getElementById('boton_login');
   
    const $icon_img = document.getElementById('eye_icon');
    const $icon_img_retype = document.getElementById('eye_icon_retype');
    const $password_container = document.getElementById('password_force');
    const $password_message = document.getElementById('password_force');
    
    const $user_doc = document.getElementById('user_doc');
    const $user_password = document.getElementById('user_password');
    const $user_password_retype = document.getElementById('user_retype_password');
    const $user_mail = document.getElementById('user_mail');


    $icon_img.onclick = (e) => {
        e.preventDefault();

        const icon = $icon_img.src.split('/');
    
        if ( icon[5] == "eye-closed-svgrepo-com.svg") {
            $icon_img.src= "../img/eye-svgrepo-com.svg";
            $user_password.type = "text";
        }else {
            $icon_img.src= "../img/eye-closed-svgrepo-com.svg";
            $user_password.type = "password";
        }

        return false;
    }

    $icon_img_retype.onclick = (e) => {
        e.preventDefault();

        const icon_retype = $icon_img_retype.src.split('/');
    
        if ( icon_retype[5] == "eye-closed-svgrepo-com.svg") {
            $icon_img_retype.src= "../img/eye-svgrepo-com.svg";
            $user_password_retype.type = "text";
        }else {
            $icon_img_retype.src= "../img/eye-closed-svgrepo-com.svg";
            $user_password_retype.type = "password";
        }

        return false;
    }

    $boton_login.onclick = (e) => {
        e.preventDefault();

        try {
            if ($user_doc.value === "") throw new Error("Ingrese su N° de documento");
            if ($user_mail.value === "") throw new Error("Ingrese un correo electrónico");
            if (!regex.test($user_mail.value)) throw new Error("Ingrese un correo electrónico válido");
            if ($user_password.value === '') throw new Error("La contraseña esta en blanco");
            if ($user_password_retype.value === "") throw new Error("Escriba la contraseña nuevamente");
            if ($user_password.value !== $user_password_retype.value) throw new Error("Las contraseñas no son iguales");
            if ($password_message.innerHTML !== 'Media' && $password_message.innerHTML !== 'Fuerte') throw new Error("La contraseña no es válida, escriba otra palabra");

            formData = new FormData();
            formData.append('correo',$user_mail.value);
            formData.append('documento',$user_doc.value);
            formData.append('clave',$user_password.value);
            formData.append('funcion','changePass');

            fetch ('../inc/login.inc.php',{
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.respuesta) {
                    sleep(2000).then(() => {
                        window.location = 'http://localhost/portalnew/';
                    }); 
                }else{
                    mostrarMensaje(data.mensaje,data.clase);
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

    $user_password.onkeydown = () => {
        const password_force = checkPasswordStrength($user_password.value);

        $password_message.innerHTML = password_force;

        switch (password_force) {
            case 'Debil':
                $password_container.style.backgroundImage =`linear-gradient(${'-90deg'}, ${'#FF8A8A'}, ${'#FA0606'})`;
                $password_message.style.color = "#000";
                break;
            case 'Media':
                $password_container.style.backgroundImage =`linear-gradient(${'-90deg'}, ${'#7B7BC6'}, ${'#4E2CE7'})`;
                $password_message.style.color = "#fff";
                break;
            case 'Fuerte':
                $password_container.style.backgroundImage =`linear-gradient(${'-90deg'}, ${'#8EC77B'}, ${'#039525'})`;
                $password_message.style.color = "#fff";
                break;
        }
    }

    //evita que se pueda copiar
    $user_password.onpaste = (e) => {
        e.preventDefault();

        return false;
    }

    $user_password_retype.onpaste = (e) => {
        e.preventDefault();

        return false;
    }
    //----------------------//
})()