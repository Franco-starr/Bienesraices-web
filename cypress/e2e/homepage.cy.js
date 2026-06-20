/// <reference types="cypress" />

describe('Carga la pagina principal', () => {
    it('Prueba el header de la pagina principal', () => {
        cy.visit('/');

        //Seleccionar elementos y comprobar que tenga ese elemento o exista
        cy.get('[data-cy="heading-sitio"]').should('exist');
        //Selecciona el elemento con esa clase revisa su texto y comprueba si es igual a ese texto 
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal', 'Venta de casas y departamentos Exclusivos de lujo');

        cy.get('[data-cy="heading-sitio"]').invoke('text').should('not.equal', 'bienes raices');

        
    })

    it('Prueba el header de los iconos principales', () => {
        cy.visit('/');

        //Seleccionar elementos y comprobar que tenga ese elemento o exista
        cy.get('[data-cy="Sobre-nosotros"]').should('exist');
        //Selecciona el elemento y verifica si tiene un elemento html
        cy.get('[data-cy="Sobre-nosotros"]').should('have.prop', 'tagName').should('equal', 'H2');
       
        //selecciona los iconos
        cy.get('[data-cy="iconos-nosotros"]').should('exist');
        //verifica cuantos iconos son (en este caso 3)
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('have.length', 3);
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('not.have.length', 4);
        
    })

    it('Prueba la seccion de propiedades', () => {
        cy.visit('/');
        cy.get('[data-cy="anuncio"]').should('have.length', 3);

        //Porbar el enlace de propiedad
        cy.get('[data-cy="enlace-propiedad"]').should('not.have.class', ' boton-amarillo');

        cy.get('[data-cy="enlace-propiedad"]').first().invoke('text').should('equal', 'Ver Propiedad')

        //Probar un click
        cy.get('[data-cy="enlace-propiedad"]').first().click();
        cy.get('[data-cy="titulo-propiedad"]').should('exist');

        //volver atras
        cy.wait(1000); //espera en milisegundos
        //cy.go('back');
        
    })

    it('Prueba el routing hacia todas las propiedades', () => {
        cy.visit('/');
        cy.get('[data-cy="ver-propiedades"]').should('exist');
        cy.get('[data-cy="ver-propiedades"]').should('have.class', 'boton-verde')
        cy.get('[data-cy="ver-propiedades"]').invoke('attr', 'href').should('equal', '/propiedades');
        
        cy.get('[data-cy="ver-propiedades"]').click();
        cy.get('[data-cy="heading-propiedad"]').invoke('text').should('equal', 'Casas y depas en ventas')
        //volver atras
        cy.wait(1000); //espera en milisegundos
        //cy.go('back');
    
    })

    it('Prueba el Bloque de contacto', () => {
        cy.visit('/');
        cy.get('[data-cy="imagen-contacto"]').should('exist');
        cy.get('[data-cy="imagen-contacto"]').find('h2').invoke('text').should('equal', 'Encuentra la casa de tus sueños')
        cy.get('[data-cy="imagen-contacto"]').find('p').invoke('text').should('equal', 'Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad')        
        cy.get('[data-cy="imagen-contacto"]').find('a').invoke('attr', 'href')
            .then( href => {
                cy.visit(href);
            });
        
        cy.get('[data-cy="contacto"]').should('exist')
        //volver atras
        cy.wait(1000); //espera en milisegundos
        cy.visit('back');
    
    })

    it('Prueba los testimoniales y el blog', () => {
        cy.visit('/');
        cy.get('[data-cy="blog"]').should('exist');
        cy.get('[data-cy="blog"]').find('h3').invoke('text').should('not.equal', 'blog');
        cy.get('[data-cy="blog"]').find('img').should('have.length', 2);


        cy.get('[data-cy="testimoniales"]').should('exist');
        cy.get('[data-cy="testimoniales"]').find('h3').invoke('text').should('not.equal', 'Nuestros Testimoniales');

    })
    
})