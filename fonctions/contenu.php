<?php

// affiche la publicité
function afficher_publicite(){
?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- pub journalperso 5 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:80px"
     data-ad-client="ca-pub-1499321886222382"
     data-ad-slot="2640275907"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php
}

// affiche l'introduction
function afficher_introduction(){
    $langue = langue();
    if($langue=="fr"){
        ?>
            <p>www.journalperso.fr est une <strong>communauté d’internautes en ligne</strong> qui s’exprime sur leurs journaux d’absolument tout ceux qu’ils veulent.</p>
            <p>Le site permet de créer des <strong>journaux personnels en ligne</strong> que l’ont peut mettre en privé ou en public et en donner librement l’accès ou en faire payer l’accès.</p>
            <p>Vous pouvez créer plusieurs journaux et dans ces journaux vous pouvez y noter tout ce que vous vous voulez vos pensées, vos notes ou articles ou autres (images, vidéos, fichiers).</p>
            <p>Pour une utilisation optimale sur ordinateurs, smartphones et tablettes ajouter le site <span class="violet">à vos favoris</span>.</p>
            <p>Nous avons développé un <strong>système de rédaction de contenu unique</strong> en son genre nommé MemoPlay.</p>
            <p>Plus vous avez de vues sur votre journal plus il sera bien classé.</p>
            <p>Si le site a du succès il sera nettement amélioré. Vos données restent confidentielles et ne seront pas donné à un tiers. Le site est entièrement sécurisé. Nous vous souhaitons une bonne expérience.</p>
            <p>En écrivant un journal il sera présent sur le site et sur Google.</p>
            <ul>
                <li>Paiement dès 1€.</li>
                <li>Vous gagnez 30% des gains de vos filleuls de niveau 1 et 10% des gains de vos filleuls de niveau 2.</li>
                <li>Vous pouvez rendre votre journal payant et en faire payer chaque accès.</li>
                <li>90% des gains sont reversés aux membres.</li>
            </ul>
        <?php
    }elseif($langue=="en"){
        ?>
        <div style="padding:2px;">   
            <p>www.journalperso.fr is an <strong>online community of Internet users</strong> who speak on their newspapers about absolutely anyone they want. </p>
            <p>The site allows you to create <strong>personal journals online</strong> that can be put in private or in public and to freely give access or to make access pay. </p>
            <p>You can create several newspapers and in these logs you can write down everything you want your thoughts, your notes or articles or other (images, videos, files). </p>
            <p>For optimal use on computers, smartphones and tablets add the site to your favorites. </p>
            <p>We have developed <strong>a unique content writing system</strong> called MemoPlay. </p>
            <p>The more you have seen on your newspaper the better it will be ranked. </p>
            <p>If the site is successful it will be significantly improved. Your data remains confidential and will not be given to a third party. The site is fully secure. We wish you a good experience. </p>
            <p>By writing a newspaper he will be present on the site and on Google.</p>       
            <ul>
                <li>Payment from 1€.</li>
                <li>You earn 30% of the earnings of your level 1 referrals and 10% of your level 2 referrals.</li>
                <li>You can make your newspaper pay and have it paid for each access.</li>
                <li>90% of the winnings go to members.</li>
            </ul>
        </div>
        <?php
    }
    ?>
    <?php
}

// affiche les meilleurs journaux
function afficher_meilleurs_journaux(){
    $langue = langue();
    ?>
        <center>
        <table>
            <?php 
            // affiche les 30 premiers journaux connus
            afficher_journaux_connus(30); 
            ?>
        </table>
        <form action="recherche.html" method="post">
            <div class="input-group mb-3">
                <input type="text" name="recherche" class="form-control" placeholder="<?php if($langue=="fr"){echo "Rechercher un journal...";}elseif($langue=="en"){echo"Search a journal...";} ?>" aria-label="<?php if($langue=="fr"){echo "Rechercher un journal";}elseif($langue=="en"){echo"Search a journal";} ?>" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><?php if($langue=="fr"){echo "Rechercher";}elseif($langue=="en"){echo"Search";} ?></button>
                </div>
            </div>
        </form>
        </center>
<?php
}

// affiche les meilleurs journaux en carte
function afficher_meilleurs_journaux_card(){
    $langue = langue();
    // recherche dans les journaux les 4 les plus connus
    $requete = "SELECT id, nom, description FROM `journaux` ORDER BY vues DESC LIMIT 0, 4";
    $reponse = select_bdd($requete);
    while ($rep = $reponse->fetch()){
            $nom = $rep["nom"];
            $description = $rep["description"];
            $id = $rep["id"];
            // affiche la carte pour le journal plus connus avec ses infos
            ?>
            <div class="card text-center card-journaux-connus" style="">
            <div class="card-body">
                <div style="height:100px;overflow-y: scroll;">
                    <h5 class="card-title"><strong><?php echo $nom; ?></strong></h5>
                    <p class="card-text"><?php echo $description; ?></p>
                </div><br>
                <a target="_blank" href="https://www.journalperso.fr/journal-<?php echo $id;?>.html" class="btn btn-primary"><?php if($langue=="fr"){echo "Visiter";}elseif($langue=="en"){echo"Visit";} ?></a>
            </div>
            </div>
            <?php 
    }
    ?>
<?php
}

