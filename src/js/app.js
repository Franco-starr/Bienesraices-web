document.addEventListener('DOMContentLoaded', function() {
    EventListener();

    darkMode();

});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)')
    const botonDarkMode = document.querySelector('.dark-mode-boton');

    //console.log(prefiereDarkMode.matches)
    
    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    })

    
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode')
    });
};

function EventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    //muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contactar]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
};

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
};

function mostrarMetodosContacto(event) {

    const contactoDiv = document.querySelector('#contacto');

    if(event.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">Numero de telefono</label>
        <input data-cy="input-telefono" id="telefono" type="tel" placeholder="Tu numero" name="contacto[telefono]">
        
        <p>Elija la fecha y la hora para la llamada</p>
        <label for="fecha">fecha</label>
        <input data-cy="input-fecha" id="fecha" type="date" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input data-cy="input-hora" id="hora" type="time" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input data-cy="input-email" id="email" type="email" placeholder="Tu Email" name="contacto[email]" required>
        `;
    }
}
