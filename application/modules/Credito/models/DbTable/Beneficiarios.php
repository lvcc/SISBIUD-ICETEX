<?php

class Credito_Model_DbTable_Beneficiarios extends Zend_Db_Table_Abstract
{

    protected $_name = 'beneficiarios';
    
    function datos_beneficiario($id)
    {
        
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        $select->from('beneficiarios');
        $select->where('codigo_ud = ?',$id);
        $result = Zend_Db_Table::getDefaultAdapter()->fetchRow($select); 
        
        if(!empty($result['codigo_beneficiario']))
        {
        $select_proyecto = Zend_Db_Table::getDefaultAdapter()->select();
        $select_proyecto->from(array('es' => 'estudiantes'),array('p.nombre_proyecto'));
        $select_proyecto->joinleft( array('p' => 'proyectos_curriculares'),'es.cod_proyecto = p.codigo_proyecto',array());
        $select_proyecto->where('es.cod_beneficiario = ?',$result['codigo_beneficiario']);
        $result_proyecto = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_proyecto);
        $proyecto = $result_proyecto['nombre_proyecto'];
        $result['proyecto']=$proyecto;
        $select_datos_beneficiario = Zend_Db_Table::getDefaultAdapter()->select();
        $select_datos_beneficiario->from(array('estudiantes'),array('promedio','semestre_actual','valor_matricula'));
        $select_datos_beneficiario->where('cod_beneficiario = ?',$result['codigo_beneficiario']);
        $result_datos_beneficiario = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_datos_beneficiario);
        $promedio = $result_datos_beneficiario['promedio'];
        $semestre = $result_datos_beneficiario['semestre_actual'];
        $matricula = $result_datos_beneficiario['valor_matricula'];
        $result['promedio']=$promedio;
        $result['semestre']=$semestre;
        $result['matricula']=$matricula;
        }
        
        if(!empty($result['cod_domicilio']))
        {
        $select_cod_municipio = Zend_Db_Table::getDefaultAdapter()->select();
        $select_cod_municipio->from(array('domicilios'),array('cod_municipio'));
        $select_cod_municipio->where('codigo_domicilio = ?',$result['cod_domicilio']);
        $result_cod_municipio = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_cod_municipio);
        $cod_municipio = $result_cod_municipio['cod_municipio'];
            
        $select_municipio = Zend_Db_Table::getDefaultAdapter()->select();
        $select_municipio->from(array('municipios'),array('nombre_municipio','cod_departamento'));
        $select_municipio->where('codigo_municipio = ?',$cod_municipio);
        $result_municipio = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_municipio);
        $municipio = $result_municipio['nombre_municipio'];
        $result['municipio']=$municipio;
        $cod_departamento = $result_municipio['cod_departamento'];
        
        $select_departamento = Zend_Db_Table::getDefaultAdapter()->select();
        $select_departamento->from(array('departamentos'),array('nombre_departamento'));
        $select_departamento->where('codigo_departamento = ?',$cod_departamento);
        $result_departamento = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_departamento);
        $departamento = $result_departamento['nombre_departamento'];
        $result['departamento']=$departamento;
        }    
        return $result;
    }

    function datos_beneficiario2($id)
    {   
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        $select->from('beneficiarios');
        $select->where('codigo_beneficiario = ?',$id);
        $result = Zend_Db_Table::getDefaultAdapter()->fetchRow($select); 
        
        $select_proyecto = Zend_Db_Table::getDefaultAdapter()->select();
        $select_proyecto->from(array('es' => 'estudiantes'),array('p.nombre_proyecto'));
        $select_proyecto->joinleft( array('p' => 'proyectos_curriculares'),'es.cod_proyecto = p.codigo_proyecto',array());
        $select_proyecto->where('es.cod_beneficiario = ?',$id);
        $result_proyecto = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_proyecto);
        
        $proyecto = $result_proyecto['nombre_proyecto'];
        $result['proyecto']=$proyecto;
        $select_datos_beneficiario = Zend_Db_Table::getDefaultAdapter()->select();
        $select_datos_beneficiario->from(array('estudiantes'),array('promedio','semestre_actual','valor_matricula'));
        $select_datos_beneficiario->where('cod_beneficiario = ?',$id);
        $result_datos_beneficiario = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_datos_beneficiario);
        $promedio = $result_datos_beneficiario['promedio'];
        $semestre = $result_datos_beneficiario['semestre_actual'];
        $matricula = $result_datos_beneficiario['valor_matricula'];
        $result['promedio']=$promedio;
        $result['semestre']=$semestre;
        $result['matricula']=$matricula;
        
        $select_cod_municipio = Zend_Db_Table::getDefaultAdapter()->select();
        $select_cod_municipio->from(array('domicilios'),array('cod_municipio'));
        $select_cod_municipio->where('codigo_domicilio = ?',$result['cod_domicilio']);
        $result_cod_municipio = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_cod_municipio);
        $cod_municipio = $result_cod_municipio['cod_municipio'];
            
        $select_municipio = Zend_Db_Table::getDefaultAdapter()->select();
        $select_municipio->from(array('municipios'),array('nombre_municipio','cod_departamento'));
        $select_municipio->where('codigo_municipio = ?',$cod_municipio);
        $result_municipio = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_municipio);
        $municipio = $result_municipio['nombre_municipio'];
        $result['municipio']=$municipio;
        $cod_departamento = $result_municipio['cod_departamento'];
        
        $select_departamento = Zend_Db_Table::getDefaultAdapter()->select();
        $select_departamento->from(array('departamentos'),array('nombre_departamento'));
        $select_departamento->where('codigo_departamento = ?',$cod_departamento);
        $result_departamento = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_departamento);
        $departamento = $result_departamento['nombre_departamento'];
        $result['departamento']=$departamento;
            
        return $result;
    }
}

