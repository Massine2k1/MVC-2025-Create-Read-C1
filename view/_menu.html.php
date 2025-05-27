<?php
# view/_menu.html.php

?>
<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="./">Accueil<br></a></li>
        <li><a href="./?pageChanger=about">About</a></li>
        <!--<li class="dropdown"><a href="#"><span>Sections</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="#">Dropdown 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Deep Dropdown 1</a></li>
                        <li><a href="#">Deep Dropdown 2</a></li>
                        <li><a href="#">Deep Dropdown 3</a></li>
                        <li><a href="#">Deep Dropdown 4</a></li>
                        <li><a href="#">Deep Dropdown 5</a></li>
                    </ul>
                </li>
                <li><a href="#">Dropdown 2</a></li>
                <li><a href="#">Dropdown 3</a></li>
                <li><a href="#">Dropdown 4</a></li>
            </ul>
        </li>-->
        <?php
        if(isset($_SESSION['user_name'])):
        ?>
            <li><a href="./?pageChanger=admin">Administration</a></li>
        <li><a href="./?pageChanger=profile">Profil de <?= $_SESSION['user_name'] ?></a></li>
            <li><a href="./?pageChanger=disconnect">Déconnexion</a></li>
        <?php
        else:
        ?>
        <li><a href="./?pageChanger=login">Connexion</a></li>
        <?php
        endif;
        ?>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

