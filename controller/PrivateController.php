<?php
# controller/PrivateController.php

if(isset($_GET['pageChanger'])){
    // on veut se déconnecter
    if($_GET['pageChanger']==="disconnect") {
        $disconnect = disconnectUser();
        if ($disconnect) {
            header("Location: ./");
            exit();
        }
    // on veut atteindre l'admin
    }elseif ($_GET['pageChanger']==="admin"){

        // si on tente d'insérer un article
        if(isset($_POST['article_title'])){
            addArticle($db,$_POST,$_SESSION['iduser']);
        }

        // appel de la vue
        require_once "../view/admin.html.php";
    }
}