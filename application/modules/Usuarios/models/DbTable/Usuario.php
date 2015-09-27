<?php

class Usuarios_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    
    public function get($id)
    {
        $id = (String) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('nombre_usuario = "'.$id.'"' );
        if (!$row)
       {
         throw new Exception("Could not find row $id");
       }
       return $row->toArray();
    }
    
    public function mostrarUsuarios()
    {
        return $this->fetchAll();
    }
    public function validardisponibilidad($usuario,$tabla,$columna)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        $select->from($tabla,array('count' => 'count(*)'));
        $select->where($columna.' = ?',$usuario);
        $result = Zend_Db_Table::getDefaultAdapter()->fetchRow($select);
        $disponibilidad = $result['count'];
        return $disponibilidad;
    }
    
    function crearUsuario($nombreUsuario,$contrasena,$id,$nombre,$apellido,$cargo,$perfil,$estado)
    {
        $data=array('nombre_usuario'=>$nombreUsuario,'contrasena'=>$contrasena,'identificacion'=>$id,'nombre_real'=>$nombre,'apellido_real'=>$apellido,'cargo'=>$cargo,'perfil'=>$perfil,'estado'=>$estado);
        $this->insert($data);
    }
    
    function modificarUsuario($usuario,$contrasena,$iden,$nombre,$apellido,$cargo,$perfil,$estado)
    {
        $data=array('contrasena'=>$contrasena,'identificacion'=>$iden,'nombre_real'=>$nombre,'apellido_real'=>$apellido,'cargo'=>$cargo,'perfil'=>$perfil,'estado'=>$estado);
        //$where["nombre_usuario = ?"]=$usuario;
        //$this->update($data, $where);
        $this->update($data, "nombre_usuario = '".$usuario."'");
    }
    
    function eliminarUsuario($usuario)
    {
        $this->delete('nombre_usuario = "'.$usuario.'"');
    }
}

