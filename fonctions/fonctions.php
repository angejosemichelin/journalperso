<?php
/* VARIABLES */
const MDP_ADMIN = "aeromode758";
const HEADERS  = "From: \"Journalperso.fr\"<webmaster@journalperso.fr>"."\r\n".'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=UTF-8' . "\r\n";

// retourne la langue en fonction du cookie langue
function langue(){
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if($lang == 'fr'){
        if($_COOKIE["langue"] == "fr"){
            return "fr";
        } elseif($_COOKIE["langue"] == "en"){
            return "en";
        } else {
            return "fr";
        } 
    }elseif($lang == 'en'){
        if($_COOKIE["langue"] == "fr"){
            return "fr";
        } elseif($_COOKIE["langue"] == "en"){
            return "en";
        } else {
            return "en";
        } 
    }
}

//Includes
include("autres.php");
include("bdd.php");
include("contenu.php");
include("page.php");


// converti les vues en euros
function nombre_filleul($id_user){

    $nombreFilleul = 0;
    $requete = "SELECT COUNT(*) as nombre_filleul, id FROM `users` WHERE parrain = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $nombreFilleul += $rep["nombre_filleul"];
        $idFilleul1 = $rep["id"];
        if($idFilleul1 != 0 || $idFilleul1 != null || $idFilleul1 != ""){
            $requete = "SELECT COUNT(*) as nombre_filleul2 FROM `users` WHERE parrain = '$idFilleul1'";
            $reponse = select_bdd($requete);
            while ($rep = $reponse->fetch()){
                $nombreFilleul += $rep["nombre_filleul2"];
            }
            $reponse->closeCursor();
        }
    }
    $reponse->closeCursor();
    return $nombreFilleul;
}

// affiche le solde
function affiche_solde($id_user){
        $solde = 0;
        //on recupere le total des paiements de l'utilisateurs
        $requete = "SELECT montant FROM `paiements` WHERE id_user = '$id_user'";
        $reponse = select_bdd($requete);
        while ($rep = $reponse->fetch()){
            $solde += $rep["montant"];
        }
        return $solde;
        $reponse->closeCursor();
}

// affiche le nom et le prenom
function affiche_nom_prenom($id_user){
    //on recupere le nom prenom de l'utilisateur
    $requete = "SELECT nom_prenom FROM `users` WHERE id = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["nom_prenom"];
    }
    $reponse->closeCursor();
}

// affiche l email paypal
function affiche_paypal($id_user){
    //on recupere le nom prenom de l'utilisateur
    $requete = "SELECT paypal FROM `users` WHERE id = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["paypal"];
    }
    $reponse->closeCursor();
}

//recupere le chiffre pour valider le compte
function chiffre_compte_valide($email){
    $requete = "SELECT * FROM `users` WHERE email ='$email'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["compte_valide"];
    }
    $reponse->closeCursor();
}

//valide le compte
function valide_compte($email){
    $valeurs = [
        'compte_valide' => 1,
        'email' => $email
    ];
    update_bdd("UPDATE users SET compte_valide = :compte_valide WHERE email = :email", $valeurs);
}

// Envoyer mail grouper
function envoi_mail_groupe(){
    $requete = "SELECT * FROM `users`";
    $reponse = select_bdd($requete);
    $i=0;
    while ($rep = $reponse->fetch()){

        $nom_prenom = $rep["nom_prenom"];
        $email = $rep["email"];
        $id = $rep["id"];

        //preparation de l'email
        $message = '
        <html>
        <head>
            <style type="text/css">
                #content {
                    width: 55%;
                    margin:10px auto;
                    background-color:white;
                    padding: 10px;
                    -webkit-border-radius: 10px;
                    -moz-border-radius: 10px;
                    border-radius: 10px;
                }
                @media screen and (max-width: 600px){
                    body,html {
                        font-size: 0.8em;
                    }
                    #content {
                        width: 90%;
                        margin: 0 auto;
                        display:block;
                    }
                    #image {
                        width: 90%;
                        margin: 0 auto;
                        display:block;
                    }
                }
            </style>
        </head>
        <body style="display:block;padding:10px;width:100%;height:100%;font-family: Arial, Helvetica, sans-serif;background-color: #c252e7;">
            <div id="content">
                <center><a href="https://www.journalperso.fr"><img id="image" src="https://journalperso.fr/ressources/img/logo-journalperso.png" alt="Logo du site de journalisme Journalperso.fr pour les emails."/></a></center>
                <center><h1>Bienvenue sur Journalperso.fr</center></h1><br/>
                <div style="width: 95%;margin:0 auto;">
                    <p style="color:red;">Veuillez confirmer que cet mail n est pas un SPAM, mettez le en marque blanche au cas ou il arrive en SPAM. Merci.</p>
                    <hr>
                    Bonjour, <b>'.$nom_prenom.'</b>, vous faites parti des premiers inscrits, profitez-en !<br/>
                    Votre identifiant: <b>'.$email.'</b><br/>
                    <hr>
                    <center>
                        Vous faites partie des premiers inscrits, profitez-en !<br>
                        Venez participez sur le site Journalperso.fr et gagnez de l argent.<br>
                        Venez travailler et créer des journaux qui seront disponible sur notre site et sur Google.<br>
                        Plus vous poster de contenu et de journaux plus le site sera connu et vous engrengez du profit.<br>
                        <b style="text-align:center;color:#c252e7">Venez poster du contenu de qualité pour nous aider à démarrer notre site !</b>
                    </center>
                    <hr>
                    <a href="https://journalperso.fr/connexion.html" alt="Créez votre premier journal"><img style="display:block;margin:0 auto;" src="https://www.journalperso.fr/ressources/img/bouton-aide.png" alt="Créez votre premier journal" /></a>
                </div>
                <center>
                <p>Ajouter le site à vos favoris sur votre mobile, tablette et ordinateur pour une utilisation optimale.</p>
                <a href="https://www.journalperso.fr">https://www.journalperso.fr</a>
                </center>
            </div>
        </body>
    </html>
        ';
        //envoi de l'email
        mail($email, "Devenez journaliste, travaillez sur Journalperso.fr", $message, HEADERS); 
        echo "Email envoyer à : $email<br>";
        $i++;
    }
    echo "Nombre de mails envoyés: ".$i;
    $reponse->closeCursor();
}

