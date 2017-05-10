<?php

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 16:23
 *  Requerimos el archivo config.php, que contiene las constantes generales en la aplicación web y otras configuraciones.
 */
require_once __DIR__ . '/../config/development.php';

/**
 * Clase de abstracción, contiene funciones que acceden a la base de datos.
 *
 * La clase abstracta modelo_bd es la encargada de acceder directamente a la base de datos
 * y manejar todo lo referente a esta.
 *
 * @author yeisonvargasf
 *
 */
abstract class Database
{

    private static $host = DB_HOST;
    private static $user = DB_USER;
    private static $password = DB_PASSWORD;
    private static $name = DB_NAME;
    protected $query;
    protected $rows = array();
    protected $connection;
    protected $message;
    protected $error_code;


    /**
     *  Función encargada de crear una conexión con la base de datos.
     *
     *  Crea una nueva instancia de la clase PDO enviando como parámetros en el
     *  constructor el nombre del host, el nombre de la base de datos, el nombre
     *  del usuario y la contraseña. En el caso de que exista algún error en el
     *  proceso, se captura y se almacena la información del message del error
     *  y el código de éste.
     *
     */
    private function init_connection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$name, self::$user, self::$password);
        } catch (PDOException $excepcion) {
            $this->message = DB_ERROR_CONNECTION . $excepcion->getMessage();
            $this->error_code = DB_ERROR_CONNECTION . $excepcion->getCode();
        }

    }

    /**
     * Función encargada de borrar una conexión con la base de datos.
     *
     * Borra la instancia actual de la clase PDO igualandola a null, esta instancia
     * tiene la conexión actual con la base de datos, de esta manera la conexión
     * es borrada.
     *
     */
    private function delete_connection()
    {
        $this->connection = null;
    }

    /**
     * Función encargada de ejecutar una peticion sql simple (INSERT, DELETE, UPDATE) en la base de datos.
     *
     * Crea la conexión con la base de datos llamando al respectivo método, prepara la petición sql llamando
     * al método prepare de la instancia 'connection' de la clase PDO y luego la ejecuta, guarda información
     * de posibles errores producidos al realizar la petición y luego borra la conexión.
     *
     */
    protected function execute_simple_query()
    {
        $this->init_connection();
        $temporal = $this->connection->prepare($this->query);
        $temporal->execute();
        $this->message = $temporal->errorInfo();
        $this->error_code = $temporal->errorCode();
        $this->delete_connection();
    }

    /**
     * Función encargada de ejecutar consultas sql en la base de datos.
     *
     * Crea la conexión con la base de datos llamando al respectivo método, prepara la petición sql llamando
     * al método prepare de la instancia 'connection' de la clase PDO y luego la ejecuta, guarda información
     * de posibles errores producidos al realizar la petición y convierte los resultados de la consulta en
     * un array asociativo que se trasnfiere al atributo rows y luego borra la conexión.
     *
     */
    protected function get_results_query()
    {
        $this->init_connection();
        $temporal = $this->connection->prepare($this->query);
        $temporal->execute();
        $this->message = $temporal->errorInfo();
        $this->error_code = $temporal->errorCode();
        $this->rows = null;
        while ($this->rows[] = $temporal->fetch(PDO::FETCH_ASSOC)) ;
        array_pop($this->rows);
        $this->delete_connection();
    }

}

?>
