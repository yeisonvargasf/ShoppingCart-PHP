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
     *
     */
    private function delete_connection()
    {
        $this->connection = null;
    }

    /**
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
