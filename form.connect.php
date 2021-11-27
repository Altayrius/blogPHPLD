<?php // CODE DE TEST CONNEXION (Version antérieur du fichier "connexion.php")
  require_once 'config/init.conf.php'; 
  require_once 'config/bdd.conf.php';



  if(isset($_POST['submit'])) 
  {
    //Création de l'utilisateur
    $utilisateurs = new utilisateurs();
    $utilisateurs->hydrate($_POST);
    

    $utilisateursManager = new utilisateursManager($bdd);

    $utilisateursManager->add($utilisateurs);

    if($utilisateursManager->get_result() == true) //  Si le résultat est concluant alors le compte est bien ajouté
    {
        $_SESSION['notification']['result'] = 'success';
        $_SESSION['notification']['message'] = 'Votre compte a été ajouté.';
    } 
    else // Sinon un message d'erreur est affiché
    {
        $_SESSION['notification']['result'] = 'danger';
        $_SESSION['notification']['message'] = 'Une erreur est survenue';
    }

    header("Location: form.connect.php"); // Localisation au fichier form.connect.php

}
    else 
{
    $utilisateurs = new utilisateurs();
    $action = 'ajouter';
}
 
?>

<!DOCTYPE html>
<html lang="en">

    <?php include 'includes/header.inc.php';?>
<body>

      <!-- Responsive navbar-->
        <?php include 'includes/nav.inc.php';?>

      <!-- Page Content-->
        <div class="container px-4 px-lg-5">

      <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
          <div class="col-12">
            <h1 class="font-weight-light"> <?php echo "Bienvenue sur le formulaire pour créer votre compte utilisateur ! " ?> </h1>
            <p>Formulaire d'inscription </p>
          </div>
        </div>
            

<form encatype = "multipart/form-data" action="form.connect.php" method="post">
    
  <div class="form-group">
    <label for="nom">Votre Nom : </label>
    <input type="text" name= "nom" class="form-control" id="nom">
  </div>
 
  <div class="form-group">
    <label for="prenom">Votre prénom : </label>
    <input type="text" name= "prenom" class="form-control" id="prenom">
  </div>

  <div class="form-group">
    <label for="email">Votre E-mail: </label>
    <input type="text" name= "email" class="form-control" id="email">
  </div>
  
  <div class="form-group">
    <label for="mdp">Votre mot de passe : </label>
    <input type="text" name= "mdp" class="form-control" id="mdp">
  </div>
   
  <button type="submit" name= "submit" class="btn btn-primary">Créer mon compte utilisateur</button>
</form>

        <!-- Footer
        <footer class="py-5 bg-dark">
            <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer> -->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>