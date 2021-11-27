<?php  // Utilisation des fichiers de config 
    require_once 'config/init.conf.php'; 
    require_once 'config/bdd.conf.php';
    require_once 'config/bdd.conf.php';
       // mdp : $2y$10$ymo0WYNg/mHKOAIRJd6rZuEqaqD453htzDfPkSDdd50p17TKme7O2

    if(isset($_POST['submit']))
    {
        $utilisateurs = new utilisateurs();
        $utilisateurs->hydrate($_POST);

           
        $utilisateurs->setMdp(password_hash($utilisateurs->getMdp(),PASSWORD_DEFAULT)); // mise du mdp en haschage
        $isConnect = password_verify($utilisateurs->getMdp(), $utilisateursEnBdd->getMdp()); // vérification du mot de passe
        $utilisateursManager = new utilisateursManager($bdd); 
        $utilisateursEnBdd = $utilisateursManager->getByEmail($utilisateurs->getEmail()); // vérification de l'email
        $pass1 = $utilisateurs->getMdp();
        $pass2 = $utilisateursEnBdd->getMdp();

    if ($isConnect==$true) // Utilisation du SID si le compte utilisateur existe
    {
        $sid = md5($utilisateurs->getEmail() . time());
        setCookie('sid', $sid, time() + 86400); // Mise en place d'un temps de connexion grâce au cookie 
        $utilisateurs->setSid($sid);
        $utilisateursManager->updateByEmail($utilisateurs);
    }

        $pass1 = $utilisateurs->getMdp();
        $pass2 = $utilisateursEnBdd->getMdp();

    if($isConnect==$true) // précision de l'état de la connexion, si elle est bonne on sera connecté
    {
        $_SESSION['notification']['result'] = 'success';
        $_SESSION['notification']['message'] = 'Vous êtes connecté.';
        header("Location: index.php");

    } 
        else // précision de l'état de la connexion, si elle n'est pas bonne on ne sera pas connecté
        {
            $_SESSION['notification']['result'] = 'danger';
            $_SESSION['notification']['message'] = 'Une erreur est survenue';
            header("Location: connexion.php");
        }

    }
       else 
       {
           $utilisateurs = new utilisateurs();
           $action = 'ajouter';

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
                <h1 class="font-weight-light"> <?php echo "Bienvenue sur la page de connexion ! " ?> </h1>
            </div>
        </div>
            
    <!-- Formulaire avec les données désirées -->
<form encatype = "multipart/form-data" action="connexion.php" method="post">

        <div class="form-group">
            <label for="email">Votre E-mail: </label>
            <input type="text" name= "email" class="form-control" id="email">
        </div>
    <p></p>

        <div class="form-group">
            <label for="mdp">Votre mot de passe : </label>
            <input type="text" name= "mdp" class="form-control" id="mdp">
        </div>
    <p></p>

    <button type="submit" name= "submit" class="btn btn-primary">Connexion</button>

</form>
    <p></p>

    <!-- Footer-->
<footer class="py-5  bg-dark">
    <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
</footer>

    <!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
<script src="js/scripts.js"></script>

    </body>
</html>

<?php

}
?>