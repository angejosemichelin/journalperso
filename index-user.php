<?php  
    // On inclus les fonctions php
    include('fonctions/fonctions.php');

    // Ouvrir session
    ouvrir_session();

    enligne();

    if(!isset($_SESSION["id"])) 
    {
        ?>
        <script>window.location.replace('https://www.journalperso.fr/')</script>
        <?php 
    }
    
    $langue = langue();
?>
<!DOCTYPE html>
    <head>
        <?php 
        $page = isset($_GET["page"]) ? $_GET["page"] : null;
        $titre_page = titre_page($page);
        $description_page = description_page($page);
        afficher_head($titre_page, $description_page); 
        ?> 
    </head>
    <body>
        <!--
    <div id="petit_ecran">
        <img style="width:200px;margin:0 auto;display:block;" src="ressources/img/logo-journalperso.png" alt="Journalperso.fr sur petit ecran" />
        <p style="font-weight:bold;color:red;text-align:center;">Le site n'est pas disponible sur petit écran merci d'utiliser un PC.</p>
        <div style="display:block;width:100%;text-align:center;">    
                    <?php 
                    // on affiche les publications
                    //afficher_publicite();
                    ?>
        </div>
        <p class="nbr_journaux"><?php //echo nombre_utlisateur(); ?> <?php //if($langue=="fr"){echo "inscrits";}elseif($langue=="en"){echo"registered";} ?></p>
        <p class="nbr_journaux"><?php //echo nombre_journaux(); ?> <?php //if($langue=="fr"){echo "journaux personnels";}elseif($langue=="en"){echo"personal journals";} ?></p>
        <div style="font-size:1em;margin:30px 10px;" id="meilleurs_journaux">
            <h1 class="h1"><img class="podium" src="ressources/img/podium-page-accueil.png" alt="Podium"/><?php //if($langue=="fr"){echo "<b>J</b>ournaux personnels les plus visités";}elseif($langue=="en"){echo"<b>M</b>ost visited personal journals";} ?></h1>
            <div style="font-size:1.1em;"><?php //afficher_meilleurs_journaux2(); ?></div>
        </div>
</div>
-->
<div id="wrapper">
    <!-- HEADER -->
    <header style="position:relative">
        <div class="langues">
            <a id="fr" href="#"><img src="ressources/img/francais.png" alt="Passer en langue française sur le site internet journalperso.fr" /></a>
            <a id="en" href="#"><img src="ressources/img/anglais.png" alt="Passer en langue anglaise sur le site internet journalperso.fr" /></a>
            <a href=""><img style="height: 25px;" src="ressources/img/refresh.png" alt="Rafraichir la page directement." /></a>
        </div>
        <div class="hvr-pulse" style="display:inline-block;">
                <a href="https://www.journalperso.fr"><img class="logo" src="ressources/img/logo-journalperso.png" alt="Logo de la société Journalperso.fr - Site de journalisme independant!" /></a>     
        </div>
        <!-- PUBLICITE -->
        <div id="publicite">
                    <?php 
                    // on affiche les publications
                    afficher_publicite();
                    ?>
        </div>
        <div id="solde">
                <p class="p-line"><?php if($langue=="fr"){echo "Votre solde:";}elseif($langue=="en"){echo"Your balance:";} ?> <b><?php echo affiche_solde($_SESSION['id']); ?>€</b></p>
                <p class="p-line"><b><?php echo nombre_filleul($_SESSION["id"]); ?></b> <?php if($langue=="fr"){echo "filleul(s)";}elseif($langue=="en"){echo"godson(s)";} ?></p>
                <p class="p-line"><a style="font-size:0.8em;" href="demande-paiement.html"><?php if($langue=="fr"){echo "Demande de paiement";}elseif($langue=="en"){echo"Payment";} ?></a></p>
                <p class="p-line"><a style="font-size:0.8em;color:red" href="notifications.html">Notifications(<?php echo nbr_notif($_SESSION["id"]) ?>)</a></p>
        </div>
    </header>
    
    <?php
            if(compte_valider($_SESSION['id']) != 1){
                    ?>
                    <center>
                        <div class="alert alert-warning" style="margin:0;padding:0;font-size:0.9em;" role="alert">
                        <?php 
                        if($langue=="fr"){echo "Un mail vous a été envoyé. Veuillez cliquer sur le lien pour valider votre compte. Verfifer vos spams.<a href='renvoi_mail_validation_compte.html' alt='Renvoi du mail de validation du compte'>Renvoyer le mail</a>";}elseif($langue=="en"){echo"An email has been sent to you. Please click on the link to validate your account. Verfifer your spams.<a href='renvoi_mail_validation_compte.html' alt='Return the account validation email'>Resend the mail</a>";} 
                        ?>
                        </div>
                    </center>
                    <?php
            }
            
        ?>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="accueil-membre.html">Menu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="accueil-membre.html"><?php if($langue=="fr"){echo "Accueil";}elseif($langue=="en"){echo"Home";} ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if($langue=="fr"){echo "Journaux";}elseif($langue=="en"){echo"Journals";} ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="creerunjournal.html"><b style="font-size:1.1em;"><?php if($langue=="fr"){echo "Créer/modifier un journal";}elseif($langue=="en"){echo"Create/modifiate a journal";} ?></b></a>
                        <?php
                        afficher_journaux_creer_menu($_SESSION['id']);
                        ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if($langue=="fr"){echo "Compte";}elseif($langue=="en"){echo"Account";} ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="moncompte.html"><?php if($langue=="fr"){echo "Mes infos";}elseif($langue=="en"){echo"My info";} ?></a>
                        <a class="dropdown-item" href="statistiques.html"><?php if($langue=="fr"){echo "Statistiques";}elseif($langue=="en"){echo"Statistics";} ?></a>
                        <a class="dropdown-item" href="demande-paiement.html"><?php if($langue=="fr"){echo "Demande de paiement";}elseif($langue=="en"){echo"Payment";} ?></a>
                        <a class="dropdown-item" href="notifications.html"><?php if($langue=="fr"){echo "Notifications";}elseif($langue=="en"){echo"Notifications";} ?></a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="parrainnage.html"><strong><?php if($langue=="fr"){echo "Parrainnage";}elseif($langue=="en"){echo"Sponsorship";} ?></strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php"><?php if($langue=="fr"){echo "Deconnexion";}elseif($langue=="en"){echo"Log out";} ?></a>
                </li>
                </ul>
            </div>
        </nav>
        <!-- CONTENU -->
        <div id="contenu">
            <?php
                // On gère les pages
                gerer_les_pages(true, $page);
            ?>
        </div>
        </div>
        <!-- FOOTER -->
        <footer>
            <?php afficher_footer(); ?>
        </footer>
    </body>
</html>