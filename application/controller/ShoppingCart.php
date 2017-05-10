<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../views/HomeProducts.php';
require_once __DIR__ . '/../models/CartProduct.php';
require_once __DIR__ . '/../views/HomeShoppingCart.php';

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 16:38
 */
class ShoppingCart
{
    private $model;

    public function __construct() {
    }

    // Product
    public function showProducts() {
        $this->model = new Product();
        new HomeProductsView('list_products', $this->model->list(), (new CartProduct())->get_resume_by_cart(1), '');
    }

    public function showCart() {
        $this->model = new CartProduct();
        new HomeShoppingCartView('list_shoppingcart', $this->model->list(),
            (new CartProduct())->get_resume_by_cart(1), '');
    }

    public function addProductCart($productId) {
        $this->model = new Product();

        $this->model->get('id', $productId);

        if($this->model->getStock() < 1) {
            # Print ERROR
            print("ERROR");
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

        header("Location: /shoppingcart/products/");
        die();

    }

    public function deleteProductCart($productId) {
        $this->model = new Product();
        $this->model->get('id', $productId);

        if($this->model->getId() < 0) {
            # Print ERROR
            print("ERROR");
            exit;
        }

        $currentCartProduct = new CartProduct();
        $currentCartProduct->get('product', $productId);

        if($currentCartProduct->getId() >= 0 && $currentCartProduct->getQuantity() > 0) {
            $currentCartProduct->setQuantity($currentCartProduct->getQuantity() - 1);
            $this->model->setStock($this->model->getStock() + 1);

        } else {
            # Print ERROR
            print("ERROR");
            exit;
        }

        header("Location: /shoppingcart/cart/1/");
        die();

    }



}