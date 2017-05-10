<?php

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 18:48
 */
class HomeProductsView extends View
{
    function __construct($type, $data=array(), $message)
    {
        parent::__construct();
        if($type == 'error' || $type == 'exito') {
            $this->getTemplate($type);
            $this->data = array('MENSAJE'=>$message);
            $this->renderData();
        }

        $datos['DIV'] = $this->template;
        $this->template = "";

        $this->showView('iniciar_sesion', $datos);
    }

}