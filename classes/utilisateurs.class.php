<?php 
// Déclaration de la classe utilisateurs et des éléments qui la compose
class utilisateurs 
{
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $mdp;
    public $sid;

// Déclaration des fonctions Get des éléments Id, Titre, Texte, Data et Publie
    function getId() 
    {
        return $this->id;
    }

    function getNom() 
    {
        return $this->nom;
    }

    function getPrenom() 
    {
        return $this->prenom;
    }

    function getEmail() 
    {
        return $this->email;
    }

    function getMdp() 
    {
        return $this->mdp;
    }

    function getSid() 
    {
        return $this->Sid;
    }

// Déclaration des fonctions Set des éléments Id, Titre, Texte, Data et Publie
    function setId($id) 
    {
        $this->id = $id;
    }

    function setNom($Nom) 
    {
        $this->Nom = $Nom;
    }

    function setPrenom($prenom) 
    {
        $this->prenom = $prenom;
    }

    function setEmail($email) 
    {
        $this->email = $email;
    }

    function setMdp($Mdp) 
    {
        $this->Mdp = $Mdp;
    }

    function setSid($sid) 
    {
        $this->sid = $sid;
    }
// Déclaration de la fonction hydrate des éléments Id, Titre, Texte, Data et Publie
    public function hydrate($donnees) 
    {
        if (isset($donnees['id'])) 
        {
            $this->id = $donnees['id'];
        } 

        else 
        {
            $this->id = '';
        }

        if (isset($donnees['nom'])) 
        {
            $this->nom = $donnees['nom'];
        } 

        else 
        {
            $this->nom = '';
        }

        if (isset($donnees['prenom'])) 
        {
            $this->prenom = $donnees['prenom'];
        } 

        else 
        {
            $this->prenom = '';
        }

        if (isset($donnees['email'])) 
        {
            $this->email = $donnees['email'];
        } 
        
        else
        {
            $this->email = '';
        }

        if (isset($donnees['mdp'])) 
        {
            $this->mdp = $donnees['mdp'];
        } 

        else 
        {
            $this->mdp = '';
        }

        if (isset($donnees['sid'])) 
        {
            $this->sid = $donnees['sid'];
        } 
        
        else
        {
            $this->sid = 0;
        }
    }
        
}