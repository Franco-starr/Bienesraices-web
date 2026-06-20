

<main class="contenedor seccion contenido-centrado">
        <h1 data-cy="heading-login">Iniciar sesion</h1>

        <?php foreach($errores as $error): ?>
        <div data-cy="alerta-login" class="alerta error"><?php echo $error ;?></div>
        <?php endforeach; ?>


        <form data-cy="formulario-login" method="POST" class="formulario" action="/login">
            <fieldset>
                <legend>Email y password</legend>
 
                <label for="email">E-mail</label>
                <input data-cy="input-email" id="email" name="email" type="email" placeholder="Tu Email">
                
                <label for="password">Password</label>
                <input data-cy="input-password" id="password" name="password" type="password" placeholder="Tu password">
            </fieldset>
            <input type="submit" value="iniciar sesion" class="boton boton-verde">
        </form>
    </main>