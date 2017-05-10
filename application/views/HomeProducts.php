<?php

require_once __DIR__ . '/../libs/View.php';

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 18:48
 */
class HomeProductsView extends View
{
    function __construct($type, $products=array(), $resume=array(), $message)
    {
        parent::__construct();

        $dataListProducts = array('PRODUCTS' => '', 'NUMBER_ITEMS'=> '', 'TOTAL'=> '');

        foreach ($products as $product) {
            $this->getTemplate('add_product');
            $this->data = $product;
            $this->renderData();
            $dataListProducts['PRODUCTS'] = $dataListProducts['PRODUCTS'].$this->template;
        }

        $dataListProducts['NUMBER_ITEMS'] = $resume['NUMBER_ITEMS'];
        $dataListProducts['TOTAL'] = $resume['TOTAL'];

        $this->showView('list_products', $dataListProducts);
    }

}