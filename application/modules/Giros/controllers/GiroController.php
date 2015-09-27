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
                    
                    $codigo2=  $this->_request->getPost("cod_es_1");
                    $valor=$this->_request->getPost("val_es_1");
                            
                    $fecha=  $this->fechaMysql($fecha);
                    $consulta=new Giros_Model_DbTable_Resolucion();
                    $consulta->insertarResolucion($resolucion, $fecha, $valortotal);
                   
                    $consulta2=new Giros_Model_DbTable_GiroEstudiante();
                    $consulta2->insertar($resolucion, $_POST);  
                         
                    $config = array('ssl' => 'tls', 'port' => 587, 'auth' => 'login', 'username' => 'opregonerog@gmail.com', 'password' => 'Gwind708*');
                    $smtpConnection = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
                    Zend_Mail::setDefaultFrom('opregonerog@gmail.com', 'Opregonerog');
                    Zend_Mail::setDefaultReplyTo('opregonerog@gmail.com','Opregonerog');
                    
                    if(empty($_POST['total_estudiantes']))
                        $_POST['total_estudiantes']=1;
                    
                    for($i=1;$i<=$_POST['total_estudiantes'];$i++){
                        $mail = new Zend_Mail();
                        $mail->addTo($_POST['ema_es_'.$i], $_POST['nom_es_'.$i]);
                        $mail->setSubject('Giro Icetex');
                        $mail->setBodyHtml('Se&ntilde;or(a) estudiante: <br><br> Le informamos que el ICETEX ya realiz&oacute; el giro correspondiente de este semestre.<br><br>Por favor dir&iaucute;jase a la oficina de la Universidad Distrital.');
                        $mail->send($smtpConnection);
                    }
                    Zend_Mail::clearDefaultFrom();
                    Zend_Mail::clearDefaultReplyTo();                     
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
                    //var_dump($_POST);
                    
                    $fecha=  $this->fechaMysql($fecha);
                    $consulta=new Giros_Model_DbTable_Resolucion();
                    $consulta->insertarResolucion($resolucion, $fecha, $valortotal);
                    
                    $consulta2=new Giros_Model_DbTable_GiroEstudiante();  
                    $consulta2->insertar($resolucion, $codigo2, $valor);
                    
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

    public function disponibleAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            if($this->getRequest()->isPost())
            {
                
                $datos = $this->getRequest()->getPost();
                $tabla=$datos['tabla'];
                $tabla2=$datos['tabla2'];
                if($tabla=='resolucion'){
                $campo=$datos['resolucion'];
                $tabla=$datos['tabla'];
                $columna=$datos['columna'];
                $table= new Giros_Model_DbTable_Resolucion();
                $disponibilidad=$table->validardisponibilidad($campo,$tabla,$columna);
                if($disponibilidad>0)
                {
                    die("ya esta registrado en el sistema");
                } else 
                {
                    die("Disponible");
                }
                }
                elseif($datos['estudiante_cod'])
                {
                $campo=$datos['campo'];
                $tabla2=$datos['tabla2'];
                $columna=$datos['estudiante_cod'];
                $table2= new Giros_Model_DbTable_Beneficiarios();
                $disponibilidad=$table2->validardisponibilidad($campo,$tabla2,$columna);
                die($disponibilidad);
                }
            }            
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function datosbeneficiarioAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            if($this->getRequest()->isPost())
            {
                $datos = $this->getRequest()->getPost();
                $campo=$datos['campo'];
                $tabla=$datos['tabla'];
                $columna=$datos['estudiante_cod'];
                $table= new Giros_Model_DbTable_Beneficiarios();
                $disponibilidad=$table->validardisponibilidad($campo,$tabla,$columna);
                if($disponibilidad>0)
                {
                    die("ya esta registrado en el sistema");
                }
            }            
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function editargiroAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $this->view->title="Actualizar Giro - ";
            $this->view->headTitle($this->view->title);
            $formEditar=new Giros_Form_Giro();
            
            $this->view->form=$formEditar;
            if($this->getRequest()->isPost())
            {
                $formDatos=  $this->getRequest()->getPost();
                if($formEditar->isValid($formDatos))
                {
                    $giro=new Giros_Model_DbTable_GiroEstudiante();
                    //$reso=new Giros_Model_DbTable_Resolucion();
                    $giro->limpiarGiro($_POST['id_resolucion']);
                    $giro->actualizar($_POST['id_resolucion'],$_POST);
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
                    $formActualizar=new Giros_Model_DbTable_Resolucion();
                    $actualizar=$formActualizar->get($id);
                    $formEditar->populate($actualizar);
                    $estudiantesgiro = new Giros_Model_DbTable_GiroEstudiante();
                    $estudiantes=$estudiantesgiro->get_estudiantes($id);
                    $this->view->estudiantes=$estudiantes;
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        } 
    }

    public function vergiroAction()
    {
      if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->view->title="Giro - ";
            $this->view->headTitle($this->view->title);
            $id=$this->_getParam('id',0);
            
            if(strlen($id)>0) {
              $formVer=new Giros_Model_DbTable_Resolucion();
              $ver=$formVer->get($id);
              $this->view->giro=$ver;
              $estudiantesgiro = new Giros_Model_DbTable_GiroEstudiante();
              $estudiantes=$estudiantesgiro->get_estudiantes($id);
              $this->view->estudiantes=$estudiantes;
            }             
        } else {
            $this->_redirect('Index/index');
        } 
    }


}



