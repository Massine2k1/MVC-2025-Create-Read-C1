<?php
# model/ArticleModel.php

function getArticlesPublished(PDO $conn): array
{
    $sql = "
        SELECT a.`idarticle`, a.`article_title`, LEFT(a.`article_text`,290) AS article_text , a.`article_date_created`, a.`article_date_published`,a.`article_is_published`,
u.user_login, u.user_name
        FROM article a
        INNER JOIN `user` u
        	ON u.iduser=a.user_iduser
        WHERE a.`article_is_published`=1;
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