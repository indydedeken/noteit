<?php
include_once('generique/applications.php');
verifLogin();
?>

<script>
$(function() {

	create("sticky", { class:'echec', title:'Nouvelle note :', text:'Il y a eu un problème !<br> La note n\'a pas pu être enregistrée.'}, { custom: true });

});
</script>
