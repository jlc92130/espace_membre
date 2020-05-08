<?php
if (isset($_COOKIE['souvenir']) && !isset($_SESSION['connect'])) {
    require('src/connection_bdd.php'); 
    //RECUPERATION OF THE COOKIE NAME
    $valeur_cookie = htmlspecialchars($_COOKIE['souvenir']);
   //IS THERE SOMEONE IN DBB WITH THIS SECRET NUMBER
    $reqVal = $bdd->prepare('SELECT count(*) as nombre_res FROM user WHERE secret=?');
    $reqVal->execute(array($valeur_cookie));

    $resVal = $reqVal->fetch();
    if ($resVal['nombre_res'] == 1) {
        $reqUser = $bdd->prepare('SELECT email,password FROM user WHERE secret=?');
        $reqUser->execute(array($valeur_cookie));
        $res = $reqUser->fetch();
        $_SESSION['email'] = $res['email'];
        $_SESSION['connect'] = 1;
        
    }


}