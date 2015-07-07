<?php
require_once '../Conexion.php';
require_once 'fotosubasta.php';
require_once '../oferta/oferta.php';

class Subasta
{
	
  protected $_idSubasta;
  protected $_descripcion;
  protected $_fechaInicio;
  protected $_fechaFin;
  protected $_idEstadoSub;
  protected $_idUsuarioSub;
  protected $_idCategoriaSub;
  protected $_titulo;
  
  
 


  // getters y setters 
  

 public function getIdSubasta() {
    return $this->_idSubasta;
  }

 public function setIdSubasta($id){
    $this->_idSubasta = $id;
  }

public function getDescripcion()
{
      return $this->_descripcion;
}
public function setDescripcion($des)
{
       $this->_descripcion = $des;
}  
  
public function getFechaInicio()
{
      return $this->_fechaInicio;
}
public function setFechaInicio($fecha)
{
       $this->_fechaInicio = $fecha;
}  

public function getFechaFin()
{
      return $this->_fechaFin;
}
public function setFechaFin($fecha)
{
       $this->_fechaFin = $fecha;
}  

public function getIdEstadoSub()
{
      return $this->_idEstadoSub;
}
public function setIdEstadoSub($est)
{
       $this->_idEstadoSub = $est;
}  

public function getIdUsuarioSub()
{
      return $this->_idUsuarioSub;
}
public function setIdUsuarioSub($id)
{
       $this->_idUsuarioSub = $id;
}  

public function getIdCategoriaSub()
{
      return $this->_idCategoriaSub;
}
public function setIdCategoriaSub($cat)
{
       $this->_idCategoriaSub = $cat;
}

public function getTitulo()
{
      return $this->_titulo;
}
public function setTitulo($tit)
{
       $this->_titulo = $tit;
}    

  
  function __construct($idsubasta,$descripcion,$fechainicio,$fechafin,$idestadosub,$idusuariosub,$idcategoriasub,$titulo)
  {
	$this->setIdSubasta($idsubasta);
	$this->setDescripcion($descripcion);
	$this->setFechaInicio($fechainicio);
	$this->setFechaFin($fechafin);
	$this->setIdEstadoSub($idestadosub);
	$this->setIdUsuarioSub($idusuariosub);
	$this->setIdCategoriaSub($idcategoriasub);
	$this->setTitulo($titulo);
	
	
  }
  
  static function buildFromBD($userBD)
  {
  	return new Subasta($userBD['idsubasta'],$userBD['descripcion'],$userBD['fecha_inicio'],$userBD['fecha_fin'],$userBD['idestadosub'],$userBD['idusuariosub'],$userBD['idcategoriasub'],$userBD['titulo']);
  }
 
	public static function existeSubasta($id)
	{
	$db=conectaDb();

	$res = $db->prepare('SELECT * FROM subasta WHERE idsubasta=:id and idestadosub=1');
	$res->bindParam(':id', $id);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=Subasta::buildFromBD($row);
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	}
  
  
  // AGREGAR UNA SUBASTA //

	public static function altaSubasta($subasta)
	{
	$db=conectaDb();
	
	if (!(Subasta::existeSubasta($subasta->getIdSubasta()))){
		
		
							
		
		
		$res = $db->prepare('INSERT INTO grupo10.subasta (idsubasta,descripcion,fecha_inicio,fecha_fin,idestadosub,idusuariosub,idcategoriasub,titulo) VALUES (NULL,:des,:fechai,:fechaf,:estsub,:ususub,:catsub,:tit)');
	
         $res->bindParam(':des', $subasta->getDescripcion());
		  $res->bindParam(':fechai',$subasta->getFechaInicio() );
		 $res->bindParam(':fechaf', $subasta->getFechaFin());
         $res->bindParam(':estsub',$subasta->getIdEstadoSub());
		  $res->bindParam(':ususub',$subasta->getIdUsuarioSub());
		  	 $res->bindParam(':catsub', $subasta->getIdCategoriaSub());
          $res->bindParam(':tit', $subasta->getTitulo());
		  
            $res->execute();	
			$id= $db->lastInsertId();
			$db=null;
			return $id;
		}
		else{
			return null;
			$mensaje="subasta existente";
			exit;
	}
	}
	
