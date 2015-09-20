<?php

class Giros_Model_DbTable_Beneficiarios extends Zend_Db_Table_Abstract
{

    protected $_name = 'beneficiarios';
    
     public function validardisponibilidad($campo,$tabla,$columna)
    {
        $resultado = 0;
        $select2 = Zend_Db_Table::getDefaultAdapter()->select();
        $select2->from(array('beneficiarios'),array('codigo_beneficiario'));
        $select2->where('codigo_ud = ?',$columna);
        $result2 = Zend_Db_Table::getDefaultAdapter()->fetchRow($select2);
        $resultado2 = $result2['codigo_beneficiario'];
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        if($resultado2){
        if($campo=="Nombre"){        
            
            $select->from(array($tabla),array('nombres','apellidos'));            
            $select->where('codigo_beneficiario = ?',$resultado2);
            $result = Zend_Db_Table::getDefaultAdapter()->fetchRow($select);
            $resultado = $result['nombres']." ".$result['apellidos'];
        }
        elseif($campo=='Email')
        {
            $select->from(array($tabla),array('email_personal'));            
            $select->where('codigo_beneficiario = ?',$resultado2);
            $result = Zend_Db_Table::getDefaultAdapter()->fetchRow($select);
            $resultado = $result['email_personal'];
        }
        elseif($campo=='Carrera')
        {
            $select->from(array('es' => 'estudiantes'),array('p.nombre_proyecto'));
            $select->joinleft( array('p' => 'proyectos_curriculares'),'es.cod_proyecto = p.codigo_proyecto',array());
            $select->where('es.cod_beneficiario = ?',$resultado2);
            $result = Zend_Db_Table::getDefaultAdapter()->fetchRow($select);
            $resultado = $result['nombre_proyecto'];
        }
        }
        return $resultado;
    }


}

