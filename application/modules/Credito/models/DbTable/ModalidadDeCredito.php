<?php

class Credito_Model_DbTable_ModalidadDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'modalidad_de_credito';
    
    function get_modalidades()
    {
        return $this->fetchAll();
    }

}

