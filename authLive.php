<?php 

include_once('generique/applications.php');
$urlAuth = "https://login.live.com/oauth20_authorize.srf?client_id=00000000480D369C&scope=wl.signin%20wl.basic%20wl.emails%20 wl.contacts_photos&response_type=code&redirect_uri=http://noteit.indydedeken.fr/callback";
header("Location:" . $urlAuth);

?>