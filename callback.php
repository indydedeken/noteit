<?php 

include_once('generique/applications.php');
include_once('generique/RESTClient.php');

ini_set('display_errors',0);

include_once('generique/haut.php');

$code = $_GET['code'];

$url = "https://login.live.com/oauth20_token.srf?client_id=00000000480D369C&redirect_uri=http://noteit.indydedeken.fr/callback&client_secret=88QpzafjdFWK2JPgScfv9pJYR0vbGUMr&code=" . $code . "&grant_type=authorization_code";

$json = file_get_contents($url, 0, null, null);

$jsonOutput = json_decode($json, true);
/*
 [token_type] => bearer
 [expires_in] => 3600
 [scope] => wl.signin wl.basic
 [access_token] => ...
 [authentication_token] => ...
*/

$rest = new RESTclient();
$url = 'https://apis.live.net/v5.0/me?access_token=' . $jsonOutput['access_token'];
$rest->createRequest("$url", "GET");
$rest->sendRequest();
$output = $rest->getResponse();

?>
<pre>
<?php print_r($output); ?>
</pre>
<?php

$emails = $output['emails'];

if(!empty($emails['account']))
	$email = $emails['account'];
if(!empty($output['first_name']))
	$prenom = $output['first_name'];
if(!empty($output['last_name']))
	$nom = $output['last_name'];
if(!empty($output['locale']))
	$pays = substr($output['locale'], 3, 2);

// faut-il créer un compte
$insert = $user->isUser( $email );


if($insert) {
	// inscription de l'utilisateur
	if( !$user->setUser( $email, $nom, $prenom, $pays ) )
		header('Location: ' . BASE_URL . 'deconnexion'); 
}

// on met l'id en session
if( $user->getUserId( $email ) )
	header('Location: ' . BASE_URL . 'bienvenue'); 
else
	header('Location: ' . BASE_URL . 'deconnexion'); 	


include_once('generique/bas.php');

?>