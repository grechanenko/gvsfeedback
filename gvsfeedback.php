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
        $this->author = 'Grechanenko Vasiliy';

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Module of product comments');
        $this->description = $this->l('With this module, your customers will be able to grade and comments your products.');
        $this->version = '0.1';
    }

    public function install ()
    {
        parent::install();

        $this->registerHook('displayProductTabContent');
        return true;
    }

    public function processConfiguration()
    {
        if (Tools::isSubmit('gvs_pc_form'))
        {
            $enable_grades =  Tools::getValue('enable_grades');
            $enable_comments = Tools::getValue('enable_comments');
            Configuration::updateValue('GVS_GRADES', $enable_grades);
            Configuration::updateValue('GVS_COMMENTS', $enable_comments);

            $this->context->smarty->assign('confirmation', 'ok');
        }
    }

    public function assignConfiguration()
    {
        $enable_grades = Configuration::get('GVS_GRADES');
        $enable_comments = Configuration::get('GVS_COMMENTS');
        $this->context->smarty->assign('enable_grades', $enable_grades);
        $this->context->smarty->assign('enable_comments', $enable_comments);
    }

    public function getContent()
    {
        $this->processConfiguration();
        $this->assignConfiguration();
        return $this->display(__FILE__, 'getContent.tpl');
    }

    public function processProductTabContent()
    {
        if (Tools::isSubmit('gvs_tpc_submit_comment'))
        {
            $id_product = Tools::getValue('id_product');
            $grade = Tools::getValue('grade');
            $comment = Tools::getValue('comment');

            $insert = array(
                'id_product' => (int)$id_product,
                'grade' => (int)$grade,
                'comment' => pSQL($comment),
                'date_add' => date('Y-m-d H:i:s')
            );
            Db::getInstance()->insert('gvs_comment', $insert);

        }
    }

    public function assignProductTabContent()
    {
        $enable_grades = Configuration::get('GVS_GRADES');
        $enable_comments = Configuration::get('GVS_COMMENTS');

        $id_product = Tools::getValue('id_product');
        $comments = Db::getInstance()->executeS('SELECT * FROM '._DB_PREFIX_.'gvs_comment WHERE id_product = '.(int)$id_product);
        $this->context->smarty->assign('enable_grades', $enable_grades);
        $this->context->smarty->assign('enable_comments', $enable_comments);
        $this->context->smarty->assign('comments', $comments);
    }

    public function hookDisplayProductTabContent($params)
    {
        $this->processProductTabContent();
        $this->assignProductTabContent();
        return $this->display(__FILE__, 'displayProductTabContent.tpl');
    }
}