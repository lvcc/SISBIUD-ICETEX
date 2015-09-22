<?php

class Giros_Model_DbTable_GiroEstudiante extends Zend_Db_Table_Abstract
{

    protected $_name = 'giro_estudiante';
       
    function insertar($resolucion,$datos)
    {
        if(empty($datos['total_estudiantes']))
            $datos['total_estudiantes']=1;
           
        for($i=1;$i<=$datos['total_estudiantes'];$i++){
            $select2 = Zend_Db_Table::getDefaultAdapter()->select();
            $select2->from(array('beneficiarios'),array('codigo_beneficiario'));
            $select2->where('codigo_ud = ?',$datos['cod_es_'.$i]);
            $result2 = Zend_Db_Table::getDefaultAdapter()->fetchRow($select2);
            $resultado2 = $result2['codigo_beneficiario'];
            $sql = "insert into giro_estudiante values ('',".$resolucion.",".$resultado2.",".$datos['val_es_'.$i].")";
            $this->getAdapter()->query($sql);
        }
    }
    
    function actualizar($resolucion,$datos)
    {
        var_dump($datos);
        var_dump(count($datos));
        
        $total_estudiantes = (count($datos)-4)/5;
        var_dump($total_estudiantes); 

        for($i=1;$i<=$total_estudiantes;$i++){
            $select2 = Zend_Db_Table::getDefaultAdapter()->select();
            $select2->from(array('beneficiarios'),array('codigo_beneficiario'));
            if(!$datos['cod_es_'.$i]){
              $total_estudiantes=$total_estudiantes+1; 
            }
            else{
              $select2->where('codigo_ud = ?',$datos['cod_es_'.$i]);       
              $result2 = Zend_Db_Table::getDefaultAdapter()->fetchRow($select2);
   
              $resultado2 = $result2['codigo_beneficiario'];
              $sql = "insert into giro_estudiante values ('',".$resolucion.",".$resultado2.",".$datos['val_es_'.$i].")";
              $this->getAdapter()->query($sql);
            }
        }
    }
    
    function limpiarGiro($id)
    {
        $this->delete('id_resolucion = '.(int)$id);   
    }
    
    function get_estudiantes($id)
    {
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        $select->from(array('giro_estudiante'));
        $select->where('id_resolucion = ?',$id);
        $result = Zend_Db_Table::getDefaultAdapter()->fetchAll($select); 
        $aux = 0;
        foreach ($result as $row){
            $select_datos = Zend_Db_Table::getDefaultAdapter()->select();
            $select_datos->from(array('beneficiarios'),array('codigo_ud','nombres','apellidos','email_personal'));
            $select_datos->where('codigo_beneficiario = ?',$row['cod_estudiante']);
            $result_datos = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_datos);
            $codigo_ud = $result_datos['codigo_ud'];
            $nombre_completo = $result_datos['nombres']." ".$result_datos['apellidos'];
            $email = $result_datos['email_personal'];
            $result[$aux]['codigo_ud']=$codigo_ud;
            $result[$aux]['nombre_completo']=$nombre_completo;
            $result[$aux]['email']=$email;
            $select_proyecto = Zend_Db_Table::getDefaultAdapter()->select();
            $select_proyecto->from(array('es' => 'estudiantes'),array('p.nombre_proyecto'));
            $select_proyecto->joinleft( array('p' => 'proyectos_curriculares'),'es.cod_proyecto = p.codigo_proyecto',array());
            $select_proyecto->where('es.cod_beneficiario = ?',$row['cod_estudiante']);
            $result_proyecto = Zend_Db_Table::getDefaultAdapter()->fetchRow($select_proyecto);
            $proyecto = $result_proyecto['nombre_proyecto'];
            $result[$aux]['proyecto']=$proyecto;
            $aux++;
        }
        return $result;
    }
}

