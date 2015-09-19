<?php

class Giros_Model_DbTable_GiroEstudiante extends Zend_Db_Table_Abstract
{

    protected $_name = 'giro_estudiante';
       
    function insertar($resolucion,$datos)
    {
        if(empty($datos['total_estudiantes']))
            $datos['total_estudiantes']=1;
            
        for($i=1;$i<=$datos['total_estudiantes'];$i++){
            $sql = "insert into giro_estudiante values ('',".$resolucion.",".$datos['cod_es_'.$i].",".$datos['val_es_'.$i].")";
            $this->getAdapter()->query($sql);
        }
    }


}

