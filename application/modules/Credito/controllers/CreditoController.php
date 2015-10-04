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
                        $credito=new Credito_Model_DbTable_Credito();
                        $credito->insertar($_POST);
                  
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

    public function infobeneficiarioAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            if($this->getRequest()->isPost())
            {
                
                $datos = $this->getRequest()->getPost();
                $codigo_ud = $datos['estudiante_cod'];
                $beneficiario = new Credito_Model_DbTable_Beneficiarios();
                $info=$beneficiario->datos_beneficiario($codigo_ud);
 
                switch($datos['campo'])
                {
                    case 'numero_documento':
                        die($info['numero_documento']);
                    case 'carrera':
                        die($info['proyecto']);
                    case 'nombre':
                        die($info['nombres']." ".$info['apellidos']);
                    case 'departamento':
                        die($info['departamento']);
                    case 'municipio':
                        die($info['municipio']);
                    case 'promedio':
                        die($info['promedio']);
                    case 'semestre':
                        die($info['semestre']);
                    case 'matricula':
                        die($info['matricula']);
                    case 'correoi':
                        die($info['email_institucional']);
                    case 'correop':
                        die($info['email_personal']);
                }
            }            
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function editarcreditoAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $this->view->title="Actualizar Credito - ";
            $this->view->headTitle($this->view->title);
            $formEditar=new Credito_Form_Credito();
            
            $this->view->form=$formEditar;
            if($this->getRequest()->isPost())
            {
                $formDatos=  $this->getRequest()->getPost();
                if($formEditar->isValid($formDatos))
                {
                    $credito=new Credito_Model_DbTable_Credito();
                    $credito->actualizar($_POST);
                    $this->_helper->redirector('index');
                }
                else
                {
                    $formEditar->populate($formDatos);
                }
            }
            else
            {
                $id=$this->_getParam('id',0);
                if(strlen($id)>0)
                {
                    $formActualizar=new Credito_Model_DbTable_Credito();
                    $actualizar=$formActualizar->get($id);
                    $formEditar->populate($actualizar);
                    $beneficiario = new Credito_Model_DbTable_Beneficiarios();
                    $info=$beneficiario->datos_beneficiario2($actualizar['cod_estudiante']);                   
                    $this->view->info=$info;
                    $this->view->actualizar=$actualizar;
                    $estados_credito = new Credito_Model_DbTable_EstadoDeCredito();
                    $estados=$estados_credito->get_estados();

                    $modalidades_credito = new Credito_Model_DbTable_ModalidadDeCredito();
                    $modalidad=$modalidades_credito->get_modalidades();

                    $tipos_modalidades_credito = new Credito_Model_DbTable_TipoModalidadCredito();
                    $tipo_modalidad=$tipos_modalidades_credito->get_tipos_modalidades();            
          
                    $this->view->estados_credito=$estados;
                    $this->view->modalidades_credito=$modalidad;
                    $this->view->tipos_modalidades_credito=$tipo_modalidad;
                    
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function vercreditoAction($id)
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $this->view->title="Actualizar Credito - ";
            $this->view->headTitle($this->view->title);
            $id=$this->_getParam('id',0);
                if(strlen($id)>0)
                {
                    $formActualizar=new Credito_Model_DbTable_Credito();
                    $actualizar=$formActualizar->get($id);
                    $beneficiario = new Credito_Model_DbTable_Beneficiarios();
                    $info=$beneficiario->datos_beneficiario2($actualizar['cod_estudiante']);                   
                    $this->view->info=$info;
                    $this->view->actualizar=$actualizar;
                    $ecredito = new Credito_Model_DbTable_EstadoDeCredito();
                    $estado_credito = $ecredito->get($actualizar['id_estado_credito']);
                    $modalidad = new Credito_Model_DbTable_ModalidadDeCredito();
                    $modalidad_credito = $modalidad->get($actualizar['id_modalidad']);
                    $tmodalidad = new Credito_Model_DbTable_TipoModalidadCredito();
                    $tipo_modalidad = $tmodalidad->get($actualizar['id_tipo_modalidad']);
                    $this->view->estado_credito=$estado_credito;        
                    $this->view->modalidad_credito=$modalidad_credito;
                    $this->view->tipo_modalidad=$tipo_modalidad;
                }
        } else {
            $this->_redirect('Index/index');
        }
    }


}









