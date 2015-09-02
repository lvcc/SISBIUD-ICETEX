<?php

class Giros_Model_DbTable_GiroEstudiante extends Zend_Db_Table_Abstract
{

    protected $_name = 'giro_estudiante';
       
    function insertarResolucionEstudiante($id,$codigo,$valor)
    {
        $data=array('id_resolucion'=>$id,'cod_estudiante'=>$codigo,"valor_girado_estudiante"=>$valor);
        $this->insert($data);
        var_dump($data);
        //$insert_id = $this->db->getLastId();
       // print_r($insert_id);
    }


}

