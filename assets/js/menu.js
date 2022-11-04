window.addEventListener('DOMContentLoaded', (event) => {
   let localObj = window.location;
   let contextPath = localObj.pathname.split("/")[1];
   let path = localObj.protocol + "//" + localObj.host + "/"+ contextPath;

   const menuClick = document.getElementById('btn-menu');
   if(menuClick != null) {
       menuClick.addEventListener('click', (e) => {
         dealsModule.showMenu(e);
       });
   }

   const buttonContinue = document.getElementById('submitContact');
   if(buttonContinue != null) {
       buttonContinue.addEventListener('click', (e) => {
         
         dealsModule.contactSubmit(path,e);
       })
   }
   
   // Input keypress
   const wereinputs = document.querySelectorAll('.iam-input');
   if(wereinputs != null) {
       wereinputs.forEach((input) => {
           input.addEventListener('keypress', (e) => {
            dealsModule.removeError(e);
           });
       });
   }

   // Is numeric 
   const numericInputs = document.querySelectorAll('.justnumeric');
   if (numericInputs != null) {
       numericInputs.forEach((input) => {
           input.addEventListener('keypress', (e) => {
            dealsModule.justNumeric(e);
           });
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
      },


      contactSubmit: async function(path,e){
         e.preventDefault();
         const contacto = document.getElementById('contactoForm');
         const engine = new FormData(contacto);
 
         const validate = {
            nombre : engine.get('nombre'),
            correo : engine.get('correo'),
            telefono : engine.get('telefono'),
            asunto : engine.get('asunto'),
            pais :   engine.get('pais'),
            estado : engine.get('estado'),
            ciudad : engine.get('ciudad'),
            mensaje : engine.get('mensaje')
         };


         if(validate.nombre == null || validate.nombre == 0 || /^\s+$/.test(validate.nombre)) {
             this.errorActive('nombre');
             return false;
         }
         if(validate.telefono == null || validate.telefono == 0 || /^\s+$/.test(validate.telefono)) {
            this.errorActive('telefono');
            return false;
         }
         if (!(/\w+([-+.']\w+)*@\w+([-.]\w+)/.test(validate.correo))) {
             this.errorActive('correo');
             return false;
         }
 
         if(validate.pais == null || validate.pais == 0 || /^\s+$/.test(validate.pais)) {
            this.errorActive('pais');
            return false;
         }

         if(validate.estado == null || validate.estado == 0 || /^\s+$/.test(validate.estado)) {
            this.errorActive('estado');
            return false;
         } 

         if(validate.ciudad == null || validate.ciudad == 0 || /^\s+$/.test(validate.ciudad)) {
            this.errorActive('ciudad');
            return false;
         }

         if(validate.asunto == null || validate.asunto == 0 || /^\s+$/.test(validate.asunto)) {
            this.errorActive('asunto');
            return false;
         }

         if(validate.mensaje == null || validate.mensaje == 0 || /^\s+$/.test(validate.mensaje)) {
            console.log(validate.mensaje);
             this.errorActive('mensaje');
             return false;
         }

         try {
            const response = await fetch('/controllers/EmailController.php',{
               method: "post",
               body: engine
            });
            let res=await response.json();
            if (res.status==200) {
               Swal.fire(
                  'Mensaje enviado correctamente!',
                  'click en button!',
                  'success'
                )
               const wereinputs = document.querySelectorAll('.iam-input');
               if(wereinputs != null) {
                   wereinputs.forEach((input) => {
                       input.value = "";
                   });
               }

            }
         } catch (e) {
              console.log('fetch failed', e);
         }
          
          
      },
      errorActive: function(idAttr) {

         const input = document.getElementById(`${idAttr}`);
         const error = input.nextElementSibling;
         if (error!=null) {
            error.classList.remove('oculto');
            error.classList.add('mostrar');
            input.focus();
         }
     },
      removeError: function(el) {
         const error = el.target.nextElementSibling;
         // console.log(error)
         if(error.classList.contains('mostrar')) {
            error.classList.remove('mostrar');
            error.classList.add('oculto');
         }
      },
      justNumeric: function(e) {
         if (e.charCode < 48 || e.charCode > 57) {
             e.preventDefault();
             return false;
         }
     }

   }


});