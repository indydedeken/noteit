<?php
include_once('generique/applications.php');
include_once('openid.php');

if(!isset($_SESSION['id'])) {
	
	try {
		$openid = new LightOpenID(BASE_URL);
		$openid->identity = 'https://www.google.com/accounts/o8/id';
		$openid->required = array(	'contact/email', 
									'namePerson/first', 
									'namePerson/last',
									'contact/country/home',
								);       
		
		if(!$openid->mode) {
		
			header('Location: ' . $openid->authUrl());
		
		} else {
		
			$validation = $openid->validate();
		
			if($openid->mode != 'cancel' && $validation) {
				// connexion accepté et validé par l'utilisateur
				
				// récupération des attributs
				$attributs = $openid->getAttributes();
				
				$email = $attributs['contact/email'];
				if(!empty($attributs['namePerson/first']))
					$prenom = $attributs['namePerson/first'];
				else $prenom = '';
				if(!empty($attributs['namePerson/last']))
					$nom = $attributs['namePerson/last'];
				else $nom = '';
				if(!empty($attributs['contact/country/home']))
					$pays = $attributs['contact/country/home'];
				else $pays = '';
				
				// faut-il créer un compte
				$insert = $user->isUser( $email );
				
				if($insert) {
					// inscription de l'utilisateur
					if( !$user->setUser( $email, $nom, $prenom, $pays ) )
						header('Location: ' . BASE_URL . 'deconnexion'); 
				}
				
				/* on met l'id en session */
				if( $user->getUserId( $email ) )
					header('Location: ' . BASE_URL . 'bienvenue'); 
				else
					header('Location: ' . BASE_URL . 'deconnexion'); 
				
			} else {
				// connexion échouée
				header('Location: ' . BASE_URL . 'signin');
			
			}
			
		}
		
	} catch(ErrorException $e) {
		
		echo $e->getMessage();
	
	}
	
} else {
	header('Location: bienvenue');
}