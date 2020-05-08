<?php 
session_start(); // INITIALISE SESSION
session_unset(); // DESACTIVE SESSION   
session_destroy(); // DESTROY SESSION
setcookie('souvenir','',time()-1,'/',null,false,true);

header('location: ./');
exit();
