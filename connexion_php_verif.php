<?php
//DATA VERIFICATION OF CONNEXION FORM
 
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
	
    } 
    else {
		$req = $bdd->prepare('SELECT password FROM user WHERE email = ?');
		$req->execute(array($email_conn));
		$res = $req->fetch();
		
		if ($res['password'] != $password) {
			$error_conn = "Votre password est erroné";
			 
        } 
        else {
            $reqSession = $bdd->prepare('SELECT * FROM user WHERE email = ?');
            $reqSession->execute(array($email_conn));
            $resSession = $reqSession->fetch();
            $_SESSION['connect'] = 1;
            $_SESSION['email'] = $resSession['email'];
            //CHECKBOX 
            if (!empty($_POST['souvenir'])) {
                setcookie('souvenir',$resSession['secret'],time()+365*24*3600,'/',null,false,true );
            }
			 			
		}
						
	}
}
    ?>