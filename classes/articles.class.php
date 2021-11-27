<?php 
// Déclaration de la classe article et des éléments qui la compose
    class articles 
    {
        public $id;
        public $titre;
        public $texte;
        public $date;
        public $publie;

// Déclaration des fonctions Get des éléments Id, Titre, Texte, Data et Publie
        function getId() 
        {
            return $this->id;
        }

        function getTitre() 
        {
            return $this->titre;
        }

        function getTexte() 
        {
            return $this->texte;
        }

        function getDate() 
        {
            return $this->date;
        }

        function getPublie() 
        {
            return $this->publie;
        }

// Déclaration des fonctions Set des éléments Id, Titre, Texte, Data et Publie
        function setId($id) 
        {
            $this->id = $id;
        }

        function setTitre($titre) 
        {
            $this->titre = $titre;
        }

        function setTexte($texte) 
        {
            $this->texte = $texte;
        }

        function setDate($date) 
        {
            $this->date = $date;
        }

        function setPublie($publie) 
        {
            $this->publie = $publie;
        }

// Déclaration de la fonction hydrate éléments Id, Titre, Texte, Data et Publie
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

            if (isset($donnees['titre'])) 
            {
                $this->titre = $donnees['titre'];
            } 
                else 
                {
                    $this->titre = '';
                }

            if (isset($donnees['texte'])) 
            {
                $this->texte = $donnees['texte'];
            } 
                else 
                {
                    $this->texte = '';
                }

            if (isset($donnees['date'])) 
            {
                $this->date = $donnees['date'];
            } 
                else 
                {
                    $this->date = '';
                }

            if (isset($donnees['publie'])) 
            {
                $this->publie = $donnees['publie'];
            }
                else 
                {
                    $this->publie = 0;
                }
        }
        
        
    }