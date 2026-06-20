<?php 

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear (Router $router) {

        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //crear una nueva instancia 
            $vendedor = new Vendedor($_POST['vendedor']);

            // Validar que no haya campos vacios
            $errores = $vendedor->validar();

            //No hay errores
            if(empty($errores)){
                $vendedor->guardar();
                header('Location: /admin?resultado=1');
            }

        }


        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }


    public static function actualizar (Router $router) {

        $id = validarRedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //sincronizar objeto en memoria con lo que el usuario escribio
            $args = $_POST['vendedor'];
            $vendedor->sincronizar($args);

            //errores
            $errores = $vendedor->validar();

            //revisar que el arreglo de errores este vacio
            if(empty($errores)){
                $resultado = $vendedor->guardar();  
            }

        }
   

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }


    public static function eliminar ( Router $router ) {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                
                    if($tipo === 'vendedor') {
                        $vendedor = Vendedor::find($id);
                        $vendedor->eliminar();
                        header('location: /admin/index.php?resultado=3');
                    } 
                }

            }
        }
    }


}