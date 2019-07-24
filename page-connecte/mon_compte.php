<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>V</b>os informations";}elseif($langue=="en"){echo"<b>Y</b>our infos";} ?></h1>
<div class="contenu-centre">
<form action="moncompte.html" method="post">
    <?php
        if($langue=="fr"){  
            input("text", "Nom et prénom:", "nom_prenom", "nom_prenom", "Nom et prénom", true, affiche_nom_prenom($_SESSION["id"]));
            input("password", "Nouveau mot de passe:", "password", "password", "Nouveau mot de passe", false, "");
            input("password", "Répeter nouveau mot de passe:", "repeat_password", "repeat_password", "Répeter nouveau mot de passe", false, "");
            input("text", "Email Paypal de paiement:", "email_paypal", "email_paypal", "Email Paypal de paiement", true, affiche_paypal($_SESSION["id"]));
        }elseif($langue=="en"){
            input("text", "Last name and first name:", "nom_prenom", "nom_prenom", "Last name and first name", true, affiche_nom_prenom($_SESSION["id"]));
            input("password", "New Password:", "password", "password", "New Password", false, "");
            input("password", "Repeat new password:", "repeat_password", "repeat_password", "Repeat new password", false, "");
            input("text", "Paypal email payment:", "email_paypal", "email_paypal", "Paypal email payment", true, affiche_paypal($_SESSION["id"]));
        }
    ?>
    <input type="hidden" name="modifier" value="modifier">
    <center><button type="submit" class="hvr-float-shadow centrer btn btn-primary"><?php if($langue=="fr"){echo "Changer";}elseif($langue=="en"){echo"Change";} ?></button></center>
</form>
<?php
// Si des modifs ont été faites on update dans la bdd
if(isset($_POST["modifier"])){
    $nom_prenom = filter_input(INPUT_POST, 'nom_prenom', FILTER_SANITIZE_STRING);
    $email_paypal = filter_input(INPUT_POST, 'email_paypal', FILTER_SANITIZE_STRING);
    if((!empty($_POST["password"]) && !empty($_POST["repeat_password"])) && ($_POST["repeat_password"] == $_POST["password"])){
        $mdp = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $hashed_password = crypt($mdp, '');
        $valeurs = [
            'nom_prenom' => $nom_prenom,
            'email_paypal' => $email_paypal,
            'mdp' => $hashed_password,
            'id_user' => $_SESSION["id"]
        ];
        update_bdd("UPDATE users SET nom_prenom = :nom_prenom, paypal = :email_paypal, mdp = :mdp WHERE id = :id_user", $valeurs);
        notifier($_SESSION['id'], date("Y-m-d"), "Les infos de votre compte ont été modifié");
        if($langue=="fr"){echo "Modifié!";}elseif($langue=="en"){echo"Edited!";}
    } else {
        $valeurs = [
            'nom_prenom' => $nom_prenom,
            'email_paypal' => $email_paypal,
            'id_user' => $_SESSION["id"]
        ];
        update_bdd("UPDATE users SET nom_prenom = :nom_prenom, paypal = :email_paypal WHERE id = :id_user", $valeurs);
        notifier($_SESSION['id'], date("Y-m-d"), "Les infos de votre compte ont été modifié");
        if($langue=="fr"){echo "Modifié!";}elseif($langue=="en"){echo"Edited!";}
    }
}
?>
</div>