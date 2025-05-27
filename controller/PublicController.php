<?php
# controller/PublicController.php

if (isset($_GET['pageChanger']) AND $_GET['pageChanger']==="login"){
    // si on a envoyé le formulaire
    if(isset($_POST['user_login'], $_POST['user_pwd'])){
        // fonction qui va vérifier la validité de connexion
        $connect = connectUser($db,$_POST['user_login'],$_POST['user_pwd']);
        // si on est connecté
        if($connect===true){
            header("Location: ./");
            exit();
        }else {
            $error = "Login et/ou mot de passe incorrectes !";
        }
    }
    // chargement de la vue
    require "../view/connexion.html.php";

}