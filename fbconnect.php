<?php 
    $langue = langue();
    $parrain = isset($_COOKIE["parrain"]) ? $_COOKIE["parrain"] : 0;

    if(!empty($_GET["nom"]) && !empty($_GET["prenom"]) && !empty($_GET["email"])){
        $nom = filter_input(INPUT_GET, 'nom', FILTER_SANITIZE_STRING);
        $prenom = filter_input(INPUT_GET, 'prenom', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING);

        $requete = "SELECT id, email, mdp, nom_prenom, COUNT(*) as deja_inscrit FROM `users` WHERE email = '$email'";
        $reponse = select_bdd($requete);

        $nomprenom = $nom." ".$prenom;

        while ($rep = $reponse->fetch()){
            if($rep["deja_inscrit"] == 0){

                $hashed_password = crypt("1234", '');

                inscription($email, $hashed_password, $nomprenom, "1234", $parrain);

                $_SESSION['id'] = id_email($email);
                $_SESSION['email'] = $email;
                $_SESSION['mdp'] = "1234";
                $_SESSION['nom_prenom'] = $nomprenom;

                if($langue=="fr"){
                ?>
                    <center>
                        <p>Votre mot de passe est <b>1234</b> par defaut pour les comptes enregistrés via Facebook vous pouvez le modifier dans la rubrique "Mon compte".<br>
                        Merci de valider votre compte par email qui vous a été envoyé.</p>
                        <p>Vous allez etre rediriger vers votre compte.</p>
                        <meta http-equiv="refresh" content="7; URL=accueil-membre.html">
                    </center>
                    <?php
                }elseif($langue=="en"){
                    ?>
                    <center>
                        <p>Your password is <b>1234</b> by default for accounts registered through Facebook you can modifiate your password in "My account".<br>
                        Thanks validate your account by email sended to you.</p>
                        <p>You will be redirected to your account.</p>
                        <meta http-equiv="refresh" content="2; URL=home-member.html">
                    </center>
                    <?php
                }
                }elseif ($rep["deja_inscrit"] > 0){
                $_SESSION['id'] = $rep["id"];
                $_SESSION['email'] = $rep["email"];
                $_SESSION['mdp'] = $rep["mdp"];
                $_SESSION['nom_prenom'] = $rep["nom_prenom"]; 
                if($langue=="fr"){
                    ?>
                        <center>
                            <p>Vous allez etre rediriger vers votre compte.</p>
                            <meta http-equiv="refresh" content="2; URL=accueil-membre.html">
                        </center>
                    <?php
                }elseif($langue=="en"){
                    ?>
                    <center>
                        <p>You will be redirected to your account.</p>
                        <meta http-equiv="refresh" content="2; URL=accueil-membre.html">
                    </center>
                    <?php
                } 
                ?>
                <?php
            }
        }
    }
?>