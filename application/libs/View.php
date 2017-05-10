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
            'CONTENT' => '',
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
                $this->template = str_replace('[' . strtoupper($key) . ']', $value, $this->template);
            }
        }
    }

    protected function showView($vista, $data = array())
    {
        $this->getTemplate($vista);
        $this->data = $data;
        $this->renderData();

        $this->baseTemplate['CONTENT'] = $this->template;

        $this->getTemplate('template_base');

        $this->data = $this->baseTemplate;
        $this->renderData();

        print $this->template;
    }
}