// affiche les meilleurs journaux sans recherche
function afficher_meilleurs_journaux2(){
    $langue = langue();
    ?>
        <center>
        <table>
            <?php 
            // affiche les 100 journaux les plus connus
            afficher_journaux_connus(100); 
            ?>
        </table>
        </center>
<?php
}

// affiche les meilleurs journaux sans recherche
function afficher_meilleurs_journaux3(){
    $langue = langue();
    ?>
        <center>
        <table>
            <?php 
            // affiche les 30 journaux les plus connus
            afficher_journaux_connus2(30); 
            ?>
        </table>
        </center>
<?php
}

//affiche le head html
function afficher_head($title, $description){
?>
        <!-- Affiche les metas pour les recherches -->
        <meta name="Content-Type" content="UTF-8">
        <meta name="Content-Language" content="fr">
        <meta name="Description" content="www.journalperso.fr est une communauté d’internautes en ligne qui s’exprime sur leurs journaux d’absolument tout ceux qu’ils veulent. Le site permet de créer des journaux personnels en ligne que l’ont peut mettre en privé ou en public et en donner librement l’accès ou en faire payer l’accès. Vous pouvez créer plusieurs journaux et dans ces journaux vous pouvez y noter tout ce que vous vous voulez vos pensées, vos notes ou articles ou autres (images, vidéos, fichiers).">
        <meta name="Subject" content="Journalisme">
        <meta name="Copyright" content="Journalperso.fr">
        <meta name="Author" content="Ange-José Michelin">
        <meta name="Publisher" content="Ange-José Michelin">
        <meta name="Identifier-Url" content="https://www.journalperso.fr">
        <meta name="Reply-To" content="webmaster@journalperso.fr">
        <meta name="Revisit-After" content="1 day">
        <meta name="Robots" content="all">
        <meta name="Rating" content="general">
        <meta name="Distribution" content="global">
        <meta name="Geography" content="france">
        <meta name="Category" content="literature">
        <meta name="DC.Content-Type" content="UTF-8">
        <meta name="DC.Content-Language" content="fr">
        <meta name="DC.Description" content="www.journalperso.fr est une communauté d’internautes en ligne qui s’exprime sur leurs journaux d’absolument tout ceux qu’ils veulent. Le site permet de créer des journaux personnels en ligne que l’ont peut mettre en privé ou en public et en donner librement l’accès ou en faire payer l’accès. Vous pouvez créer plusieurs journaux et dans ces journaux vous pouvez y noter tout ce que vous vous voulez vos pensées, vos notes ou articles ou autres (images, vidéos, fichiers).">
        <meta name="DC.Subject" content="Journalisme">
        <meta name="DC.Copyright" content="Journalperso.fr">
        <meta name="DC.Author" content="Ange-José Michelin">
        <meta name="DC.Publisher" content="Ange-José Michelin">
        <meta name="DC.Identifier-Url" content="https://www.journalperso.fr">
        <meta name="DC.Reply-To" content="webmaster@journalperso.fr">
        <meta name="DC.Revisit-After" content="1 day">
        <meta name="DC.Robots" content="all">
        <meta name="DC.Rating" content="general">
        <meta name="DC.Distribution" content="global">
        <meta name="DC.Geography" content="france">
        <meta name="DC.Category" content="literature">

        <!-- Liens vers elements et fichiers utiles -->
        <link rel="stylesheet" href="ressources/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" href="ressources/css/styles.css"/>
        <link rel="stylesheet" href="ressources/jquery-ui/jquery-ui.css"/>    
        <link rel="stylesheet" href="ressources/jquery-ui/jquery-ui.theme.css"/>
        <link rel="stylesheet" type="text/css" href="ressources/cleditor/jquery.cleditor.css"/>
        <link href="ressources/css/hover.css" rel="stylesheet" media="all">
        <script type="text/javascript" src="ressources/jquery/jquery.js"></script>
        <script type="text/javascript" src="ressources/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="ressources/cleditor/jquery.cleditor.min.js"></script>
        <script type="text/javascript" src="ressources/jquery-ui/jquery-ui.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!--<link rel="icon" href="src/img/favicon.ico" /> -->

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="ressources/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">  
        <meta name="viewport" content="width=device-width" />
        
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="ressources/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="ressources/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="ressources/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="ressources/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="ressources/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="ressources/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="ressources/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="ressourcesc/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="ressources/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="ressources/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="ressources/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="ressources/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="ressources/favicon/favicon-16x16.png">
        <link rel="manifest" href="ressources/favicon/manifest.json">

        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v3.3&appId=392499051612451&autoLogAppEvents=1"></script>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124340528-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-124340528-1');
        </script>
        
        <title><?php echo $title; ?></title>
<?php
}

//affiche le head html
function afficher_footer(){
    ?>
    <br>
        <!-- affiche le plugin facebook partage et like -->
        <iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/Journalpersofr-355630085163630&width=300&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId" width="300" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        <!-- Affiche les reseaux sociaux -->
        <p><b>Instagram:</b> journalperso.fr | <b>Snapchat:</b> angemichelin75 | <b>Facebook:</b> journalperso.fr</p>
        <!-- Affiche les infos relatives au site et aux contacts -->
        <p style="font-size:0.9em;">® Journalperso.fr 2018-<?php echo date('Y');?> - webmaster@journalperso.fr - Partenaires: <a href="http://www.écris.com">http://www.écris.com</a></p>
        <br><script type="text/javascript" src="ressources/js/langue.js"></script>
    <?php
}