<?php

class Giros_Model_DbTable_GiroEstudiante extends Zend_Db_Table_Abstract
{

    protected $_name = 'giro_estudiante';
       
    function insertar($resolucion,$codigo2,$valor)
    {
        $data=array('id_resolucion'=>$resolucion,'cod_estudiante'=>$codigo2,"valor_girado_estudiante"=>$valor);
        var_dump($data);
        exit();
        $this->insert($data);
       
        //$insert_id = $this->db->getLastId();
       // print_r($insert_id);
    }


}

