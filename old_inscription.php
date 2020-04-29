<?php
	session_start();

	
	
	//ENVOI DU FORMULAIRE

	if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_two'])){
		// IMPORT CONNECTION FILE FOR THE CONNECTION WITH DATA BASE
		require('src/connection_bdd.php'); 
		$email 		  = htmlspecialchars($_POST['email']);
		$password     = htmlspecialchars($_POST['password']);
		$password_two = htmlspecialchars($_POST['password_two']);
		
		if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		//	header('location: inscription.php/?error=true&message=ceci n\'esttttttt pas une url.');
		//	exit();
		$error = "Ceci n'est pas une adresse email valide";
		
		?>
		
		<?php
		}
			
		//PASSWORD = PASSWORD_TWO ?
		else	if ($password_two == $password) {
				$success="true";
				$req = $bdd->prepare('SELECT COUNT(*) AS x FROM user WHERE email= ?');
				$req->execute(array($email));

				$res = $req->fetch();	
				if ($res['x'] !=0 ) {
		//			header('location: inscription.php?error=true&message=cet email existe déja');
		//			exit();	
					$error_password = "Vous avez déja un compte";
				} 
			//HASH PASSWORD
			$password = "sas".sha1($password."12")."22";
				
			// CODE EMAIL			
			$secret = sha1($email).time();
			// SEND IN DBB
			$req = $bdd->prepare("INSERT INTO user(email,password,secret) VALUES(?,?,?)");
			$req->execute(array($email,$password,$secret));
			
		//	header('location: inscription.php?success=1');
		//	exit();

			} else {
				$error = "Vos mots de passe doivent être identiques";
				
			}
	} else {
		$fill_missing = "Vous devez remplir tout les champs";
	} 
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pharma</title>
	<link rel="stylesheet" type="text/css" href="design/css/default.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
</head>
<body>

	<section>
		<div id="login-body">
			<div id="form">
				<?php
				if(isset($fill_missing)){
					echo '<div class="text-warning">'.$fill_missing.'</div>';
				
				}

				if (!empty($error)) {
					echo '<div class="text-warning">'.$error.'</div>';
			// TEST POUR GARDER LA MODAL 
			?>
		<script type="text/javascript">$('#inscription_form').modal('show')</script>
			<?php		}
				
				if (isset($success)) {
				?>
					<script type="text/javascript">
						inscription = document.getElementById('inscription');
						inscription.style.color = "green";
					</script>
		<?php	}
			//	if(isset($_GET['error'])){  
			//		if (isset($_GET['message'])) {
			//		echo '<div id="saisi_error" class="alert-danger">'.htmlspecialchars($_GET['message']).'</div>';
			//		} 

			//	} else if (isset($_GET['success'])) {
			//		echo '<div>vous etes inscrits </div>';
			//	}
	    ?>
				<form id="formulaire" method="post" action=""  name="form" >
					<small id="caractere" class="text-warning">Votre mot de passe doit faire plus de 6 caracteres</small>
					<small id="identique" class="text-warning">Vos mots de passe doivent être identiques</small>
					<table>
						<tr>
							<td>Email</td>
							<td><input type="text" id="email" name="email" placeholder="Votre adresse email" required   /></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" id="password"  name="password" placeholder="Mot de passe"  /></td>
						</tr>
						<tr>
							<td>Confirm your password</td>
							<td><input type="password" id="password_two"  name="password_two" placeholder="Retapez votre mot de passe" /></td>
						</tr>
					</table>
					<div id="button">
						<button type="submit">S'inscrire</button>
					</div>
					<p class="white">Déjà inscrit ? <a  href='#connexion' href="index.php">Connectez-vous</a>.</p>
				</form>

				 
			
			</div>	
		</div>
</section>
	
</body>
</html>
