<?php

/**
 * Created by PhpStorm.
 * User: yeison
 * Date: 09/05/17
 * Time: 16:15
 */
class View
{

    protected $template;
    protected $data;
    private $baseTemplate;

    function __construct()
    {
        $this->baseTemplate = array(
            'SECTION' => '',
            'MENU' => '',
            'MIGAS_PAN' => ''
        );
    }


    protected function getTemplate($form)
    {
        $path = "public/" . $form . ".html";
        $this->template = file_get_contents($path);
    }

    protected function renderData()
    {
        if (count($this->data) > 0) {
            foreach ($this->data as $key => $value) {
                $this->template = str_replace('[' . $key . ']', $value, $this->template);
            }
        }
    }

    protected function showView($vista, $data = array())
    {
        $this->getTemplate($vista);
        $this->data = $data;
        $this->renderData();

        $this->baseTemplate['SECTION'] = $this->template;

        if (isset($_SESSION['correo'])) {
            $this->baseTemplate['MENU'] = $data['MENU'];
            $this->baseTemplate['MIGAS_PAN'] = $data['MIGAS_PAN'];
        }

        $this->getTemplate('template_base');

        $this->data = $this->baseTemplate;
        $this->renderData();

        print $this->template;
    }
}