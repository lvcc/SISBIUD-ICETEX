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
            $muestragiros=new Giros_Model_DbTable_Resolucion();
            $this->view->mostrar=$muestragiros->mostrarGiros();
        }
        else
        {
            $this->_redirect('Index/index');
        }
    }


}

