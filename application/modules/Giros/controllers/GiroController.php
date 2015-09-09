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
                    //$codigo2=  $this->_request->getPost("cod_estudiante");
                    var_dump($_POST);
                    ///$consulta=new Giros_Model_DbTable_Resolucion();
                    //$consulta2=new Giros_Model_DbTable_GiroEstudiante();  
                    ///$consulta->insertarResolucion($resolucion, $fecha, $valortotal);
                    //$consulta2->insertarResolucionEstudiante($resolucion, $codigo, $valor);
                    //$this->_helper->redirector('index');
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

    public function creargiro2Action()
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
                    
                    $codigo2=  $this->_request->getPost("cod_estudiante_1");
                    $valor=$this->_request->getPost("valor_girado_estudiante_1");
                    var_dump($_POST);
                    
                    $fecha=  $this->fechaMysql($fecha);
                    //$consulta=new Giros_Model_DbTable_Resolucion();
                    $consulta2=new Giros_Model_DbTable_GiroEstudiante();  
                    //$consulta->insertarResolucion($resolucion, $fecha, $valortotal);
                    $consulta2->insertar($resolucion, $codigo2, $valor);
                    
                    //$this->_helper->redirector('index');
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


}





