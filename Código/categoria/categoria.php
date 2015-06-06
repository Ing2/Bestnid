<?php
require_once '../Conexion.php';


class Categoria
{
	
  protected $_idCategoria;
  protected $_contenidoCat;
  protected $_idEstadoCat;
  // getters y setters 
  

 public function getIdCategoria() {
    return $this->_idCategoria;
  }

 public function setIdCategoria($id){
    $this->_idCategoria = $id;
  }

public function getContenidoCategoria()
{
      return $this->_contenidoCat;
}
public function setContenidoCategoria($cat)
{
       $this->_contenidoCat = $cat;
}  
  
public function getIdEstadoCategoria()
{
      return $this->_idEstadoCat;
}
public function setIdEstadoCategoria($id)
{
       $this->_idEstadoCat = $id;
}  



  
  function __construct($idcat,$contenidocat,$idestadocat)
  {
	$this->setIdCategoria($idcat);
	$this->setContenidoCategoria($contenidocat);
	$this->setIdEstadoCategoria($idestadocat);	
  }
  
  static function buildFromBD($userBD)
  {
  	return new Categoria($userBD['idcategoria'],$userBD['contenido_cat'],$userBD['idestadocat']);
  }
 
	public static function existeCategoria($id)
	{
	$db=conectaDb();

	$res = $db->prepare('SELECT * FROM categoria WHERE idcategoria=:id');
	$res->bindParam(':id', $id);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=Categoria::buildFromBD($row);
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	}
  
  
  // AGREGAR UNA SUBASTA //

	
	//eliminar Categoria , es una baja logica, se hace un update , actualiza el valor de idestadosub=2 . estadosub en 2 significa que esta eliminada//
	public static function eliminarCategoria($idCategoria){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE categoria SET idestadocat=2 WHERE (idcategoria=:id)');
		 $res->bindParam(':id', $idCategoria);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	
	
	public static function recuperarCategoriasActivas()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from categoria where idestadocat=1');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Categoria::buildFromBD($row);
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
		
  public static function recuperarCategoriasTodas()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from categoria INNER JOIN estado_categoria ON estado_categoria.idestadocat=categoria.idestadocat');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Categoria::buildFromBD($row);
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
		
		
		
		
		
//	public static function modificarSubasta($id,$descripcion){
//	$db=conectaDb();

//	$res = $db->prepare('UPDATE alimento SET idsubasta=:id, descripcion=:descripcion WHERE (idsubasta=:id2)');
//	$res->bindParam(':id', $codigo);
//	$res->bindParam(':id2', $id);
//	$res->bindParam(':descripcion', $descripcion);
//	$res->execute();	
//	$db=null;
//	return $res;
//           }

		
		
     public static function recuperarCategoria($id)
	{
	$db=conectaDb();
	$res = $db->prepare('select * from categoria where (idcategoria=:id)');
	$res->bindParam(':id',$id);
	$res->execute();
		if (($row = $res->fetch())){
			$a=Categoria::buildFromBD($row);
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
}




?>
	
