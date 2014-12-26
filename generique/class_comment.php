<?php 

/**
* @class comment 
* @function bool setComment
* @function mixed getComments
*/
class comment 
{ 
	function __construct($db)
	{
		$this->db = $db;		
	}
	
/**
* @function setComment 
* Permet de créer une note. Retourne true ou false.
* @param int $id_user
* @param string $title
* @param string $comment
* @return bool 
*/
	function setComment($id_user, $title, $comment) 
	{
		
		if ( get_magic_quotes_gpc() ) {
			$title		= htmlspecialchars( stripslashes( $title ) );
			$comment	= htmlspecialchars( stripslashes( $comment ) );
		} else {
			$title		= htmlspecialchars( $title );
			$comment	= htmlspecialchars( $comment );
		}
		
		try {
			$this->db->beginTransaction();
			
			$query = $this->db->prepare("INSERT INTO life VALUES ('', :id_user, :title, :comment, :date, '')");
			$query->bindParam(":id_user", $id_user);
			$query->bindParam(":title", $title);
			$query->bindParam(":comment", $comment);
			$query->bindParam(":date", date('Y-m-d H:i:s'));
			$query->execute();
			
			$this->db->commit();
			
			return true;
			
		} catch(Exception $e) {
			
			$this->db->rollBack();
			
			return false;
			
		}
	}
	
/**
* @function updateComment 
* Permet de créer une note. Retourne true ou false.
* @param int $id
* @param int $id_user
* @param string $title
* @param string $comment
* @return bool 
*/
	function updateComment($id, $id_user, $title, $comment) 
	{
		
		if ( get_magic_quotes_gpc() ) {
			$title		= htmlspecialchars( stripslashes( $title ) );
			$comment	= htmlspecialchars( stripslashes( $comment ) );
		} else {
			$title		= htmlspecialchars( $title );
			$comment	= htmlspecialchars( $comment );
		}
		
		try {
			$this->db->beginTransaction();
			
			$query = $this->db->prepare("	UPDATE life 
											SET title = :title, comment = :note, date_modification = NOW() 
											WHERE id_user = :id_user AND id = :id");
			$query->bindParam(":title", $title, PDO::PARAM_STR);
			$query->bindValue(":note", $comment, PDO::PARAM_STR);
			$query->bindParam(":id_user", intval($id_user), PDO::PARAM_INT);
			$query->bindParam(":id", intval($id), PDO::PARAM_INT);
							
			$query->execute();
			
			$this->db->commit();
			
			return true;
			
		} catch(Exception $e) {
			
			$e->getMessage();
			
			$this->db->rollBack();
			
			return false;
			
		}
	}
		
/**
* @function getComments 
* Permet d'obtenir l'ensemble des commentaires. Retourne le tableau des commentaires.
* @param int $id_user
* @return mixed 
*/
	function getComments($id_user) 
	{
		$tabComments = array();
		$i = 0;
		
		try {
						
			$query = $this->db->prepare("SELECT * FROM life WHERE id_user = :id_user ORDER BY date_creation DESC;");
			$query->bindParam(':id_user', $id_user);
			$query->execute();
			
			while($row = $query->fetch(PDO::FETCH_OBJ)) {
				
				$tabComments[$i]['id'] = $row->id;
				$tabComments[$i]['title'] = $row->title;
				$tabComments[$i]['comment'] = $row->comment;
				$tabComments[$i]['date_creation'] = $row->date_creation;
				$tabComments[$i]['date_modification'] = $row->date_modification;
			
				$i++;
			}
			
		} catch(Exception $e) {
			
			return false;
		
		}
		
		return $tabComments;
					
	}
	
/**
* @function getComment 
* Permet dd'obtenir une note en particulier. Retourne un tableau avec le commentaire
* @param int $id
* @param int $id_user
* @return mixed 
*/
	function getComment($id, $id_user)
	{
		$i = 0;
		$tabComment = array();
		
		try {
		
			$query = $this->db->prepare("SELECT * FROM life WHERE id = :id AND id_user = :id_user;");
			$query->bindParam(':id', $id);
			$query->bindParam(':id_user', $id_user);
			$query->execute();
			
			while( $row = $query->fetch( PDO::FETCH_OBJ ) ) {
				
				$tabComment[$i]['id'] = $row->id;
				$tabComment[$i]['title'] = $row->title;
				$tabComment[$i]['comment'] = $row->comment;
				$tabComment[$i]['date_creation'] = $row->date_creation;
				$tabComment[$i]['date_modification'] = $row->date_modification;
			
				$i++;	
			}
			
			return $tabComment;
		
		} catch(Exception $e) {
		
			return false;
			
		}
	}
	
/**
* @function delComment 
* Permet de supprimer une note. Retourne true ou false.
* @param int $id
* @param int $id_user
* @return bool 
*/
	function delComment($id, $id_user)
	{
		
		try {
			
			$this->db->beginTransaction();
			
			$query = $this->db->prepare("DELETE FROM life WHERE id = :id AND id_user = :id_user");
			$query->bindParam(":id", $id);
			$query->bindParam(":id_user", $id_user);
			$query->execute();
			
			$this->db->commit();
			
			return true;
			
		} catch(Exception $e) {
			
			$this->db->rollBack();
			
			return false;
			
		}
	}
}