<?php

class Credito_Form_Credito extends Zend_Form
{

    public function init()
    {
         $this->setName('giro');
        
        $periodo_academico=new Zend_Form_Element_Text('estudiante_periodo');
        $periodo_academico->setAttrib("class", "form-control unico required");
                
        $codigo=new Zend_Form_Element_Text('estudiante_cod');
        $codigo->setAttrib("class", "form-control unico required");
         
        $id=new Zend_Form_Element_Text('estudiante_id');
        $id->setAttrib("class", "form-control unico required");
        
        $carrera=new Zend_Form_Element_Text('estudiante_carrera');
        $carrera->setAttrib("class", "form-control required");
                
        $nombre=new Zend_Form_Element_Text('estudiante_nombre');
        $nombre->setAttrib("class", "form-control required");
        
        $departamento=new Zend_Form_Element_Text('estudiante_departamento');
        $departamento->setAttrib("class", "form-control required");
        
        $municipio=new Zend_Form_Element_Text('estudiante_municipio');
        $municipio->setAttrib("class", "form-control required");
        
        $promedio=new Zend_Form_Element_Text('estudiante_promedio');
        $promedio->setAttrib("class", "form-control required");
        
        $vmatricula=new Zend_Form_Element_Text('estudiante_matricula');
        $vmatricula->setAttrib("class", "form-control required");
        
        $semestre=new Zend_Form_Element_Text('estudiante_semestre');
        $semestre->setAttrib("class", "form-control required");
        
        $cpersonal=new Zend_Form_Element_Text('estudiante_cpersonal');
        $cpersonal->setAttrib("class", "form-control required");
        
        $cinstitucional=new Zend_Form_Element_Text('estudiante_cinstitucional');
        $cinstitucional->setAttrib("class", "form-control required");
               
        $submit=new Zend_Form_Element_Submit('insertar');
        $submit->setLabel('Ingresar Credito')
                ->setAttrib('class', 'btn btn-primary');
        
        $this->addElements(array($codigo,$periodo_academico,$id,$carrera,$nombre,$departamento,$municipio,$promedio,$vmatricula,$semestre,$cpersonal,$cinstitucional,$submit));
        $this->setElementDecorators(array('ViewHelper','Errors'));
    }


}

