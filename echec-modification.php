<?php 

include_once('generique/applications.php');
verifLogin();

?>

<script>
$(function() {
	
	create("default", { class:'modifier echec', title:'Modification', text:'Il y a eu un problème !<br> La note ne peut pas être modifiée.'});
	
});
</script>