<?php
# model/UserModel.php

function connectUser(PDO $connection, string $userLogin, string $userPassword): bool
{
    // on va éviter les espaces avant arrière en cas de copier/coller
    $userLogin = trim($userLogin);
    $userPassword= trim($userPassword);
    // SQL qui récupère l'utilisateur via son login
    $sql = "SELECT * FROM `user` WHERE `user_login` = ?";
    // prepare
    $query = $connection->prepare($sql);
    try{
        // exécution de la requête
        $query->execute([$userLogin]);
        // si pas de réponse, on renvoie false
        if($query->rowCount()===0) return false;
        // si on est ici, on a récupéré un utilisateur
        $user = $query->fetch();
        // bonne pratique
        $query->closeCursor();
        // on vérifie si le mot de passe envoyé par
        // $_POST correspond au hash stocké dans la base
        // de donnée encodée en password_hash
        if(password_verify($userPassword,$user['user_pwd'])){
            // connexion
            // on régénère un id de session (sécurité ++)
            session_regenerate_id(true);
            // on met dans la session
            // le tableau associatif récupéré de la DB
            $_SESSION = $user;
            // suppression du mot de passe
            unset($_SESSION['user_pwd']);
            $_SESSION['connectTime'] = time();
            return true;
        }else{
            return false;
        }

    }catch(Exception $e){
        die($e->getMessage());
    }
}


/**
 * Déconnexion de session
 * @return boolean
 */
function disconnectUser(): bool
{
    # suppression des variables de sessions
    session_unset();

    # suppression du cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    # Destruction du fichier lié sur le serveur
    session_destroy();
    return true;
}

