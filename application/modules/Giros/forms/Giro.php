<?php

class Giros_Form_Giro extends Zend_Form
{

    public function init()
    {
        $this->setName('giro');
        
        $resolucion=new Zend_Form_Element_Text('id_resolucion');
        $resolucion
                ->setAttrib("class", "form-control unico required")
                ->setAttrib('placeholder', 'Resolución');
        
        $fecha=new Zend_Form_Element_Text('fecha_giro');
        $fecha
                ->setAttrib("class", "form-control required")
                ->setAttrib('id', 'sandbox-container')
                ->setAttrib('placeholder', 'Fecha');
        
        $valortotal=new Zend_Form_Element_Text('valor_total');
        $valortotal
                ->setAttrib("class", "form-control required")
                ->setAttrib('placeholder', 'Valor total');
               
        $submit=new Zend_Form_Element_Submit('insertar');
        $submit->setLabel('Guardar Giro')
                ->setAttrib('class', 'btn btn-primary');
        
        $this->addElements(array($resolucion,$fecha,$valortotal,$submit));
        $this->setElementDecorators(array('ViewHelper','Errors'));
    }
}