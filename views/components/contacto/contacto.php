<?php require_once 'views/components/banner/banner.php' ?>

   <div class="contacto contenedor">
      <div class="caja-contacto-form">
         <div class="contenedor-form">
            <div class="info-contact">
               <span>Mas información</span>
               <p>Solicita tu cotizacion en nuestro formulario de contacto con gusto estamos para apoyarte y resolver tus dudas.</p>
            </div>
            <form method="post" action="<?=base_url?>success" autocomplete="off">
               <div class="input-group">
                  <div class="input-group-prepend">
                     <label for="nombre">Nombre Completo:</label>
                  </div>
                  <input type="text" class="form-control" name="nombre" required>
               </div>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <label for="nombre">Correo Electronico:</label>
                  </div>
                  <input type="text" class="form-control" name="correo">
               </div>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <label for="nombre">Asunto:</label>
                  </div>
                  <input type="text" class="form-control" name="asunto" >
               </div>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <label for="nombre">Pais:</label>
                  </div>
                  <input type="text" class="form-control" name="pais" >
               </div>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <label for="nombre">Estado:</label>
                  </div>
                  <input type="text" class="form-control" name="estado" >
               </div>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <label for="nombre">ciudad:</label>
                  </div>
                  <input type="text" class="form-control" name="ciudad" >
               </div>
               <div class="input-group">
                  <div class="input-group-prepend">
                     <label for="nombre">Mensaje:</label>
                  </div>
                  <textarea class="form-control" rows="5" name="mensaje"></textarea>
               </div>
               <input  type="submit" value="Enviar Mensaje">
            </form>
         </div>
         <div class="comunicate">
            <div class="caja-contacto-info">
               <div class="mas-info">
                  <ul class="mas-info-contacto">
                     <li>
                        <i class="fas fa-phone"></i>
                        998 577 5390
                     </li>
                     <li>
                        <i class="fas fa-envelope"></i>
                        info@dwebcancun.com
                     </li>
                  </ul>
               </div>
            </div>
            <img src="<?=base_url?>assets/img/comunicate.png" title="diseño web cancun" alt="imagen de los diseños web cancun">
            <img src="<?=base_url?>assets/img/redes.png" title="diseño web cancun" alt="imagen de los diseños web cancun">
         </div>
      </div>
   </div>