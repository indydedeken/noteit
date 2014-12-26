<?php 

include_once('generique/applications.php');

if(!empty($_SESSION['id']) && isset($_SESSION['id'])) {
	
	header("Location: bienvenue");
	
}

include_once('generique/haut.php');

?>

<div class="hero-unit">
	<p class="lead">Connexion</p>
	<p>Pour pouvoir utiliser l'application, il faut se connecter avec un compte Google.</p>
	<div class="well podConnexion">
		<a class="btn btn-large btn-block btn-success" href="authGoogle" title="connexion">Se connecter avec un compte Google</a>
		<!--
			<br>
			<br>
			<a class="btn btn-large btn-block btn-info" href="authLive" title="connexion">Se connecter avec un compte Live</a>
		-->
	</div>
</div>

<!--
<script src="//js.live.net/v5.0/wl.js"></script>
<script>

	/* initialisation de l'API avec vos propres paramètres */
	WL.init({
		client_id: "00000000480D369C", 
		redirect_uri: "http://noteit.indydedeken.fr/" 
	});
	
	WL.Event.subscribe("auth.login", onLogin);
	
	function onLogin() {
		var session = WL.getSession();
		if (session) {
			getInfo();
		}
	}
	
	/* check la session à chaque rechargement de page */
	var session = WL.getSession();
	if (session) {
		getInfo();
	} else {
		// permet de lancer la connexion automatiquement
		//WL.login({ scope: "wl.signin" });
	}
	
	function getAllInfo() {
		// obtenir les infos liées à l'image perso
		WL.api({
			path: "me/picture",
			method: "GET"
		}).then(
			function (response) {
				if (response.location) {
					imgTagString = "<img src='" + response.location + "' />";
					document.getElementById("userImage").innerHTML = imgTagString;
				}
			},
			function (responseFailed) {
				document.getElementById("infoArea").innerText =
					"Error calling API: " + responseFailed.error.message;
			}
		);
		
		// obtenir les infos liées au compte mail
		WL.api({ path: "/me", method: "GET" }).then(
			function(response) {
				var chaine = "";
				var id = response.id;
				var firstName = response.first_name;
				var lastName = response.last_name;
				var email = response.emails.preferred;
				
				if (id) {
					log("id: " + id);
				}
				
				if (firstName) {
					chaine = "Salut, " + firstName;
				} 
				if (lastName) {
					chaine += " " + lastName;
				}
				if (email) {
					chaine += "(email: " + email + ")";	
				}
				log(chaine);
			},
			function(response) {
				log("API call failed: " +
					JSON.stringify(response.error).replace(/,/g, "\n"));
			}
		);
	}
	
	/* définit tous les domaines qui pourront être exploités */
	function getInfo() {
		WL.login({ "scope": "wl.basic wl.birthday wl.emails" }).then(
			function(response) {
				getAllInfo();
			},
			function(response) {
				log("Could not connect, status = " + response.status);
			}
		);
	}
	
	function log(message) {
		var child = document.createTextNode(message);
		var parent = document.getElementById('data') || document.body;
		parent.appendChild(child);
		parent.appendChild(document.createElement("br"));
	}
	
	/* style du bouton sign in */
	WL.ui({
		brand: "none", //messenge, hotmail, windows, skydrive, none
		name: "signin",
		element: "signin",
		theme: "white"
	});
			
</script>
-->


<?php

include_once('generique/bas.php');

?>