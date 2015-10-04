<?php

class Usuarios_Form_Usuarios extends Zend_Form
{

    public function init()
    {
        $this->setName('usuarios');
        
        
        $usuario=new Zend_Form_Element_Text('nombre_usuario');
        $usuario
                //->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                //->addValidator('NotEmpty')
                ->setAttrib('class', 'form-control required unico')
                ->setAttrib('placeholder', 'Nombre de usuario');
        
        $contrasena=new Zend_Form_Element_Password('contrasena');
        $contrasena
                //->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                //->addValidator('NotEmpty')
                ->setAttrib('class', 'form-control required')
                ->setAttrib('placeholder', 'Contraseña');
        
        $identificacion=new Zend_Form_Element_Text('identificacion');
        $identificacion
                //->setRequired(true)
                ->addFilter('StripTags')
                ->setAttrib('class', 'form-control required unico')
                ->setAttrib('onkeypress', 'ValidaSoloNumeros();')
                ->setAttrib('placeholder', 'Identificación');
        
        $nombre=new Zend_Form_Element_Text('nombre_real');
        $nombre
                //->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'form-control required')
                ->setAttrib('placeholder', 'Nombres');
                
        $apellido=new Zend_Form_Element_Text('apellido_real');
        $apellido
                //->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'form-control required')
                ->setAttrib('placeholder', 'Apellidos');
        
        $cargo=new Zend_Form_Element_Text('cargo');
        $cargo
                //->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttrib('class', 'form-control required')
                ->setAttrib('placeholder', 'Cargo');
        
        $perfil=new Zend_Form_Element_Select('perfil');
        $perfil
                //->setRequired(true)
                ->addMultiOption('','Seleccione...')
                ->addMultiOption('Director','Director')
                ->addMultiOption('Administrador','Administrador')
                ->setAttrib('class', 'form-control required')
                ->setAttrib('placeholder', 'Perfil');
        
        $estado=new Zend_Form_Element_Select('estado');
        $estado 
                //->setRequired(true)
                ->addMultiOption('','Seleccione...')
                ->addMultiOption('Activo','Activo')
                ->addMultiOption('Inactivo','Inactivo')
                ->setAttrib('class', 'form-control required')
                ->setAttrib('placeholder', 'Estado');
        $modulo=new Zend_Form_Element_Hidden("modulo");
        $modulo->setValue('2');
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Guardar')
                ->setAttrib('class', 'btn btn-primary');
        
        $this->addElements(array($usuario,$contrasena,$identificacion,$nombre,$apellido,$cargo,$perfil,$estado,$modulo,$submit));
        $this->setElementDecorators(array('ViewHelper',"Errors")) ;
    }
}