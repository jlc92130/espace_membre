<?php
if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_two'])){
		// IMPORT CONNECTION FILE FOR THE CONNECTION WITH DATA BASE
		require('src/connection_bdd.php');
		$email 		  = htmlspecialchars($_POST['email']);
		$password     = htmlspecialchars($_POST['password']);
		$password_two = htmlspecialchars($_POST['password_two']);
		 
		
		if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$error = "Ceci n'est pas une adresse email valide";
		} 
		else if ($password_two == $password) {
			$req = $bdd->prepare('SELECT count(*) AS x FROM user WHERE email= ?');
				$req->execute(array($email));

				$res = $req->fetch();	
				if ($res['x'] !=0 ) {
					$already_email = "Vous avez déja un compte";
					
				} else {
					//HASH PASSWORD
					$password = "sas".sha1($password."12")."22";
									
					// CODE EMAIL			
					$secret = sha1($email).time();
					// SEND IN DBB
					$req = $bdd->prepare("INSERT INTO user(email,password,secret) VALUES(?,?,?)");
					$req->execute(array($email,$password,$secret));
					 
				}
		}	
		else {
				$error = "Vos mots de passe doivent être identiques";
			}
}
	else { 
		$fill_missing = "Vous devez remplir tout les champs";
		}
