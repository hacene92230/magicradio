<?php
include "../verif/config.php";
include "../menu/player.php";
if (isset($_POST['inscription']))
{
$_POST['date_inscription'] = stripslashes(trim($_POST['date_inscription']));
$_POST['ip'] = stripslashes(trim($_POST['ip']));
$_POST['pseudo'] = stripslashes(trim($_POST['pseudo']));
$_POST['mdp'] = stripslashes(trim($_POST['mdp']));
$_POST['mdp_confirme'] = stripslashes(trim($_POST['mdp_confirme']));
$_POST['sexe'] = stripslashes(trim($_POST['sexe']));
$_POST['email'] = stripslashes(trim($_POST['email']));
$_POST['age'] = stripslashes(trim($_POST['age']));
if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
$date_inscription = $_POST['date_inscription'];
$ip = $_POST['ip'];
$pseudo = $_POST['pseudo'];
$mdp = sha1($_POST['mdp']);
$mdp_confirme = $_POST['mdp'];
$sexe = $_POST['sexe'];
$email = $_POST['email'];
$age = $_POST['age'];
if($_POST['mdp_confirme'] != $_POST['mdp'])
{
echo "les 2 motdepasse que vous avez entrez ne sont pas identique";
echo('<br /><a href="../../index.php">clique ici pour retourner à l\'accueil</a>');
die();
}
$req = $bdd->prepare("INSERT INTO membres (date_inscription,ip,pseudo,mdp,sexe,email,age) VALUES (:date_inscription,:ip,:pseudo,:mdp,:sexe,:email,:age)");
try
{
	$req->execute(array(
'date_inscription' => $date_inscription,
'ip' => $ip,
'pseudo' => $pseudo,
'mdp' => $mdp,
'sexe' => $sexe,
'email' => $email,
'age' => $age));
echo 'ton inscription a bien été prise en compte.';
echo('<br /><a href="../../index.php">clique ici pour te connecter</a>');
die();
}
catch (Exception $ex)
{
die('Erreur lors de ton inscription.');
}
$req->closeCursor();
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inscription MagicRadio</title>
</head>
<body>
<p><a href = "../../index.php">Retournez à l'accueil.</a></p>
<br />
<h2>Inscription</h2>
<br />
<form action="inscription.php" method="post">


<input type="hidden" name="date_inscription" value="<?php echo date('j/m/Y'); ?>">
<input type="hidden" name="ip" value="<?php echo get_ip(); ?>">
<select aria-label="civilité" name="sexe">
<option value="homme">un homme</option>
<option value="femme">une femme</option>
<option value="femme">une femme</option>
</select>
<p><input type="number" aria-label="ton âge" name="age" maxlength="128" required/> <br /></p>
<p><input type="email" aria-label="ton adresse mail" name="email" maxlength="128" required/> <br /></p>
<p><input type="text" aria-label="ton pseudo"pseudo" name="pseudo" maxlength="222" required/> <br /></p>
<p><input type="password" aria-label="Ton mot de passe" name="mdp" maxlength="16" required/></p>
<p><input type="password" aria-label="confirme ton mot de passe" name="mdp_confirme" maxlength="16" required/></p>
<p><input type="submit" aria-label="je m'inscrit"name="inscription" value="s'inscrir"/></p>
</form>
</body>	
</html>