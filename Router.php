<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }


    public function comprobarRutas() {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas
        $rutas_protegidas = [
            '/admin', 
            'propiedades/crear', 
            '/propiedades/actualizar', 
            '/propiedades/eliminar', 
            '/vendedores/actualizar', 
            '/vendedores/crear',
            '/vendedores/eliminar'
            ];



        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        //debuguear($urlActual);

        //Proteger las rutas
        if( in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if($metodo === 'GET') {
          $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if($fn) {
            //La URL eexiste y hay una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }

        

        
    }

    //Muestra una vista
    public function render($view, $datos = []) {
        foreach($datos as $key => $value) {
            $$key = $value; //Variable de variable
        }

        ob_start(); //Almacena el codigo HTML en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //Limpia el buffer

        include __DIR__ . "/views/layout.php";
    }

}