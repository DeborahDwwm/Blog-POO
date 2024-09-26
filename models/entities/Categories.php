<?php 

class Categories {
    private $IdTblCategories;
    private $NomCategorie;


    public function getIdTblCategories()
    {
        return $this->IdTblCategories;
    }

    public function getNomCategorie()
    {
        return $this->NomCategorie;
    }

    public function setNomCategorie($NomCategorie)
    {
        $this->NomCategorie = $NomCategorie;
    }
}