<?php
require_once '../Conexion.php';


class Respuesta
{
 
//VARIABLES DE INSTANCIA
  protected $_idRespuesta;
  protected $_idComentario;
  protected $_idUsuarioRespuesta;
  protected $_cuerpo;
  protected $_fechaRespuesta;
  protected $_idEstadoRespuesta;

  
  
// Getters y Setters
 
 public function getIdRespuesta() {
    return $this->_idRespuesta;
  }

  public function setIdRespuesta($id) {
    $this->_idRespuesta = $id;
  }
 
   public function getIdComentario() {
    return $this->_idComentario;
  }

  public function setIdComentario($idcom) {
    $this->_idComentario = $idcom;
  }
  
    public function getIdUsuarioRespuesta() {
    return $this->_idUsuarioRespuesta;
  }

  public function setIdUsuarioRespuesta($idusur) {
    $this->_idUsuarioRespuesta = $idusur;
  } 

  public function getCuerpo() {
    return $this->_cuerpo;
  }

  public function setCuerpo($cuerpo) {
    $this->_cuerpo = $cuerpo;
  }
public function getFechaRespuesta() {
    return $this->_fechaRespuesta;
  }

  public function setFechaRespuesta($fecha) {
    $this->_fechaRespuesta = $fecha;
  }
public function getIdEstadoRespuesta() {
    return $this->_idEstadoRespuesta;
  }

  public function setIdEstadoRespuesta($id) {
    $this->_idEstadoRespuesta = $id;
  }




  
  //CONSTRUCTOR  
  
  function __construct($idrespuesta,$idcomentario,$idusuariorespuesta,$cuerpo,$fecharespuesta,$idestadorespuesta)
  {
	$this->setIdRespuesta($idrespuesta);
	$this->setIdComentario($idcomentario);
	$this->setIdUsuarioRespuesta($idusuariorespuesta);
  	$this->setCuerpo($cuerpo);
	$this->setFechaRespuesta($fecharespuesta);
	$this->setIdEstadoRespuesta($idestadorespuesta);
  }
  
    static function buildFromBD($userBD)
  {
  	return new Respuesta($userBD['idrespuesta'],$userBD['idcomentario'],$userBD['idusuariorespuesta'],$userBD['cuerpo'],$userBD['fecharespuesta'],$userBD['idestadorespuesta']);
  }
  
  

  

//agregar una respuesta
	public static function altaRespuesta($respuesta)
	{
	$db=conectaDb();
	
	$fecha=date("Y-m-j");
	
			
		$res = $db->prepare('INSERT INTO `grupo10`.`respuesta` (`idrespuesta`, `idcomentario`, `idusuariorespuesta`, `cuerpo`, `fecharespuesta`,`idestadorespuesta`) VALUES (NULL,:idcomentario,:idusuario,:cuerpo,:fecha_com,1)');
		  
		  $res->bindParam(':idcomentario', $respuesta->getIdComentario());
		 $res->bindParam(':idusuario', $respuesta->getIdUsuarioRespuesta());
		  $res->bindParam(':cuerpo', $respuesta->getCuerpo());
		  $res->bindParam(':fecha_com',$fecha);
	
            $res->execute();	
			$db=null;
			return $respuesta;
	}

	public static function eliminarRespuesta($idrespuesta){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE `grupo10`.`respuesta` SET `idestadorespuesta` =2 WHERE `respuesta`.`idrespuesta`=:id ');
		 $res->bindParam(':id', $idrespuesta);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
  public static function eliminarRespuestaSubasta($comentario){
  $db=conectaDb();
          $res = $db->prepare('UPDATE respuesta r SET r.idestadorespuesta=2 WHERE (r.idcomentario=:id)');
     $res->bindParam(':id', $comentario);
      $res->execute();
          $db=null;
      return true;
      exit;
  }
  public static function eliminarRespuestaUsuario($usuario){
  $db=conectaDb();
          $res = $db->prepare('UPDATE respuesta r SET r.idestadorespuesta=2 WHERE (r.idusuariorespuesta=:id)');
     $res->bindParam(':id', $usuario);
      $res->execute();
          $db=null;
      return true;
      exit;
  }


	   public static function modificarRespuesta($idrespuesta,$cuerpo,$fechares){
	$db=conectaDb();
	$res = $db->prepare('UPDATE grupo10.respuesta SET cuerpo=:respuesta, fecharespuesta =:fecha WHERE respuesta.idrespuesta =:id');
	$res->bindParam(':id',$idrespuesta);
	$res->bindParam(':respuesta',$cuerpo);
	$res->bindParam(':fecha',$fechares);
	$res->execute();	
	$db=null;
	return $res;
            }






}
?>
	
