<?php 

namespace Model;

class ActiveRecord {

    //base de datos
    protected static $db;
    PROTECTED STATIC $columasDB = [];
    PROTECTED STATIC $tabla = '';

    //errores 
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

     //definidir conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar(): mixed {
        if($this->id) {
            return $this->actualizar();
        } else {
            return $this->crear();
        }
    }

    public function actualizar() {
        //sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }

        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);
        if($resultado) {
            // Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }

        return $resultado;
    }


    public function crear() {

        //sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $string = join(', ', array_keys($atributos));

        //debuguear($string);
        
        //insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
            
        // '$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->creado', '$this->wc', '$this->estacionamiento', '$this->vendedorId' */
        $resultado = self::$db->query($query);
        return $resultado;

    }

    //eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $resultado = self::$db->query($query);

        //Eliminar la imagen
        if($resultado) {
           $this->borrarImagen();
        }
        return $resultado;
    }

    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // identificar y unir los atributos de la base de datos
    public function atributos(){
        $atributos = [];
        foreach(static::$columasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //subida de imagen
    public function setImagen($imagen){

        //solo eliminar imagen previa si se está asignando una nueva imagen
        if( !is_null($this->id)) {
            $this->borrarImagen();
        } 

        //asignar el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }



    public static function getErrores() {

        
        return static::$errores;
    }

    public function validar() {

        static::$errores = [];
        
        return static::$errores;
    }
   
    //Lista de las propiedades
    public static function all() {
        $query = "SELECT * FROM  " . static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    //Obtiene determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM  " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    //busca una propiedad por su id
    public static function find($id) {
         $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
         $resultado = self::consultarSQL($query);

         return array_shift($resultado);
        
    }

    public static function consultarSQL($query) {
        //consultar la base de datos
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }

}