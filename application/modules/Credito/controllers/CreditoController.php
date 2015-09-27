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

    public function crearcreditoAction()
    {
       if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $formCrear=new Credito_Form_Credito();
            
            $estados_credito = new Credito_Model_DbTable_EstadoDeCredito();
            $estados=$estados_credito->get_estados();
            //var_dump($estados);
            $modalidades_credito = new Credito_Model_DbTable_ModalidadDeCredito();
            $modalidad=$modalidades_credito->get_modalidades();
            //var_dump($modalidad);
            $tipos_modalidades_credito = new Credito_Model_DbTable_TipoModalidadCredito();
            $tipo_modalidad=$tipos_modalidades_credito->get_tipos_modalidades();            
            //var_dump($tipo_modalidad);
          
            $this->view->estados_credito=$estados;
            $this->view->modalidades_credito=$modalidad;
            $this->view->tipos_modalidades_credito=$tipo_modalidad;
            $this->view->crear=$formCrear;
            if($this->getRequest()->isPost())
            {
                $formData=$this->getRequest()->getPost();
                
                if(isset($formData['insertar']))
                {
                
                    if($formCrear->isValid($formData))
                    {
                        $nombre=$formCrear->getValue('nombre_estado_credito');
                        $descripcion=$formCrear->getValue('descripcion_estado_credito');

                        $consulta=new Estado_Model_DbTable_EstadoDeCredito();
                        $consulta->insertarEstado($nombre, $descripcion);

                        $this->_helper->redirector('index');
                    }else
                    {
                        $formCrear->populate($formData);
                    }
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }


}



