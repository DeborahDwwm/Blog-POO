<?php //ouverture de php

require_once './models/managers/dbconnect.php'; // le manager à besoin de se connecter à la BDD puisque c'est lui qui gère les échanges
require_once './models/entities/Users.php'; // le manager à besoin de se connecter à l'entité qu'il gère

class UsersManager { // le manager est lui même une class mais il n'a pas besoin d'être instancié (pas de new ... donc pas d'objets qui en découle)

    // fonction post inscription members===========================================
    
    public static function insertUser($Nom, $Prenom, $Email, $Mdp) {
        $dbh = dbconnect();
        $query = "INSERT INTO users (Nom, Prenom, Email, Mdp) VALUES (:Nom, :Prenom, :Email, :Mdp );";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':Nom', $Nom);
        $stmt->bindParam(':Prenom', $Prenom);
        $stmt->bindParam(':Email', $Email);
        $stmt->bindParam(':Mdp', $Mdp);
        $stmt->execute();
    }
    
// fonction session connection members===========================================

    public static function isUser($email) { // les function se transforment en public static function
        $dbh = dbconnect();
        $query = "SELECT * FROM users Where Email = :email";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt ->execute();
        $result = $stmt->fetch(PDO::FETCH_CLASS, 'Users' ); // les fetch_assos du php natif se transforment en fetch_class + ajout du type d'objet à créer
        return $result;
    }

    // fonction attraper nom de l'auteur ===========================================

    public static function getAllUsers() {
        $dbh = dbconnect();
        $query = "SELECT * FROM users";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'Users');
        return $results;
    }
}