        <?php
        // On inclus les fonctions php
        include('fonctions/fonctions.php');
        $langue = langue();
        enligne();
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <?php 
            // on recupère l'id du journal
            $id_journal = isset($_GET["id"]) ? $_GET["id"] : null;
            // on recupère le nom et prenom de l'utilisateur
            $nom_prenom = nom_prenom_de_journal($id_journal);
            // on recupere le nom du journal
            $nom_journal = recuperer_nom_journal($id_journal);
            // on recupere la description
            $description_journal = recuperer_description_journal($id_journal);

            if($langue=="fr"){$texte="Journal personnel de ".$nom_prenom;}elseif($langue=="en"){$texte="Personnal journal of ".$nom_prenom;}
            afficher_head("Journalperso.fr - ".$nom_journal, $texte); 
            if(isset($_POST["mot_de_passe_journal"])){
                if($_POST["mot_de_passe_journal"] == mot_de_passe($id_journal)){
                    $acceder_journal = true;
                }
            }
            ?> 
        </head>
        <body>
    <!-- WRAPPER -->
    <div id="wrapper2">
        <header>
            <div class="langues">
                <a id="fr" href="#"><img src="ressources/img/francais.png" alt="Passer en langue française sur le site innternet de journalisme journalperso.fr" /></a>
                <a id="en" href="#"><img src="ressources/img/anglais.png" alt="Passer en langue anglaise sur le site innternet de journalisme journalperso.fr" /></a>
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
        <?php  
        if(!$acceder_journal){
            if(payant($id_journal) == 1){
                ?>
                    <div class="fond_gris"></div>
                    <div class="modal messsage_fond_gris" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><strong><?php echo $nom_journal; ?></strong></h5>
                            </div>
                            <div class="modal-body">
                                    <form action="journal-<?php echo $id_journal; ?>.html" method="post">
                                        <?php
                                            if($langue=="fr"){
                                                input("password", "Mot de passe du journal:", "mot_de_passe_journal", "mot_de_passe_journal", "Entrez le mot de passe du journal", true, "");
                                            }elseif($langue=="en"){
                                                input("password", "Password of the journal:", "mot_de_passe_journal", "mot_de_passe_journal", "Enter the password of the journal", true, "");
                                            }
                                        ?>
                                        <button class="hvr-float-shadow btn btn-primary" type="submit"><?php if($langue=="fr"){echo "Acceder au journal";}elseif($langue=="en"){echo"Access to journal";} ?></button>
                                    </form>
                            </div>
                            <div class="modal-footer">
                                <a href="index.php?page=paiement-mdp-journal&id=198<?php echo $id_journal; ?>" class="hvr-float-shadow btn btn-primary"><?php if($langue=="fr"){echo "Obtenir le code";}elseif($langue=="en"){echo"Get the code";} ?></a>
                            </div>
                            </div>
                        </div>
                    </div>
                <?php
            }  
        }      
                // On affichage le nom du détenteur du journal personnel
                ?>
                <h1 class="h1"><?php if($langue=="fr"){echo "<b>J</b>ournal personnel: ";}elseif($langue=="en"){echo"<b>P</b>ersonal journal: ";} ?> <?php echo $nom_journal; ?></h1>
                <?php
                //On ajoute une vue
                $date_du_jour = date("Y-m-d");
                $adresse_ip = $_SERVER['REMOTE_ADDR'];
                ajouter_vue_journal($adresse_ip, $date_du_jour, $id_journal);

        ?>
        <center>
            <h2>Journal de <?php echo $nom_prenom; ?></h2>
            <p><?php echo $description_journal; ?></p>
        </center>
        <br><br>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php if($langue=="fr"){echo "Ecrire un commentaire";}elseif($langue=="en"){echo"Write a comment";} ?></h5>
                <button type="button" class="hvr-float-shadow close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                        <?php
                            if($langue=="fr"){
                                input("text", "Nom et prénom:", "nom_prenom_com", "nom_prenom_com", "Nom et prénom", true, "");
                            }elseif($langue=="en"){
                                input("text", "Nom et prénom:", "nom_prenom_com", "nom_prenom_com", "Nom et prénom", true, "");
                            }
                        ?>
                        <label>Commentaire:</label>
                        <textarea class="form-control" rows="4" id="commentaire" name="commentaire" required aria-label="Ecrire un commentaire..."></textarea>
                        <script>
                            function envoi_data(idpub){
                                $('#data').append('<input type="hidden" name="idpub" value="'+idpub+'">');
                            }
                        </script>
                        <div id="data"></div><br>
                        <div class="g-recaptcha" data-sitekey="6LdYjq4UAAAAAHlU2nTmBfyVJG4FlhhZZv8JnD2J"></div>
                        <center><br><button type="submit" class="hvr-float-shadow centrer btn btn-primary">Poster</button></center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="hvr-float-shadow btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
            </div>
        </div>
        </div>
        <?php
            $googleResponse = false;
            // Ma clé privée
            $secret = "6LdYjq4UAAAAAKeb7ErdzasLjf8HNz184XlmGoqb";
            // Paramètre renvoyé par le recaptcha
            $response = $_POST['g-recaptcha-response'];
            // On récupère l'IP de l'utilisateur
            $remoteip = $_SERVER['REMOTE_ADDR'];
            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$remoteip;
            $decode = json_decode(file_get_contents($api_url), true);
            if ($decode['success'] == true) {
                $googleResponse = true;
            }else {
                $googleResponse = false;
            }

            // si les infos entrer dans le formulaire sont correctes
            if ($googleResponse == true && isset($_POST["nom_prenom_com"]) && isset($_POST["commentaire"]) && !empty($_POST["nom_prenom_com"]) && !empty($_POST["commentaire"])){
                $nom_prenom = filter_input(INPUT_POST, 'nom_prenom_com', FILTER_SANITIZE_STRING);
                $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);
                $idpub = filter_input(INPUT_POST, 'idpub', FILTER_SANITIZE_STRING);
                commenter($idpub, $nom_prenom, $commentaire);
                $id_user = recup_id($id_journal);
                notifier($id_user, date("Y-m-d"), "Commentaire de ".$nom_prenom ." sur une publication");
                echo '<script>alert("Commentaire publié !");</script>';
            }
        ?>
        <!-- Affichage des publication de la personne concerné en fonction de la methode get de la page -->
        <div id="publications">
                <?php 
                // on affiche les publications
                afficher_publications_simple($id_journal);
                ?>
        </div>
    </div>
        <script type="text/javascript" src="ressources/js/resize_image.js"></script>
        <br>
        <!-- FOOTER -->
        <footer>
            <?php afficher_footer(); ?>
        </footer>
    </body>
    </html>