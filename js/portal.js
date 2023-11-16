(function() {
    const acordeon = document.getElementById('acordeon');
    const link_arrow = document.getElementsByClassName('link_arrow');
    const opciones = document.querySelectorAll('.enlace_opcion');
    const submenu = document.querySelectorAll('.submenu');

    opciones.forEach(opcion  => {
        let id = opcion.getAttribute("href");

        opcion.addEventListener("click",(e) =>{
            e.preventDefault();

            for (let index = 0; index < link_arrow.length; index++) {
                link_arrow[index].style.transform = "rotate(0deg)";
            }

            opcion.nextSibling.style.transform = "rotate(90deg)";

            submenu[id].style.display = "block";

            return false;
        })
    });

    /*const showMenu = (e) => {
        e.preventDefault();
        
        const opcion = e.target;

        

        

        return false
    }*/

    //acordeon.addEventListener("click", showMenu);

    
})()