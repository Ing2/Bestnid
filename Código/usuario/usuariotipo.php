<?php
require_once '../Conexion.php';

class UsuarioTipo
{
	protected $_idTipo;
	protected $_descripcion;

	 /**
 * Getters & Setters
 */

 public function getIdTipo() {
    return $this->_idTipo;
  }

  public function setIdTipo($idTipo) {
    $this->_idTipo = $idTipo;
  }
 
 public function getDescripcion() {
    return $this->_descripcion;
  }

  public function setDescripcion($des) {
    $this->_descripcion = $des;
  }
  
  function __construct($idTipo,$descripcion)
  {
	$this->setIdTipo($idTipo);
	$this->setDescripcion($descripcion);	
  }
  
  static function buildFromBD($usuarioRolBD)
  {
  	return new UsuarioTipo($usuarioRolBD['idusuario'],$usuarioRolBD['descripcion']);
  }
  
  public static function recuperarTipo($idusuario)
  {
	$db=conectaDb();
	$res = $db->prepare('select * from tipo_usuario where (idtipousuario=:id)');
      $res->bindParam(':id', $idusuario);	
	  $res->execute();	
		if (($row = $res->fetch())){
			$a=UsuarioTipo::buildFromBD($row);
			//print_r($a);
			}
		else {
			$mensaje="El usuario no tiene seteado un tipo";
			
		}
		$db=null;
		return $a;
		}
		
	public static function altaUsuarioRol($usuarioRol)
	{
	$db=conectaDb();
	$res = $db->prepare('insert into usuariorol (idusuario, idrol) values (:idusuario, :idrol)');
	 $res->bindParam(':idusuario', $usuarioRol->getIdUsuario());
 	 $res->bindParam(':idrol', $usuarioRol->getIdRol());
        $res->execute();	
		$db=null;
		return $usuarioRol;
		}

	
	
	public static function eliminarUsuarioRol($usuarioId){
	$db=conectaDb();
	$res = $db->prepare('DELETE from usuariorol where idUsuario=:id');
	$res->bindParam(':id', $usuarioId);
        $res->execute();	
	$db=null;
	}
	
	public static function ModUsuarioRol($usuarioRol)
	{
	$db=conectaDb();
	$res = $db->prepare('update usuariorol set idusuario =:idusuario, idrol =:idrol where idusuario =:idusu');
	$res->bindParam(':idusuario', $usuarioRol->getIdUsuario());
	$res->bindParam(':idrol', $usuarioRol->getIdRol());
	$res->bindParam(':idusu', $usuarioRol->getIdUsuario());
        $res->execute();
    $db=null;
	return $usuarioRol;
	}
	public static function recuperarRolPorNombre($nombre)
  {
	$db=conectaDb();
	$res = $db->prepare('select * from rol where nombre=:nombre');
	$res->bindParam(':nombre', $nombre);
        $res->execute();
	
		if (($row = $res->fetch())){
			$a=Rol::buildFromBD($row);
			
			}
		else {
			$mensaje="El usuario no tiene seteado un rol";
			
		}
		$db=null;
		return $a;
		}
	
}