<?php

require_once __DIR__ . '/Product.php';

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
        $this->update('quantity', $quantity);
    }

    public function get($key = '', $value = '')
    {

        if (isset($key) && isset($value)) {
            $this->query = "
						SELECT *
						FROM cart_product
						WHERE cart_product.$key = '$value'";
            $this->get_results_query();

        }

        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $attribute => $value) {
                $this->$attribute = $value;
            }
        } else {
            $this->init();
        }

    }

    public function update($key = '', $value = '') {
        $this->query = "
					UPDATE cart_product SET " . $key . " = '$value'
					WHERE id = '$this->id'
					";

        $this->execute_simple_query();
        $this->$key = $value;
    }

    public function list()
    {
        $this->query = "SELECT * FROM cart_product WHERE quantity>0 LIMIT " . LIMIT_LIST_PRODUCTS;
        $this->get_results_query();

        foreach ($this->rows as $key => $value) {
            $myProduct = new Product();
            $myProduct->get('id', $this->rows[$key]['product']);
            $this->rows[$key]['name'] = $myProduct->getName();
            $this->rows[$key]['price'] = $myProduct->getPrice();
        }

        return $this->rows;
    }


    public function get_resume_by_cart($carId) {
        $this->query = "
						SELECT *
						FROM cart_product
						WHERE cart_product.cart = '$carId'";

        $this->get_results_query();

        $number = 0;
        $total = 0;

        if(count($this->rows) < 1) {
            return array('NUMBER_ITEMS'=> $number, 'TOTAL'=> $total);
        }

        foreach ($this->rows as $key => $value) {
            $myProduct = new Product();
            $myProduct->get('id', $this->rows[$key]['product']);

            $number += $this->rows[$key]['quantity'];
            $total += $this->rows[$key]['quantity'] * $myProduct->getPrice();
        }


        return array('NUMBER_ITEMS'=> $number, 'TOTAL'=> $total);
    }

}