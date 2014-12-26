<?php 
	$currentPage = getCurrentPage();
	if(empty($currentPage))
		header('Location: bienvenue');
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Note it ! Outil pour la mémoire</title>
	<link rel="shortcut icon" href="http://noteit.indydedeken.fr/img/favicon.ico">
	<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css" />
	<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="bootstrap/css/custom.css" />
	<link type="text/css" rel="stylesheet" href="bootstrap/css/jquery.notify.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.notify.js"></script>
	<script type="text/javascript" src="bootstrap/js/setting.notify.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<div class="nav-collapse collapse">
				<?php if($currentPage != "signin") { ?>
				<ul class="nav">
					<li class="<?php echo $etat = ($currentPage == "bienvenue" || $currentPage == "") ? "active" : ""?>">
						<a href="bienvenue" title="Bienvenue">
							<i class="icon-home <?php echo $etat = ($currentPage == "bienvenue" || $currentPage == "") ? "" : "icon-grey"?>"></i> Home
						</a>
					</li>
					<li class="<?php if($currentPage == "dashboard") echo "active"?>">
						<a href="dashboard" title="Dashboard">
							<i class="icon-plus-sign <?php echo $etat = ($currentPage == "dashboard") ? "" : "icon-grey"?>"></i> Dashboard
						</a>
					</li>
					<?php if( $user->isWindowsLive($_SESSION['id']) ): ?>
					<li>
						<a class="upload" href="#" title="upload" onClick="uploadBox();">
							<i class="icon-th-list icon-upload icon-grey"></i> Uploader un document
							<span class="label label-warning">new</span>
						</a>
					</li>
					<?php endif; ?>
					<li>
						<a href="deconnexion" title="goodbye !">
							<i class="icon-off icon-grey"></i> Déconnexion
						</a>
					</li>
				</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<header class="blueBackground">
	<h1>
	<?php if($currentPage == "signin") { ?>
		Pour accéder au service, il est nécessaire de se connecter !
	<?php } else if($currentPage == "bienvenue" || $currentPage == "") { ?>
		Quoi de neuf ?
	<?php } else { ?>
		Dashboard des notes
	<?php } ?>
	</h1>
</header>

<section class="<?php echo $currentPage?>">