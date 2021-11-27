<?php  require_once 'config/init.conf.php' // Utilisation du fichier de config  ?> 

<?php

  //Création de l'article
  if(isset($_GET['id'])) 
  {
    $idArticle=($_GET['id']);
    $articlesManager = new articlesManager($bdd);
    $a = $articlesManager->get($idArticle);
  }

  else 
  {
    echo "";
  }


  if(isset($_POST['submit']))
  {
    //print_r2($_POST);
    //print_r2($FILES);
    $articles = new articles();
    $articles->hydrate($_POST);

    $articles->setDate(Date('Y-m-d')); // utilisation de la date pour la date de publication de l'article
    $publie = $articles->getPublie()=== 'on' ? 1:0;
    $articles->setPublie($publie);
    
    //insertion de l'article ou Mise à jour
    $articlesManager = new articlesManager($bdd);

    if(empty($_POST['id'])) 
    {
      $articlesManager->add($articles); // Ajout de l'article
    }

      else 
      {
        $articlesManager->update($articles); // Mise à jour de l'article
      }
  

    //Traitement de l'image
    if($FILES['image'] ['error'] === 0)
    {
      $fileInfos = pathinfo($_FILES['image']['name']);
      move_uploaded_file($_FILES['image']['tmp_name'], 'img/' .$articlesManager->get_getLastInsertId() . '.' . $fileInfos['extension']);
    }

    if($articlesManager->get_result() == true) // Si le résultat est correct, alors l'article est ajouté
    {
      $_SESSION['notification']['result'] = 'success';
      $_SESSION['notification']['message'] = 'Votre article a bien été ajouté !';
    } 
      
      else // Sinon si le résultat n'est pas correct, alors l'article n'est pas ajouté mais une erreur est signalé
      {
        $_SESSION['notification']['result'] = 'danger'; 
        $_SESSION['notification']['message'] = 'Une erreur est survenue pendant la création de votre article...';
      }

      header("Location: index.php"); // Localisation à l'index.php à la fin
    exit();
  }
    else 
    {
    // $article= new articles();
    // $action = 'ajouter';
 
?>

<!DOCTYPE html>
<html lang="en">

  <?php include 'includes/header.inc.php'; // Include du fichier header ?> 
  
  <body>

    <!-- Responsive navbar-->
      <?php include 'includes/nav.inc.php';?>

    <!-- Page Content-->
      <div class="container px-4 px-lg-5">

    <!-- Heading Row-->
      <div class="row gx-4 gx-lg-5 align-items-center my-5">
      <div class="col-12">
        <h1 class="font-weight-light"> <?php echo "Bienvenue sur le formulaire des articles ! " ?> </h1>
        <p>Votre formulaire pour publié un article : </p>
      </div>
      </div>                     

    <!-- Formulaire de publication d'article -->  
  <form encatype = "multipart/form-data" action="articles.php" method="post">

    <div class="form-group">
      <?php if(isset($a)){?>
      <label for="Titre">Titre</label>
      <input type="text" name ="titre" class="form-control" id="Titre" aria-describedby="emailHelp" placeholder="Entrez un titre" value="<?= $a->getTitre()?>">
      <?php }else{ ?>
      <label for="Titre">Titre</label>
      <input type="text" name ="titre" class="form-control" id="Titre" aria-describedby="emailHelp" placeholder="Entrez un titre">  
      <?php } ?>
    </div>

    <div class="form-group">
      <?php if(isset($a)){?>
      <label for="Texte">Texte</label>
<!-- ICI POUR LE COMMENTAIRE--><textarea class="form-control" name ="texte" id="Texte" rows="10" placeholder="Entrez un texte" ><?= $a->getTexte()?></textarea>
      <?php }else{ ?>
      <label for="Texte">Texte</label>
      <textarea class="form-control" name ="texte" id="Texte" rows="10" placeholder="Entrez un texte"></textarea>
      <?php } ?>
    </div>

    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="Publie">
      <label class="form-check-label" name ="publie" for="Publie">Publier l'article ?</label>
    </div>

    <div class="form-group">
      <label for="exampleFormControlFile1">Inserer une image</label>
      <input type="file" name ="image"class="form-control-file" id="exampleFormControlFile1">
    </div>

      <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
      <?php if(isset($a)){?>
      <input type="hidden" name="id" value="<?= $a->getId()?>">
      <?php }else{}?>
  </form>

  <p></p>

  <!-- Footer-->
    <p></p>
    <footer class="py-5 bg-dark">
      <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
    </footer>

  <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

  </body>
</html>

<?php  } ?>