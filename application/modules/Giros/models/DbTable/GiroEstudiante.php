<?php

class Giros_Model_DbTable_GiroEstudiante extends Zend_Db_Table_Abstract
{

    protected $_name = 'giro_estudiante';
       
    function insertar($resolucion,$datos)
    {
        var_dump($datos);
        for($i=1;$i<=$datos['total_estudiantes'];$i++){
            $sql = "Insert into giro_estudiante values ('',".$resolucion.",".$datos['cod_es_'.$i].",".$datos['val_es_'.$i].")";
            $this->getAdapter()->query($sql);
        }
    }


}

