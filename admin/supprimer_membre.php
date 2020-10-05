<?php
include_once "../modules/verif/config.php";
include_once "../modules/verif/verif_membres.php";
if (isset($_POST['supprimer_membre']))
{
$reponse = $bdd->prepare("Delete FROM membres WHERE id_membre = :id");
$reponse->execute(array('id' => $_POST['supprimer_membre']));
echo "ce membre à bien été supprimé.";
echo '<br /><a href="../index.php">revnir à l\'accueil</a>"';
die();
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="ISO-8859-15">
  <title>Supprimer un membre Magicradio.</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
<h2>suppression d'un membre</h2>
<form action="supprimer_membre.php" method="post">
<a href="../index.php">Retourner à l'accueil.</a>
<br />
<p>Ici, vous pouvez supprimer le  membre que vous voullez, attention: votre choix est iréverssible.</p>
<p>petit rapel, la supression d'un membre doit être faite qu'en cas de majoritée total parmi l'équipe des administrateurs;</p>
<p>La supression d'un membre ne dois s'effectuer que si le banissement n'a pas suffi, ou bien si le personnage en fais exprésément la demande.</p>
<select name="supprimer_membre">
<?php
$reponse = $bdd->prepare('SELECT * FROM membres');
$reponse->execute();
while ($donnees = $reponse->fetch())
{
echo '<option value="'.$donnees['id_membre'].'">'.$donnees['pseudo'].'</option>';
}
$reponse->closeCursor();
?>
</select>
<br />
<input type="submit" name="supprimer" value ="supprimer ce membre.">
</form>