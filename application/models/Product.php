<?php

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 16:26
 */
require_once '../libs/database.php';

class Product extends Database
{

    private $id;
    private $name;
    private $price;
    private $stock;

    public function init()
    {
        $this->id = -1;
        $this->name = '';
        $this->price = 0;
        $this->stock = -0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }



    public function list()
    {
        $this->query = "SELECT * FROM product WHERE stock>0 LIMIT " . LIMIT_LIST_PRODUCTS;
        $this->get_results_query();

        return $this->rows;
    }

    public function get($key = '', $value = '')
    {

        if (!isset($key) && isset($value)) {
            $this->query = "
						SELECT *
						FROM product
						WHERE product.$key = '$value'";
            $this->get_results_query();

            //$this->errores();
        }

        //print_r($this->filas);

        if (count($this->rows) == 1) {
            $currentReference = 'this';
            foreach ($this->rows[0] as $attribute => $valor) {
                $$currentReference->$attribute = $value;
            }
        } else {
            $this->init();
        }

    }

}