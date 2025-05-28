<?php
# model/ArticleModel.php

function addArticle(PDO $conn, array $datas, int $iduser)
{
    // requête d'insertion
    $sql = "INSERT INTO `article` (`article_title`,`article_text`,`article_date_published`, `article_is_published`,`user_iduser `) VALUES (?,?,?,?,?);";
    // préparation de la requête
    $query = $conn->prepare($sql);

    // si on a coché publié
    if(isset($datas['article_is_published'])){
        // article_is_published => 1
        $isPublished = 1;
        // on gère la date de publication si publié
        $datePublished = $datas['article_date_published'];
        // si vide, on prend la date actuelle
        if(empty($datePublished)){
            // date du jour par défaut (time())
            $datePublished = date("Y-m-d H:i:s");
        }else{
            // on transforme la date en timestamp
            // temps en secondes depuis le 1/1/1970
            $datetime = strtotime($datePublished);
            // conversion en temps valide dans la DB
            $datePublished = date("Y-m-d H:i:s", $datetime);
        }
    }else{
        // article_is_published => 0
        $isPublished = 0;
        // article_date_published => NULL
        $datePublished = null;
    }

    // ICI

    try{

    }catch (Exception $e){

    }
}
/**
 * @param PDO $conn
 * @return array
 * Récupération des articles qui sont publiés par date
 * de publication descendante
 */
function getArticlesPublished(PDO $conn): array
{
    $sql = "
        SELECT a.`idarticle`, a.`article_title`, LEFT(a.`article_text`,290) AS article_text , a.`article_date_created`, a.`article_date_published`,a.`article_is_published`,
u.user_login, u.user_name
        FROM article a
        INNER JOIN `user` u
        	ON u.iduser=a.user_iduser
        WHERE a.`article_is_published`=1
        ORDER BY a.`article_date_published` DESC;
    ";
    try {
        $query = $conn->query($sql);
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }catch(Exception $e){
        die($e->getMessage());
    }

}

function cutTheText(string $text): string
{
    // on récupère la position du dernier espace dans le texte
    $lastSpace = strripos($text," ");
    // on coupe le texte de 0 à la position de l'espace vide
    return substr($text,0,$lastSpace)."...";
}