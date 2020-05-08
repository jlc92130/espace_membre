<?php

if (isset($_SESSION['connect'])) {
	?>
		<script>
		function modalFerm() {
				alert('Vous êtes déja connecté !');

			}		
		let connexion = document.getElementById('conn');
			connexion.addEventListener('click',modalFerm);
		</script>
	
	<?php
	
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
