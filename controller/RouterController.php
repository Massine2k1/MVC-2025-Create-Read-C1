<?php
# controller/RouterController.php

// appel des dépendances
require "../model/ArticleModel.php";
require "../model/UserModel.php";

// pageChanger n'existe pas, Accueil
if(!isset($_GET['pageChanger'])){

    // on charge les articles
    $articles = getArticlesPublished($db);

    // chargement de la vue
    require "../view/homepage.html.php";
}