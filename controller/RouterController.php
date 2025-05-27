<?php
# controller/RouterController.php

// appel des dépendances
require "../model/ArticleModel.php";
require "../model/UserModel.php";

// pageChanger n'existe pas, Accueil
// pour utilisateurs connectés ou pas
if(!isset($_GET['pageChanger'])){

    // on charge les articles
    $articles = getArticlesPublished($db);



    // chargement de la vue
    require "../view/homepage.html.php";

// page about
// pour utilisateurs connectés ou pas
}elseif ($_GET['pageChanger']==="about"){
    // chargement de la vue
    require "../view/about.html.php";

}

// Vérification si on est connecté ou pas
if(isset($_SESSION['user_name'])){
    require "PrivateController.php";
}else{
    // routes pour les utilisateurs non connectés
    require "PublicController.php";
}