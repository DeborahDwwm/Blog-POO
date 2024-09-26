<?php 

class Users {
    private $IdTblUsers;
    private $Nom;
    private $Prenom;
    private $Email;
    private $Mdp;

    public function getIdTblUsers()
    {
        return $this->IdTblUsers;
    }

    public function getNom()
    {
        return $this->Nom;
    }

    public function setNom($Nom)
    {
        $this->Nom = $Nom;
    }

    public function getPrenom()
    {
        return $this->Prenom;
    }

    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getMdp()
    {
        return $this->Mdp;
    }

    public function setMdp($Mdp)
    {
        $this->Mdp = $Mdp;
    }
}