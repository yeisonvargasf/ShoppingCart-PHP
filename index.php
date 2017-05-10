<?php
/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 16:40
 */

require_once 'application/controller/ShoppingCart.php';

$application = new ShoppingCart();

if (isset($_GET['route'])) {
    switch ($_GET['route']) {

        case 'SHOW_CART':
            $application->showCart();
            break;

        case 'ADD_PRODUCT':
            if (isset($_GET['id'])) {
                $application->addProductCart($_GET['id']);
            }
            break;

        case 'DELETE_PRODUCT':
            if (isset($_GET['id'])) {
                $application->deleteProductCart($_GET['id']);
            }
            break;
    }
} else {
    $application->showProducts();
}
