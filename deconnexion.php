<?php 
session_start(); // INITIALISE SESSION
session_unset(); // DESACTIVE SESSION   
session_destroy(); // DESTROY SESSION

header('location: ./');
exit();
