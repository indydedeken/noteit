<?php 

include_once('generique/applications.php');
verifLogin();

?>

<script>
$(function() {
	
	create("sticky", { class:'modifier succes', title:'Modification', text:'La note a été modifiée avec succès !'}, { custom: true });
	
});
</script>