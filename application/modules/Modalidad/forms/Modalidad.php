<?php

class Modalidad_Form_Modalidad extends Zend_Form {

    public function init() {
        $this->setName('modalidad');
        //campo hidden para guardar id de album
        $id = new Zend_Form_Element_Hidden('cod_modalidad_credito');
        $id->addFilter('Int');

        $nombre = new Zend_Form_Element_Text('nombre_modalidad_credito');
        $nombre->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                //->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control required')
                ->setAttrib('placeholder', 'Nombre de modalidad');
        $descripcion = new Zend_Form_Element_Textarea('descripcion_modalidad');
        $descripcion->setAttrib('cols', 50)
                ->setAttrib('rows', 6)
                //->setAttrib('resize', 'none')
                ->setAttrib('class', 'form-control')
                ->addFilter('StripTags')
                ->addFilter('StringTrim');
        $submit = new Zend_Form_Element_Submit('submitmodalidad');
        $submit->setAttrib('class', 'btn btn-primary')
                ->setLabel('Guardar');


        $this->addElements(array($id, $nombre, $descripcion, $submit));
        $this->setElementDecorators(array('ViewHelper', "Errors"));
    }

}
