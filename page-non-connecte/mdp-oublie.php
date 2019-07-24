<?php 
$langue = langue();
if(isset($_POST["email"])){
    $email_new = $_POST["email"];
?>
<div class="changer_mdp">
    <h1 class="h1"><?php if($langue=="fr"){echo "<b>C</b>hanger de mot de passe";}elseif($langue=="en"){echo"<b>C</b>hange password";} ?></h1>
    <div class="contenu-centre">
    <form action="motdepasse-oublie.html" method="post">
        <?php
        if($langue=="fr"){  
            input("password", "Nouveau mot de passe:", "mdp_oublie1", "password", "Nouveau mot de passe", true, "");
            input("password", "Répéter nouveau mot de passe:", "mdp_oublie2", "repeat_password", "Répéter nouveau mot de passe", true, "");
        }elseif($langue=="en"){
            input("password", "New Password:", "mdp_oublie1", "password", "New Password", true, "");
            input("password", "Repeat new password:", "mdp_oublie2", "repeat_password", "Repeat new password", true, "");
        }
        ?>
        <input type="hidden" name="email_new" value="<?php echo $email_new; ?>">
        <center><button type="submit" class="hvr-float-shadow centrer btn btn-primary"><?php if($langue=="fr"){echo "Valider";}elseif($langue=="en"){echo"Validate";} ?></button></center>
    </form>
    </div>
</div>
<?php
} elseif(isset($_POST["password"])){
    $mdp = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $mdp_repeat = filter_input(INPUT_POST, 'repeat_password', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email_new', FILTER_SANITIZE_STRING);
    
    if($mdp_repeat == $mdp){
            if(utilisateur_existe($email) > 0){
                $hashed_password2 = crypt($mdp, '');
                $valeurs = [
                    "mdp" => $hashed_password2,
                    "email" => $email
                ];
                update_bdd("UPDATE users SET mdp = :mdp WHERE email = :email", $valeurs);
                ?>
                    <p style="text-align:center;"><?php if($langue=="fr"){echo "Mot de passe changé.";}elseif($langue=="en"){echo"Password change.";} ?><br/><a href="/"><?php if($langue=="fr"){echo "<< Retour <<";}elseif($langue=="en"){echo"<< Back <<";} ?></a></p>
                    <br/><br/>
                <?php
            } else {
                ?>
                    <p style="text-align:center;"><?php if($langue=="fr"){echo "Cet utilisateur n'existe pas.";}elseif($langue=="en"){echo"This user does not exist.";} ?></p>
                <?php
            }
    } else {
        ?>
        <p style="text-align:center;"><?php if($langue=="fr"){echo "Les mots de passe ne sont pas identiques.";}elseif($langue=="en"){echo"Passwords are not the same.";} ?></p>
    <?php
        }
} else {
?>
<div class="changer_mdp">
    <h1 class="h1"><?php if($langue=="fr"){echo "<b>C</b>hanger de mot de passe";}elseif($langue=="en"){echo"<b>C</b>hange password";} ?></h1>
    <div class="contenu-centre">
    <form action="motdepasse-oublie.html" method="post">
        <?php
            if($langue=="fr"){
                input("email", "Adresse e-mail:", "email_connexion", "email", "Entrez votre adresse e-mail", true, "");
            }elseif($langue=="en"){
                input("email", "E-mail adress:", "email_connexion", "email", "Enter your e-mail adress", true, "");
            }
        ?>
        <center><button type="submit" class="hvr-float-shadow centrer btn btn-primary"><?php if($langue=="fr"){echo "Continuer";}elseif($langue=="en"){echo"Continue";} ?></button></center>
    </form>
    </div>
</div>
<?php
}
?>


