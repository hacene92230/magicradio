<?php
include"../modules/verif/config.php";
include"../memodules/verif/verif_membres.php";
if (isset($_POST['bannir']))
{
$verif_bannissement = $bdd->prepare('SELECT * from membres_bannissement where membres_banni = :id');
$verif_bannissement->execute(array('id' => $_POST['membre']));
while ($bannissement = $verif_bannissement->fetch())
{
if($bannissement['membres_banni'] = $_POST['membre'])
{
echo "ce personnage est déjà banni.";
echo '<p><a href = "../index.php">retournez à l\'accueil</a></p>';
die();
}
}
$req = $bdd->prepare("INSERT INTO membres_bannissement (membres_banni,raison_ban) VALUES (:membres_banni,:raison_ban)");
        try {
            $req->execute(array(
                'membres_banni' => $_POST['membre'],
                             'raison_ban' => $_POST['raison_ban']));
echo 'Ce membre vient d\'être banni';
echo '<p><a href = "../index.php">retournez à l\'accueil</a></p>';
die();
        } catch (Exception $ex)
		{
echo "erreur lors du banissement de ce membre";
            echo '<p><a href = "../index.php">retournez à l\'accueil</a></p>';
die();
            $req->closeCursor();
}
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="ISO-8859-15">
  <title>Bannir un membre MagicRadio</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
<a href="../index.php">Revenir à l'accueil</a>
<h2>Bannir un membre</h2>
<form action="bannir_membre.php" method="post">
<p>Rien de plus simple pour bannir un membre.</p>
<p>Choisis le membre à bannir puis clique sur bannir ce membre.</p>
<p>Ensuite tu arrivera dans une nouvelle page, et précise les raisons qui te conduise à bannir ce membre ensuite clique sur appliquer le mbannissement.</p>
<select name="membre">
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
<p>Raison qui vous pousse à bannir ce membre.</p>
<textarea name="raison_ban"></textarea>
<br />
<input type="submit" name="bannir" value ="Bannir ce membre.">
</form>
</body>
</html>