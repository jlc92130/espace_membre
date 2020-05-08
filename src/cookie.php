<?php
if (isset($_COOKIE['souvenir'])) {
    require('src/connection_bdd.php'); 
    
    $valeur_cookie = htmlspecialchars($_COOKIE['souvenir']);
   
    $reqVal = $bdd->prepare('SELECT count(*) as nombre_res FROM user WHERE secret=?');
    $reqVal->execute(array($valeur_cookie));

    $resVal = $reqVal->fetch();
    echo $resVal['nombre_res'];
    if ($resVal['nombre_res'] == 1) {
        $reqUser = $bdd->prepare('SELECT email,password FROM user WHERE secret=?');
        $reqUser->execute(array($valeur_cookie));
        $res = $reqUser->fetch();
        $_SESSION['email'] = $res['email'];
        $_SESSION['connect'] = 1;
        
    }


}