function publier_texte($texte, $id_journal){
    $langue = langue();
    $date = date("Y-m-d H:i:s");
    $valeurs = [
        "id" => null,
        "id_journal" => $id_journal,
        "types" => 'texte',
        "texte" => $texte,
        "url_upload" => "",
        "date_post" => $date
    ];
    insert_bdd("publications", $valeurs);
    if($langue=="fr"){echo "Texte publié.";}elseif($langue=="en"){echo"Published text.";}
}

//publier une image
function publier_image($path, $description, $id_journal){
    $date = date("Y-m-d H:i:s");
    $valeurs = [
        "id" => null,
        "id_journal" => $id_journal,
        "types" => 'image',
        "texte" => "",
        "url_upload" => $path,
        "date_post" => $date,
        "description_img" => $description
    ];
    insert_bdd("publications", $valeurs);
}

//publier une video
function publier_video($path, $id_journal){
    $date = date("Y-m-d H:i:s");
    $valeurs = [
        "id" => null,
        "id_journal" => $id_journal,
        "types" => 'video',
        "texte" => "",
        "url_upload" => $path,
        "date_post" => $date
    ];
    insert_bdd("publications", $valeurs); 
}

//publier un fichier
function publier_fichier($path, $description, $id_journal){
    $date = date("Y-m-d H:i:s");
    $valeurs = [
        "id" => null,
        "id_journal" => $id_journal,
        "types" => 'fichier',
        "texte" => "",
        "url_upload" => $path,
        "date_post" => $date,
        "description_img" => $description
    ];
    insert_bdd("publications", $valeurs);
}

// Déconnexion
function deconnexion(){
    // On détruit la session et on redirige vers l'accueil du site
    $_SESSION = array();
    session_destroy();
    UNSET($_SESSION['id']);
    UNSET($_SESSION['email']);
    setcookie(session_name(), 0, time(), '/');
    header('Location: https://www.journalperso.fr/accueil.html');
}

//On verifie si le compte est valide
function compte_valider($id){
    $requete = "SELECT * FROM `users` WHERE id ='$id'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["compte_valide"];
    }
}

//Id en fonctionde l'email
function id_email($email){
    $requete = "SELECT id FROM `users` WHERE email ='$email'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["id"];
    }
}

// Connexion au site par un utilisateur
function connexion_user($email, $mdp){
    $langue = langue();
    $requete = "SELECT * FROM `users` WHERE email = '$email'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
            if (hash_equals($rep["mdp"], crypt($mdp, $rep["mdp"]))) {
                $_SESSION['id'] = $rep["id"];
                $_SESSION['email'] = $rep["email"];
                $_SESSION['mdp'] = $rep["mdp"];
                $_SESSION['nom_prenom'] = $rep["nom_prenom"];
                if($rep["compte_valide"] == 1){
                    ?>
                    <center><a href="accueil-membre.html"><?php if($langue=="fr"){echo "Vous aller etre redirigé. Sinon cliquez ici.";}elseif($langue=="en"){echo"You will be redirected. Otherwise click here.";} ?></a></center>
                    <meta http-equiv="refresh" content="2; URL=accueil-membre.html">
                <?php
                } else {
                    if($langue=="fr"){echo "<center>Veuillez valider votre compte. Un mail vous à été envoyé. Mais vous pouvez vous connecter.</center>";}elseif($langue=="en"){echo"<center>Please validate your account. An email has been sent to you. But you can connect.</center>";}
                    ?>
                        <center><a href="accueil-membre.html"><?php if($langue=="fr"){echo "Vous aller etre redirigé. Sinon cliquez ici.";}elseif($langue=="en"){echo"You will be redirected. Otherwise click here.";} ?></a></center>
                        <meta http-equiv="refresh" content="2; URL=accueil-membre.html">
                    <?php
                }
            } else {
                if($langue=="fr"){
                    exit("Mot de passe incorrect.");
                }elseif($langue=="en"){
                    exit("Incorrect password.");
                }
            }
        }
    $reponse->closeCursor();
}



// Affiche le nom et le prenom de l'utilisateur
function nom_prenom_de($id_user){
    $requete = "SELECT nom_prenom FROM `users` WHERE id ='$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
       return $rep["nom_prenom"];
    }
    $reponse->closeCursor();
}

// Affiche le nom et le prenom de l'utilisateur dans sa page dedié
function journal_perso_de($id_user){
    $langue = langue();
    $requete = "SELECT nom_prenom FROM `users` WHERE id ='$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        echo $rep["nom_prenom"];
    }
    $reponse->closeCursor();
}

