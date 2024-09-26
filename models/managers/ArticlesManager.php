<?php

require_once './models/managers/dbconnect.php';
require_once './models/entities/Articles.php';

class ArticlesManager 
{
    
    // fonction envoi article dans BDD ===========================================

    public static function sendArticle($IdTblArticles, $Titre, $ImagePreview, $ImageUne, $Contenu, $IdUsersTblArticles) {
        $dbh = dbconnect();
        $query = "INSERT INTO articles (IdTblArticles, Titre, ImagePreview, ImageUne, Contenu, IdUsersTblArticles) VALUES (:IdTbleArticles, :Titre, :ImagePreview, :ImageUne, :Contenu, :IdUsersTblArticles);";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':IdTblArticles', $IdTblArticles);
        $stmt->bindParam(':Titre', $Titre);
        $stmt->bindParam(':ImagePreview', $ImagePreview);
        $stmt->bindParam(':ImageUne', $ImageUne);
        $stmt->bindParam(':Contenu', $Contenu);
        $stmt->bindParam(':IdUsersTblArticles', $IdUsersTblArticles);
        $stmt->execute();
    }

    // fonction envoi article BDD > blog ===========================================

public static function publishArticleById($IdTblArticles) {
    $dbh = dbconnect();
   $query = "SELECT * FROM `articles`
    WHERE IdTblArticles = :IdTblArticles;";
   $stmt = $dbh->prepare($query);
   $stmt->bindParam(':IdTblArticles', $IdTblArticles);
   $stmt->execute();
   $stmt->setFetchMode(PDO::FETCH_CLASS, 'Articles');
   $result = $stmt->fetch();
   return $result;
}

// fonction recup tous les articles de la BDD ===========================================

public static function getAllArticles() {
    $dbh = dbconnect();
    $query = "SELECT * FROM articles";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Articles');
    return $results;
}

// fonction recup tous les articlesd'un même auteur ===========================================

public static function publishArticlesByAuteurId($IdUsersTblArticles) {
    $dbh = dbconnect();
   $query = "SELECT * FROM `articles` INNER JOIN `users` ON IdUsersTblArticles = IdTblUsers WHERE IdUsersTblArticles = :IdUsersTblArticles;";
   $stmt = $dbh->prepare($query);
   $stmt->bindParam(':IdUsersTblArticles', $IdUsersTblArticles);
   $stmt->execute();
   $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Articles');
   return $result;
}
}