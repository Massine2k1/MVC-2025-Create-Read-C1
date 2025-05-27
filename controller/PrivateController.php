<?php
# controller/PrivateController.php

if(isset($_GET['pageChanger']) AND $_GET['pageChanger']==="disconnect"){
    $disconnect = disconnectUser();
    if($disconnect){
        header("Location: ./");
        exit();
    }
}