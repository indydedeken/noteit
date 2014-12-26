<?php 
include_once('generique/applications.php');
verifLogin();

if ( isset( $_POST['id'] ) ) {
	
	$id = $_POST['id'];
	
	if($comment->delComment($id, $_SESSION['id'])) {
		
		include_once('succes-suppression.php');
		
	} else {
		
		include_once('echec-suppression.php');
		
	}
	
} else {
	
	include_once('echec-suppression.php');
}
?>