(function() {
    const acordeon = document.getElementById('acordeon');
    const menus = acordeon.querySelectorAll('acordeon >div');

    const showMenu = (e) => {
        //console.log(e.target);
        const opcion = e.target;

        opcion.nextSibling.remove();
    }

    acordeon.addEventListener("click", showMenu);

    
})()