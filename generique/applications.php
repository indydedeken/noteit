<?php

/********************************************************/
/* Fichier applications.php								*/
/********************************************************/

session_start();
$prod = true;
/********************************************************/
/* définition des constantes 							*/
/********************************************************/
if($prod)
	define('BASE_URL', 'http://noteit.indydedeken.fr/');
else
	define('BASE_URL', 'http://localhost:8888/serveur/noteit/');


/********************************************************/
/* Connexion à la DB									*/
/********************************************************/
try {

if($prod) {
	$PARAM_hote='mysql hote';
	$PARAM_port='3306';
	$PARAM_nom_bd='db name';
	$PARAM_utilisateur='user name';
	$PARAM_mot_passe='user pwd';
} else {
	$PARAM_hote='localhost';
	$PARAM_port='3306';
	$PARAM_nom_bd='db name';
	$PARAM_utilisateur='root';
	$PARAM_mot_passe='root';
}

	$db = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	// cette ligne active le commit et rollback
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
}

/********************************************/
/********************************************/
/* fonctions générales						*/
/********************************************/
/********************************************/

/********************************************/
/* Vérifier que l'utilisateur est logué		*/
/* sinon, il est redirigé					*/
/********************************************/
function verifLogin() {
	if(empty($_SESSION['id']) && !isset($_SESSION['id'])) {
		header('Location: deconnexion');
	}
}

/********************************************/
/* GETTER de la page courante				*/
/********************************************/
function getCurrentPage() {
	$url = strtolower(str_replace(".php", "",$_SERVER['REQUEST_URI']));
	$url = explode('/', $url);
	$url = array_pop($url);

	return $url;
}

/*************************************/
/* transformer la date au format fr	*/
/* @param : une date entière	   */
/**********************************/
function getDateFr ($date) {
	$date = explode(" ", $date);
	$date = new DateTime($date[0]);
	return $date->format('d/m/Y');
}

/******************************************/
/* recuperer l'heure à partir de la date */
/* @param : une date entière			*/
/***************************************/
function getHeure ($date) {
	$date = explode(" ", $date);
	$date = new DateTime($date[1]);
	return $date->format('H:i');
}

/**********************************************************/
/* indique l'écart entre aujourd'hui et la date en jours */
/* @param : une date entière							*/
/*******************************************************/
function depuis ($date) {
	$dateFrom = explode(" ", $date);
	$dateFrom = new DateTime( $dateFrom[0]);

	$dateTo = new DateTime("now");

	$depuis = $dateFrom->diff($dateTo);

	return $depuis->format('%a');
}

include_once('class_user.php');

include_once('class_comment.php');

$user = new user($db);
$comment = new comment($db);
?>
