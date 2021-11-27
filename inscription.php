<?php  // Utilisation des fichiers de config
  require_once 'config/init.conf.php';
  require_once 'config/bdd.conf.php';



  if(isset($_POST['submit'])) // Si le bouton submit possède des données alors on fait la création de l'utilisateur
  {
    $utilisateurs = new utilisateurs();
    $utilisateurs->hydrate($_POST);
    $utilisateurs->setMdp(password_hash($utilisateurs->getMdp(),PASSWORD_DEFAULT)); // hachage du mdp
    
    $utilisateursManager = new utilisateursManager($bdd);
    $utilisateursManager->add($utilisateurs);

  if($utilisateursManager->get_result() == true) // Si le résultat est concluant alors le compte est bien ajouté
  {
    $_SESSION['notification']['result'] = 'success';
    $_SESSION['notification']['message'] = 'Votre compte a été ajouté.';
  } 

    else // Sinon un message d'erreur est affiché
      {
        $_SESSION['notification']['result'] = 'danger';
        $_SESSION['notification']['message'] = 'Une erreur est survenue';
      }

    header("Location: inscription.php"); // Localisation au fichier inscription.php
  }

    else // utilisation dees templates pour la page utilisateurs.html.twig
      {
        $loader = new \Twig\Loader\FilesystemLoader('Templates/includes');
        $twig = new \Twig\Environment($loader, ['debug'=>true]);
     
        echo $twig->render('utilisateurs.html.twig', []);
        // $utilisateurs = new utilisateurs();
        // $action = 'ajouter';
      }
 
?>
