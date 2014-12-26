<?php 
include_once('generique/applications.php');
verifLogin();

if ( isset( $_POST['id'] ) ) {
	
	$id = $_POST['id'];
	
	if($note = $comment->getComment($id, $_SESSION['id'])) {
		
		//include_once('succes-modification.php');
		
		$note['id'] = $note[0]['id'];
		$note['title'] = $note[0]['title'];
		$note['comment'] = $note[0]['comment'];
		$note['date_creation'] = $note[0]['date_creation'];
		$note['date_modification'] = $note[0]['date_modification'];

?>
		
<script>
	
	$(function() {
	
		$( '#id_note' ).attr('value', '<?php echo $note['id']?>');
		$( '#title' ).val( "<?php echo html_entity_decode( str_replace(array(PHP_EOL, '\n', '\r'), '',  $note['title'] ) )?>" );
		$( 'textarea.editor' ).val("<?php echo html_entity_decode( str_replace(array(PHP_EOL, '\n', '\r'), '',  $note['comment'] ) )?>");
	
	});
	
</script>

<?php
		
	} else {
		
		include_once('echec-modification.php');
		
	}
	
} else {
	
	include_once('echec-modification.php');
}
?>