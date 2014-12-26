<?php 

include_once('generique/applications.php');
verifLogin();

?>

<script>
$(function() {
	
	create("sticky", { class:'supprimer succes', title:'Suppression', text:'La note a été supprimée !'}, { custom: true });
	
});
</script>