// Affiche les publication de l'utilisateur dans sa page dédié
function afficher_publications_compte($id_journal){
    $messagesParPage=10; //Nous allons afficher 5 messages par page.
    //Une connexion SQL doit être ouverte avant cette ligne... 
    $select_nbr_publications = "SELECT COUNT(*) AS nbr_publications FROM `publications` WHERE id_journal = '$id_journal'";
    $select_nbr_publications2 = select_bdd($select_nbr_publications);
    $donnees_total = $select_nbr_publications2->fetch(); //On range retour sous la forme d'un tableau.
    $total = $donnees_total['nbr_publications']; //On récupère le total pour le placer dans la variable $total.
    //Nous allons maintenant compter le nombre de pages.
    $nombreDePages=ceil($total/$messagesParPage);

    if(isset($_GET['numero-page'])) // Si la variable $_GET['page'] existe...
    {
         $pageActuelle=intval($_GET['numero-page']);
     
         if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
         {
              $pageActuelle=$nombreDePages;
         }
    }
    else // Sinon
    {
         $pageActuelle=1; // La page actuelle est la n°1    
    }
    $premiereEntree=($pageActuelle-1)*$messagesParPage; // On calcul la première entrée à lire

    $select_publications = "SELECT id, texte, date_post, types, url_upload, description_img FROM `publications` WHERE id_journal = '$id_journal' ORDER BY id DESC LIMIT $premiereEntree, $messagesParPage";
    $select_publications2 = select_bdd($select_publications);
    while($donnees_messages = $select_publications2->fetch()) // On lit les entrées une à une grâce à une boucle
    {
        $date_post = $donnees_messages['date_post'];
        $texte = $donnees_messages['texte'];
        $url_upload = $donnees_messages['url_upload'];
        $description_img = $donnees_messages['description_img'];
        $id_message = $donnees_messages['id'];

        if($donnees_messages["types"] == "texte"){
            ?> 
            <div style="position:relative;" class="card publication">
                <a href="supprimer-publication-<?php echo $id_journal; ?>-<?php echo $id_message; ?>.html" alt="Supprimer"><img style="position:absolute;top:0;right:5px;" src="ressources/img/supprimer.png" alt="Supprimer" /></a>
                <div class="card-header">
                    <?php echo "$date_post" ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $texte; ?></p>
                </div>
            </div>
            <?php
        }elseif($donnees_messages["types"] == "image"){
            ?>
            <div style="position:relative;text-align:center;" class="card publication">
                <a href="supprimer-publication-<?php echo $id_journal; ?>-<?php echo $id_message; ?>.html" alt="Supprimer"><img style="position:absolute;top:0;right:5px;" src="ressources/img/supprimer.png" alt="Supprimer" /></a>
                <div class="card-header">
                <?php echo "$date_post" ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                    <img class='image_publication_simple' src='<?php echo $url_upload; ?>' alt='Site de journalisme journalperso.fr - Image de <?php echo $description_img; ?>' />
                    </p>
                </div>
            </div>
            <?php
        }elseif($donnees_messages["types"] == "video"){
            ?>
            <div style="position:relative;text-align:center;" class="card publication">
                <a href="supprimer-publication-<?php echo $id_journal; ?>-<?php echo $id_message; ?>.html" alt="Supprimer"><img style="position:absolute;top:0;right:5px;" src="ressources/img/supprimer.png" alt="Supprimer" /></a>
                <div class="card-header">
                    <?php echo "$date_post" ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <video width="320" height="240" controls>
                        <source src="<?php echo $url_upload; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                        </video>
                    </p>
                </div>
            </div>
            <?php
        }elseif($donnees_messages["types"] == "fichier"){
            ?>
            <div style="position:relative;text-align:center;" class="card publication">
                <a href="supprimer-publication-<?php echo $id_journal; ?>-<?php echo $id_message; ?>.html" alt="Supprimer"><img style="position:absolute;top:0;right:5px;" src="ressources/img/supprimer.png" alt="Supprimer" /></a>
                <div class="card-header">
                    <?php echo "$date_post" ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                    <a href="<?php echo $url_upload; ?>" alt="Site de journalisme journalperso.fr - Image de <?php echo $description_img; ?>">Télécharger => <?php echo $description_img; ?></a>
                    </p>
                </div>
            </div>
            <?php
        }
    }

    pagination($nombreDePages, $pageActuelle, "modifier-journal-".$id_journal, "");
    $select_nbr_publications2->closeCursor();
    $select_publications2->closeCursor(); 
}  

// Supprimer une publications
function supprimmer_publication($id_message){
    $langue = langue();
    // On supprime les images dans le serveur au cas ou si c'est une images
    $requete = "SELECT types, url_upload FROM `publications` WHERE id = '$id_message'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        if ($rep["types"] == "image"){
            unlink($rep["url_upload"]);
        }
    }
    delete_bdd("publications", $id_message);
    if($langue=="fr"){
        echo "Publication supprimée.";
    }elseif($langue=="en"){
        echo "Publication deleted.";
    }
    
}

// affiche les commentaire en fonction de l'id de la publication
function afficher_commentaire($id){
    // on recherche les infos des commentaires en fonction le d'id de la publication
    $requete = "SELECT texte, nom_prenom, date_com FROM `commentaire` WHERE id_publication ='$id' ORDER BY id DESC";
    $reponse = select_bdd($requete);
    $i = 0;
    while ($rep = $reponse->fetch()){
        $nom_prenom = $rep['nom_prenom'];
        $texte = $rep['texte'];
        $date = $rep['date_com'];
        ?>
        <p style="font-size:0.9em;"><?php echo $date ?> - <b><?php echo $nom_prenom; ?></b> - <?php echo $texte; ?></p>
        <?php
    }
}

