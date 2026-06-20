<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]); 
    }

    public static function propiedad(Router $router) {

        //validar el id
        $id = validarRedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);


    }

    public static function blog(Router $router) {
        $router->render('paginas/blog', [
            
        ]);

    }

    public static function entrada(Router $router) {

        $router->render('paginas/entrada', [
            
        ]);
        
    }

    public static function contacto(Router $router) {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];
            //debuguear($respuestas);

            //Crear una instancia de phpMailer
            $mail = new PHPMailer();

            //configurar el SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['SMTP_PORT'];
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = 'tls';

            //configurar el contenido del email
            $mail->setFrom($_ENV['SMTP_FROM']);
            $mail->addAddress($_ENV['SMTP_FROM'], $_ENV['SMTP_FROM_NAME']);
            $mail->Subject = 'Tienes un nuevo mensaje';

            //habilitar html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //definir el contenido
            $contenido = '<html>'; 
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            
            //Enviar el telefono solo si elige ser contactado por telefono o email
            if($respuestas['contactar'] === 'telefono') {
                $contenido .= '<p>Prefiere ser contactado por telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora contacto: ' . $respuestas['hora'] . '</p>';
            } else {
                //es email y se agrega su campo
                $contenido .= '<p>Prefiere ser contactado por email</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';

            }
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o compra: ' . $respuestas['opciones'] . '</p>';
            $contenido .= '<p>Precio o presupuesto: $' . $respuestas['presupuesto'] . '</p>';
           
            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Texto alternativo sin HTML';

            //enviar el email
            if( $mail->send() ){
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "Mensaje no se pudo enviar";
            }

        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }

}