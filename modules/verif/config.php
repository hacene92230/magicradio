<?php
	session_start();
	$BD_serveur     = "localhost";
    $BD_utilisateur = "hacene";
    $BD_motDePasse  = "albatros92I";
    $BD_base        = "magicradio";
    try {
		$bdd = new PDO('mysql:host=' . $BD_serveur . ';dbname=' . $BD_base, $BD_utilisateur, $BD_motDePasse, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $bdd->exec("SET CHARACTER SET utf8");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	catch (Exception $ex) {
		die('Impossible de se connecter à la base de données.');
	}
 /**
  * Récupérer la véritable adresse IP d'un visiteur
  */
 function get_ip() {
 	// IP si internet partagé
 	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
 		return $_SERVER['HTTP_CLIENT_IP'];
 	}
 	// IP derrière un proxy
 	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
 		return $_SERVER['HTTP_X_FORWARDED_FOR'];
 	}
 	// Sinon : IP normale
 	else {
 		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
 	}
 }
?>