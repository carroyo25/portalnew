(function() {
   const listElements = document.querySelectorAll('.list__button--click');

   listElements.forEach(listElement => {
      listElement.addEventListener('click',()=>{
         
         //obtiene el numero de elementos del menu 
         let options = listElements.length;

         //limpia todos los elmnetos del menu
         for (let i = 0; i < options; i++) {
            listElements[i].classList.remove('arrow');
            listElements[i].nextElementSibling.style.height = 0;   
         }

         listElement.classList.toggle('arrow');

         let height = 0,
            menu = listElement.nextElementSibling;

            if(menu.clientHeight == 0){
               height = menu.scrollHeight;
            }

            menu.style.height = `${height}px`;
      })
   })

})()