//Affiche les publications du compte
function afficher_publications_simple($id_journal){
    // on affiche les infos des publications en fonction de l'id du journal
    $requete = "SELECT texte, date_post, id, types, url_upload, description_img FROM `publications` WHERE id_journal ='$id_journal' ORDER BY id DESC";
    $reponse = select_bdd($requete);
    $i = 0;
    while ($rep = $reponse->fetch()){
        $id = $rep['id'];
        $date_post = $rep['date_post'];
        $texte = $rep['texte'];
        $url_upload = $rep['url_upload'];
        $description_img = $rep['description_img'];
        $i++;
        // on recherche les nombre de commentaire lié a la publication
        $requete2 = "SELECT COUNT(*) as nbr_com FROM `commentaire` WHERE id_publication ='$id'";
        $reponse2 = select_bdd($requete2);
        while ($rep2 = $reponse2->fetch()){
            $nbr_com = $rep2["nbr_com"];
        }
        // on regarde le type de publications texte, image ou autres
        if($rep["types"] == "texte"){
            ?>
            <div class="card publication">
                <div class="card-header">
                    <?php echo "$date_post" ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <?php echo $texte; ?>
                    </p>
                </div>
            </div>
            <center style="margin-bottom:10px"><a data-toggle="collapse" href="#collapseExample<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $i; ?>" style="font-size:0.8em;" type="button" class="btn btn-primary" href="#" alt="Commentaires publications - Journalperso.fr - Journalisme">Voir les commentaires(<?php echo $nbr_com ?>)</a>  <a href="#" onClick="envoi_data('<?php echo $id; ?>');" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="font-size:0.8em;">Ecrire un commentaire</a></center> 
            <div class="collapse" style="margin:10px;" id="collapseExample<?php echo $i; ?>">
                <div class="card card-body">
                    <?php afficher_commentaire($id); ?>
                </div>
            </div>
            <?php
        } elseif($rep["types"] == "image"){
            ?>
            <div style='text-align:center;' class="card publication">
                <div class="card-header">
                    <?php echo "$date_post" ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <img class='image_publication_simple' src='<?php echo $url_upload; ?>' alt='<?php echo $description_img; ?>' />
                    </p>
                </div>
            </div>
            <center style="margin-bottom:10px"><a data-toggle="collapse" href="#collapseExample<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $i; ?>" style="font-size:0.8em;" type="button" class="btn btn-primary" href="#" alt="Commentaires publications - Journalperso.fr - Journalisme">Voir les commentaires(<?php echo $nbr_com ?>)</a>  <a href="#" onClick="envoi_data('<?php echo $id; ?>');" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="font-size:0.8em;">Ecrire un commentaire</a></center>                 
            <div class="collapse" style="margin:10px;" id="collapseExample<?php echo $i; ?>">
                <div class="card card-body">
                    <?php afficher_commentaire($id); ?>
                </div>
            </div>
            <?php
        }elseif($rep["types"] == "video"){
            ?>
            <div style='text-align:center;position:relative;text-align:center;' class="card publication">
                <div class="card-header">
                    <?php echo "$date_post" ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <video width="320" height="240" controls>
                        <source src="<?php echo $url_upload; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                        </video>
                    </p>
                </div>
            </div>
            <center style="margin-bottom:10px"><a data-toggle="collapse" href="#collapseExample<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $i; ?>" style="font-size:0.8em;" type="button" class="btn btn-primary" href="#" alt="Commentaires publications - Journalperso.fr - Journalisme">Voir les commentaires(<?php echo $nbr_com ?>)</a>  <a href="#" onClick="envoi_data('<?php echo $id; ?>');" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="font-size:0.8em;">Ecrire un commentaire</a></center>                
            <div class="collapse" style="margin:10px;" id="collapseExample<?php echo $i; ?>">  
                <div class="card card-body">
                    <?php afficher_commentaire($id); ?>
                </div>
            </div>
            <?php
        }elseif($rep["types"] == "fichier"){
            ?>
            <div style='text-align:center;position:relative;text-align:center;' class="card publication">
                <div class="card-header">
                    <?php echo "$date_post" ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                    <a href="<?php echo $url_upload; ?>" alt="<?php echo $description_img; ?>">Télécharger => <?php echo $description_img; ?></a>
                    </p>
                </div>
            </div>
            <center style="margin-bottom:10px"><a data-toggle="collapse" href="#collapseExample<?php echo $i; ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $i; ?>" style="font-size:0.8em;" type="button" class="btn btn-primary" href="#" alt="Commentaires publications - Journalperso.fr - Journalisme">Voir les commentaires(<?php echo $nbr_com ?>)</a>  <a href="#" onClick="envoi_data('<?php echo $id; ?>');" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="font-size:0.8em;">Ecrire un commentaire</a></center>                
            <div class="collapse" style="margin:10px;" id="collapseExample<?php echo $i; ?>">
                <div class="card card-body">
                    <?php afficher_commentaire($id); ?>
                </div>
            </div>
            <?php
        }
    }
    $reponse->closeCursor();
}

// On cherche a savoir si un utilisateur a déja un compte un email identique
function utilisateur_existe($email){
    $requete = "SELECT COUNT(*) as nombre_user FROM `users` WHERE email ='$email'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $nombre_user = $rep["nombre_user"];
    }
    return $nombre_user;
    $reponse->closeCursor();
}

// Renvoi du mail de validation du compte
function renvoi_mail_validation_compte($id){
    $requete = "SELECT email, nom_prenom, compte_valide FROM `users` WHERE id ='$id'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $email = $rep["email"];
        $nom_prenom = $rep["nom_prenom"];
        $validation_chiffre = $rep["compte_valide"];
    }
    $reponse->closeCursor();

    //Envoi d'un mail de confirmation
    $message = '
    <html>
    <head>
    <style type="text/css">
        #content {
            width: 55%;
            margin:10px auto;
            background-color:white;
            padding: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }
        @media screen and (max-width: 600px){
            body,html {
                font-size: 0.8em;
            }
            #content {
                width: 90%;
                display:block;
                margin: 0 auto;
            }
            #image {
                width: 90%;
                margin: 0 auto;
                display:block;
            }
        }
    </style>
    </head>
<body style="display:block;padding:10px;width:100%;height:100%;font-family: Arial, Helvetica, sans-serif;background-color: #c252e7;">
    <div id="content">
        <center><a href="https://www.journalperso.fr"><img id="image" src="https://journalperso.fr/ressources/img/logo-journalperso.png" alt="Logo du site de journalisme journalperso.fr pour les emails."/></a></center>
        <center><h1>Bienvenue sur Journalperso.fr</center></h1><br/>
        <div style="width: 95%;margin:0 auto;">
                <p style="color:red;">Veuillez confirmer que cet email n est pas un SPAM, mettez le en marque blanche au cas ou il arrive en SPAM. Merci.</p>
                <hr>
                Bonjour, nom de votre journal: <b>'.$nom_prenom.'</b><br/>
                Votre identifiant: <b>'.$email.'</b><br/>
                <hr/>
                <center><a href="https://www.journalperso.fr/index.php?page=validation-compte&email='.$email.'&valide='.$validation_chiffre.'">Valider votre compte</a></center>
                Validez votre compte: https://www.journalperso.fr/index.php?page=validation-compte&email='.$email.'&valide='.$validation_chiffre.'
                <hr/>
                <center>
                    Vous faites partie des premiers inscrits, profitez-en !<br>
                    Venez participez sur le site Journalperso.fr.<br>
                    <b style="text-align:center;color:#c252e7">Venez poster du contenu de qualité pour nous aider à démarrer notre site !</b>
                </center>
                <hr/>
                <a href="https://journalperso.fr/connexion.html" alt="Créez votre premier journal"><img style="display:block;margin:0 auto;" src="https://www.journalperso.fr/ressources/img/bouton-aide.png" alt="Créez votre premier journal" /></a>
        </div>
        <center>
        <p>Ajoutez le site à vos favoris sur votre mobile, tablette et ordinateur pour une utilisation optimale.</p>
        <a href="https://www.journalperso.fr">https://www.journalperso.fr</a>
        </center>
    </div>
