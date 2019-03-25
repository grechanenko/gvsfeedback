<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class gvsfeedback extends Module
{
    public function __construct()
    {
        $this->name = 'gvsfeedback';
        $this->tab = 'front_office_features';
        $this->version = '0.1';
        $this->author = 'Grechanenko Vasiliy';
        $this->displayName = 'Module of product comments';
        $this->description = 'With this module, your customers will be able to
grade and comments your products.';
        $this->bootstrap = true;

        parent::__construct();
    }

    public function getContent()
    {
        return $this->display(__FILE__, 'getContent.tpl');
    }
}