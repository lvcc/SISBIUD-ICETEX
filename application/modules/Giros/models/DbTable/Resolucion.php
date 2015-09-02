<?php

class Giros_Model_DbTable_Resolucion extends Zend_Db_Table_Abstract
{

    protected $_name = 'resolucion';
    function mostrarGiros()
    {
        return $this->fetchAll();
    }
    
    function insertarResolucion($id,$fecha,$valort)
    {
        $data=array('id_resolucion'=>$id,'fecha_giro'=>$fecha,"valor_total"=>$valort);
        $this->insert($data);
        //var_dump($data);
    }


}