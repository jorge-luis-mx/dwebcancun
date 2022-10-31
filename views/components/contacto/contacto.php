<?php require_once 'views/components/banner/banner.php' ?>

   <div class="contacto contenedor">
      <div class="caja-contacto-form">
         <div class="contenedor-form">
            <div class="info-contact">
               <div class="info-contacto">
                  <span>Mas información</span>
                  <p class="more-info-contact">Solicita tu cotizacion en nuestro formulario de contacto con gusto estamos para apoyarte y resolver tus dudas.</p>
               </div>
               <form method="post" action=""  id="contactoForm" autocomplete="off" >
                  <div class="inputs">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">Nombre</label>
                        </div>
                        <input type="text" class="form-control iam-input" name="nombre" id="nombre" required>
                        <p class="has-text-danger is-block mt-2 oculto">Nombre es requerido</p>
                     </div>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">Telefono</label>
                        </div>
                        <input type="text" class="form-control iam-input justnumeric" maxlength="10" name="telefono" id="telefono" required>
                        <p class="has-text-danger is-block mt-2 oculto">Telefono es requerido</p>
                     </div>
                  </div>
               
                  <div class="inputs">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">Correo</label>
                        </div>
                        <input type="text" class="form-control iam-input" name="correo" id="correo" required>
                        <p class="has-text-danger is-block mt-2 oculto">Correo es requerido</p>
                     </div>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">Pais</label>
                        </div>
                        <input type="text" class="form-control iam-input" name="pais" id="pais" required>
                        <p class="has-text-danger is-block mt-2 oculto">Pais es requerido</p>
                     </div>
                  </div>

                  <div class="inputs">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">Estado</label>
                        </div>
                        <input type="text" class="form-control iam-input" name="estado" id="estado" required>
                        <p class="has-text-danger is-block mt-2 oculto">Estado es requerido</p>
                     </div>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">ciudad</label>
                        </div>
                        <input type="text" class="form-control iam-input" name="ciudad" id="ciudad" required>
                        <p class="has-text-danger is-block mt-2 oculto">Ciudad es requerido</p>
                     </div>
                  </div>

                  <div class="inputs-asunto">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">Asunto</label>
                        </div>
                        <input type="text" class="form-control iam-input" name="asunto" id="asunto" required>
                        <p class="has-text-danger is-block mt-2 oculto">Asunto es requerido</p>
                     </div>
                  </div>

                  <div class="inputs-message">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <label for="nombre">Mensaje</label>
                        </div>
                        <textarea class="form-control iam-input" rows="5" name="mensaje" id="mensaje" required></textarea>
                        <p class="has-text-danger is-block mt-2 oculto">Mensaje es requerido</p>
                     </div>
                  </div>
                  <div class="inputs-btn"> 
                     <input  type="submit" value="Enviar Mensaje" id="submitContact">
                  </div>
               </form>
            </div>
         </div>
         <div class="comunicate">
            <div class="caja-contacto-info">
               <div class="mas-info">
                  <ul>
                     <li>
                        <i class="fas fa-phone"></i>
                        998 577 5390
                     </li>
                     <li>
                        <i class="fas fa-envelope"></i>
                        info@devscun.com
                     </li>
                  </ul>
               </div>
               <div class="siguenos">
                  <img src="<?=base_url?>assets/img/redes.png" title="diseño web cancun" alt="imagen de los diseños web cancun"> 
               </div>
            </div>
            
         </div>
      </div>
   </div>