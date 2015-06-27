<?php
require_once '../Conexion.php';


class FotoSubasta
{
	
  protected $_idFoto;
  protected $_idSubasta;
  protected $_foto;
  // getters y setters 
  

 public function getIdFoto() {
    return $this->_idFoto;
  }

 public function setIdFoto($id){
    $this->_idFoto = $id;
  }

   public function getIdSubasta() {
    return $this->_idSubasta;
  }

 public function setIdSubasta($id){
    $this->_idSubasta = $id;
  }

   public function getFoto() {
    return $this->_foto;
  }

 public function setFoto($ruta){
    $this->_foto = $ruta;
  }
  
  
  
  function __construct($id,$idsubasta,$ruta)
  {
	$this->setIdFoto($id);  
	$this->setIdSubasta($idsubasta);
	$this->setFoto($ruta);
	
  }
  
  static function buildFromBD($userBD)
  {
  	return new FotoSubasta($userBD['idfoto'],$userBD['idsubasta'],$userBD['foto']);
  }
 
	public static function existeFotoSubasta($id)
	{
	$db=conectaDb();

	$res = $db->prepare('SELECT * FROM `foto_subasta` WHERE `idfoto` = :id');
	$res->bindParam(':id', $id);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=FotoSubasta::buildFromBD($row);
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	}
  
	public static function altaFotoSubasta($fotosubasta)
	{
		//echo "Foto Subasta: ";
		//print_r($fotosubasta);
		
	$db=conectaDb();	
	if (!(FotoSubasta::existeFotoSubasta($fotosubasta->getIdFoto()))){
		
		$res = $db->prepare('INSERT INTO grupo10.foto_subasta (idfoto,idsubasta,foto) VALUES (:id,:idsubasta,:foto)');
	
 $res->bindParam(':id',$fotosubasta->getIdFoto() );
		  $res->bindParam(':idsubasta',$fotosubasta->getIdSubasta() );
		 $res->bindParam(':foto', $fotosubasta->getFoto());

		  
            $res->execute();	
			$db=null;
			return $fotosubasta;
		}
		else{
			return null;
			$mensaje="subasta existente";
			exit;
	}
	}
	
	public static function borrarFotoSubasta($id)
	{
	
	$db=conectaDb();			
	$res = $db->prepare('DELETE FROM grupo10.foto_subasta WHERE idfoto=:id');
	$res->bindParam(':id',$id );
	$res->execute();	
	$db=null;
    return $id;

	}
	
	
	
		public static function idMaximo()
	{
	$db=conectaDb();

	$res = $db->prepare('SELECT MAX(idfoto) FROM foto_subasta');
	
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
	
	
	
	
	
	
	
	
}
?>
	
