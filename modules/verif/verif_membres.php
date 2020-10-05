<?php
$req = $bdd->prepare("SELECT * FROM membres WHERE pseudo=:membre");
$req->execute(array('membre' => $_SESSION['membre']));
$result = $req->fetchAll();
$req->closeCursor();
if (count($result) == 0) {
echo "tu ne peut pas accédé à cette partie du site.";
die();
}
else
 {
$result = $result[0];
}
?>