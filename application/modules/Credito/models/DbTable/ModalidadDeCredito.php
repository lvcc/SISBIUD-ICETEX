<?php

class Credito_Model_DbTable_ModalidadDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'modalidad_de_credito';
    
    function get_modalidades()
    {
        return $this->fetchAll();
    }
    
    function get($id)
    {
        $id = (int) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('cod_modalidad_credito = ' . $id);
        if (!$row)
        {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

}

