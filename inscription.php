<?php

// IF WE ARE ALREADY CONNECTED THEN REDIRECT TO HOME PAGE
if (isset($_SESSION['connect'])) {
	?>
	<script>
	let inscription = document.getElementById('inscription');
		inscription.addEventListener('click',closeModal);
		function closeModal() {
			alert('Vous êtes déja inscit!!');
		}
	</script>
	<?php
	
}
// import file where we make verification of inscription form
include('inscr_php_verif.php');
?>

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
 
