<?php

class Giros_GiroController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->initView();
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

    public function creargiroAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $formgiro=new Giros_Form_Giro();
            $this->view->add=$formgiro;
            //$formadd->submit->setLabel('Insertar Modalidad');
            if($this->getRequest()->isPost())
            {
                $formData=  $this->getRequest()->getPost();
                if($formgiro->isValid($formData))
                {
                    $resolucion=$formgiro->getValue('id_resolucion');
                    $fecha=$formgiro->getValue('fecha_giro');
                    $valortotal=$formgiro->getValue('valor_total');
                    
                    $fecha=  $this->fechaMysql($fecha);
                    var_dump($fecha);
                    $consulta=new Giros_Model_DbTable_Resolucion();
                    $consulta->insertarResolucion($resolucion, $fecha, $valortotal);
                    $this->_helper->redirector('index');
                }
                else
                {
                    $formgiro->populate($formData);
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }
     public function fechaMysql($fecha)
    {
        $arr = split("/", $fecha);
        if (count($arr) != 3)
        {
            return $fecha;
        } else
        {
            return "$arr[2]-$arr[1]-$arr[0]";
        }
    }

}



