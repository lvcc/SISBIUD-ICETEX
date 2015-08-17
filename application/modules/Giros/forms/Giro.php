<?php

class Giros_Form_Giro extends Zend_Form
{

    public function init()
    {
        $this->setName('giro');
        
        $resolucion=new Zend_Form_Element_Text('id_resolucion');
        $resolucion->setRequired(true);
        
        $fecha=new Zend_Form_Element_Text('fecha_giro');
        $fecha->setRequired(true);
        
        $valortotal=new Zend_Form_Element_Text('valor_total');
        $valortotal->setRequired(true);
        
        $codigo=new Zend_Form_Element_Text("cod_estudiante");
        $codigo->setRequired(TRUE);
        
        $valorestudiante=new Zend_Form_Element_Text('valor_girado_estudiante');
        $valorestudiante->setRequired(TRUE);
        $submit=new Zend_Form_Element_Submit('insertar');
        $submit->setLabel('Ingresar Giro');
        
        $this->addElements(array($resolucion,$fecha,$valortotal,$codigo,$valorestudiante,$submit));
        $this->setElementDecorators(array('ViewHelper','Errors'));
    }


}

