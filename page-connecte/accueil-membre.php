<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>B</b>ienvenue sur votre compte";}elseif($langue=="en"){echo"<b>W</b>elcome to your account";}?> <?php journal_perso_de($_SESSION['id']); ?></h1>
<center><a class="hvr-grow" href="https://www.journalperso.fr/creerunjournal.html" alt="Créez votre premier journal"><img style="display:block;margin:0 auto;" src="ressources/img/bouton-aide.png" alt="Créez votre premier journal" /></a></center>
<div style="margin-top:10px;" class="alert alert-success" role="alert">
<?php 
    if($langue=="fr"){
        echo "<strong>Devenez journaliste !</strong> Creer des journaux privés ou libre. Publiez ce que vous voulez (Images, Videos, Texte, Articles, Fichier téléchargeable). Vos notes, vos pensées faites en un <strong>journal privé</strong> ou publique. Vous pouvez faire payer l'accès à votre journal privé et recevoir de l'argent pour chaque accès a votre journal. Alors au travail et soyer creatif! Vous pouvez même écrire un livre interactif! En écrivant un journal il sera présent sur le site et sur Google.";
    }elseif($langue=="en"){
        echo"<strong>Become journalist !</strong> Create journals to sell them later. Publish what you want (Images, Videos, Text, Articles, Downloadable File). Your notes, your thoughts done in a <strong>private journal</strong> or public. You can charge access to your diary and receive money for each access to your private journal. So, go work and be creative! You can even write an interactive book. By writing a newspaper he will be present on the site and on Google.";
    } 
?>
</div>
<img id="img_gagner_argent" src="ressources/img/Photo-Journalperso-texteetplante.png" alt="Révélez vos talents sur notre site de journalisme independant journalperso.fr. Soyez créatif!"/>
<div id="meilleurs_journaux">
   <h1 class="h1"><img class="podium" src="ressources/img/podium-page-accueil.png" alt="Podium"/><?php if($langue=="fr"){echo "<b>J</b>ournaux personnels les plus visités";}elseif($langue=="en"){echo"<b>M</b>ost visited personal journals";} ?></h1>
   <?php afficher_meilleurs_journaux3(); ?>
</div>