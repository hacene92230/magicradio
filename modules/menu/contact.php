<?php
include "../membres/config.php";
include "player.php";
if(isset($_POST['envoi_msg']))
{
$req = $bdd->prepare("INSERT INTO contact (email,objet,texte_msg) VALUES(:email,:objet,:texte_msg)");
try
{
$req->execute(array(
'email' => $_POST['email'],
'objet' => $_POST['objet'],
'texte_msg' => $_POST['texte_msg']));
echo "Ton message a bien été envoyé, une réponse te sera donnée le plus rappidement possible!";
echo '<p><a href = "../../index.php">retournez à l\'accueil</a></p>';
        } catch (Exception $ex)
		{
            die('Erreur lors de l\envoi de ton message. Erreur : ' . $ex->getMessage());
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
  <title>Contact MagicRadio</title>
</head>
<body>
<form name="envoi_msg" action="contact.php" method="POST">
<p><a href = "../../index.php">Retournez à l'accueil.</a></p>
<br />
<p>Avec MagicRadio il est très simple de nous contacter.</p>
<p>En effet, il vous suffit simplement de remplir le formulaire ci-dessous et nous y répondrons le plus rapidement possible.</p>
<br />
<h2>Contact</h2>
<br />
<p>Veuillez saisir une adresse mail valide car la réponse vous y sera envoyée.</p>
<p><input type="email" aria-label="TON adresse mail" name="email" maxlength="128" required/> <br /></p>
<p>Sois précis quant à l'objet de ton message, cela facilitera grandement son traitement.</p>
<p><input type="text" aria-label="Quel est l'objet de votre message" name="objet" maxlength="128" required/> <br /></p>
<p>Ici, tu écris ton message à nous transmettre, sois précis et évites les vulgarités.</p>
<p><textarea aria-label="Quel est ton message" name="texte_msg" cols="30" rows="5"></textarea></p>
<br />
<p><input type="submit" name="envoi_msg" value ="Envoyer mon message."></p>
</form>
</body>
</html>