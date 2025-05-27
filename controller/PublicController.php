<?php
# controller/PublicController.php

if (isset($_GET['pageChanger']) AND $_GET['pageChanger']==="login"){
    // chargement de la vue
    require "../view/connexion.html.php";

}