<?php
require_once '../Conexion.php';
require_once 'respuesta.php';



class Comentario
{
 
//VARIABLES DE INSTANCIA
  protected $_idComentario;
  protected $_cuerpo;
  protected $_idUsuarioCom;
  protected $_idSubastaCom;
  protected $_idEstadoCom;
  protected $_fechacom;

  
  
// Getters y Setters
 
 public function getIdComentario() {
    return $this->_idComentario;
  }

  public function setIdComentario($id) {
    $this->_idComentario = $id;
  }
   public function getCuerpo() {
    return $this->_cuerpo;
  }

  public function setCuerpo($cuerpo) {
    $this->_cuerpo = $cuerpo;
  }
   public function getIdUsuarioCom() {
    return $this->_idUsuarioCom;
  }

  public function setIdUsuarioCom($idusu) {
    $this->_idUsuarioCom = $idusu;
  }
  
    public function getIdSubastaCom() {
    return $this->_idSubastaCom;
  }

  public function setIdSubastaCom($idsub) {
    $this->_idSubastaCom = $idsub;
  } 

   public function getIdEstadoCom() {
    return $this->_idEstadoCom;
  }

  public function setIdEstadoCom($idest) {
    $this->_idEstadoCom = $idest;
  }
public function getFechaCom() {
    return $this->_fechacom;
  }

  public function setFechaCom($fecha) {
    $this->_fechacom = $fecha;
  }

  
  //CONSTRUCTOR  
  
  function __construct($idcomentario,$cuerpo,$fechacom,$idUsuarioCom,$idSubastaCom,$idEstadoCom)
  {
	$this->setIdComentario($idcomentario);
	$this->setCuerpo($cuerpo);
	$this->setFechaCom($fechacom);
  	$this->setIdUsuarioCom($idUsuarioCom);
	$this->setIdSubastaCom($idSubastaCom);
	$this->setIdEstadoCom($idEstadoCom);
	


  }
  
  static function buildFromBD($userBD)
  {
  	return new Comentario($userBD['idcomentario'],$userBD['cuerpo'],$userBD['fecha_com'],$userBD['idusuariocom'],$userBD['idsubastacom'],$userBD['idestadocom']);
  }
  
  

  

//agregar un comentario
	public static function altaComentario($comentario)
	{
	$db=conectaDb();
	
	$fecha=date("Y-m-j");
	$id=2;
			
		$res = $db->prepare('INSERT INTO `grupo10`.`comentario` (`idcomentario`, `cuerpo`, `fecha_com`, `idusuariocom`, `idsubastacom`, `idestadocom`) VALUES (NULL,:cuerpo,:fecha_com,:idusuariocom,:idsubastacom,:idestadocom)');
	
         $res->bindParam(':cuerpo', $comentario->getCuerpo());
		  $res->bindParam(':fecha_com',$fecha);
		 $res->bindParam(':idusuariocom', $comentario->getIdUsuarioCom());
         $res->bindParam(':idsubastacom', $comentario->getIdSubastaCom());
		  $res->bindParam(':idestadocom', $comentario->getIdEstadoCom());  
            $res->execute();	
			$db=null;
			return $comentario;
		}



	
	// RECUPERAR EL TIPO te imprimiria todo lo del usuario + el tipo (usuario,administrador,usuario eliminado,administrador eliminado) //
	
