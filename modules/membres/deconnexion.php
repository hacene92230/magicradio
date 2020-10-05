<?php
include "../verif/config.php";
session_destroy();
header('location: ../../index.php');
exit;
?>