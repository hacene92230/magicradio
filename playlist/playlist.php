<?php
$nb_fichier = 0;
if($dossier = opendir('../playlist'))
{
while(false !== ($fichier = readdir($dossier)))
{
if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
{
$nb_fichier++;
echo '<p><a href="../playlist/' . $fichier . '">' . $fichier . '</a></p>';
}
}
echo '</ul><br />';
echo 'Il y a <strong>' . $nb_fichier .'</strong> fichier(s) dans le dossier';
closedir($dossier);
}
else
{
echo 'Le dossier n\' a pas pu être ouvert';
}
?>