	public static function recuperarTipo($id)
	{
	print_r ($id);
	$db=conectaDb();
	$res = $db->prepare('SELECT * FROM tipo_usuario INNER JOIN usuario
	WHERE (:id = usuario.idusuario)AND (usuario.idtipo = tipo_usuario.idtiposuario)');
	$res->bindParam(':id', $id);
		  $res->execute();
		  
		if (($row = $res->fetch())){
			
			$a=TipoUsuario::buildFromBD($row);
			
			}
		else {
			$mensaje="El usuario no tiene un tipo configurado";
		}
		$db=null;
		return $a;
	
	}
	
	//baja logica
	public static function eliminarComentario($idcomentario){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE `grupo10`.`comentario` SET `idestadocom` =2 WHERE `comentario`.`idcomentario`=:id ');
		 $res->bindParam(':id', $idcomentario);
			$res->execute();
			$res2 = $db->prepare('UPDATE `grupo10`.`respuesta` SET `idestadorespuesta` =2 WHERE `respuesta`.`idcomentario`=:id ');
		 $res2->bindParam(':id', $idcomentario);
			$res2->execute();



         	$db=null;
			return true;
			exit;





	}
	public static function eliminarComentarioSubasta($subasta){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE comentario c SET c.idestadocom=2 WHERE (c.idsubastacom=:id)');
		 $res->bindParam(':id', $subasta);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	public static function eliminarComentarioSubastaUsuario($subasta){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE comentario c INNER JOIN subasta s on c.idsubastacom = s.idsubasta SET c.idestadocom=2 WHERE s.idusuariosub=:id');
		 $res->bindParam(':id', $subasta);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	public static function eliminarComentarioUsuario($usuario){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE comentario c SET c.idestadocom=2 WHERE (c.idusuariocom=:id)');
		 $res->bindParam(':id', $usuario);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}

	
	// RECUPERAR Todos los comentarios para una subasta dada.
	public static function recuperarComentariosParaSubasta($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * FROM `comentario` WHERE idsubastacom=:id and idestadocom=1');
	$res->bindParam(':id', $id);
	$res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Comentario::buildFromBD($row);
				  $objArrayConsult[$i] = $objConsult; 
				  $i = $i + 1;
				}while(($row = $res->fetch()));
			}
			else{
			return null;
			}
		$db=null;
		return $objArrayConsult;
	}
	public static function recuperarComentariosParaUsuario($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * FROM `comentario` WHERE idusuariocom=:id and idestadocom=1');
	$res->bindParam(':id', $id);
	$res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Comentario::buildFromBD($row);
				  $objArrayConsult[$i] = $objConsult; 
				  $i = $i + 1;
				}while(($row = $res->fetch()));
			}
			else{
			return null;
			}
		$db=null;
		return $objArrayConsult;
	}

	public static function recuperarRespuestaParaComentario($idcomentario)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * FROM respuesta r where r.idcomentario=:id and r.idestadorespuesta=1');
	$res->bindParam(':id', $idcomentario);
	$res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Respuesta::buildFromBD($row);
				  $objArrayConsult[$i] = $objConsult; 
				  $i = $i + 1;
				}while(($row = $res->fetch()));
			}
			else{
			return null;
			}
		$db=null;
		return $objArrayConsult;
	}


 






	
   
  // VER CUANTOS SE NECESITAN DEL MODIFICAR 
   public static function modificarComentario($idcomentario,$comentario,$fechacom){
	$db=conectaDb();
	$res = $db->prepare('UPDATE grupo10.comentario SET cuerpo=:comentario, fecha_com =:fecha WHERE comentario.idcomentario =:id');
	$res->bindParam(':id',$idcomentario);
	$res->bindParam(':comentario',$comentario);
	$res->bindParam(':fecha',$fechacom);
	$res->execute();	
	$db=null;
	return $res;
            }

		
		

 public static function recuperarUsuarioComentario($id)
	{
	$db=conectaDb();
	
	$res = $db->prepare('SELECT u.email from usuario u inner join comentario c ON ( u.idusuario = c.idusuariocom ) where (u.idusuario=:id)');
	 $res->bindParam(':id', $id);
	$res->execute();
	if (($row = $res->fetch())){
	    $row = $res->fetch();
		  }
			else{
			return null;
			}
	return $row[0];
	}
	public static function recuperarComentarioSubasta($id)
	{
	$db=conectaDb();
	
	$res = $db->prepare('SELECT * from comentario where (c.idsubastacom=:id)');
	 $res->bindParam(':id', $id);
	$res->execute();
	if (($row = $res->fetch())){
	    $row = $res->fetch();
		  }
			else{
			return null;
			}
	return $row[0];
	}






	

  public static function recuperarComentariosTodos()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from comentario');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Comentario::buildFromBD($row);
				  $objArrayConsult[$i] = $objConsult; 
				  $i = $i + 1;
				}while(($row = $res->fetch()));
			}
			else{
			return null;
			}
		$db=null;
		return $objArrayConsult;
		}
}




?>
	
