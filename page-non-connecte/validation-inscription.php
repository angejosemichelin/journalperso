<?php
$langue = langue();
?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>V</b>alidation inscription";}elseif($langue=="en"){echo"<b>S</b>ign up validation";} ?></h1>
<div class="contenu-centre">
<?php
    $googleResponse = false;
	// Ma clé privée
	$secret = "6LcSRXEUAAAAAL1y9QFv4bqETSJrkOuOy22aFRZ2";
	// Paramètre renvoyé par le recaptcha
	$response = $_POST['g-recaptcha-response'];
	// On récupère l'IP de l'utilisateur
	$remoteip = $_SERVER['REMOTE_ADDR'];
	$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$remoteip;
	$decode = json_decode(file_get_contents($api_url), true);
	if ($decode['success'] == true) {
        $googleResponse = true;
    }else {
        $googleResponse = false;
	}


// si les infos entrer dans le formulaire sont correctes
if (($googleResponse == true) && isset($_POST['mdp']) && isset($_POST['email']) && strlen($_POST['mdp']) > 5 && strlen($_POST['nom_prenom']) < 30 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
// on recupere les infos du formulaire
$mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$nom_prenom = filter_input(INPUT_POST, 'nom_prenom', FILTER_SANITIZE_STRING);
$parrain = isset($_POST["parrain"]) ? $_POST["parrain"] : 0;
$hashed_password = crypt($mdp, '');
// on verifier si l'utilisateur est deja inscrit
$nombre_user = utilisateur_existe($email);

if($nombre_user > 0){
?>
    <p><?php if($langue=="fr"){echo "Cet utilisateur est déja inscrit.";}elseif($langue=="en"){echo"This user is already registered.";} ?></p>
	<br><a href="https://journalperso.fr/connexion.html" alt="Créez votre premier journal"><img style="display:block;margin:0 auto;" src="ressources/img/bouton-aide.png" alt="Créez votre premier journal" /></a>
<?php
} else {
    //sinon inscirption
    inscription($email, $hashed_password, $nom_prenom, $mdp, $parrain);
?>
	<center><p><?php if($langue=="fr"){echo "Vous etes inscrit. <strong>Un mail vous à été envoyé.</strong> Veuillez cliquer sur le lien dans cet email pour activé votre compte. Verifiez dans vos spams. Vous pouvez vous connecter en attendant en cliquant sur Connexion.";}elseif($langue=="en"){echo"You are registered. <strong>An email has been sent to you.</strong> Please click on the link in this email to activate your account. Check in your spam. You can log in while waiting by clicking Login.";} ?><br><a href="/"><?php if($langue=="fr"){echo "<< Retour <<";}elseif($langue=="en"){echo"<< Back <<";} ?></a></p></center>
	<br><center><a href="https://journalperso.fr/connexion.html" alt="Créez votre premier journal"><img style="display:block;margin:0 auto;" class="hvr-grow" src="ressources/img/bouton-aide.png" alt="Créez votre premier journal" /></a></center>
<?php    
}  
}
else {
// si le formulaire est mal rempli on affiche une erreur
    ?>
	<br><p><?php if($langue=="fr"){echo "Erreur dans le formulaire.";}elseif($langue=="en"){echo"Error in the form.";} ?></p> 
    <?php
}
?>
</div>