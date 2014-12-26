<?php 

include_once('generique/applications.php');
verifLogin();
include_once('generique/haut.php');
include_once "ckeditor/ckeditor.php";

?>

<div class="notif"></div>
<div id="frameLeft">
	<form id="nouveau" action="#" method="post">
		<label>Titre</label>
		<input id="id_note" type="hidden" name="id" value="" />
		<input id="title" class="input-xlarge" name="title" type="text" placeholder="Donne un titre">
		<textarea class="editor"></textarea>
		<div class="boutons">
			<button id="envoi" class="btn btn-large btn-success" type="submit"> <i class="icon-ok icon-white"></i> Ajouter cette note </button>
			<button id="vider" class="btn btn-large btn-danger" type="submit"> <i class="icon-trash icon-white"></i> Vider les champs </button>
		</div>
	</form>
</div>
<div id="frameRight">

	<?php include_once('consulter.php')?>
	
</div>
<script type="application/javascript" src="js/dashboard.js"></script>

<?php

include_once('generique/bas.php');

?>