</body></html>';
    mail($email, 'Validez votre compte Journalperso.fr', $message, HEADERS); 
}

// Inscription
function inscription($email, $hashed_password, $nom_prenom, $mdp, $parrain){
    $validation_chiffre = rand(1, 100000);
    // On insere l'utilisateur et ses infos dans la base de donnée
    $valeurs = [
        "id" => null,
        "email" => $email,
        "mdp" => $hashed_password,
        "nom_prenom" => $nom_prenom,
        "valide" => 2,
        "date_inscription" => date("Y-m-d"),
        "compte_valide" => $validation_chiffre,
        "parrain" => $parrain,
        "paypal" => ""
    ];
    insert_bdd("users", $valeurs);

        //Envoi d'un mail de confirmation
        $message = '
        <html>
        <head>
        <style type="text/css">
        #content {
            width:55%;
            margin:10px auto;
            background-color:white;
            padding: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }
        @media screen and (max-width: 600px){
            body,html {
                font-size: 0.8em;
            }
            #content {
                width: 90%;
                margin: 0 auto;
                display:block;
            }
            #image {
                width: 90%;
                margin: 0 auto;
                display:block;
            }
        }
        </style>
        </head>
        <body style="display:block;padding:10px;width:100%;height:100%;font-family: Arial, Helvetica, sans-serif;background-color: #c252e7;">
        <div id="content">
            <center><a href="https://www.journalperso.fr"><img id="image" src="https://journalperso.fr/ressources/img/logo-journalperso.png" alt="Logo du site de journalisme Journalperso.fr pour les emails."/></a></center>
            <center><h1>Bienvenue sur Journalperso.fr</center></h1><br/>
            <div style="width: 95%;margin:0 auto;">
                    <p style="color:red;">Veuillez confirmer que cet email n est pas un SPAM, mettez le en marque blanche au cas ou il arrive en SPAM. Merci.</p>
                    <hr>
                    Bonjour, nom de votre journal: <b>'.$nom_prenom.'</b><br/>
                    Votre identifiant: <b>'.$email.'</b><br/>
                    Votre mot de passe: <b>'.$mdp.'</b><br/>
                    <hr/>
                    <center><a href="https://www.journalperso.fr/index.php?page=validation-compte&email='.$email.'&valide='.$validation_chiffre.'">Valider votre compte</a></center>
                    Validez votre compte: https://www.journalperso.fr/index.php?page=validation-compte&email='.$email.'&valide='.$validation_chiffre.'
                    <hr/>
                    <center>
                        Vous faites partie des premiers inscrits, profitez-en !<br>
                        Venez participez sur le site Journalperso.fr.<br>
                        <b style="text-align:center;color:#c252e7">Venez poster du contenu de qualité pour nous aider à démarrer notre site !</b>
                    </center>
                    <hr/>
            </div>
            <center>
            <p>Ajoutez le site à vos favoris sur votre mobile, tablette et ordinateur pour une utilisation optimale.</p>
            <a href="https://www.journalperso.fr">https://www.journalperso.fr</a>
            </center>
        </div>
    </body></html>';
    mail($email, 'Inscription Journalperso.fr', $message, HEADERS); 
}

// On recupere le mot de passe du journal
function mot_de_passe($id_journal){
    $requete = "SELECT mot_de_passe FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["mot_de_passe"];
    }
    $reponse->closeCursor();
}
// On cherche le nombre d'utilisateur et on l'affiche
function nombre_utlisateur(){
    $requete = "SELECT COUNT(*) as nombre_user FROM `users`";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $nombre_user = $rep["nombre_user"];
    }
    return $nombre_user;
    $reponse->closeCursor();
}

// Ajoute une vue
function ajouter_vue_journal($adresse_ip, $date_du_jour, $id_journal){
    // Regarde si la personne a deja vu je journal aujourd'hui
    $requete = "SELECT COUNT(*) as nombre_vues_personne FROM `vues` WHERE date_vue = '$date_du_jour' AND adresse_ip = '$adresse_ip' AND id_journal = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $nombre_vue_personne = $rep["nombre_vues_personne"];
        if($nombre_vue_personne == 0){
            // Ajoute un vue dans le journal 
            ajouter_vue($id_journal);
            // On insere une ligne dans la table vues
            $valeurs = [
                "adresse_ip" => $adresse_ip,
                "date_vue" => $date_du_jour,
                "id_journal" => $id_journal
            ];
            insert_bdd("vues", $valeurs); 
        }
    }
}

// Savoir si le compte est valide
function compte_valide($id_user){
    $requete = "SELECT valide FROM `users` WHERE id = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $valide = $rep["valide"];
        if($valide == 0){
            return 0;
        } elseif($valide == 1){
            return 1;
        } elseif($valide == 2){
            return 2;
        }
    }
    $reponse->closeCursor();
}

