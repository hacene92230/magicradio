<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Accueil MagicRadio</title>
</head>
<body>
<?php
include "modules/verif/config.php";
include "modules/menu/player.php";
if($_SESSION['membre'] == "MagicRadio.Y" or $_SESSION['membre'] == "MagicRadio.H")
{
?>
<details>
 <summary>admin</summary>
<?php
include "admin/accueil_admin.php";
}
?>
</details>
<?php
if($_SESSION['membre'])
{
?>
<p><input type="button" value="chat" onclick="window.location='modules/chat/index.php';"> 
<br />
<?php
echo "<br /><p>Bienvenu ".$_SESSION['membre'].'!</p>';
?>
<p><input type="button" value="modifier mon profil" onclick="window.location='modules/membres/modifier_profil.php';"> <input type="button" value="Se déconnecté" onclick="window.location='modules/membres/deconnexion.php';"></p>
<br />
<?php
}
?>
<h1>Présentation</h2>
<br />
<p>Bienvenue sur les ondes de MagicRadio, la magie des émissions musicales, débats et des antennes libres! Ici, tu as la parole en direct dans les émissions.
<p>MagicRadio favorise ses auditeurs dans les décisions prises à tous les niveaux!</p>
<p>La Webradio est géré par deux animateurs passionné par le monde de la radio, ils te feront découvrir ce dernier sous toutes ses formes!</p>
<p>En effet, Yanis et Hacène sont là pour te divertir durant les émissions en direct, et les émissions musicales!</p>
<p>Tu souhaites en savoir plus sur les deux animateurs, tu trouveras la rubrique (Qui sommes-nous) mise à la disposition de tous dans le but de décrire leur passion pour la radio...</p>
<br /> <p>Merci, et bonne écoute à toi!</p>
<br />
<?php
if($_SESSION['membre'] != true)
{
include "modules/membres/connexion.php";
}
else
{
include "modules/menu/menu_membres.php";
}
include "modules/menu/menu_accueil.php";
?>
</body>
</html>