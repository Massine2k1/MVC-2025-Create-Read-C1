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

/**
 * Génère un slug optimisé pour les URLs et les champs uniques à partir d'une chaîne de caractères.
 *
 * @param string $title La chaîne de caractères à "sluggifier".
 * @param bool $addUniqueId Si true, ajoute un suffixe unique pour garantir l'unicité.
 * @param string $separator Le séparateur à utiliser (par défaut '-').
 * @return string Le slug généré.
 */
function createSlug(string $title, bool $addUniqueId = false, string $separator = '-'): string
{
    // 1. Translitérer les caractères accentués en leurs équivalents ASCII (ex: é -> e)
    // Utilise l'extension `intl` qui est la méthode moderne et la plus fiable.
    $slug = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0100-\u7fff] remove', $title);

    // 2. Mettre la chaîne en minuscules
    $slug = strtolower($slug);

    // 3. Remplacer tout ce qui n'est pas une lettre, un chiffre, un underscore ou le séparateur par le séparateur
    // Cela permet de nettoyer les espaces, la ponctuation, etc.
    $slug = preg_replace('/[^a-z0-9_' . preg_quote($separator, '/') . ']+/i', $separator, $slug);

    // 4. Supprimer les séparateurs en double
    $slug = preg_replace('/' . preg_quote($separator, '/') . '{2,}/', $separator, $slug);

    // 5. Supprimer les séparateurs en début et fin de chaîne
    $slug = trim($slug, $separator);

    // 6. (Optionnel) Ajouter un suffixe unique pour garantir l'unicité en base de données
    if ($addUniqueId) {
        // Genère 4 octets aléatoires et les convertit en une chaîne hexadécimale de 8 caractères.
        // C'est plus court et plus sûr que uniqid().
        $uniqueSuffix = bin2hex(random_bytes(4));
        $slug = $slug . $separator . $uniqueSuffix;
    }

    return $slug;
}

