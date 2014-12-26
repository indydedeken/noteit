<?php

/**
* @class user 
* @function bool isUser
* @function bool setUser
* @function bool getUserId
*/
class user 
{ 	
	function __construct($db)
	{
		$this->db = $db;
	}
	
	/**
	* Permet de savoir s'il faut créer un compte pour l'utilisateur. Retourne true ou false.
	* @param string $email 
	* @return bool 
	*/
	function isUser ( $email ) 
	{
		
		try {
			
			$query = $this->db->prepare("SELECT id FROM userNoteIt WHERE email = :email");
			$query->execute(array(":email" => $email));				
			
			if($query->rowCount())
				return false;
			else
				return true;
			
		} catch(Exception $e) {
			return false;			
		}
		
	}
	
	/**
	* Inscrire un utilisateur. Retourne true ou false.
	* @param string $email 
	* @param string $nom 
	* @param string $prenom 
	* @param string $pays 
	* @return bool 
	*/
	function setUser ( $email, $nom = '', $prenom = '', $pays = '' ) 
	{ 
		try {
			
			$this->db->beginTransaction();
			
			$query = $this->db->prepare("INSERT INTO userNoteIt VALUES ('', :email, :nom, :prenom, :pays)");
			$query->bindParam(":email", $email);
			$query->bindParam(":nom", $nom);
			$query->bindParam(":prenom", $prenom);
			$query->bindParam(":pays", $pays);
			$query->execute();
			
			$this->db->commit();
			
			return true;
			
		} catch (Exception $e) {
			
			$this->db->rollBack();
			return false;
		
		}
	}
	
	/**
	* Grâce à l'email, obtenir l'ID de l'utilisateur. Retourne true ou false.
	* @param string $email
	* @return bool 
	*/
	function getUserId ( $email ) 
	{ 
		try {
			
			$query = $this->db->prepare("SELECT id FROM userNoteIt WHERE email = :email");
			$query->execute(array(":email" => $email));
			
			while($row = $query->fetch(PDO::FETCH_OBJ)) {	
				$_SESSION['id'] = $row->id;
			}
		
			return true;
		
		} catch(Exception $e) {
			return false;
		}
	}
	
	/**
	* Détermine si on peut utiliser l'API windows live
	* @param string email
	* @return bool
	*/
	function isWindowsLive ( $id )
	{
		try {
		
			$query = $this->db->prepare("SELECT email FROM userNoteIt WHERE id = :id");
			$query->execute(array(":id" => $id));
			
			while($row = $query->fetch(PDO::FETCH_OBJ)) {	
				$email = $row->email;
			}
			
		} catch(Exception $e) {
			return false;
		}
		
		$email = explode( "@", $email );
		$email = explode( ".", $email[1] );
		
		if( $email[0] == "hotmail" || $email[0] == "live" ) {
			return true;
		} else {
			return false;
		}
	}
}