<?php

class Credito_Model_DbTable_Credito extends Zend_Db_Table_Abstract
{

    protected $_name = 'credito';
    function lista_creditos()
    {
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        $select->from(array('credito'));
        $result = Zend_Db_Table::getDefaultAdapter()->fetchAll($select); 
        $aux = 0;
        
        foreach ($result as $row){
            
            $select_codigo_ud = Zend_Db_Table::getDefaultAdapter()->select();
            $select_codigo_ud->from(array('beneficiarios'),array('codigo_ud'));
            $select_codigo_ud->where('codigo_beneficiario = ?',$row['cod_estudiante']);
            $result_codigo = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_codigo_ud);
            $codigo_ud = $result_codigo['codigo_ud'];
            $result[$aux]['codigo_ud']=$codigo_ud;
            $select_nombre_estado = Zend_Db_Table::getDefaultAdapter()->select();
            $select_nombre_estado->from(array('estado_de_credito'),array('nombre_estado_credito'));
            $select_nombre_estado->where('id_estado_credito = ?',$row['id_estado_credito']);
            $result_nombre_estado = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_nombre_estado);
            $nombre_estado_credito = $result_nombre_estado['nombre_estado_credito'];
            $result[$aux]['nombre_estado_credito']=$nombre_estado_credito;
            $select_nombre_modalidad = Zend_Db_Table::getDefaultAdapter()->select();
            $select_nombre_modalidad->from(array('modalidad_de_credito'),array('nombre_modalidad_credito'));
            $select_nombre_modalidad->where('cod_modalidad_credito = ?',$row['id_modalidad']);
            $result_nombre_modalidad = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_nombre_modalidad);
            $nombre_modalidad = $result_nombre_modalidad['nombre_modalidad_credito'];
            $result[$aux]['nombre_modalidad']=$nombre_modalidad;
            $select_nombre_tipo_modalidad = Zend_Db_Table::getDefaultAdapter()->select();
            $select_nombre_tipo_modalidad->from(array('tipo_modalidad_credito'),array('nombre_tipo_modalidad'));
            $select_nombre_tipo_modalidad->where('cod_tipo_modalidad_credito = ?',$row['id_tipo_modalidad']);
            $result_nombre_tipo_modalidad = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_nombre_tipo_modalidad);
            $nombre_tipo_modalidad = $result_nombre_tipo_modalidad['nombre_tipo_modalidad'];
            $result[$aux]['nombre_tipo_modalidad']=$nombre_tipo_modalidad;
            $aux++;
        }
        return $result;
    }
    
    function insertar($datos)
    {
            $select = Zend_Db_Table::getDefaultAdapter()->select();
            $select->from(array('beneficiarios'),array('codigo_beneficiario'));
            $select->where('codigo_ud = ?',$datos['estudiante_cod']);
            $result = Zend_Db_Table::getDefaultAdapter()->fetchRow($select);
            $codigo = $result['codigo_beneficiario'];
            $sql = "insert into credito values ('','".$datos['estudiante_periodo']."',".$codigo.",".$datos['estado_credito'].",".$datos['modalidad_credito'].",".$datos['tipo_modalidad'].",'".$datos['credito_observaciones']."')";
            
            $this->getAdapter()->query($sql);
    }

}

