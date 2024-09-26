<?php

class Articles //avec majuscule au début comme le nom du fichier bonne pratique pour reconnaître les classe (pascal case)
{ //création d'un moule pour table sous la forme d'une classe qui permettra la création de de la table de la BDD (un objet qui sera persisté/utilisé dans une BDD s'appelle une entité)
    private $IdTblArticles; // à écrire en camel case
    private $Titre;
    private $ImagePreview;
    private $ImageUne;
    private $Date;
    private $Contenu;
    private $IdUsersTblArticles;

    // public function __construct($idArticlePK, $titre, $img, $date, $contenu, $usersTblArticlesFK, $categorieTblArticlesFK) //construire l'objet
    // {
    //     $this->idArticlePK = $idArticlePK; //pas obligatoire car on va injecter les données avec un Fetch class
    //     $this->titre = $titre;
    //     $this->img = $img;
    //     $this->date = $date;
    //     $this->contenu = $contenu;
    //     $this->usersTblArticlesFK = $usersTblArticlesFK;
    //     $this->categorieTblArticlesFK = $categorieTblArticlesFK;
    // }


    public function getIdTblArticles() //à écrire en camel case
    {
        return $this->IdTblArticles;//this c'est l'objet en cours (sur lequel on est et derrirer la -> c'est la propriété qu'il contient)
    }

    public function getTitre()
    { //quand on veut attraper/accéder à une donnée : pour les PK uniquement un geter est necessaire mais pas un seter
        return $this->Titre; // il nous retourne ce que contient l'objet au niveau de cette propriété
    }

    public function setTitre($Titre)
    { //quand on veut pouvoir modifier une donnée, il n'envoi rien mais il modifie celui qui est sur l'objet
        $this->Titre = $Titre;//on cible la propriété qu'on veut modifier dans l'objet et on lui envoi la variable qu'on veut pour remplacer
    }

    public function getImagePreview()
    {
        return $this->ImagePreview;
    }

    public function setImagePreview($ImagePreview)
    {
        $this->ImagePreview = $ImagePreview;
    }

    public function getImageUne()
    {
        return $this->ImageUne;
    }

    public function setImageUne($ImageUne)
    {
        $this->ImageUne = $ImageUne;
    }

    public function getDate()
    {
        return $this->Date;
    }

    public function setDate($Date)
    {
        $this->Date = $Date;
    }

    public function getContenu()
    {
        return $this->Contenu;
    }

    public function setContenu($Contenu)
    {
        $this->Contenu = $Contenu;
    }

    public function getIdUsersTblArticles()
    {
        return $this->IdUsersTblArticles;
    }

    public function setIdUsersTblArticles($IdUsersTblArticles)
    {
        $this->IdUsersTblArticles = $IdUsersTblArticles;
    }


}
