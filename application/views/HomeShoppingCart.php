<?php

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 18:50
 */
class HomeShoppingCartView extends View
{
    function __construct($tipo, $datos=array(), $mensaje)
    {
        parent::__construct();
        if($tipo == 'error' || $tipo == 'exito') {
            $this->getTemplate($tipo);
            $this->data = array('MENSAJE'=>$mensaje);
            $this->renderData();
        }

        $datos['DIV'] = $this->plantilla;
        $this->plantilla = "";

        $this->showView('iniciar_sesion', $datos);
    }

}