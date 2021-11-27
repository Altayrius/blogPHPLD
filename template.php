<?php 
// Utilisation des fichiers de config
require_once 'config/init.conf.php';
require_once 'vendor/authoload.php';

$loader = new \Twig\Loader\FilesystemLoader('Templates/');
$twig = new \Twig\Environment($loader, ['debug'=>true]);

$users = [['username'=>'toto']];
echo $twig->render('template.html.twig', ['prenom' => 'romain', 'go' => 'here', 'users' => $users]);
