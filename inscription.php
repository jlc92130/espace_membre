<?php

// IF WE ARE ALREADY CONNECTED THEN REDIRECT TO HOME PAGE
if (isset($_SESSION['connect'])) {
	?>
	<script>
	let inscription = document.getElementById('inscription');
		inscription.addEventListener('click',closeModal);
		function closeModal() {
			alert('Vous êtes déja inscit!');
			 
		}
				
	</script>
	<?php
	
}
	 
	//ENVOI DU FORMULAIRE


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

?>

 <?php  ob_start();  // We have to use that function to "desactivate" the HTML before my header function in the connexion file to allowed the redirection ?>
	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pharma</title>
	<link rel="stylesheet" type="text/css" href="design/css/default.css">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
</head>
<body>

	<section>
		<div id="login-body">
			<div id="form">
			<?php

				if ((!empty($fill_missing)) && (!empty($_POST['inscription']))) {
			?>
					<script type="text/javascript">$('#inscription_form').modal('show')</script>
			<?php
					echo '<div class="text-warning">'.$fill_missing.'</div>';
				}			
				

				if (!empty($error)) {
					echo '<div class="text-warning">'.$error.'</div>';
				
			?>
				<script type="text/javascript">$('#inscription_form').modal('show')</script>
			<?php		
				}
								
				if (!empty($already_email)) {
			?>
				<div class="already_email">
			<?php
				echo '<div class="text-warning">'.$already_email.'</div>';
			?>
				</div>
				
				<script type="text/javascript">$('#inscription_form').modal('show')</script>
			<?php		
				}
			?>
				<form id="inscription_form" method="post" action=""  name="inscription" >
					<small id="champsVide" class='text-warning text-center'>Tout les champs dv etre remplis</small>
					<small id="email_er" class='text-warning text-center'>Vous dv saisir un email valide</small>
					<small id="identique" class="text-warning text-center">Vos mots de passe doivent être identiques et faire au moins 6 caracteres</small>
					<table>
						<tr>
							<td>Email</td>
							<td><input type="text" id="email" name="email" placeholder="Votre adresse email"      /></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" id="password"  name="password" placeholder="Mot de passe"   /></td>
						</tr>
						<tr>
							<td>Confirm your password</td>
							<td><input type="password" id="password_two"  name="password_two" placeholder="Retapez votre mot de passe"  /></td>
						</tr>
						<tr>
							<td><input type="hidden"  name="inscription" value= "false" /></td>
						</tr>

					</table>
					<div id="button">
						<button id="myBtn" type="submit">S'inscrire</button>
					</div>
					<p class="white">Déjà inscrit ? <a  href='#connexion'>Connectez-vous</a>.</p>
				</form>		 
			
			</div>	
		</div>
</section>
<script type="text/javascript"  src="pharma_insc.js"></script>
</body>
</html>
 
