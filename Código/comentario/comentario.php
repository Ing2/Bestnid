<?php
require_once '../Conexion.php';


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
	
	//baja logica idtipo=4 es el id que corresponde a Usuario Eliminado mirar base de datos
	public static function eliminarUsuario($usuarioId){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE usuario SET idtipo=4 WHERE (idusuario=:id)');
		 $res->bindParam(':id', $usuarioId);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	//baja logica idtipo=3 es el id que corresponde a Administrador Eliminado mirar base de datos
		public static function eliminarAdministrador($AdminId){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE usuario SET idtipo=3 WHERE (idusuario=:id)');
		 $res->bindParam(':id', $AdminId);
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
 
// VER USUARIOS ACTIVOS 
 public static function recuperarUsuariosActivos()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from usuario INNER JOIN tipo_usuario where (tipo_usuario.idtipousuario = usuario.idtipo) and (usuario.idtipo=1 or usuario.idtipo=2)');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Usuario::buildFromBD($row);
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





// VER USUARIOS ELIMINADOS 	
	 public static function recuperarUsuariosEliminados()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from usuario INNER JOIN tipo_usuario where (tipo_usuario.idtipousuario = usuario.idtipo) and (usuario.idtipo=3 or usuario.idtipo=4)');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Usuario::buildFromBD($row);
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
   public static function modUsuario($id){
	$db=conectaDb();
	$res = $db->prepare('update usuario set user =:user, pass = :pass where (idusuario = :idwhere)');
	$res->bindParam(':user',$user);
	$res->bindParam(':pass',$pass);
	$res->bindParam(':idwhere',$id);
	$res->execute();	
	$db=null;
	return $res;
            }

		
		
     public static function recuperarUsuario($id)
	{
	$db=conectaDb();
	$res = $db->prepare('select * from usuario where (idusuario=:id)');
	$res->bindParam(':id',$id);
	$res->execute();
		if (($row = $res->fetch())){
			$a=Usuario::buildFromBD($row);
			
			}
		else {
			return null; 
		}
		
		$db=null;
		return $a;
		
	}
 public static function recuperarUsuarioComentario($id)
	{
	$db=conectaDb();
	$numero=20;
	$res = $db->prepare('SELECT u.email from usuario u inner join comentario c ON ( u.idusuario = c.idusuariocom ) where (u.idusuario=20)');
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






	public static function filtrarPorFechas($fechainicio,$fechafin)
	{
	$db=conectaDb();
	echo $fechainicio;
	echo $fechafin;
	$res = $db->prepare (' select * from usuario u where (( $fechainicio <= u.fecha_alta) and (u.fecha_alta <= $fechafin) and (u.idtipo=2))');
	
		  $res->execute();
		  print_r($res);
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				
				  $objConsult = Usuario::buildFromBD($row);
				  print_r ($objConsult);
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
public static function filtrarPorFechaInicio($fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `usuario` WHERE `fecha_alta` = '$fechainicio' AND idtipo=1");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Usuario::buildFromBD($row);
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
	
