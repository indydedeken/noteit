<?php
include_once('generique/applications.php');
verifLogin();
include_once('generique/haut.php');
?>

<div class="hero-unit">
	<p class="lead">Salut !</p>
	<p>
		Cette application permet de garder vos notes jour après jour.<br>
		Ensuite, quand vous le souhaitez, vous pouvez venir les consulter.<br>
	</p>
	<p class="lead">
		Simple, rapide et efficace.
	</p>
	<div class="boutons">
		<a class="btn btn-large btn-info" href="dashboard" title="créer ma première note">Créer une nouvelle note</a>
	</div>
</div>

<?php
include_once('generique/bas.php');
?>
