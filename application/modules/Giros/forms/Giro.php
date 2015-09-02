<?php

class Giros_Form_Giro extends Zend_Form
{

    public function init()
    {
        $this->setName('giro');
        
        $resolucion=new Zend_Form_Element_Text('id_resolucion');
        $resolucion->setAttrib("required", "required")
                ->setAttrib("class", "form-control");
        
        $fecha=new Zend_Form_Element_Text('fecha_giro');
        $fecha->setAttrib("required", "required")
                ->setAttrib("class", "form-control")
                ->setAttrib('id', 'sandbox-container');
        
        $valortotal=new Zend_Form_Element_Text('valor_total');
        $valortotal->setAttrib("required", "required")
                ->setAttrib("class", "form-control");        
               
        $submit=new Zend_Form_Element_Submit('insertar');
        $submit->setLabel('Ingresar Giro')
                ->setAttrib('class', 'btn btn-primary');
        
        $this->addElements(array($resolucion,$fecha,$valortotal,$valorunitario,$submit));
        $this->setElementDecorators(array('ViewHelper','Errors'));
    }
}