<?php
include_once "../verif/config.php";
include_once "../verif/verif_membres.php";
include "../menu/player.php";
if(isset($_POST['ap_modif']))
{
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $pseudo = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
    $mdp = htmlspecialchars($_POST['mdp'], ENT_QUOTES);
    $mdp_confirme = htmlspecialchars($_POST['mdp_confirme'], ENT_QUOTES);
    $mdp_actuel = htmlspecialchars($_POST['mdp_actuel'], ENT_QUOTES);
if($mdp !=  $mdp_confirme)
{
echo "les deux mot de passes ne correspondent pas.";
die();
}
if($result['mdp'] != sha1($mdp_actuel))
{
echo "Ton ancien mot de passe n'est pas bon";
die();
}
if(empty($mdp))
{
$mdp = $mdp_actuel;
}
if (empty($email) || empty($pseudo) || empty($mdp_actuel))
{
echo "tu ne peut pas laissé un champ vide";
die();
}
$req = $bdd->prepare('UPDATE membres SET email = ?, pseudo = ?, mdp = ? WHERE id_membre = ?');
try
{
$req->execute(array(
$email,
$pseudo,
sha1($mdp),
$result['id_membre']));
echo "la modification s'est correctement effectuer";
die();
}
    catch (Exception $ex)
	{}
	die('Erreur lors de la modification de ton profil.');
$reponse->closeCursor();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Modifier mon Profil MagicRadio</title>
</head>
<body>
<p><a href = "../../index.php">Retournez à l'accueil.</a></p>
<p>Ici, tu peut modifier ton profil.</p>
<p>Cela signifi que tu peut changer ton pseudo, ton mot de passe ainsi que ton adresse mail.</p>
<br />
<form action="modifier_profil.php" method="post">
  <p>Email</p>
  <input type="text" name="email" value="<?php echo $result['email'];?>"/>
<p>pseudo</p>
<p>  <input type="text" name="pseudo" value="<?php echo $result['pseudo'];?>"/>
</p>
<p>Tape ton nouveau mot de passe</p>
<input type="password" name="mdp" value=""/>
<p>Confirmez le nouveau mot de passe</p>
<p><input type="password" name="mdp_confirme"/></p>
<p>Afin d'appliquer les modifications en étant sûr que c'est toi tape ton ancien mot de passe.</p>
<p><input type="password" name="mdp_actuel"/></p>
<p><input type="submit" name="ap_modif" value ="appliquer les modifications"></p>
</form>