// Retourne si le delais entre date de l'inscription et la date d'essai est valide
function delais_valide($id_user){
    // On recupere la date d'inscription de l'utlisateur
    $requete = "SELECT date_inscription FROM `users` WHERE id = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $date_inscription = $rep["date_inscription"];
    }

    // On recupere la date du jour
    $date_du_jour = date("Y-m-d");
    $date_du_jour = new DateTime($date_du_jour); 
    $date_du_jour = $date_du_jour->format('Ymd'); 

    // On ajoute 5 jour a la date d'inscription
    $date_et_delais = new DateTime($date_inscription.'+45 day'); 
    $date_et_delais = $date_et_delais->format('Ymd');

    // On compare la date du jour avec la date d'inscrption +45 et si le compte n'est pas valide
    if($date_du_jour >= $date_et_delais && compte_valide($id_user) != 1){
        // Si le delais est dépasser on passe au compte payant
        $valeurs = [
            'valide' => 0,
            'id_user' => $id_user
        ];
        update_bdd("UPDATE users SET valide = :valide WHERE id = :id_user", $valeurs);
    }
    $reponse->closeCursor();
}

// Paye le membre et le parrain
function payer_membre_et_parrain($id){
    // Paye le membre
    $valeurs = [
        "id" => null,
        "id_user" => $id,
        "montant" => 0.3,
        "date" => date("Y-m-d H:i:s"),
        "description" => "Paiement journal membre id=".$id
    ];
    insert_bdd("paiements", $valeurs);
    notifier($id, date("Y-m-d"), "Vous avez reçu un paiement de 0.3€"); 

    // Paye le parrain 1
    $requete = "SELECT parrain FROM `users` WHERE id = '$id'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $parrain1 = $rep["parrain"];
    }
    if($parrain1 != 0 || $parrain1 != null || $parrain1 != ""){
        $valeurs = [
            "id" => null,
            "id_user" => $parrain1,
            "montant" => 0.1,
            "date" => date("Y-m-d H:i:s"),
            "description" => "Paiement journal parrain id=".$parrain1
        ];
        insert_bdd("paiements", $valeurs);
        notifier($parrain1, date("Y-m-d"), "Vous avez reçu un paiement de 0.1€ de la part d'un filleul"); 
    } 

    // Paye le parrain 2
    $requete = "SELECT parrain FROM `users` WHERE id = '$parrain1'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $parrain2 = $rep["parrain"];
    }
    if($parrain2 != 0 || $parrain2 != null || $parrain2 != ""){
        $valeurs = [
            "id" => null,
            "id_user" => $parrain2,
            "montant" => 0.05,
            "date" => date("Y-m-d H:i:s"),
            "description" => "Paiement journal parrain id=".$parrain2
        ];
        insert_bdd("paiements", $valeurs);
        notifier($parrain2, date("Y-m-d"), "Vous avez reçu un paiement de 0.05€ de la part d'un filleul"); 
    }
    
}

// Valide le paiement en passant le champs 'valide' a 1 dans la base de données
function valider_paiement($id_user){
    $valeurs = [
        "id" => null,
        "id_user" => $id_user,
        "montant" => 0,
        "date" => date("Y-m-d H:i:s"),
        "description" => "Paiement inscription"
    ];
    insert_bdd("paiements", $valeurs); 
    $valeurs = [
        'valide' => 1,
        'id' => $id_user
    ];
    update_bdd("UPDATE users SET valide = :valide WHERE id = :id", $valeurs);
}

// Affiche les journaux personels les plus connus par 10 par pages
function afficher_journaux_connus(int $x){
    $langue = langue();
    $messagesParPage = $x; //Nous allons afficher 5 messages par page.
    $select_nbr_journaux = "SELECT COUNT(*) AS nbr_journaux FROM `journaux`";
    $select_nbr_journaux2 = select_bdd($select_nbr_journaux);
    $donnees_total = $select_nbr_journaux2->fetch(); //On range retour sous la forme d'un tableau.
    $total = $donnees_total['nbr_journaux']; //On récupère le total pour le placer dans la variable $total.
    $nombreDePages=ceil($total/$messagesParPage);
    if(isset($_GET['numero-page'])) // Si la variable $_GET['page'] existe...
    {
         $pageActuelle=intval($_GET['numero-page']);
     
         if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
         {
              $pageActuelle=$nombreDePages;
         }
    }
    else // Sinon
    {
         $pageActuelle=1; // La page actuelle est la n°1    
    }
    $premiereEntree=($pageActuelle-1)*$messagesParPage; // On calcul la première entrée à lire

    $requete = "SELECT nom, vues, id FROM `journaux` ORDER BY vues DESC LIMIT $premiereEntree, $messagesParPage";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
            $nom = $rep["nom"];
            $vues = $rep["vues"];
            $id = $rep["id"];
            ?>
            <a class="journaux_connus" href="https://www.journalperso.fr/journal-<?php echo $id;?>.html" target="_blank" alt="Journal <?php echo $nom;?>"><?php echo $nom;?></a>&nbsp;&nbsp;
            </div>
            <?php 
    }

    pagination($nombreDePages, $pageActuelle, "accueil", "#meilleurs_journaux");

    $reponse->closeCursor();  
}  

// Affiche les journaux personels les plus connus par 10 par pages
function afficher_journaux_connus2(int $x){
    $langue = langue();
    $messagesParPage = $x; //Nous allons afficher 5 messages par page.
    $select_nbr_journaux = "SELECT COUNT(*) AS nbr_journaux FROM `journaux`";
    $select_nbr_journaux2 = select_bdd($select_nbr_journaux);
    $donnees_total = $select_nbr_journaux2->fetch(); //On range retour sous la forme d'un tableau.
    $total = $donnees_total['nbr_journaux']; //On récupère le total pour le placer dans la variable $total.
    $nombreDePages=ceil($total/$messagesParPage);
    if(isset($_GET['numero-page'])) // Si la variable $_GET['page'] existe...
    {
         $pageActuelle=intval($_GET['numero-page']);
     
         if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
         {
              $pageActuelle=$nombreDePages;
         }
    }
    else // Sinon
    {
         $pageActuelle=1; // La page actuelle est la n°1    
    }
    $premiereEntree=($pageActuelle-1)*$messagesParPage; // On calcul la première entrée à lire

    $requete = "SELECT nom, vues, id FROM `journaux` ORDER BY vues DESC LIMIT $premiereEntree, $messagesParPage";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
            $nom = $rep["nom"];
            $vues = $rep["vues"];
            $id = $rep["id"];
            ?>
            <a class="journaux_connus" href="https://www.journalperso.fr/journal-<?php echo $id;?>.html" target="_blank" alt="Journal <?php echo $nom;?>"><?php echo $nom;?></a>&nbsp;&nbsp;
            </div>
            <?php 
    }

    pagination($nombreDePages, $pageActuelle, "accueil-membre", "#meilleurs_journaux");

    $reponse->closeCursor();  
}  


