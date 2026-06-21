# Bienes Raíces MVC

Proyecto de gestión de propiedades inmobiliarias desarrollado en PHP con arquitectura MVC. Permite administrar propiedades y vendedores desde un panel privado, y ofrece una página pública con listado de propiedades, blog y formulario de contacto.

## Tecnologías

- **PHP 8** con arquitectura MVC propia (Router + Active Record)
- **MySQL** para la base de datos
- **Composer** con `phpmailer/phpmailer` (envío de emails via Mailtrap) e `intervention/image` (manipulación de imágenes)
- **Frontend:** Sass, Gulp, JavaScript vanilla
- **Cypress** para testing E2E

## Características

- Panel de administración con autenticación
- CRUD de propiedades y vendedores
- Subida y redimensionamiento de imágenes
- Página pública con listado, blog y contacto
- Envío de formularios por email (SMTP)
- Diseño responsivo

## Instalación

```bash
git clone <repo>
composer install
npm install
cp .env.example .env   # configurar credenciales
```

Configurar el `.env` con los datos de tu base de datos y SMTP, luego importar `sql/bienes_raices.sql` en MySQL y ejecutar `gulp` para compilar assets.

## Panel de administración

El acceso al panel está protegido con autenticación. Las contraseñas se almacenan como hashes de bcrypt (PHP `password_hash`) en la tabla `usuario`.

### Crear un usuario administrador en producción

1. Subí este script temporal al servidor y ejecutalo una vez:

   ```php
   <?php
   echo password_hash('TuContraseña', PASSWORD_DEFAULT);
   ```

2. Copiá el hash generado y ejecutá:

   ```sql
   INSERT INTO usuario (email, password) VALUES ('admin@tudominio.com', 'hash_generado');
   ```

3. **Borrá el script temporal** del servidor.

> El archivo `sql/bienes_raices.sql` incluye un usuario de prueba con contraseña `admin` (hash bcrypt). No lo uses en producción, creá uno nuevo.
