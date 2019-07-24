<?php
    // On inclus les fonctions php
    include('fonctions/fonctions.php');

    // Ouvrir session
    ouvrir_session();

    enligne();

    // on recupère le parrain et la langue par defaut
    if(isset($_GET["parrain"])){
        setcookie("parrain", $_GET["parrain"]);
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
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v3.3&appId=392499051612451&autoLogAppEvents=1"></script>
    <script>
  function statusChangeCallback(response) {
    if (response.status === 'connected') {
      testAPI();
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '392499051612451',
      cookie     : true,
      xfbml      : true,
      version    : '3.3'
    });
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function testAPI() {
    FB.api('/me?fields=id,first_name,last_name,friends,email', function(response) {
      document.location.href="index.php?page=validation-connexion-fb&prenom="+response.first_name+"&nom="+response.last_name+ "&email="+response.email;
    });
  }
</script>
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
            <h1 class="h1"><img class="podium" src="ressources/img/podium-page-accueil.png" alt="Podium"/><strong><?php //if($langue=="fr"){echo "Journaux personnels les plus visités";}elseif($langue=="en"){echo"Most visited personal journals";} ?></strong></h1>
            <div style="font-size:1.1em;"><?php //afficher_meilleurs_journaux2(); ?></div>
        </div>
</div>
-->
<!-- WRAPPER -->
<div id="wrapper">
   <!-- HEADER -->
    <header>
        <div class="langues">
            <a id="fr" href="#"><img src="ressources/img/francais.png" alt="Passer en langue française sur le site internet journalperso.fr" /></a>
            <a id="en" href="#"><img src="ressources/img/anglais.png" alt="Passer en langue anglaise sur le site internet journalperso.fr" /></a> 
            <a href=""><img style="height: 25px;" src="ressources/img/refresh.png" alt="Rafraichir la page directement." /></a>
        </div>
        <div class="hvr-pulse" style="display:inline-block;">
            <a href="https://www.journalperso.fr"><img class="logo" src="ressources/img/logo-journalperso.png" alt="Logo du site internet Journalperso.fr - Site de journalisme independant!" /></a>
        </div>
        <!-- PUBLICITE-->
        <div id="publicite">
            <?php
            // on affiche les publications
            afficher_publicite();
            ?>
        </div> 
    </header>
            <!-- NAVBAR -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="accueil.html">Menu</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="accueil.html"><?php if($langue=="fr"){echo "Accueil";}elseif($langue=="en"){echo"Home";} ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inscription.html"><img src="ressources/img/fleche_inscription.png" alt="Devenez journaliste"> <?php if($langue=="fr"){echo "<strong>Devenez journaliste !</strong>";}elseif($langue=="en"){echo"<strong>Become a journalist !</strong>";} ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reglement2.html"><?php if($langue=="fr"){echo "Reglement";}elseif($langue=="en"){echo"Regulations";} ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mentionslegales.html"><?php if($langue=="fr"){echo "Mentions Legales";}elseif($langue=="en"){echo"Legal Notice";} ?></a>
                    </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <a class="nav-link" href="connexion.html"><?php if($langue=="fr"){echo "<b>Connexion</b>";}elseif($langue=="en"){echo"<b>Sign in</b>";} ?></a>
                    </form>
                </div>
            </nav>
       <div id="contenu">
            <?php
                // gérer les pages
                $page = isset($_GET["page"]) ? $_GET["page"] : null;
                gerer_les_pages(false, $page);
            ?>
        </div>
    </div>
    <!-- FOOTER -->
    <footer>
        <?php afficher_footer(); ?>
    </footer>
    </body>
</html>