	//eliminar subasta , es una baja logica, se hace un update , actualiza el valor de idestadosub=2 . estadosub en 2 significa que esta eliminada//
	public static function eliminarSubasta($idSubasta){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE subasta SET idestadosub=2 WHERE (idsubasta=:id)');
		 $res->bindParam(':id', $idSubasta);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	
	
	public static function recuperarSubastasActivas()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from subasta where idestadosub=1');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
		
		public static function recuperarSubastasActivasParaUnUsuario($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from subasta where idestadosub=1 and idusuariosub=:id');
     $res->bindParam(':id', $id);
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
		
		
		
		
		
  public static function recuperarSubastasTodas()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from subasta');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
		
 public static function recuperarEstadoSubasta($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT estado_subasta.descripcion from estado_subasta INNER JOIN subasta ON estado_subasta.idestadosubasta=:id');
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

	
	
	
	 public static function recuperarUsuarioSubasta($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT usuario.email from usuario INNER JOIN subasta ON usuario.idusuario=:id');
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
	 public static function recuperarCategoriaSubasta($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT categoria.contenido_cat from categoria INNER JOIN subasta ON categoria.idcategoria=:id');
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
		
		
		
		
     public static function recuperarSubasta($id)
	{
	$db=conectaDb();
	$res = $db->prepare('select * from subasta where (idsubasta=:id)');
	$res->bindParam(':id',$id);
	$res->execute();
		if (($row = $res->fetch())){
			$a=Subasta::buildFromBD($row);
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
	
	
	
	
	
 public static function recuperarFoto($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT foto_subasta.foto from foto_subasta INNER JOIN subasta ON foto_subasta.idsubasta=:id');
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
	
		
	public static function recuperarFotos($id)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * from foto_subasta INNER JOIN subasta ON foto_subasta.idsubasta=subasta.idsubasta where subasta.idsubasta=:id");
	$res->bindParam(':id', $id);
		  $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = FotoSubasta::buildFromBD($row);
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public static function filtrarPorTitulo($titulo)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `titulo` LIKE '%$titulo%' AND idestadosub=1");
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorNombreyOrdenarAlfabeticamente($titulo)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `titulo` LIKE '%$titulo%' AND idestadosub=1 ORDER BY `titulo` ASC  ");
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	public static function filtrarPorNombreyOrdenarPorFechaVencimiento($titulo)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `titulo` LIKE '%$titulo%' AND idestadosub=1 ORDER BY `fecha_fin` ASC  ");
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorTituloyCategoria($titulo,$categoria)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `titulo` LIKE '%$titulo%' AND idestadosub=1 AND idcategoriasub=:cat");
	$res->bindParam(':cat', $categoria);
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorNombremasCategoriayOrdenarAlfabeticamente($titulo,$categoria)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `titulo` LIKE '%$titulo%' AND idestadosub=1 AND idcategoriasub=:cat ORDER BY `titulo` ASC");
	$res->bindParam(':cat', $categoria);
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

	public static function filtrarPorNombremasCategoriayOrdenarPorFechaVencimiento($titulo,$categoria)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `titulo` LIKE '%$titulo%' AND idestadosub=1 AND idcategoriasub=:cat ORDER BY `fecha_fin` ASC");
	$res->bindParam(':cat', $categoria);
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	
	
	public static function filtrarPorTituloCategoriayFechas($titulo,$cat,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND titulo LIKE '%$titulo%' AND idcategoriasub=:cat");
	                 $res->bindParam(':cat',$cat);    
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorNombremasFechasmasCategoriayOrdenarAlfabeticamente($titulo,$cat,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND titulo LIKE '%$titulo%' AND idcategoriasub=:cat ORDER BY `titulo` ASC");
	                 $res->bindParam(':cat',$cat);    
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	public static function filtrarPorNombremasFechasmasCategoriayOrdenarPorFechaVencimiento($titulo,$cat,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND titulo LIKE '%$titulo%' AND idcategoriasub=:cat ORDER BY `fecha_fin` ASC");
	                 $res->bindParam(':cat',$cat);    
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	
	
	
	public static function filtrarPorTituloyFechas($titulo,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND titulo LIKE '%$titulo%'");
	                     
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorNombremasFechasyOrdenarAlfabeticamente($titulo,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND titulo LIKE '%$titulo%' ORDER BY `titulo` ASC");
	                     
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorNombremasFechasyOrdenarPorFechaVencimiento($titulo,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND titulo LIKE '%$titulo%' ORDER BY `fecha_fin` ASC");
	                     
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorCategoriayFechas($cat,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND idcategoriasub=:cat");
	              $res->bindParam(':cat',$cat);        
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorCategoriamasFechasyOrdenarAlfabeticamente($cat,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND idcategoriasub=:cat ORDER BY `titulo` ASC");
	              $res->bindParam(':cat',$cat);        
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	public static function filtrarPorCategoriamasFechasyOrdenarPorFechaVencimiento($cat,$fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ( "SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 AND idcategoriasub=:cat ORDER BY `fecha_fin` ASC");
	              $res->bindParam(':cat',$cat);        
	
		  $res->execute();
	
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
	
	
	
public static function filtrarPorFechas($fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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


// ficha inicio

public static function filtrarPorFechaInicio($fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND idestadosub=1");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

public static function filtrarPorFechaInicioOrdenarAlfabeticamente($fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND idestadosub=1  ORDER BY `titulo` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaInicioOrdenarPorVencimiento($fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND idestadosub=1   ORDER BY `fecha_fin` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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








public static function filtrarPorFechaInicioMasCategoria($cat,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `idcategoriasub` =:cat AND idestadosub=1");
	 $res->bindParam(':cat',$cat); 
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaInicioMasCategoriaOrdenarAlfabeticamente($cat,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `idcategoriasub` =:cat AND idestadosub=1 ORDER BY `titulo` ASC");
	 $res->bindParam(':cat',$cat); 
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaInicioMasCategoriaOrdenarPorVencimiento($cat,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `idcategoriasub` =:cat AND idestadosub=1 ORDER BY `fecha_fin` ASC");
	 $res->bindParam(':cat',$cat); 
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

public static function filtrarPorFechaInicioMasTitulo($titulo,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `titulo` LIKE '%$titulo%' AND idestadosub=1");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaInicioMasTituloOrdenarAlfabeticamente($titulo,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `titulo` LIKE '%$titulo%' AND idestadosub=1 ORDER BY `titulo` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaInicioMasTituloOrdenarPorVencimiento($titulo,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `titulo` LIKE '%$titulo%' AND idestadosub=1 ORDER BY `fecha_fin` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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




public static function filtrarPorFechaInicioTituloyCategoria($titulo,$cat,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `titulo` LIKE '%$titulo%'  AND `idcategoriasub` =:cat AND idestadosub=1");
	$res->bindParam(':cat',$cat);
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

public static function filtrarPorFechaInicioTituloyCategoriaOrdenarAlfabeticamente($titulo,$cat,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `titulo` LIKE '%$titulo%'  AND `idcategoriasub` =:cat AND idestadosub=1 ORDER BY `titulo` ASC");
	$res->bindParam(':cat',$cat);
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaInicioTituloyCategoriaOrdenarPorVencimiento($titulo,$cat,$fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` = '$fechainicio' AND `titulo` LIKE '%$titulo%'  AND `idcategoriasub` =:cat AND idestadosub=1 ORDER BY `fecha_fin` ASC");
	$res->bindParam(':cat',$cat);
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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




//fecha fin

public static function filtrarPorFechaFin($fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND idestadosub=1");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

public static function filtrarPorFechaFinOrdenarAlfabeticamente($fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND idestadosub=1  ORDER BY `titulo` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaFinOrdenarPorVencimiento($fechainicio)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND idestadosub=1   ORDER BY `fecha_fin` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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


public static function filtrarPorFechaFinMasCategoria($cat,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `idcategoriasub` =:cat AND idestadosub=1");
	 $res->bindParam(':cat',$cat); 
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaFinMasCategoriaOrdenarAlfabeticamente($cat,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `idcategoriasub` =:cat AND idestadosub=1 ORDER BY `titulo` ASC");
	 $res->bindParam(':cat',$cat); 
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaFinMasCategoriaOrdenarPorVencimiento($cat,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `idcategoriasub` =:cat AND idestadosub=1 ORDER BY `fecha_fin` ASC");
	 $res->bindParam(':cat',$cat); 
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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











public static function filtrarPorFechaFinMasTitulo($titulo,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `titulo` LIKE '%$titulo%' AND idestadosub=1");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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


public static function filtrarPorFechaFinMasTituloOrdenarAlfabeticamente($titulo,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `titulo` LIKE '%$titulo%' AND idestadosub=1 ORDER BY `titulo` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaFinMasTituloOrdenarPorVencimiento($titulo,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `titulo` LIKE '%$titulo%' AND idestadosub=1 ORDER BY `fecha_fin` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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




public static function filtrarPorFechaFinTituloyCategoria($titulo,$cat,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `titulo` LIKE '%$titulo%'  AND `idcategoriasub` =:cat AND idestadosub=1");
	$res->bindParam(':cat',$cat);
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaFinTituloyCategoriaOrdenarAlfabeticamente($titulo,$cat,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `titulo` LIKE '%$titulo%'  AND `idcategoriasub` =:cat AND idestadosub=1 ORDER BY `titulo` ASC");
	$res->bindParam(':cat',$cat);
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechaFinTituloyCategoriaOrdenarPorVencimiento($titulo,$cat,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_fin` = '$fechafin' AND `titulo` LIKE '%$titulo%'  AND `idcategoriasub` =:cat AND idestadosub=1 ORDER BY `fecha_fin` ASC");
	$res->bindParam(':cat',$cat);
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

















public static function filtrarPorFechayOrdenarAlfabeticamente($fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 ORDER BY `titulo` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function filtrarPorFechayOrdenarPorFechaVencimiento($fechainicio,$fechafin)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `fecha_inicio` >= '$fechainicio' AND `fecha_fin` <= '$fechafin' AND idestadosub=1 ORDER BY `fecha_fin` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

public static function filtrarPorCategoria($idcategoria)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `idcategoriasub` ='$idcategoria' AND idestadosub=1");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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


public static function filtrarPorCategoriayOrdenarAlfabeticamente($idcategoria)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `idcategoriasub` ='$idcategoria' AND idestadosub=1 ORDER BY `titulo` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

public static function filtrarPorCategoriayOrdenarPorFechaVencimiento($idcategoria)
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM `subasta` WHERE `idcategoriasub` ='$idcategoria' AND idestadosub=1 ORDER BY `fecha_fin` ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

public static function ordenarPorTitulo()
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM subasta  WHERE idestadosub=1 ORDER BY subasta.titulo ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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

public static function ordenarPorFechaVencimiento()
	{
	$db=conectaDb();
	
	$res = $db->prepare ("SELECT * FROM subasta WHERE idestadosub=1 ORDER BY subasta.fecha_fin ASC");
	
		  $res->execute();
	if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Subasta::buildFromBD($row);
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
public static function TieneOferta($id)
	{
	$db=conectaDb();

	$res = $db->prepare('select COUNT(s.idsubasta) as ofertas
from subasta s , oferta o 
where (( s.idsubasta = o.idsubastaofer) and ( s.idestadosub = 1 ) and ( s.idsubasta = :id ))
group by s.idsubasta');
	$res->bindParam(':id', $id);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=$row[0];
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	} 
	
	public static function cantidadDeFotos($id)
	{
	$db=conectaDb();

	$res = $db->prepare('select COUNT(f.idfoto) as fotos from foto_subasta f , subasta s where (( s.idsubasta = f.idsubasta) and ( s.idestadosub = 1 and ( s.idsubasta = :id ))) group by s.idsubasta');
	$res->bindParam(':id', $id);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=$row[0];
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	} 
	
	
	
	
	
 public static function modificarSubasta($idsubasta,$des,$tit,$cat)
	{
	$db=conectaDb();
	$res = $db->prepare('UPDATE `grupo10`.`subasta` SET descripcion =:des , idcategoriasub =:cat , titulo =:tit WHERE subasta.idsubasta =:id and subasta.idestadosub=1;');
	$res->bindParam(':id',$idsubasta);
	$res->bindParam(':des',$des);
	$res->bindParam(':tit',$tit);
	$res->bindParam(':cat',$cat);
	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
public static function modificarSubastaTitulo($idsubasta,$tit)
	{
	$db=conectaDb();
	$res = $db->prepare('UPDATE `grupo10`.`subasta` SET titulo =:tit WHERE subasta.idsubasta =:id and subasta.idestadosub=1;');
	$res->bindParam(':id',$idsubasta);
	
	$res->bindParam(':tit',$tit);
	
	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
public static function modificarSubastaDescripcion($idsubasta,$des)
	{
	$db=conectaDb();
	$res = $db->prepare('UPDATE `grupo10`.`subasta` SET descripcion =:des WHERE subasta.idsubasta =:id and subasta.idestadosub=1;');
	$res->bindParam(':id',$idsubasta);
	$res->bindParam(':des',$des);
	
	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}


public static function modificarSubastaCategoria($idsubasta,$cat)
	{
	$db=conectaDb();
	$res = $db->prepare('UPDATE `grupo10`.`subasta` SET idcategoriasub =:cat WHERE subasta.idsubasta =:id and subasta.idestadosub=1;');
	$res->bindParam(':id',$idsubasta);
	$res->bindParam(':cat',$cat);
	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
	public static function modificarSubastaDescripcionyTitulo($idsubasta,$des,$tit)
	{
	$db=conectaDb();
	$res = $db->prepare('UPDATE `grupo10`.`subasta` SET descripcion =:des , titulo =:tit WHERE subasta.idsubasta =:id and subasta.idestadosub=1;');
	$res->bindParam(':id',$idsubasta);
	$res->bindParam(':des',$des);
	$res->bindParam(':tit',$tit);
	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
public static function modificarSubastaDescripcionyCategoria($idsubasta,$des,$cat)
	{
	$db=conectaDb();
	$res = $db->prepare('UPDATE `grupo10`.`subasta` SET descripcion =:des , idcategoriasub =:cat WHERE subasta.idsubasta =:id and subasta.idestadosub=1;');
	$res->bindParam(':id',$idsubasta);
	$res->bindParam(':des',$des);
	$res->bindParam(':cat',$cat);
	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
public static function modificarSubastaTituloyCategoria($idsubasta,$tit,$cat)
	{
	$db=conectaDb();
	$res = $db->prepare('UPDATE `grupo10`.`subasta` SET idcategoriasub =:cat , titulo =:tit WHERE subasta.idsubasta =:id and subasta.idestadosub=1;');
	$res->bindParam(':id',$idsubasta);
	$res->bindParam(':tit',$tit);
	$res->bindParam(':cat',$cat);
	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
	
	 public static function controlarSubastas()
	{
	$fechafin=date("Y-m-j");
	$db=conectaDb();
	$res = $db->prepare('UPDATE grupo10.subasta SET idestadosub = 4 WHERE subasta.idestadosub = 1 and subasta.fecha_fin < :fechafin;');
	$res->bindParam(':fechafin',$fechafin);

	

	$res->execute();
		if (($row = $res->fetch())){
			$a=$row;
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
	 public static function controlarFoto($idsubasta)
	{
	$db=conectaDb();
	$res = $db->prepare('select COUNT(f.idfoto)
from  subasta s left join foto_subasta f ON ( s.idsubasta = f.idsubasta ) 
where ( s.idsubasta = :id)
group by s.idsubasta');
	
		$res->bindParam(':id', $idsubasta);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=$row[0];
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;		
	}
	
	
	
	
	
	
	 public static function agregarFotoPorDefecto($idsubasta)
	{


	$db=conectaDb();
	$res = $db->prepare("INSERT INTO `grupo10`.`foto_subasta` (`idfoto`, `idsubasta`, `foto`) VALUES (NULL,:id, 'imagenes/logobestnid.jpg')");
	$res->bindParam(':id',$idsubasta);


	$res->execute();
	$db= null;
	return $res;		
	}
	
		 public static function controlarOfertaParaUsuario($idsubasta,$idusuario)
	{
	$db=conectaDb();
	$res = $db->prepare('select COUNT(o.idoferta)
from oferta o left join subasta s ON ( o.idsubastaofer = s.idsubasta ) 
where (( o.idusuarioofer = :idusuario) and (o.idsubastaofer=:idsub) and (o.idestadoofer=1))
group by s.idsubasta');
	
		$res->bindParam(':idsub', $idsubasta);
		$res->bindParam(':idusuario', $idusuario);
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=$row[0];
			
		}
		else {
	
			return 0; 
		}
			
		$db= null;
		return $a;		
	}
	

	
	
	
		 public static function esTuSubasta($idsubasta,$idusuario)
	{
	$db=conectaDb();
	$res = $db->prepare('select s.idusuariosub
from oferta o left join subasta s ON ( o.idsubastaofer = s.idsubasta ) 
where ((o.idsubastaofer=:idsub) and (o.idestadoofer=1))
group by s.idsubasta');
	
		$res->bindParam(':idsub', $idsubasta);
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=$row[0];
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		if($a==$idusuario)
		{return 1;}
		else
		{return 0;}
	}
	


}
?>
	
