<?php
require_once '../Conexion.php';


class Oferta
{
	
  protected $_idOferta;
  protected $_razon;
  protected $_monto;
  protected $_esGanador;
  protected $_idEstadoOferta;
  protected $_idUsuarioOferta;
  protected $_idSubastaOferta;
  
  // getters y setters 
  

 public function getIdOferta() {
    return $this->_idOferta;
  }

 public function setIdOferta($id){
    $this->_idOferta = $id;
  }

public function getRazon()
{
      return $this->_razon;
}
public function setRazon($razon)
{
       $this->_razon = $razon;
}  
  
public function getMonto()
{
      return $this->_monto;
}
public function setMonto($monto)
{
       $this->_monto = $monto;
}  

public function getEsGanador()
{
      return $this->_esGanador;
}
public function setEsGanador($booleano)
{
       $this->_esGanador = $booleano;
}  

public function getIdEstadoOferta()
{
      return $this->_idEstadoOferta;
}
public function setIdEstadoOferta($est)
{
       $this->_idEstadoOferta = $est;
}  

public function getIdUsuarioOferta()
{
      return $this->_idUsuarioOferta;
}
public function setIdUsuarioOferta($id)
{
       $this->_idUsuarioOferta = $id;
}  

public function getIdSubastaOferta()
{
      return $this->_idSubastaOferta;
}
public function setIdSubastaOferta($sub)
{
       $this->_idSubastaOferta = $sub;
}

  
  function __construct($idoferta,$razon,$monto,$esganador,$idestadooferta,$idusuariooferta,$idsubastaoferta)
  {
	$this->setIdOferta($idoferta);
	$this->setRazon($razon);
	$this->setMonto($monto);
	$this->setEsGanador($esganador);
	$this->setIdEstadoOferta($idestadooferta);
	$this->setIdUsuarioOferta($idusuariooferta);
	$this->setIdSubastaOferta($idsubastaoferta);
	
	
	
  }
  
  static function buildFromBD($userBD)
  {
  	return new Oferta($userBD['idoferta'],$userBD['razon'],$userBD['monto'],$userBD['esganador'],$userBD['idestadoofer'],$userBD['idusuarioofer'],$userBD['idsubastaofer']);
  }
 
	public static function existeOferta($id)
	{
	$db=conectaDb();

	$res = $db->prepare('SELECT * FROM oferta WHERE idoferta=:id');
	$res->bindParam(':id', $id);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=Oferta::buildFromBD($row);
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	}
  
  
  // AGREGAR UNA SUBASTA //
	public static function altaOferta($oferta)
	{
	$db=conectaDb();
	
	if (!(Oferta::existeOferta($oferta->getIdOferta()))){
	                   	
		$res = $db->prepare('INSERT INTO oferta (idoferta,razon,monto,esganador,idestadoofer,idusuarioofer,idsubastaofer) 
		VALUES (:id,:razon,:monto,:esganador,:idestadoofer,:idusuarioofer,:idsubastaofer)');
		   $res->bindParam(':id', $oferta->getIdOferta());
		  $res->bindParam(':razon', $oferta->getRazon());
		  $res->bindParam(':monto', $oferta->getMonto());
		 $res->bindParam(':esganador', $oferta->getEsGanador());
		 $res->bindParam(':idestadoofer', $oferta->getIdEstadoOferta());
		 $res->bindParam(':idusuarioofer', $oferta->getIdUsuarioOferta());
		 $res->bindParam(':idsubastaofer', $oferta->getIdSubastaOferta());
	
		  
      $res->execute();	
			$db=null;
			return $oferta;
		}
		else{
			return null;
			$mensaje="Oferta Existente";
			exit;
	}
	}	
	
	//eliminar oferta , es una baja logica, se hace un update , actualiza el valor de idestadosub=2 . estadosub en 2 significa que esta eliminada//
	public static function eliminarOferta($idOferta){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE oferta SET idestadoofer=2 WHERE (idoferta=:id)');
		 $res->bindParam(':id', $idOferta);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	
	
	public static function recuperarOfertasActivas()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from oferta where idestadoofer=1');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Oferta::buildFromBD($row);
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
		
  public static function recuperarOfertasTodas()
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from Oferta INNER JOIN estado_oferta ON estado_oferta.idestadooferta=oferta.idestadoofer');
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Oferta::buildFromBD($row);
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
		
	  public static function recuperarOfertasActivasParaUnUsuario($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from Oferta where oferta.idusuarioofer=:id and oferta.idestadoofer=1');
	$res->bindParam(':id',$id);
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Oferta::buildFromBD($row);
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

		
		
     public static function recuperarOferta($id)
	{
	$db=conectaDb();
	$res = $db->prepare('select * from oferta where (idoferta=:id)');
	$res->bindParam(':id',$id);
	$res->execute();
		if (($row = $res->fetch())){
			$a=Oferta::buildFromBD($row);
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
	}
	
	   public static function modificarOferta($monto,$idoferta)
	{
	$db=conectaDb();
	$res = $db->prepare('UPDATE grupo10.oferta SET monto=:monto WHERE oferta.idoferta=:id');
	$res->bindParam(':monto',$monto);
	$res->bindParam(':id',$idoferta);
	
	$res->execute();
		if (($row = $res->fetch())){
			$a=Oferta::buildFromBD($row);
			
			}
		else {
			return null; 
		}
		$db=null;
		return $a;
		
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
	
			return false; 
		}
			
		$db= null;
		return $a;		
	}


	
		 public static function devolverTitulo($idsubastaofer)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT s.titulo FROM subasta s inner join oferta o on s.idsubasta=o.idsubastaofer where o.idsubastaofer=:idsub');
	
		$res->bindParam(':idsub', $idsubastaofer);

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
		{
			return true;
		}
		else{
		return false;}		
	}
	

  public static function recuperarOfertasParaUnaSubasta($id)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * FROM `oferta` where idsubastaofer=:id');
		$res->bindParam(':id', $id);
	 $res->execute();
		if (($row = $res->fetch())){
			$i=0;
			  $objArrayConsult = array();
			  do
			  {
				 
				  $objConsult = Oferta::buildFromBD($row);
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

	public static function eliminarUsuarioOferta($usuarioId){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE oferta o SET o.idestadoofer=2 WHERE (o.idusuarioofer=:id)');
		 $res->bindParam(':id', $usuarioId);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	//baja logica idtipo=4 es el id que corresponde a ofertas de una subasta a un usuario eliminado mirar base de datos
	public static function eliminarUsuarioSubastaOferta($usuarioId){
	$db=conectaDb();
         	$res = $db->prepare('update oferta o INNER JOIN subasta s on o.idsubastaofer = s.idsubasta set o.idestadoofer = 2 where s.idusuariosub =:id');
		 $res->bindParam(':id', $usuarioId);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	
	

	public static function pasarOfertaASinExito($IdSubasta){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE `grupo10`.`oferta` SET `idestadoofer` = 3 WHERE oferta.idsubastaofer = :id');
		 $res->bindParam(':id', $IdSubasta);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
		public static function pasarOfertaAGanadora($IdGanadora){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE `grupo10`.`oferta` SET `idestadoofer` = 4 WHERE oferta.idoferta = :id');
		 $res->bindParam(':id', $IdGanadora);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}
	public static function eliminarSubastaOferta($subasta){
	$db=conectaDb();
         	$res = $db->prepare('UPDATE oferta o SET o.idestadoofer=2 WHERE (o.idsubastaofer=:id)');
		 $res->bindParam(':id', $subasta);
			$res->execute();
         	$db=null;
			return true;
			exit;
	}

	

}


?>
	