// Afficher resultats de la recherche
function afficher_resultats_recherche($recherche){
    //on passe toute la recherche en minuscule
    $recherche = strtolower($recherche);
    // on serpare les mots dans la recherche avec esepace comme separateur
    $mots = explode(" ", $recherche);
    // on fait la recherche
    foreach ($mots as $key => $value){
        if($value != " " || $value != ""){
            $requete = "SELECT nom FROM `journaux` WHERE nom LIKE '%$value' OR nom LIKE '$value%' ORDER BY id DESC";
            $reponse = select_bdd($requete);
            while ($rep = $reponse->fetch()){
                    $nom = $rep["nom"];
                    $id = $rep["id"];
                    ?>
                        <a href="https://www.journalperso.fr/journal-<?php echo $id;?>.html" target="_blank" alt="Journal <?php echo $nom;?>"><?php echo $nom;?></a>
                    <?php 
            }
            $reponse->closeCursor();
        } else {
            echo "erreur";
        }
    } 
}

//Retourne si l'utilisateur est payant ou non
function payant($id_journal){
    $requete = "SELECT payant FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["payant"];
    }
    $reponse->closeCursor();
}

//Etre payant ou ne pas etre payant
function etre_payant($id_journal, $etre_payant){
    $valeurs = [
        'payant' => $etre_payant,
        'id' => $id_journal
    ];
    update_bdd("UPDATE journaux SET payant = :payant WHERE id = :id", $valeurs);
}

// affiche les gains des memebre au total
function gain_membre(){
    $gain = 0;
    $requete = "SELECT montant FROM `paiements` WHERE description NOT LIKE 'D%'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $gain += $rep["montant"];
    }
    return $gain;
    $reponse->closeCursor();
}

// affiche le nombre de journaux personnels
function nombre_journaux(){
    $requete = "SELECT COUNT(*) as nombre_journaux FROM `journaux`";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        echo $rep["nombre_journaux"];
    }
    $reponse->closeCursor();
}

// Affiche les journaux créer dans un menu
function afficher_journaux_creer_menu($id_user){
    $requete = "SELECT nom, id FROM `journaux` WHERE id_user = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        ?>
        <a class="dropdown-item" href="modifier-journal-<?php echo $rep["id"]; ?>.html"><?php echo $rep["nom"]; ?></a>
        <?php
    }
    $reponse->closeCursor();
}

// Crée le journal
function creer_journal($id_user, $description, $nom_journal){
    $valeurs = [
        "id" => null,
        "id_user" => $id_user,
        "nom" => $nom_journal,
        "description" => $description,
        "vues" => 0,
        "mot_de_passe" => "journalperso",
        "payant" => 1
    ];
    insert_bdd("journaux", $valeurs);
    ?>
    <script>window.location.replace('https://www.journalperso.fr/creerunjournal.html')</script>
    <?php
}

// Affiche les journaux
function afficher_les_journaux($id_user){
    $requete = "SELECT nom, id, vues, mot_de_passe FROM `journaux` WHERE id_user = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        ?>
        <tr>
            <th scope="row"><?php echo $rep["id"]; ?></th>
            <td><?php echo $rep["nom"]; ?></td>
            <td>https://www.journalperso.fr/journal-<?php echo $rep["id"]; ?>.html</td>
            <td><?php echo $rep["mot_de_passe"]; ?></td>
            <td><?php echo $rep["vues"]; ?></td>
            <td><a href="https://www.journalperso.fr/journal-<?php echo $rep["id"]; ?>.html">Visualiser</a> <a href="modifier-journal-<?php echo $rep["id"]; ?>.html">Modifier</a> <a href="supprimer-journal-<?php echo $rep["id"]; ?>.html">Supprimer</a></td>
        </tr>      
        <?php
    }
    $reponse->closeCursor();
}

// nombre total de vues sur les journaux
function nbr_vues_journaux($id_user){
    $vues = 0;
    $requete = "SELECT vues FROM `journaux` WHERE id_user = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $vues += $rep["vues"];;
    }
    $reponse->closeCursor(); 
    return $vues;
}

// Ajoute une vue au journal personnel
function ajouter_vue($id_journal){
    $requete = "SELECT vues FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $vues = $rep["vues"];
    }
    $valeurs = [
        'vues' => $vues + 1,
        'id_journal' => $id_journal
    ];
    update_bdd("UPDATE journaux SET vues = :vues WHERE id = :id_journal", $valeurs);
    $reponse->closeCursor();
}

// récupère le nom du journal
function recuperer_nom_journal($id_journal){
    $requete = "SELECT nom FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["nom"];
    }
    $reponse->closeCursor();
}

// récupère mot de passe journal
function recuperer_mot_de_passe_journal($id_journal){
    $requete = "SELECT mot_de_passe FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["mot_de_passe"];
    }
    $reponse->closeCursor();
}

// récupère description journal
function recuperer_description_journal($id_journal){
    $requete = "SELECT description FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["description"];
    }
    $reponse->closeCursor();
}

