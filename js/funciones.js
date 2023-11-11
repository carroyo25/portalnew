const mostrarMensaje = (mensaje,clase) => {
    const $ventana_mensaje = document.getElementById("mensaje__sistema");
    const $mensaje_ventana = document.getElementById("mensaje_texto");

    $mensaje_ventana.innerHTML = mensaje;
    $ventana_mensaje.className = "modal_mensaje " + clase;
    $ventana_mensaje.style.right = 0;

    setTimeout(function() {
        $ventana_mensaje.style.right = "-100%";
    },5000)
}

const checkPasswordStrength = (password) => {
    const strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    const mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
    const enoughRegex = new RegExp("(?=.{6,}).*", "g");

    if (false == enoughRegex.test(password)) {
        mensaje = "Minimo 8 caractéres";
    } else if (strongRegex.test(password)) {
        mensaje = "Fuerte";
    } else if (mediumRegex.test(password)) {
        mensaje = "Media";
    } else {
       mensaje = "Debil";
    }


    return mensaje;
}

function sleep (time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}