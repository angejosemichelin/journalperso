<?php
$langue = langue();
?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>V</b>alidation connexion";}elseif($langue=="en"){echo"<b>S</b>ign in validation";} ?></h1>
<?php
// verification des information, enregistrement dans la session des infos utilisateurs et redirection vers les publications
if(isset($_POST['mdp']) && isset($_POST['email'])){
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    connexion_user($email, $mdp);
} else {
    // sinon on detruit la session et on affiche un message d'erreur
    session_destroy();
    ?>
    <p><?php if($langue=="fr"){echo "Erreur connexion.";}elseif($langue=="en"){echo"Connection error.";} ?></p>
    <?php
}
?>
<br>
<center><img class="hvr-grow" style="display:block;margin:0 auto;" src="ressources/img/bouton-aide.png" alt="Créez votre premier journal" /></center>