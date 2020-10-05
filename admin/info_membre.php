<!doctype html>
<html lang="fr">
<head>
  <meta charset="ISO-8859-15">
  <title>Information sur les membres MagicRadio</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
<p><a href="../index.php">Revenir à la page d'accueil</a></p>
<?php
include_once "../modules/verif/config.php";
include_once "..modules/verif/verif_membres.php";
if (isset($_POST['info']
))
{
$req = $bdd->prepare('SELECT * FROM membres WHERE id_membre = :id');
$req->execute(array('id' => $_POST['membre']));
while ($info = $req->fetch())
{
echo '<p><a href="info_membre.php">Revenir à la page précédante</a></p>';
echo '<p>Mail: '.$info['email'].'</p>';
echo '<p>Pseudo: '.$info['pseudo'].'</p>';
echo '<p>âge: '.$info['age'].'</p>';
echo '<p>adresse ip: '.$info['ip'].'</p>';
echo '<p>datte d\'inscription: '.$info['date_inscription'].'</p>';
die();
}
}
?><p>Sélectionné le membre pour lequel vous voulez voir les informations.</p>
<form action="info_membre.php" method="post">
<select name="membre">
<?php
$reponse = $bdd->prepare('SELECT * FROM membres');
$reponse->execute();
while ($donnees = $reponse->fetch())
{
echo '<option value="'.$donnees['id_membre'].'">'.$donnees['pseudo'].'</option>';
}
?>
</select>
<p><input type="submit" name="info" value ="Voir les informations concernant ce membre."></p>
</form>
</body>
</html>