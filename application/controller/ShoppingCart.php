<?php

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 16:38
 */
class ShoppingCart
{
    private $model;
    private $view;

    public function __construct() {
    }

    // Product
    public function showProducts() {
        $this->model = new Product();
        new HomeProductsView('home_products', $this->model->list());
    }

    public function showCart() {
        $this->model = new CartProduct();
        new HomeShoppingCartView('home_shopping_cart', $this->model->list());
    }

    public function addProductCart($productId) {
        $this->model = new Product();

        $this->model->get('id', $productId);

        if($this->model->getStock() < 1) {
            # Print ERROR
            exit;
        }

        $this->model->setStock($this->model->getStock() - 1);

        $this->model = new CartProduct();
        $this->model->get('product', $productId);

        if($this->model->getId() > 0) {
            $this->model->setQuantity($this->model->getQuantity() + 1);
        } else {
            $this->model->save($productId, 1, 1);
        }

    }

    public function removeProductCart($productId) {
        $this->model = new Product();
        $this->model->get('id', $productId);

        if($this->model->getId() < 0) {
            # Print ERROR
            exit;
        }

        $currentCartProduct = new CartProduct();
        $currentCartProduct->get('product', $productId);

        if($currentCartProduct->getId() >= 0 && $currentCartProduct->getQuantity() > 0) {
            $currentCartProduct->setQuantity($currentCartProduct->getQuantity() - 1);
            $this->model->setStock($this->model->getStock() + 1);

        } else {
            # Print ERROR
            exit;
        }

    }



}