<?php 
require_once 'config/init.conf.php'; // Utilisation du fichier de config 

setcookie('sid','', -1); 

// Fermerture de la session en cours avec un message de prévention
$_SESSION['notification']['result'] = 'danger';
$_SESSION['notification']['result'] = 'Vous êtes déconnecté ! ';

header("Location : index.php"); // Localisation au fichier index.php
?>

