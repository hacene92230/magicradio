<?php
include "../verif/config.php";
include "../verif/verif_membres.php";
include "../menu/player.php";
$req = $bdd->prepare('SELECT ip, pseudo, choix, count(*) AS nb FROM avis GROUP BY choix');
$req->execute();
while ($avis = $req->fetch())
{
echo '<p>'.$nb['3'].'on mis une note de 1</p>';
echo $avis['2'];
echo $avis['3'];
echo $avis['4'];
echo $avis['5'];
die();
if (isset($_POST['avis']))
{
if($avis['pseudo'] == $_POST['pseudo'] OR $avis['ip'] == $_POST['ip'])
{
echo "t'a déjà donné ton avis.";
echo '<p><a href = "avis.php">Retournez à la page précédante.</a></p>';
die();
}
$_POST['ip'] = stripslashes(trim($_POST['ip']));
$_POST['pseudo'] = stripslashes(trim($_POST['pseudo']));
$_POST['choix'] = stripslashes(trim($_POST['choix']));
$ip = $_POST['ip'];
$pseudo = $_POST['pseudo'];
$choix = $_POST['choix'];
$req = $bdd->prepare("INSERT INTO avis (ip,pseudo,choix) VALUES (:ip,:pseudo,:choix)");
try
{
	$req->execute(array(
'ip' => $ip,
'pseudo' => $pseudo,
'choix' => $choix));
 header('Location: '.$_SERVER['REQUEST_URI']);die();
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
        content="width=device-width, user-scalable=no, initial-scale=avis.0, maximum-scale=avis.0, minimum-scale=avis.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Je donne mon avis MagicRadio</title>
</head>
<body>
<p><a href = "../../index.php">Retournez à l'accueil.</a></p>
<br />
<h1>Je donne mon avis</h1><br />
<form action="avis.php" method="post">
<input type="hidden" name="ip" value="<?php echo get_ip(); ?>">
<input type="hidden" name="pseudo" value="<?php echo $result['pseudo']; ?>">
<p><input type="radio" name="choix" value="1" aria-label="une étoile"/></p>
<p><input type="radio" name="choix" value="2" aria-label="deux étoiles"/></p>
<p><input type="radio" name="choix" value="3" aria-label="trois étoiles"/></p>
<p><input type="radio" name="choix" value="4" aria-label="quatre étoiles"/></p>
<p><input type="radio" name="choix" value="5" aria-label="cinque étoiles"/></p>
<p><input type="submit" aria-label="je donne mon avis" name="avis" value="s'inscrir"/></p>
</form>
</body>	
</html>