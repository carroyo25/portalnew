(function(){
    const $help_link = document.getElementById('register_help');
    const $boton_login = document.getElementById('boton_login');
    const $user_mail = document.getElementById('user_mail');
    const $user_code = document.getElementById('user_code');


    $help_link.onclick = (e) => {
        mostrarMensaje("Este codigo fue proporcionado por el area de RRHH","msj_info");
    }

    $boton_login.onclick = (e) => {
        e.preventDefault();

        try {
            if ($user_mail.value === "") throw new Error("Ingrese un correo electrónico");
            if (!regex.test($user_mail.value)) throw new Error("Ingrese un correo electrónico válido");
            if ($user_code.value === "") throw new Error("Ingrese el codigo del trabajado - enviado por R.R.H.H.");

            const formData = new FormData();
            formData.append('correo',$user_mail.value);
            formData.append('codigo',$user_code.value);
            formData.append('funcion','register');

            fetch ('../inc/login.inc.php',{
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                mostrarMensaje(data.mensaje,data.clase);

                sleep(3000).then(() => {
                    window.location = 'http://localhost/portalnew/';
                }); 
            })
            .catch(error => {
                console.error(error);
            });
        } catch (error) {
            mostrarMensaje(error,"msj_error");
        }

        return false;
    }
})()

function sleep (time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}
