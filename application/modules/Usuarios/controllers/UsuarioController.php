<?php

class Usuarios_UsuarioController extends Zend_Controller_Action
{

    private $auth = null;

    private $authAdapter = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->initView();
    }

    public function indexAction()
    {
        
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $table= new Usuarios_Model_DbTable_Usuario();
            $this->view->datos=$table->mostrarUsuarios();
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function crearusuarioAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $formusuario=new Usuarios_Form_Usuarios();
            $this->view->agrega=$formusuario;
            if($this->getRequest()->isPost())
            {
                $formData=  $this->getRequest()->getPost();
                if($formusuario->isValid($formData))
                {
                    $nombreusuario=$formusuario->getValue('nombre_usuario');
                    $modulo=$formusuario->getValue('modulo');
                    //$contrasena=$formusuario->getValue('contrasena');
                    $contrasena = md5($formusuario->getValue('contrasena').'%2+7FVJ.tQuWa8ssM2@J"pb*>nDnz0x:p\C'); //md5('claveUsuario'.'textoCualquiera_KeyPass') concatenamos la clave 
                    $identificacion=$formusuario->getValue('identificacion');
                    $nombre=$formusuario->getValue('nombre_real');
                    $apellido=$formusuario->getValue('apellido_real');
                    $cargo=$formusuario->getValue('cargo');
                    $perfil=$formusuario->getValue('perfil');
                    $estado=$formusuario->getValue('estado');
                    
                    $crearBd=new Usuarios_Model_DbTable_Usuario();
                    $crearBd->crearUsuario($nombreusuario, $contrasena, $identificacion, $nombre, $apellido, $cargo, $perfil, $estado,$modulo);

                    $this->_helper->redirector('index');
                }
                else
                {
                    $formusuario->populate($formData);
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function actualizarusuarioAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $this->view->title="Actualizar Usuario - ";
            $this->view->headTitle($this->view->title);

            $formEditar=new Usuarios_Form_Usuarios();
            $this->view->form=$formEditar;
            //var_dump($formEditar);
            if($this->getRequest()->isPost())
            {
                $formDatos=  $this->getRequest()->getPost();
                //var_dump($formDatos);
                if($formEditar->isValid($formDatos))
                {
                    $nombreusuario=$formEditar->getValue('nombre_usuario');
                    //$contrasena=$formEditar->getValue('contrasena');
                    $contrasena = md5($formEditar->getValue('contrasena').'%2+7FVJ.tQuWa8ssM2@J"pb*>nDnz0x:p\C'); //md5('claveUsuario'.'textoCualquiera_KeyPass') concatenamos la clave 
                    $id=$formEditar->getValue('identificacion');
                    $nombres=$formEditar->getValue('nombre_real');
                    $apellidos=$formEditar->getValue('apellido_real');
                    $cargo=$formEditar->getValue('cargo');
                    $perfil=$formEditar->getValue('perfil');
                    $estado=$formEditar->getValue('estado');
                    //var_dump($_POST);
                    $formActualizar=new Usuarios_Model_DbTable_Usuario();
                    $formActualizar->modificarUsuario($nombreusuario, $contrasena, $id, $nombres, $apellidos, $cargo, $perfil, $estado);
                    
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
                    $formActualizar=new Usuarios_Model_DbTable_Usuario();
                    $actualizar=$formActualizar->get($id);
                    $formEditar->populate($actualizar);
                    
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function eliminarusuarioAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $id=  $this->_getParam('id',0);
            $borrar=new Usuarios_Model_DbTable_Usuario();
            $borrar->eliminarUsuario($id);
            $this->_helper->redirector('index');
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
                $usuario=$datos['nombre_usuario'];
                $tabla=$datos['tabla'];
                $columna=$datos['columna'];
                $table= new Usuarios_Model_DbTable_Usuario();
                $disponibilidad=$table->validardisponibilidad($usuario,$tabla,$columna);
                if($disponibilidad>0)
                {
                    die("El dato ".$usuario." ya esta registrado en el sistema");
                } else 
                {
                    die("Disponible");
                }
            }            
        } else 
        {
            $this->_redirect('Index/index');
        }
    }


}








