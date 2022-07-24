window.addEventListener('DOMContentLoaded', (event) => {

   const menuClick = document.getElementById('btn-menu');
   if(menuClick != null) {
       menuClick.addEventListener('click', (e) => {
         dealsModule.showMenu(e);
       });
   }


   const dealsModule = {

      showMenu: function(e) {
         var btn=document.querySelector(".btn-menu span");
         //realizamos una condicion donde comparamos la clase obtenida es igual igual
         if (btn.getAttribute('class')=='fas fa-bars') {
         //removemos la clase actual y agregamos una nueva clase
         btn.classList.remove('fas', 'fa-bars');
         btn.classList.add('fas','fa-times');
         //nuevamente hacemos queryselector para obtenemos la clase 
         var menu=document.querySelector(".menu-link");
         //mostramos la clase csss y quitar si ya existe
         menu.classList.add("mostrarMenuMovil");
         menu.classList.remove('quitarMenuMovil');
         }else{
         //removemos la clase actual y agregamos una nueva clase
         btn.classList.remove('fas','fa-times');
         btn.classList.add('fas', 'fa-bars');
         var menu=document.querySelector(".menu-link");
         menu.classList.add("quitarMenuMovil");
         menu.classList.remove('mostrarMenuMovil');
         }
      }
   }


});