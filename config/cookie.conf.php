<?php

// Utilisation des cookies avec le SID
if(!empty($_COOOKIE['sid']))
{
    $donnees = $_COOKIE['sid'];
    $utilisateursManager = new utilisateursManager($bdd);
    $sidBDD = $utilisateursManager->getBydSid($donnees);
}
?>