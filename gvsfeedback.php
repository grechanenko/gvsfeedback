<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Gvsfeedback extends Module
{
    public function __construct()
    {
        $this->name = 'Gvsfeedback';
        $this->tab = 'checkout';
        $this->version = '1.0.0';
        $this->author = 'grechanenko';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Feedback');
        $this->description = $this->l('This is feedback module');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall module?');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.6.99');
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('leftColumn');

        Configuration::updateValue('GVSFEEDBACK_LIVE_MODE', false);
    }

    public function uninstall()
    {
        Configuration::deleteByName('GVSFEEDBACK_LIVE_MODE');

        return parent::uninstall();
    }

    public function hookDisplayLeftColumn($parent)
    {
        return "Hellow, world";
    }

}