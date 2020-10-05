<?php
if (isset($_POST['pseudo']) && isset($_POST['mdp']))
{
include_once "../verif/config.php";
$pseudo         = $_POST["pseudo"];
	$mdp = sha1($_POST["mdp"]);
	$req = $bdd->prepare("SELECT * FROM membres WHERE pseudo=:pseudo AND mdp=:mdp");
	$req->execute(array('pseudo' => $pseudo, 'mdp' => $mdp));
	$result = $req->fetchAll();
	$req->closeCursor();
	if (count($result) == 1) {
$_SESSION["membre"] = TRUE;
$_SESSION["membre"] = $pseudo;
header("Location: ../../index.php");
	}
else {
$_SESSION["membre"] = FALSE;
echo "<p>Ton pseudo ou ton mot de passe n'est pas bon!</p>";
echo '<a href="../../index.php">clique ici pour retourner à l\'accueil</a>';
die();
	}
}?>
<h2>authentification</h2>
<br />
<p>Saisis les identifiants que tu as configuré lors de ton inscription</p>
<form action="modules/membres/connexion.php" method="post">
<p><input type="text" aria-label="TON pseudo"pseudo" name="pseudo" maxlength="222" required/> <br /></p>
<p><input type="password" aria-label="mot de passe" name="mdp" maxlength="16" required/></p>
	<br />
<input type="checkbox" name="souvenir" />Se souvenir de moi
<br />
<p><a href = "">J'ai oublié mon mot de passe</a></p>
	<p><input type="submit" value="Je m'authentifie."/></p>
</form>
<br />
<p>Tu n'as toujours pas de compte?</p>
<p><a href = "modules/membres/inscription.php">Clique ici.</a></p>