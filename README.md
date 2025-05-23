# MVC-2025-Create-Read

## Raison d'être de cet exercice commun

Nous devons voir le CRUD complet avec admin pour dans deux semaines, ce site servira donc de base pour atteindre cet objectif.

## Configuration

Importation du fichier `data/mvc2025createread-with-datas.sql` dans votre base de données MariaDB.

## Fichiers de configuration

Dupliquez le fichier `config-dev.php` et renommez-le-en `config-prod.php`. Il se trouve actuellement dans le `.gitignore`, pour des raisons de sécurité.

## Le dossier public 

Le dossier public est la racine de notre site, les utilisateurs ne pourront accéder qu'à ce dossier et ses enfants.

## Un template bootstrap

Nous le mettrons en place depuis `data/FlexStart-1.0.0`

## Identifiants

### Pour se connecter à l'administration

Il faudra se connecter avec un des utilisateurs présents dans la base de données.


### Utilisateurs dans la DB

Les deux premiers sont respectivement le login et le mot de passe non haché.

- `admin` | `lulu25` | `Pitz Michaël` | `admin`
- `modo` | `lala36` | `Sandron Pierre` | `modo`
- `user1` | `use123r` | `Sall Magib` | `redac`

### Notre base de donnée `mvc2025createread`

![DB schema](data/mvc2025createread.png)

## Exercice

Nous allons mettre en place un MVC basique pour commencer

Il devra être en `MVC`, 
- avec un contrôleur frontal dans `public`, 
- des contrôleurs de type routeurs dans `controller` suivant qu'on soit connecté ou non, 
- des modèles qui portent le nom des tables en `Pascal case` dans le dossier `model`, ils se chargeront des requêtes d'affichage et d'insertion d'articles pour `ArticleModel.php` et de la connexion et de déconnexion pour `UserModel.php`,
- des vues qui seront nommées dans le dossier `view` avec des `.` : exemple : `accuei.view.html.php`.

### Partie publique

#### Un menu public

Il contiendra les liens vers `Accueil`, `À propos`, et `Connexion`

Cette partie sera accessible aux utilisateurs non enregistrés et non connectés, elle contiendra les pages :

#### Pages publiques

- `Accueil` (qui affichera) : Les articles (voir la table `article`) affichés par ordre de publication `article_date_published` descendant SI `article_is_published` => 1 (0 si non publié)
- Une page `À propos` qui contiendra un texte static.
- Une page `Connexion` qui contiendra un formulaire permettant de se connecter à l'administration. Il faudra utiliser `password_verify()` pour vérifier le mot de passe. Elle ne sera pas accessible si nous sommes déjà connecté !



### Partie privée

#### Un menu privé

Il contiendra les liens vers `Accueil`, `À propos`, `Déconnexion`
et `Administration`.

#### Pages privées

- `Accueil` : identique qu'en publique, on affichera le nom de la personne connectée (avec un lien vers `Déconnexion` et plus `Connexion`)
- Une page `À propos` : identique qu'en publique, on affichera le nom de la personne connectée. (avec un lien vers `Déconnexion` et plus `Connexion`)
- Une page `Administration` qui contiendra un formulaire permettant d'insérer un nouvel article (avec un lien vers `Déconnexion` et plus `Connexion`), elle ne sera pas accessible si nous ne sommes pas connecté ! Il faudra ajouter : 

1. Qu'ils doivent être publiés `article_is_published` => 1 via une checkbox à cocher sur le formulaire, sinon ce champ non renseigné mettra `article_is_published` => 0 par défaut.
2. La date de publication `article_date_published` doit être indiquée via ce même formulaire.
3. Seul l'utilisateur connecté `$_SESSION['iduser']` peut poster l'article.

- Lors du clic sur déconnexion, l'utilisateur sera déconnecté et sera renvoyé sur l'accueil.

### Sécurité

N'oubliez pas les requêtes préparées et les protections des champs utilisateurs !

