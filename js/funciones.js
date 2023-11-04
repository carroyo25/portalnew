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