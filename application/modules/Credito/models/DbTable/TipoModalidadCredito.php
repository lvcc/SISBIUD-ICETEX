<?php

class Credito_Model_DbTable_TipoModalidadCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'tipo_modalidad_credito';

    function get_tipos_modalidades()
    {
        return $this->fetchAll();
    }
}

