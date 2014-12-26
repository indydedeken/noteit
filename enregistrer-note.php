<?php 
include_once('generique/applications.php');
verifLogin();

// s'il y a POST[id] c'est une modification de note
if (!empty( $_POST['id'] ) && isset( $_POST['title'] ) && isset( $_POST['comment'] ) ) {
	
	$title = $note = '';
	
	$id = $_POST['id'];
	$title = $_POST['title'] ;
	$note = $_POST['comment'];
		
	if( $comment->updateComment($id, $_SESSION['id'], $title, $note) ) {
		
		include_once('succes-modification.php');
		
	} else {

		include_once('echec-modification.php');
		
	}

// s'il n'y a pas POST[id], c'est une nouvelle note
} else if ( empty( $_POST['id'] ) && isset( $_POST['title'] ) && isset( $_POST['comment'] ) ) {
	
	$title = $note = '';
	
	$title = $_POST['title'] ;
	$note = $_POST['comment'];
	
	if( $comment->setComment($_SESSION['id'], $title, $note) ) {
		
		include_once('succes-enregistrement.php');
		
	} else {

		include_once('echec-enregistrement.php');
		
	}

} else {
	
}
?>