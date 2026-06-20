 <main class="contenedor seccion">
        <h1 data-cy="contacto">Contacto</h1>

        <?php 
            if($mensaje) {
                echo "<p data-cy='alerta-envio' class='alerta exito'>" . $mensaje . "</p>";
            } 
        ?>
        <picture>
            <source srcset="/build/img/destacada3.webp" type="image/webp">
             <source srcset="/build/img/destacada3.jpg" type="image/jpeg">
             <img loading="lazy" src="/build/img/destacada3.jpg" alt="imagen contacto">
        </picture>

        <h2 data-cy="heading-formulario">Llene el formulario de contacto</h2>

        <form data-cy="formulario-contacto" class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input data-cy="input-nombre" id="nombre" type="text" placeholder="Tu nombre" name="contacto[nombre]" required>
                
                
                <label for="mensaje">Mensaje</label>
                <textarea data-cy="input-mensaje" id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la propiedad</legend>
                <label for="opciones" >Vende o compra</label>
                <select data-cy="input-opciones" id="opciones" name="contacto[opciones]" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>
                
                <label for="presupuesto" >Precio o presupuesto</label>
                <input data-cy="input-precio"  id="presupuesto" type="number" placeholder="tu presupuesto o Precio" name="contacto[presupuesto]" required>
                
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>
                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input data-cy="forma-contacto" name="contacto[contactar]" type="radio" value="telefono" id="contactar-telefono" required>

                    <label for="contactar-email" >E-mail</label>
                    <input data-cy="forma-contacto" name="contacto[contactar]" type="radio" value="email" id="contactar-email" required>
                </div>

                <div id="contacto"></div>

                </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>

    </main>
