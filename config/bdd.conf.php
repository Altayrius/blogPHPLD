<?php
// Connexion à la Bdd
try 
{
    $bdd = new PDO('mysql:host=localhost;dbname=blogiut;charset=utf8','root', '');
    $bdd->exec("set name utf8");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} 
// Si cela marche on obtient une erreur
catch (Exception $e) 
{
    die('Erreur : ' . $e->getMessage());
}