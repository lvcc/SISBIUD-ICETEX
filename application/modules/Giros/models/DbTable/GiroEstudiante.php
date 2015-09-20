<?php

class Giros_Model_DbTable_GiroEstudiante extends Zend_Db_Table_Abstract
{

    protected $_name = 'giro_estudiante';
       
    function insertar($resolucion,$datos)
    {
        if(empty($datos['total_estudiantes']))
            $datos['total_estudiantes']=1;
           
        for($i=1;$i<=$datos['total_estudiantes'];$i++){
            $select2 = Zend_Db_Table::getDefaultAdapter()->select();
            $select2->from(array('beneficiarios'),array('codigo_beneficiario'));
            $select2->where('codigo_ud = ?',$datos['cod_es_'.$i]);
            $result2 = Zend_Db_Table::getDefaultAdapter()->fetchRow($select2);
            $resultado2 = $result2['codigo_beneficiario'];
            $sql = "insert into giro_estudiante values ('',".$resolucion.",".$resultado2.",".$datos['val_es_'.$i].")";
            $this->getAdapter()->query($sql);
        }
    }


}

