<?php

class Credito_Model_DbTable_TipoModalidadCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'tipo_modalidad_credito';

    function get_tipos_modalidades()
    {
        return $this->fetchAll();
    }
    
    function get($id)
    {
        $id = (int) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('cod_tipo_modalidad_credito = ' . $id);
        if (!$row)
        {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
}

