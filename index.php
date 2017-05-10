<?php
/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 16:40
 */

require_once 'application/controller/ShoppingCart.php';

$application = new ShoppingCart();

if(isset($_POST['route']) ) {
    switch ($_POST['route']) {
        case 'SHOW_PRODUCTS':
            $application->showProducts();
            break;
    }
}
