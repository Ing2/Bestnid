<?php
require_once '../Conexion.php';
require_once 'usuariotipo.php';


class Usuario
{
 
//VARIABLES DE INSTANCIA
  protected $_idUsuario;
  protected $_nombre;
  protected $_apellido;
  protected $_email;
  protected $_fechaAlta;
  protected $_idTipo;
  protected $_pass;


  
  
// Getters y Setters
 
 public function getIdUsuario() {
    return $this->_idUsuario;
  }

  public function setIdUsuario($id) {
    $this->_idUsuario = $id;
  }
   public function getNombre() {
    return $this->_nombre;
  }

  public function setNombre($nom) {
    $this->_nombre = $nom;
  }
   public function getApellido() {
    return $this->_apellido;
  }

  public function setApellido($ape) {
    $this->_apellido = $ape;
  }
  
    public function getEmail() {
    return $this->_email;
  }

  public function setEmail($mail) {
    $this->_email = $mail;
  } 

   public function getFechaAlta() {
    return $this->_fechaAlta;
  }

  public function setFechaAlta($fec) {
    $this->_fechaAlta = $fec;
  }

     public function getTipo() {
    return $this->_idTipo;
  }

  public function setTipo($tipo) {
    $this->_idTipo = $tipo;
  }
  
     public function getPass() {
    return $this->_pass;
  }

  public function setPass($pass) {
    $this->_pass = $pass;
  }
  

  
  //CONSTRUCTOR  
  
  function __construct($idUsuario,$nombre,$apellido,$email,$fechaalta,$tipo,$pass)
  {
	$this->setIdUsuario($idUsuario);
	$this->setNombre($nombre);
  	$this->setApellido($apellido);
	$this->setEmail($email);
	$this->setFechaAlta($fechaalta);
	$this->setTipo($tipo);
  	$this->setPass($pass);

  }
  
  static function buildFromBD($userBD)
  {
  	return new Usuario($userBD['idusuario'],$userBD['nombre'],$userBD['apellido'],$userBD['email'],$userBD['fecha_alta'],$userBD['idtipo'],$userBD['password']);
  }
  
  
  //METODOS
  
  // preguntar si existe el usuario independiente de si sea admin o usuario comun.
	public static function existeUsuario($email)
	{
	$db=conectaDb();

	$res = $db->prepare('select * from usuario where email=:emailusuario');
	$res->bindParam(':emailusuario', $email);
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=Usuario::buildFromBD($row);
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	}
	
	
	
	
  
//agregar un usuario 
	public static function altaUsuario($usuario)
	{
	$db=conectaDb();
	
	$fecha=date("Y-m-j");
	$id=2;
	
	if (!(Usuario::existeUsuario($usuario->getEmail()))){
		
		
							//INSERT INTO `grupo10`.`usuario` (`idusuario`, `nombre`, `apellido`, `email`, `fecha_alta`, `idtipo`, `password`, `nombreusuario`);
		
		
		$res = $db->prepare('INSERT INTO `grupo10`.`usuario` (`idusuario`, `nombre`, `apellido`, `email`, `fecha_alta`, `idtipo`, `password`) VALUES (NULL,:nombre,:apellido,:email,:fecha_alta,:idtipo,:pass)');
	
         $res->bindParam(':nombre', $usuario->getNombre());
		  $res->bindParam(':apellido',$usuario->getApellido() );
		 $res->bindParam(':email', $usuario->getEmail());
         $res->bindParam(':fecha_alta',$fecha);
		  $res->bindParam(':idtipo', $id);
		  	 $res->bindParam(':pass', $usuario->getPass());
         
		  
            $res->execute();	
			$db=null;
			return $usuario;
		}
		else{
			return null;
			$mensaje="Usuario existente";
			exit;
	}
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
	
	// RECUPERAR TODOS LOS USUARIOS DEL SISTEMA ADMIN , USUARIOS , eliminados tambien.
	public static function recuperarUsuariosTodos()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from usuario INNER JOIN tipo_usuario where tipo_usuario.idtipousuario = usuario.idtipo');
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
}




?>
	