// récupère le nom et prenom du créateur du journal
function nom_prenom_de_journal($id_journal){
    $requete = "SELECT id_user FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $id_user = $rep["id_user"];
        $requete2 = "SELECT nom_prenom FROM `users` WHERE id = '$id_user'";
        $reponse2 = select_bdd($requete2);
        while ($rep2 = $reponse2->fetch()){
            return $rep2["nom_prenom"];
        }
        $reponse2->closeCursor();
    }
    $reponse->closeCursor();
}

// récupère l'id du créateur du journal
function id_user_de_journal($id_journal){
    $requete = "SELECT id_user FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["id_user"];
    }
    $reponse->closeCursor();
}

// Supprimer un journal
function supprimmer_journal($id_journal){
    $langue = langue();
    delete_bdd("journaux", $id_journal);
    notifier(id_user_de_journal($id_journal), date("Y-m-d"), "Vous avez supprimer le journal ".$id_journal);
    ?>
    <script>window.location.replace('https://journalperso.fr/creerunjournal.html')</script>
    <?php
}

//envoyer un commentaire dans la bdd
function commenter($id_publication, $nom_prenom, $commentaire){
    $valeurs = [
        "id" => null,
        "id_publication" => $id_publication,
        "date_com" => date("Y-m-d"),
        "nom_prenom" => $nom_prenom,
        "texte" => $commentaire
    ];
    insert_bdd("commentaire", $valeurs);
}

//envoyer une notification dans la bdd
function notifier($id_user, $date_notif, $description){
    $valeurs = [
        "id" => null,
        "id_user" => $id_user,
        "date_notif" => $date_notif,
        "description_notif" => $description,
        "vue" => 1
    ];
    insert_bdd("notifications", $valeurs);
}

// récupère le nombre de notifications de l'user
function nbr_notif($id_user){
    $requete = "SELECT COUNT(*) as nbr_notif FROM `notifications` WHERE id_user = '$id_user' AND vue = 1";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["nbr_notif"];
    }
    $reponse->closeCursor();
}

// affiche les notifications
function notifications($id_user){
    $requete = "SELECT description_notif, date_notif FROM `notifications` WHERE id_user = '$id_user' ORDER BY date_notif DESC";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        echo "<b>".$rep["date_notif"]."</b>  ".$rep["description_notif"]."&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    $reponse->closeCursor();
}

// recupere l'id en fonction de l'id du journal
function recup_id($id_journal){
    $requete = "SELECT id_user FROM `journaux` WHERE id = '$id_journal'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        return $rep["id_user"];
    }
    $reponse->closeCursor();
}

//remet les vues des notifs a 0
function efface_vue($id_user){
    $requete = "SELECT vue, id_user FROM `notifications` WHERE id_user = '$id_user'";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
        $valeurs = [
            'vue' => 0,
            'id_user' => $rep["id_user"],
        ];
        update_bdd("UPDATE notifications SET vue = :vue WHERE id_user = :id_user", $valeurs);
        $reponse->closeCursor();
    }

}

//affiche les visiteurs en ligne
function enligne(){
    $temps_session = 45;
    $temps_actuel = date("U");
    $user_ip = $_SERVER["REMOTE_ADDR"];
    $count_util = "SELECT COUNT(*) as nbr_util FROM `onlinevisiteurs` WHERE user_ip = '$user_ip'";
    $reponse = select_bdd($count_util);

    $valeurs = [
        "id" => null,
        "ip_user" => $user_ip,
        "date_visite" => date("Y-m-d")
    ];
    insert_bdd("visiteurs", $valeurs);

    while ($rep = $reponse->fetch()){
        if($rep["nbr_util"] == 0){
            $valeurs = [
                "id" => null,
                "time_actuel" => $temps_actuel,
                "user_ip" => $user_ip
            ];
            insert_bdd("onlinevisiteurs", $valeurs);
        } else {
            $valeurs = [
                'time_actuel' => $temps_actuel,
                'user_ip' => $user_ip
            ];
            update_bdd("UPDATE onlinevisiteurs SET time_actuel = :time_actuel WHERE user_ip = :user_ip", $valeurs);  
        }
    }

    $session_delete_time = $temps_actuel - $temps_session;
    $bdd = connection_bdd();
    $bdd->exec("DELETE FROM `onlinevisiteurs` WHERE time_actuel < '$session_delete_time'");

    $count_util_con = "SELECT COUNT(*) as nbr_util_online FROM `onlinevisiteurs`";
    $reponse = select_bdd($count_util_con);
    while ($rep = $reponse->fetch()){
        return $rep["nbr_util_online"];;
    }
    
}

// affiche le nombre de visiteurs dans la journée
function visiteursjournee(){
    $ip_user = $_SERVER["REMOTE_ADDR"];
    $date = date("Y-m-d");
    $count_util_total = 0;
    $count_util = "SELECT COUNT(*) as nbr_util_ip_user, ip_user, date_visite FROM `visiteurs` WHERE date_visite = '$date' GROUP BY ip_user, date_visite";
    $reponse = select_bdd($count_util);
    while ($rep = $reponse->fetch()){
        if($rep["nbr_util_ip_user"] = 0){
            $valeurs = [
                "id" => null,
                "ip_user" => $ip_user,
                "date_visite" => date("Y-m-d")
            ];
            insert_bdd("visiteurs", $valeurs);
            $count_util_total++;
        }else{
            $count_util_total++;
        }
    }
    return $count_util_total;
}

function affichervuephp(){
    $count_vue = "SELECT vues FROM `vuesvideospresentation`";
    $reponse = select_bdd($count_vue);
    while ($rep = $reponse->fetch()){
        return $rep["vues"];;
    }
}

function ajoutervuephp(){
    $count_vue = "SELECT vues FROM `vuesvideospresentation`";
    $reponse = select_bdd($count_vue);
    while ($rep = $reponse->fetch()){
        $vues =  $rep["vues"];;
    }
    $valeurs = [
        'vues' => $vues+1
    ];
    update_bdd("UPDATE vuesvideospresentation SET vues = :vues", $valeurs); 
}
?>