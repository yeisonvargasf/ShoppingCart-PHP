<?php

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 17:21
 */
class CartProduct extends Database
{
    private $id;
    private $product;
    private $cart;
    private $quantity;

    public function init()
    {
        $this->id = -1;
        $this->product = -1;
        $this->cart = -1;
        $this->quantity = 0;
    }

    function save($product, $cart, $quantity){
        $this->product = $product;
        $this->cart = $cart;
        $this->quantity = $quantity;

        $this->query = "
                    INSERT INTO cart_product (product, cart, quantity) 
                    VALUES ('$this->product', '$this->cart', '$this->quantity')
                    ";

        $this->execute_simple_query();
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
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param mixed $cart
     */
    public function setCart($cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }



    public function get($key = '', $value = '')
    {

        if (!isset($key) && isset($value)) {
            $this->query = "
						SELECT *
						FROM cart_product
						WHERE cart_product.$key = '$value'";
            $this->get_results_query();

            //$this->errores();
        }

        //print_r($this->filas);

        if (count($this->rows) == 1) {
            $currentReference = 'this';
            foreach ($this->rows[0] as $attribute => $value) {
                $$currentReference->$attribute = $value;
            }
        } else {
            $this->init();
        }

    }

    public function list()
    {
        $this->query = "SELECT * FROM cart_product WHERE quantity>0 LIMIT " . LIMIT_LIST_PRODUCTS;
        $this->get_results_query();

        return $this->rows;
    }

}