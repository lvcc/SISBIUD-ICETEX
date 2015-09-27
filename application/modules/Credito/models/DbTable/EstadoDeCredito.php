<?php

class Credito_Model_DbTable_EstadoDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'estado_de_credito';

    function get_estados()
    {
        return $this->fetchAll();
    }

}

