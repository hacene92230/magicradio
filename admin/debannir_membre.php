<?php
include_once "../modules/verif/config.php";
include_once "../modules/verif/verif_membres.php";
if (isset($_POST['debannir']))
{
$reponse = $bdd->prepare("Delete FROM membres_bannissement WHERE membres_banni = :id");
$reponse->execute(array('id' => $_POST['debannir']));
echo "ce membre à bien été débanni.";
echo '<br /><a href="../index.php">revnir à l\'accueil</a>"';
die();
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="ISO-8859-15">
  <title>Débannir un membre MagicRadio</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
<h2>Débannir un membre</h2>
<form action="debannir_membre.php" method="post">
<a href="../index.php">Revenir à l'accueil.</a>
<br />
<p>Ici, vous pouvez débannir le membre que vous voullez.</p>
<select name="debannir">
<?php
$reponse = $bdd->prepare('SELECT * FROM membres_bannissement, membres WHERE membres_bannissement.membres_banni = membres.id_membre');
$reponse->execute();
while ($donnees = $reponse->fetch())
{
echo '<option value="'.$donnees['membres_banni'].'">'.$donnees['pseudo'].'</option>';
}
$reponse->closeCursor();
?>
</select>
<br />
<input type="submit" name="form_debannir" value ="Débannir ce membre.">
</form>