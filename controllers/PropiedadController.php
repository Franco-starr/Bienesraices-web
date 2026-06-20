<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {

    public static function index(Router $router){

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null; 

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);

    }
    public static function crear(Router $router){
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        //arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $propiedad = new Propiedad($_POST['propiedad']);
        
            /** Subida de archivos **/
            //Solo procesar imagen si se subió archivo
            if(isset($_FILES['propiedad']['error']['imagen']) && $_FILES['propiedad']['error']['imagen'] === 0) {
                //crear una carpeta
                $carpetaImagenes = __DIR__ . '/../../../imagenes/';
                if( !is_dir($carpetaImagenes) ) {
                    mkdir($carpetaImagenes);
                }

                //generar un nombre unico
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                
                //setear la imagen
                $propiedad->setImagen($nombreImagen);

                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            }

            $errores = $propiedad->validar();
        
            //revisar que el arreglo de errores este vacio
            if(empty($errores)){
                if(isset($image)) {
                    //crear la carpeta subir imagenes
                    if(!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                //guarda en la base de datos
                $resultado = $propiedad->guardar();

                if($resultado) {
                    header('Location: /admin?resultado=1');
                }
            }
        
    }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){

        $id = validarRedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        //Ejecutar el codigo despues de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            //asignar los atributos
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);

            // Solo procesar imagen si se subió archivo
            if(isset($_FILES['propiedad']['error']['imagen']) && $_FILES['propiedad']['error']['imagen'] === 0) {
                //generar un nombre unico
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                
                //setear la imagen
                $propiedad->setImagen($nombreImagen);

                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $image->save(CARPETA_IMAGENES . $nombreImagen);        
            }
            
            $errores = $propiedad->validar();

            //revisar que el arreglo de errores este vacio
            if(empty($errores)){
                $resultado = $propiedad->guardar();  
            }
            
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $tipo = $_POST['tipo'];

            if(validarTipoContenido($tipo)) {
                $propiedad = Propiedad::find($id);
                $resultado = $propiedad->eliminar();
                if($resultado) {
                    header('Location: /admin?resultado=3');
                }
            }
        }
    }

}