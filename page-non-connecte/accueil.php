<?php $langue = langue(); ?>
<div style="vertical-align: top;">
    <div id="inscription_accueil">
    <center style="margin-top:5px;"><div class="hvr-grow fb-login-button" scope="public_profile,email" onlogin="checkLoginState();" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="false"></div></center>
        <h1 class="h1"><?php if($langue=="fr"){echo "<b>I</b>nscription rapide !";}elseif($langue=="en"){echo"<b>F</b>ast registration !";} ?></h1>
            <form action="validation-inscription.html" method="post">
                    <?php
                        if($langue=="fr"){
                            input("email", "Adresse e-mail:", "email_inscription", "email", "Entrez votre adresse e-mail", true, "");
                            input("text", "Nom et prenom:", "nom_prenom", "nom_prenom", "Entrez votre nom et prénom", true, "");
                            input("password", "Mot de passe:", "password", "mdp", "Mot de passe", true, "");
                        }elseif($langue=="en"){
                            input("email", "E-mail adress:", "email_inscription", "email", "Enter your e-mail adress", true, "");
                            input("text", "Last name and first name", "nom_prenom", "nom_prenom", "Enter your name and surname in full", true, "");
                            input("password", "Password:", "password", "mdp", "Password", true, "");
                        }
                        $parrain = isset($_GET["parrain"]) ? $_GET["parrain"] : $_COOKIE["parrain"];
                    ?>
                    <input type="hidden" name="parrain" value="<?php echo $parrain; ?>">
                    <div class="g-recaptcha" data-sitekey="6LcSRXEUAAAAAAMk7u5oZGHx1QtV4-IoeRPxazwn"></div><br>
                    <center><button type="submit" class="hvr-float-shadow centrer btn btn-primary"><?php if($langue=="fr"){echo "Valider l'inscription";}elseif($langue=="en"){echo"Validate registration";} ?></button></center>
            </form>
    </div>
    <div id="image_accueil">
        <img style="width:100%;vertical-align: top;" src="ressources/img/Photo-Journalperso-texteetplante.png" alt="Journalperso.fr - Logo journalisme révéler vos talents idées notes centre d'interet"/>
        <p class="nbr_journaux"><?php echo nombre_utlisateur(); ?> &nbsp;<?php if($langue=="fr"){echo "inscriptions";}elseif($langue=="en"){echo"registering";} ?></p>
        <p class="nbr_journaux"><?php echo nombre_journaux(); ?> &nbsp;<?php if($langue=="fr"){echo "journaux personnels";}elseif($langue=="en"){echo"personal journals";} ?></p>
        <p class="nbr_journaux" style="font-size:0.9em"><?php echo enligne(); ?> &nbsp;<?php if($langue=="fr"){echo "visiteurs en ligne";}elseif($langue=="en"){echo"visitors online";} ?></p>
        <p class="nbr_journaux" style="font-size:0.9em"><?php echo visiteursjournee(); ?> &nbsp;<?php if($langue=="fr"){echo "visiteurs aujourd'hui";}elseif($langue=="en"){echo"visitors today";} ?></p>
        <div style="margin:10px 0;" class="alert alert-secondary" role="alert">
        <?php if($langue=="fr"){echo "Bénéfices des membres:";}elseif($langue=="en"){echo"Members benefits";} ?> <strong><?php echo gain_membre(); ?>€</strong>
        </div>
    </div>
</div>
<!-- Bloc Introduction -->
<div id="introduction">
    <?php
if($langue=="fr"){
        ?>
        <h1 class="h1"><b>E</b>crivez des journaux personnels en ligne!</h1>
        <?php
    }elseif($langue=="en"){
        ?>
        <h1 class="h1"><b>W</b>rite personnal journal online!</h1> 
        <?php
    }
    ?>
    <script>
        function ajoutervue(){
            $.ajax({
                url: 'page-non-connecte/envoi_vue.php'
            });
        }
    </script>
    <div id="div_introduction"><?php afficher_introduction(); ?></div>
    <div id="video_presentation" style="vertical-align:top;">
        <video onplaying="ajoutervue()" style="vertical-align:top;border: 5px solid #C252E7" width="250" poster="plus/video.png" height="400" preload="auto" controls src="ressources/videos/video_presentation.mp4">Vidéos de présentation de journalperso.fr par le créateur Ange-José Michelin</video>
        <p id="vue_video"><?php if($langue=="fr"){echo "Nombre de vues de la vidéo:";}elseif($langue=="en"){echo"Number of views of the video:";} ?><?php echo affichervuephp() ?></p>
    </div>
</div>
<div id="meilleurs_journaux">
   <h1 class="h1"><img class="podium" src="ressources/img/podium-page-accueil.png" alt="Podium"/><?php if($langue=="fr"){echo "<b>J</b>ournaux personnels les plus visités";}elseif($langue=="en"){echo"Most visited personal journals";} ?></h1>
</div>
    <?php afficher_meilleurs_journaux_card(); ?>
    <?php afficher_meilleurs_journaux(); ?>
</div>
