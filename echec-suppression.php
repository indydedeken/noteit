<?php 

include_once('generique/applications.php');
verifLogin();

?>

<script>
$(function() {
	
	create("default", { class:'supprimer echec', title:'Suppression', text:'Il y a eu un problème !<br> La note n\'a pas pu être supprimée.'});
	
});
</script>