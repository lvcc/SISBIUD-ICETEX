<?php

class Credito_CreditoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
         if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $creditos=new Credito_Model_DbTable_Credito();
            $this->view->creditos=$creditos->lista_creditos();
        }
        else
        {
            $this->_redirect('Index/index');
        }
    }


}

