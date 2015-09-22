<?php

class Giros_Model_DbTable_Resolucion extends Zend_Db_Table_Abstract
{

    protected $_name = 'resolucion';
    public function get($id)
    {
        $id = (int) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('id_resolucion = ' . $id);
        if (!$row)
        {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
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
    
    public function validardisponibilidad($usuario,$tabla,$columna)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        $select->from($tabla,array('count' => 'count(*)'));
        $select->where($columna.' = ?',$usuario);
        $result = Zend_Db_Table::getDefaultAdapter()->fetchRow($select);
        $disponibilidad = $result['count'];
        return $disponibilidad;
    }
    function modificarGiro($id,$fecha,$valor)
    {
        $data=array('id_resolucion'=>$id,'fecha_giro'=>$fecha,'valor_total'=>$valor);
        $this->update($data, 'id_resolucion = '.(int)$id);
    }

}