<?php

class Credito_Model_DbTable_EstadoDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'estado_de_credito';

    function get_estados()
    {
        return $this->fetchAll();
    }
    function get($id)
    {
        $id = (int) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('id_estado_credito = ' . $id);
        if (!$row)
        {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

}

