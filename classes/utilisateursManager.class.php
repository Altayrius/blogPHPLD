<?php
// Déclaration de la classe utilisateursManager et des éléments qui la compose
class utilisateursManager 
{

    //DECLARATIONS ET INSTANCIATIONS    
    private $bdd;  //Instance de PDO
    private $_result;
    private $_message;
    private $_utilisateurs; //Instance de l'utilisateur
    private $_getLastInsertId;
    
// Déclaration de la fonctions __construct 
    public function __construct (PDO $bdd)
    {
        $this->setBdd($bdd);
    }

// Déclaration des fonctions Get des éléments Bdd, _result, _message, _utilisateurs et _getLastInsertId
    function getBdd() 
    {
        return $this->bdd;
    }

    function get_result() 
    {
        return $this->_result;
    }

    function get_message() 
    {
        return $this->_message;
    }

    function get_utilisateurs() 
    {
        return $this->_utilisateurs;
    }

    function get_getLastInsertId() 
    {
        return $this->_getLastInsertId;
    }

// Déclaration des fonctions Set des éléments Bdd, _result, _message, _utilisateurs et _getLastInsertId
    function setBdd($bdd) 
    {
        $this->bdd = $bdd;
    }

    function set_result($_result) 
    {
        $this->_result = $_result;
    }

    function set_message($_message) 
    {
        $this->_message = $_message;
    }

    function set_utilisateurs($_utilisateurs) 
    {
        $this->_utilisateurs = $_utilisateurs;
    }
    
    function set_getLastInsertId($_getLastInsertId) 
    {
        $this->_getLastInsertId = $_getLastInsertId;
    }

    public function get($id) 
    {
        //Prépare une requête de type SELECT avec une clause WHERE

        $sql = 'SELECT * FROM utilisateurs WHERE id = :id';
        $req = $this->bdd->prepare($sql);

        //Execution de la requête avec attribution des valeurs 
        $req->bindValue( ':id', $id, PDO::PARAM_INT);
        $req->execute();

        //On stocke les données obetnues dans un tableau
        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $utilisateurs = new utilsateurs();
        $utilisateurs->hydrate($donnees);
        //print_r2($article);
        return $utilisateurs;
    }


    public function add(utilisateurs $utilisateurs) 
    {
        // $mdp = $_POST['mdp'];
        // $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
         
        $sql= "INSERT INTO utilisateurs (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)";
         
        //  $sql->execute(array(
                 
        //          'mdp'=>$mdp_hash
        //  ));
        
        // $mdp_hash =password_hash ($_POST['mdp'],PASSWORD_DEFAULT);      
        // $sql = "INSERT INTO utilisateurs " . "(nom, prenom, email, mdp)" . "VALUES (:nom, :prenom, :email, :mdp)";
        $req = $this->bdd->prepare($sql);
    
      // sécurisation des variables
        $req->bindValue(':nom', $utilisateurs->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $utilisateurs->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':email', $utilisateurs->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':mdp', $utilisateurs->getMdp(), PDO::PARAM_STR); 
     
      // excuter la requête
        $req->execute();

            if ($req->errorCode() == 00000) 
            {
                $this->result = true;
                $this->get_getLastInsertId = $this->bdd->LastInsertId();
            } 
        
                else 
                {
                    $this->_result = false;
                }
        return $this;
    }

// Fonction qui va compter et le mettre sous forme de tableau le résultat
    public function countutilisateursPublie() 
    {
        $sql = "SELECT COUNT(*) as total FROM utilisateurs";
        $req = $this->bdd->prepare($sql);
        $req->execute();
        $count = $req->fetch(PDO::FETCH_ASSOC);
        $total = $count['total'];
        return $total;
    }
    
    public function getList($depart, $limit) 
    {
        $listUtilisateurs = [];
        //Prépare une requête de type SELECT avec une clause WHERE
    
        $sql = 'SELECT id, ' .'nom, ' .'prenom, ' .'email, '.'mdp' .'FROM utilisateurs' .' LIMIT :depart, :limit';
        $req = $this->bdd->prepare($sql);

        $req->bindValue(':depart', $depart, PDO::PARAM_INT);
        $req->bindValue(':limit', $limit, PDO::PARAM_INT);

        //Execution de la requête avec attribution des valeurs 
        $req->execute();
        //On stocke les données obetnues dans un tableau
        
        //On stocke les données obtenues dans un tableau 
        while ($donnees = $req->fetch (PDO::FETCH_ASSOC))
        {
            //on créé des objets avec les données issues 
            $utilisateurs = new utilisateurs();
            $utilisateurs->hydrate($donnees);
            $listUtilisateurs[] = $utilisateurs;
        }
        
        //print_r2($listArticle);
        return $listUtilisateurs;

    }

// Fonction qui gère la correspondance de l'E-mail dans la bdd grâce à la requête SELECT
    public function getByEmail($email)
    {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $req = $this->bdd->prepare($sql);

        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $utilisateurs = new utilisateurs();
        $utilisateurs->hydrate($donnees);

        return $utilisateurs;
    }

// Fonction qui gère la correspondance du SID dans la bdd grâce à la requête SELECT
    public function getBySid($sid)
    {
        $sql = "SELECT * FROM utilisateurs WHERE sid = :sid";
        $req = $this->bdd->prepare($sql);

        $req->bindValue(':sid', $sid, PDO::PARAM_STR);
        $req->execute();

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $utilisateurs = new utilisateurs();
        $utilisateurs->hydrate($donnees);

        return $utilisateurs;
    }

// Fonction qui gère la mise à jour de l'utilisateur grâce à une requête UPDATE
    public function updateByEmail(utilisateurs $utilisateurs) 
    {

        $sql = "UPDATE utilisateurs SET sid = :sid WHERE email = :email";
        $req = $this->bdd->prepare($sql);
    
        //sécurisation des variables 
        
        $req->bindValue(':email', $utilisateurs->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':sid', $utilisateurs->getSid(), PDO::PARAM_STR);
        
        //execute la requête 
        $req->execute();

// En cas d'erreur de la requête, _result sera égale à vrai  sinon il sera égal à faux
        if ($req->errorCode() == 00000) {
            $this->_result = true;
        } else {
            $this->_result = false;
        }
        return $this;
        
    }
}

?>