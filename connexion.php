<?php
if (isset($_SESSION['connect'])) {
	?>
		<script>
		let connexion = document.getElementById('conn');
			connexion.addEventListener('click',closeModal);
			function closeModal() {
				alert('Vous êtes déja connecté !');
				
			}
					
		</script>
		<?php
		
	}

 
// $content = ob_get_clean();  The end of the html of the incription php file
 if (!empty($_POST['email_conn']) && !empty($_POST['password_conn'])) {
	 // IMPORT CONNECTION FILE FOR THE CONNECTION WITH DATA BASE
	 require('src/connection_bdd.php'); 
	//VERIF email_conn IS AN EMAIL
	$email_conn 	   = htmlspecialchars($_POST['email_conn']);
	$password_conn	   = htmlspecialchars($_POST['password_conn']);
	//HASH PASSWORD
	$password = "sas".sha1($password_conn."12")."22";

	if (!filter_var($email_conn,FILTER_VALIDATE_EMAIL)) {
		$error_conn_email = "vous devez saisir un email";
	} 
	// EMAIL EXIST IN DBB ?
	$req = $bdd->prepare('SELECT count(*) as x FROM user WHERE email = ?');
	$req->execute(array($email_conn));
	$res = $req->fetch();
	if ($res['x'] == 0 ) {
		$email_unknown =  "Votre email n'existe pas merci de vous <a id='lien_inscrire' data-toggle='modal' data-target='#inscription_form' href='#inscription_form'>inscire</a>" ;
	
	} else {
		$req = $bdd->prepare('SELECT password FROM user WHERE email = ?');
		$req->execute(array($email_conn));
		$res = $req->fetch();
		
		if ($res['password'] != $password) {
			$error_conn = "Votre password est erroné";
			 
		} else {
			$_SESSION['connect'] = 1;
			$_SESSION['email'] = $res['email'];
			
			?>	
			<!-- DISPLAY CONNEXION IN GREEN		-->
			
			<script>
					let connexion = document.getElementById('conn');
					connexion.className = "nav-link";
					connexion.style.color = "green";
			</script>
			<?php
			}
			//header('location: index.php?success=1');  I decided not use  redirection
			//exit();	
			
		}
	}



  	
// echo $content;	this was for the redirection to block HTML before my header function() 

?>

<?php  ob_start();  ?>
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
			<!-- AFFICHAGE DES MESSAGES D ERREURS PHP-->
			<div id="form">		
					<?php
					if (isset($error_conn_email)) {
						echo '<div class="text-warning">'.$error_conn_email.'</div>';
						?>
						<script>$('#connexion').modal('show')</script>
					<?php
					}
					/* if (isset($_GET['success'])) {
						echo '<div>Vous etes bien connecté</div>';
						
					} */
					if (isset($email_unknown)) {
						echo '<div class="text-warning">'.$email_unknown.'</div>';
						?>
						<script>
						$('#connexion').modal('show');
						var modal_conn = document.getElementById('lien_inscrire');
						modal_conn.addEventListener('click', ()=>{
							$('#connexion').modal('hide');
						})						
						</script>
					<?php
					}

					if (isset($error_conn)) {
						echo '<div class="text-warning">'.$error_conn.'</div>';
						?>
						<script>$('#connexion').modal('show')</script>
						<?php
					}
					

					if (!empty($fill_error) && !empty($_POST['hidden']) ) {
						echo '<div class="text-warning">'.$fill_missing.'</div>';
						?>
						<script>$('#connexion').modal('show')</script>
						<?php

					}

					?>
				
				<form id="connexion_form" name="connexion" method="post" action="">
					<small id="champs" ></small>
					<input id="email_conn" type="text" name="email_conn" placeholder="Votre adresse email"   />
                    <input id="password_conn" type="password" name="password_conn" placeholder="Mot de passe"  />
					<input type="hidden" name="hidden" value="true" />
					<div class="text-center">
						<button type="submit" class="m-3">Se connecter</button>
					</div>
					
				</form>
			
			</div>	
		</div>
</section>
<script type="text/javascript"  src="pharma.js"></script>
	
</body>
</html>
