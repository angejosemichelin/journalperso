<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>R</b>envoi du mail de validation de connexion";}elseif($langue=="en"){echo"<b>R</b>eturn the login validation email";}?></h1>
<div class="contenu-centre">
<?php 
// renvoi le mail de validation de compte
renvoi_mail_validation_compte($_SESSION['id']);
if($langue=="fr"){echo "Un mail vous a été renvoyé. Verifier vos spams.";}elseif($langue=="en"){echo"An email has been sent back to you. Verify your spams.";}
?>
</div>