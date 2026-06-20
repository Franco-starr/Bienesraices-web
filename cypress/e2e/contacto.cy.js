/// <reference types="cypress" />

describe('Prueba el formulario de contacto', () => {
    it('Prueba la pagina de contacto y el envio de emails', () => {
        cy.visit('/contacto');
        cy.get('[data-cy="contacto"]').should('exist');
        cy.get('[data-cy="contacto"]').invoke('text').should('equal', 'Contacto');
        cy.get('[data-cy="contacto"]').invoke('text').should('not.equal', 'formulario de Contacto');


        cy.get('[data-cy="heading-formulario"]').should('exist');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el formulario de contacto');
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'Llena el formulario');
        
        cy.get('[data-cy="formulario-contacto"]').should('exist');
        
    })

    it('Llenar los campos del formulario', () => {
        cy.visit('/contacto');
        cy.get('[data-cy="input-nombre"]').type('Franco Star');
        cy.get('[data-cy="input-mensaje"]').type('Hola para comprar una casa');
        cy.get('[data-cy="input-opciones"]').select('compra');
        cy.get('[data-cy="input-precio"]').type('1000000');
        cy.get('[data-cy="forma-contacto"]').eq(1).check(); //selecciona un radio buttom del formulario
        cy.get('[data-cy="input-email"]').type('ejemplo@ejemplo.com');

        cy.wait(3000);
        cy.get('[data-cy="forma-contacto"]').eq(0).check(); 

        cy.get('[data-cy="input-telefono"]').type('4444444444');
        cy.get('[data-cy="input-fecha"]').type('2026-06-11');
        cy.get('[data-cy="input-hora"]').type('20:40');

        cy.get('[data-cy="formulario-contacto"]').submit();

        cy.get('[data-cy="alerta-envio"]').should('exist');
        cy.get('[data-cy="alerta-envio"]').invoke('text').should('equal', 'Mensaje enviado correctamente');

        cy.get('[data-cy="alerta-envio"]').should('have.class', 'alerta').and('have.class', 'exito').and('not.have.class', 'error');

    
    })

   



})