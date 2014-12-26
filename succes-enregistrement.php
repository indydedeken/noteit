<?php 
include_once('generique/applications.php');
verifLogin();

$tabCommentTmp = $comment->getComments($_SESSION['id']);

if( $tabCommentTmp[0]['title'] != "" ) {
	
	$title = $tabCommentTmp[0]['title'];
	$size = strlen( $title );
	
	if($size > 20) 
		$title = substr( $tabCommentTmp[0]['title'], 0, 20 )."..." ;
	
	$title = addslashes( $title );

} else { 
	
	$title = "";

}

?>
<script>
$(function() {
	
	create("sticky", { class:'succes', title:'Nouvelle note :', text:'La note a été créée !'}, { custom: true });
	
});
</script>