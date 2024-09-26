<?php 

class Commentaires {
    private $IdTblCom;
    private $Date;
    private $Contenu;
    private $IdUsersTblCom;
    private $idArticlesTblCom;

    public function getIdTblCom()
    {
        return $this->IdTblCom;
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

    public function getIdUsersTblCom()
    {
        return $this->IdUsersTblCom;
    }

    public function setIdUsersTblCom($IdUsersTblCom)
    {
        $this->IdUsersTblCom = $IdUsersTblCom;
    }

    public function getidArticlesTblCom()
    {
        return $this->idArticlesTblCom;
    }

    public function setidArticlesTblCom($idArticlesTblCom)
    {
        $this->idArticlesTblCom = $idArticlesTblCom;
    }
}