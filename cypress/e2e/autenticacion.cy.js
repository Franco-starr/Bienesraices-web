/// <reference types="cypress" />
describe('Probar la autenticacion', () => {
    it('Prueba la auntenticacion del /login', () => {
        cy.visit('/login');
        cy.get('[data-cy="heading-login"]').should('exist');
        cy.get('[data-cy="heading-login"]').should('have.text', 'Iniciar sesion');
        
        cy.get('[data-cy="formulario-login"]').should('exist');

        //Ambos campos son obligatorio
        cy.get('[data-cy="formulario-login"]').should('exist').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El email es obligatorio');
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.text', 'El password es obligatorio');

        //El usuario existe 

        //verificar el password


    })

     it('Muestra un error cuando el usuario no existe', () => {
        cy.visit('/login');

        cy.get('[data-cy="input-email"]')
            .type('noexiste@test.com');

        cy.get('[data-cy="input-password"]')
            .type('123456');

        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="alerta-login"]')
            .should('exist')
            .should('have.class', 'error')
            .should('contain.text', 'El usuario no existe');
    });

     it('Muestra un error cuando el password es incorrecto', () => {
        cy.visit('/login');

        // Debe ser un usuario real de tu BD
        cy.get('[data-cy="input-email"]')
            .type('admin@admin.com');

        cy.get('[data-cy="input-password"]')
            .type('passwordIncorrecto');

        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="alerta-login"]')
            .should('exist')
            .should('have.class', 'error')
            .should('contain.text', 'El usuario no existe');
    });

    it('Inicia sesion correctamente', () => {
    cy.visit('/login');

    cy.get('[data-cy="input-email"]')
        .type('correo@gmail.com');

    cy.get('[data-cy="input-password"]')
        .type('1234'); // contraseña real

    cy.get('[data-cy="formulario-login"]').submit();

    //cy.url().should('include', '/admin');
});

    
})