<?php
require_once '../Conexion.php';

class Mail {
	protected $_idMail;
  protected $_origenMail;
  protected $_destinoMail;
  protected $_fechaMail;
  protected $_asuntoMail;
  protected $_contenidoMail;

  // getters y setters 
  public function getIdMail() {
    return $this->_idMail;
  }

 public function setIdMail($id){
    $this->_idMail = $id;
  }
  public function getOrigenMail() {
    return $this->_origenMail;
  }

 public function setOrigenMail($origenMail){
    $this->_origenMail = $origenMail;
  }
  public function getDestinoMail() {
    return $this->_destinoMail;
  }

 public function setDestinoMail($destinoMail){
    $this->_destinoMail = $destinoMail;
  }
  public function getFechaMail() {
    return $this->_fechaMail;
  }

 public function setFechaMail($fechaMail){
    $this->_fechaMail = $fechaMail;
  }
  public function getAsuntoMail() {
    return $this->_asuntoMail;
  }

 public function setAsuntoMail($asuntoMail){
    $this->_asuntoMail = $asuntoMail;
  }
  public function getContenidoMail() {
    return $this->_contenidoMail;
  }

 public function setContenidoMail($contenidoMail){
    $this->_contenidoMail = $contenidoMail;
  }
  
  
  function __construct($idmail,$origenmail,$destinomail,$fechamail,$asuntomail,$contenidomail)
  {
	  $this->setIdMail($idmail);
	  $this->setOrigenMail($origenmail);
	  $this->setDestinoMail($destinomail);
	  $this->setFechaMail($fechamail);
	  $this->setAsuntoMail($asuntomail);
	  $this->setContenidoMail($contenidomail);
  }
  
  static function buildFromBD($userBD)
  {
  	return new Mail($userBD['idmail'],$userBD['origenmail'],$userBD['destinomail'],$userBD['fechamail'],$userBD['asuntomail'],$userBD['contenidomail']);
  }
  
  public static function existeMail($id)
	{
	$db=conectaDb();

	$res = $db->prepare('SELECT * FROM mail WHERE idmail=:id');
	$res->bindParam(':id', $id);
	
		  $res->execute();
	
		if ($row = $res->fetch()){
			
			$a=Mail::buildFromBD($row);
			
		}
		else {
	
			return false; 
		}
			
		$db= null;
		return $a;
	}
	
	public static function altaMail($mail)
	{
	$db=conectaDb();
	$fecha=date("Y-m-j");
	
	
		
		
							
		
		
		$res = $db->prepare('INSERT INTO grupo10.mail (idmail,origenmail,destinomail,fechamail,asuntomail,contenidomail) VALUES (NULL,:ori,:dest,:fecham,:asun,:cont)');
	    
         $res->bindParam(':ori', $mail->getOrigenMail());
		  $res->bindParam(':dest',$mail->getDestinoMail() );
		 $res->bindParam(':fecham', $mail->getFechaMail());
         $res->bindParam(':asun',$mail->getAsuntoMail());
		  $res->bindParam(':cont',$mail->getContenidoMail());
		  	
		  
            $res->execute();	
		
			$id= $db->lastInsertId();
			$db=null;
			return $id;
		
		
	}
  
  
  	
public static function recuperarMail($orig)
	{
	$db=conectaDb();
	$res = $db->prepare('SELECT * from mail m , usuario u where m.origenmail=:orig');
	 $res->bindParam(':orig', $orig);
	$res->execute();
	if (($row = $res->fetch())){
	    $row = $res->fetch();
		  }
			else{
			return null;
			}
	return $row[0];
	}
  
  
  
  
  
  
  
  
  
}
?>