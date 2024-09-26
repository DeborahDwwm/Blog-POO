<?php 
session_start();
require_once './models/managers/ArticlesManager.php'; // lier fichiers managers et connection
require_once './models/managers/CategoriesManager.php';
require_once './models/managers/CommentairesManager.php';
require_once './models/managers/UsersManager.php';
require_once './models/managers/dbconnect.php';



//if de la fonction post d'inscription des membres (attention a bien nommer l'input pour que le lien se fasse avec le bon formulaire)==============================================================================
if(isset($_POST['subscribe'], $_POST['Nom'],$_POST ['Prenom'],$_POST ['Mail'],$_POST ['Pwd']) && !empty($_POST['subscribe']) && !empty($_POST['Nom']) && !empty(['Prenom']) && !empty(['Mail']) && !empty(['Pwd'])) {
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $Email = $_POST['Mail'];
    //hashage du MDP
    $Mdp = password_hash($_POST['Pwd'], PASSWORD_DEFAULT);
    //appel de la fonction du doc function.php
    UsersManager::insertUser($Nom, $Prenom, $Email, $Mdp);
}

// if de la fonction connection member ==========================================

//creation d'un message d'erreur (il marchait et maintenant il marche plus :(
$messageErreur = "";
//tjs bien nommer l'input pour que ca s'applique au bon formulaire de la page
    if(isset($_POST['connect']) && !empty ($_POST['connect'])){
    $email = $_POST['Email'];
    $password = $_POST['Mdp'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $user = UsersManager::isUser($email);
    
    if($user){
        $registered_password = $user['Mdp'];
        $isCredentialsOK = password_verify($password, $registered_password);

        if($isCredentialsOK){
            var_dump($messageErreur);
            $_SESSION['users'] = [
                'IdTblUsers'=>$user['IdTblUsers'],
                'Email'=>$user['Email'],
                'prenom'=>$user['Prenom']
            ];
//redirection
            header('location:espaceMembre.php');
        }else{
            $messageErreur = 'mauvais mot de passe';
        }
    }else{
        $messageErreur = 'mauvais identifiants';
    }
}

// if de la fonction de deconnection member ==============================================================================

if (isset($_POST['deconnect'])) {
    session_destroy();
header('location:index.php');
} 

// publication des previews d'articles sur le blog ==========================================

//$IdTblArticles = $_GET['IdTblArticles'];
//var_dump($ArticlesPreview);
//                    die();
//$Titre = $_GET['Titre'];
//$ImagePreview = $_GET['ImagePreview'];
//$ImageUne = $_GET['ImageUne'];
//$Date = $_GET['Date'];
//$Contenu = $_GET['Contenu'];
//$IdUsersTblArticles = $_GET['IdUsersTblArticles'];
//$Nom = $_GET['Nom'];
//$ArticlesPreview = publishArticle($IdTblArticles, $Titre, $ImagePreview, $ImageUne, $Date, $Contenu, $IdUsersTblArticles, $Nom);

$results = ArticlesManager::getAllArticles();
$resultsUsers = UsersManager::getAllUsers();


//var_dump($id);
var_dump($resultsUsers);
//$resultsAllarticle =  bla($idarticle);

?>
<!-- HTML =========================================================== -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog 40N</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <!-- Bannière =========================================================== -->

    <header class="banniere">
        <img src="images/White Beige Minimalist Elegant Classy Book Review Blog Banner-3.png" alt="banniere blog">
    </header>
    <section class="corps">
        <nav class="navbar">
            <div class="containerTop">
                <div class="boutons">
                    <img class="icone" id="burger" src="icones/bars-solid.svg" alt="menu burger">
                </div>
            </div>

    <!-- Navigation =========================================================== -->

            <div class="ulNavClass" id="ulNav">
                <ul class="ulNav">
                    <div class="divLiensNav">
                        <li class="liNav"><a class="lienNav" href="index.php">Acceuil</a></li>
                        <li class="liNav"><a class="lienNav" href="">Carriere</a></li>
                        <li class="liNav"><a class="lienNav" href="">Finances</a></li>
                        <li class="liNav"><a class="lienNav" href="">Sante</a></li>
                        <li class="liNav"><a class="lienNav" href="">Bien-etre</a></li>
                        <li class="liNav"><a class="lienNav" href="">Relations</a></li>
                        </div>
                     
                        

                        <div class="divIcones">
                    <li><a href=""><img class="icone" src="icones/heart-solid.svg" alt="icone coeur"></a></li>
                            <li><a href=""><img class="icone" src="icones/instagram-brands-solid.svg" alt="icone instagram"></a></li>
                            <li><a href=""><img class="icone" src="icones/facebook-f-brands-solid.svg" alt="icone facebook"></a></li>
                            <li><a href=""><img class="icone" src="icones/pinterest-p-brands-solid.svg" alt="icone pinterest"></a></li>
                            <li><a href=""><img class="icone" src="icones/tiktok-brands-solid.svg" alt="icone tiktok"></a></li>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
    
    <!-- Carousel  =========================================================== -->

        <section class="carouselGeneral">
            <div class="containerCarousel">
                <div class="custom-slider">
                    <img src="images/slider 1.png" alt="">
                </div>
                <div class="custom-slider">
                    <img src="images/slider 2.png" alt="">
                </div>
                <div class="custom-slider">
                    <img src="images/slider 3.png" alt="">
                </div>
                <div class="custom-slider">
                    <img src="images/slider 4.png" alt="">
                </div>

                <div class="slide-dot">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                </div>
        </section>

<!-- Articles =========================================================== -->

        <section class="main">
            <section class="articles">
                
                <?php foreach ($results as $result) {
                $elemArticles = ArticlesManager::publishArticleById($result->getIdTblArticles());
                $elemUsers = UsersManager::getAllUsers($resultsUsers->getNom());

        //$getImagePreview = getAllArticles($result["IdTblArticles"]);
        //$getArticleByid = publishArticleById($result["IdTblArticles"]);
        //getElemArticlesbyId($idarticle)
        //var_dump(getElemArticlesbyId($result["IdTblArticles"]));
        //var_dump(getElemArticlesbyId(2));
        //die();
        ?>
                    <article class="carteArticle">
                    <div class="auteurCoeur">
                    <a class="liensPhp" href="auteur.php?id=<?php echo $elemArticles->getIdUsersTblArticles()?>"><h3>Par <?php echo $elemUsers->getNom();?></h3></a>
                    <img class="icone iconeCoeurVide" src="icones/heart-vide.svg" alt="icone coeur incolore">
                    </div>
                    <div class="dateCategorie">
                    <h4><?php echo $result->getDate();?></h4>
                    <h4>Catégorie</h4>
                    </div>
                    <a href="article.php?id=<?php echo $result->getIdTblArticles();?>"><img class="mainImageArticle" src="uploads\<?php echo $result->getImagePreview();?>" alt=""></a><!--Faire un alt des images dans BDD-->
                    </article>
                    <!-- <button class="boutonMembers boutonMembers2">Lire</button>-->
                    <?php 
                    }?>
                
            </section>

<!-- About =========================================================== -->
    
            <section class="blocs">
                <article class="about">
                    <img class="photoAbout" src="images/photo fille about.jpg" alt="photo auteur du blog">
                    <h2>Déborah</h2>
                    <p class="pAbout">Hello et bienvenue sur mon blog ! Ici tu trouveras plein de conseils pour une vie meilleure. En espérant que cela puisse t'aider <img class="iconeTexte" src="icones/heart-solid.svg" alt="icone coeur"></p>
                </article>

<!-- Form inscription =========================================================== -->                

                <article class="formConnexion">
                    <h2 class="h2Members">Inscription Members</h2>
                    <form class="formMembers" action="" method="post">
                        <input class="inputMembers" type="text" placeholder="Nom" name="Nom">    
                        <input class="inputMembers" type="text" placeholder="Prenom" name="Prenom">
                        <input class="inputMembers" type="email" name="Mail" placeholder="Email" >
                        <input class="inputMembers" type="text" placeholder="Mot de Passe" name="Pwd" >
                        <input class="boutonMembers" type="submit" value="S'inscrire" name="subscribe">
                    </form>
                </article>

<!-- Form connexion =========================================================== -->

                <article class="formConnexion formConnexion2">
                    <h2 class="h2Members">Connexion Members</h2>
                    <form class="formMembers" action="" method="POST">
                        <input class="inputMembers" type="email" name="Email" placeholder="Email">
                        <input class="inputMembers" type="text" name="Mdp" placeholder="Mot de Passe">
                        
                        <?php if(isset($_SESSION['users']) && !empty($_SESSION['users'])) {?>
                            <p><?php echo $messageErreur ?></p>
                            <p class="pBoutonMember"><img class="iconeTexte" src="icones/heart-solid.svg" alt="icone coeur"> Hello <?php echo $_SESSION['users']['prenom']; ?> ! <img class="iconeTexte" src="icones/heart-solid.svg" alt="icone coeur"></p>
                            <input class="boutonMembers" type="submit" name="deconnect" value="Se déconnecter">
                            <?php } else { ?>
                                <input class="boutonMembers" type="submit"  name="connect" value="Se Connecter">
                            <?php } ?>

                            
                        
                
                        
                    </form>
                </article>
            </section>
        </section>
    </section>

<!-- Footer =========================================================== -->

    <footer>
        <div class="containerFooterGeneral">
            <div class="blocsFooterHaut">
                <article class="articleFooterUn">
                    <h2>Me suivre sur les réseaux</h2>
                    <div class="iconesReseaux">
                        <a href=""><img class="icone" src="icones/heart-solid.svg" alt="icone coeur"></a>
                        <a href=""><img class="icone" src="icones/instagram-brands-solid.svg" alt="icone instagram"></a>
                        <a href=""><img class="icone" src="icones/facebook-f-brands-solid.svg" alt="icone facebook"></a>
                        <a href=""><img class="icone" src="icones/pinterest-p-brands-solid.svg" alt="icone pinterest"></a>
                        <a href=""><img class="icone" src="icones/tiktok-brands-solid.svg" alt="icone tiktok"></a>
                    </div>
                </article>
                <article class="articleFooter">
                    <h2>Me contacter</h2>
                    <p class="pFooter">Vous souhaitez m'envoyer un message ?</p>
                    <button class="boutonFooter"><a class="lienBoutons" href="">Contact</a></button>
                </article>
                <article class="articleFooter">
                    <h2>S'abonner à la Newsletter</h2>
                    <p>Recevez les derniers articles parus !</p>
                    <input class="inputFooter" type="email" placeholder="Entrez votre email">
                    <button class="boutonFooter"><a class="lienBoutons" href="">S'abonner</a></button>
                </article>
            </div>
            <div class="blocsFooterBas">
                <h4>© 2023 Welcome on my blog</h4>
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>