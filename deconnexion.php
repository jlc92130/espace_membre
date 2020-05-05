<?php 
session_start(); // INITIALISE SESSION
session_unset(); // DESACTIVE SESSION   
session_destroy(); // DESTROY SESSION

header('location: ./');

?>
<script>
var connexion = document.getElementById('conn');
	connexion.className = "nav-link text-white";
	connexion.style.color = "green";
</script>
