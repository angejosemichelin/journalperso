    <?php 
    $langue = langue(); 
        // on recupère l'id du journal
    $id_journal = $_GET["id"];
    $id_user_journal = id_user_de_journal($id_journal);
    if($id_user_journal == $_SESSION["id"]){
        ?>
        <h1 class="h1"><?php if($langue=="fr"){echo "<b>E</b>crire votre journal: ".recuperer_nom_journal($id_journal);}elseif($langue=="en"){echo"<b>W</b>rite your journal: ".recuperer_nom_journal($id_journal);} ?></h1>
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" style="margin:0;padding:0;" id="headingOne">
              <h2 class="mb-0">
              <button class="btn btn-link violet" style="font-weight:bold;text-decoration:none;" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <?php if($langue=="fr"){echo "Mot de passe du journal";}elseif($langue=="en"){echo"Password of journal";} ?>
              </button>
          </h2>
      </div>
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body"> 
            <?php
            if($langue=="fr"){
                ?>
                <span>Par default le mot de passe est: "journalperso".</span>
                <span>Votre mot de passe est: "<?php echo recuperer_mot_de_passe_journal($id_journal); ?>".</span>
                <?php
            }elseif($langue=="en"){
                ?>
                <span>By default the password is: "journalperso".</span>
                <span>Your password is: "<?php echo recuperer_mot_de_passe_journal($id_journal); ?>".</span>
                <?php
            }
            ?>
            <div id="mot_de_passe_journal_div">
                <form action="modifier-journal-<?php echo $id_journal; ?>.html" method="post">
                    <?php
                    if($langue=="fr"){
                        input("password", "Mot de passe de votre journal:", "mot_de_passe_journal", "mot_de_passe_journal", "Entrez le mot de passe de votre journal", true, "");
                    }elseif($langue=="en"){
                        input("password", "Password of your journal:", "mot_de_passe_journal", "mot_de_passe_journal", "Enter the password of your journal", true, "");
                    }
                    ?>
                    <center><button class="hvr-float-shadow btn btn-primary" type="submit"><?php if($langue=="fr"){echo "Modifier";}elseif($langue=="en"){echo"Edit";} ?></button></center>
                </form>
            </div>
            <?php
            if(isset($_POST["mot_de_passe_journal"])){
                $valeurs = [
                    'mot_de_passe_journal' => $_POST["mot_de_passe_journal"],
                    'id' => $id_journal
                ];
                update_bdd("UPDATE journaux SET mot_de_passe = :mot_de_passe_journal WHERE id = :id", $valeurs);
                echo "Mot de passe du journal modifier.";
            }
            ?>        
        </div>
    </div>
    </div>
    <div class="card">
        <div class="card-header" style="margin:0;padding:0;" id="headingTwo">
          <h2 class="mb-0">
          <button class="btn btn-link collapsed violet" style="font-weight:bold;text-decoration:none;" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <?php if($langue=="fr"){echo "Parametres";}elseif($langue=="en"){echo"Settings";} ?>
            </button>
        </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <?php
                    // Classé la personne
        if (isset($_GET['payant']))
        {
            if($_GET['payant'] == "1"){
                etre_payant($id_journal, 1);
            } elseif($_GET['payant'] == "0"){
                etre_payant($id_journal, 0);
            }
        }
        if(payant($id_journal) == "1"){
            ?>
            <a class="a_button" href="payant-<?php echo $id_journal; ?>-0.html"><?php if($langue=="fr"){echo "Passer en journal libre";}elseif($langue=="en"){echo"Switch to free journal";} ?></a>
            <?php
        } elseif(payant($id_journal) == "0"){
            ?>
            <a class="a_button" href="payant-<?php echo $id_journal; ?>-1.html"><?php if($langue=="fr"){echo "Passer en journal privé";}elseif($langue=="en"){echo"Switch to private journal";} ?></a>
            <?php
        }
        ?>
    </div>
    </div>
    </div>
    <div class="card">
        <div class="card-header" style="margin:0;padding:0;" id="headingThree">
          <h2 class="mb-0">
          <button class="btn btn-link collapsed violet" style="font-weight:bold;text-decoration:none;" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <?php if($langue=="fr"){echo "Lien du journal";}elseif($langue=="en"){echo"Link of journal";} ?>
            </button>
        </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <div style="margin-top:10px;" class="alert alert-dark" role="alert">
            <strong><?php if($langue=="fr"){echo "Lien pour partager votre journal:";}elseif($langue=="en"){echo"Link to share your journal:";} ?></strong> <a href="https://www.journalperso.fr/journal-<?php echo $id_journal;?>.html" target="_blank" alt="<?php echo recuperer_nom_journal($id_journal); ?>">https://www.journalperso.fr/journal-<?php echo $id_journal;?>.html</a>
        </div>
    </div>
    </div>
    </div>
    </div>
    <br>
    <!-- BLOC FORMULAIRE PUBLIER -->
    <div id="publier">
        <div id="ecrire_texte">
            <h3 style="color:white;font-weigth:bold;text-align:center;"><b>MEMO PLAY</b></h3>
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1"><?php if($langue=="fr"){echo "Ecrire";}elseif($langue=="en"){echo"Write";} ?></a></li>
                    <li><a href="#tabs-3"><?php if($langue=="fr"){echo "Images";}elseif($langue=="en"){echo"Pictures";} ?></a></li>
                    <li><a href="#tabs-4"><?php if($langue=="fr"){echo "Videos";}elseif($langue=="en"){echo"Videos";} ?></a></li>
                    <li><a href="#tabs-5"><?php if($langue=="fr"){echo "Fichiers";}elseif($langue=="en"){echo"Files";} ?></a></li>
                    <li><a href="#tabs-2"><?php if($langue=="fr"){echo "Dessiner";}elseif($langue=="en"){echo"Draw";} ?></a></li>
                </ul>
                <div style="text-align:center;" id="tabs-1">
                    <?php if($langue=="fr"){echo "Uniquement sur PC";}elseif($langue=="en"){echo"Only on PC";} ?>
                    <div id="div_texte_pc">
                        <form action="modifier-journal-<?php echo $id_journal; ?>.html" method="post">
                            <div class="align-center-90" class="input-group">
                                <textarea class="form-control" rows="4" id="texte" name="texte" aria-label="Votre texte"></textarea>
                            </div>
                            <center><button type="submit" class="hvr-float-shadow publier_btn btn btn-primary"><?php if($langue=="fr"){echo "Publier";}elseif($langue=="en"){echo"Publish";} ?></button></center>
                            <input type="hidden" name="publier_text_pc" value="true" />
                        </form>
                    </div>
                    <div id="div_texte_smartphone">
                        <form action="modifier-journal-<?php echo $id_journal; ?>.html" method="post">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><?php if($langue=="fr"){echo "Taper:";}elseif($langue=="en"){echo"Type:";} ?></span>
                                </div>
                                <textarea class="form-control" rows="4" name="texte" aria-label="Votre texte"></textarea>
                            </div>
                            <center><button type="submit" class="hvr-float-shadow publier_btn btn btn-primary"><?php if($langue=="fr"){echo "Publier";}elseif($langue=="en"){echo"Publish";} ?></button></center>
                            <input type="hidden" name="publier_text_smartphone" value="true" />
                        </form>
                    </div>
                </div>
                <div style="text-align:center;" id="tabs-2">
                    <?php if($langue=="fr"){echo "Uniquement sur PC";}elseif($langue=="en"){echo"Only on PC";} ?>
                    <div id="div_dessin">
                        <div class="palette">
                            <span onclick="changecouleur('#000'); bigHeight('4')" style="background:#000"></span>
                            <span onclick="changecouleur('#606060'); bigHeight('4')" style="background:#606060"></span>
                            <span onclick="changecouleur('#AAAAAA'); bigHeight('4')" style="background:#AAAAAA"></span>
                            <span onclick="changecouleur('#FFF'); bigHeight('4')" style="background:#FFF"></span>
                            <span onclick="changecouleur('#FF0000'); bigHeight('4')" style="background:#FF0000"></span>
                            <span onclick="changecouleur('#FF8000'); bigHeight('4')" style="background:#FF8000"></span>
                            <span onclick="changecouleur('#FFFF00'); bigHeight('4')" style="background:#FFFF00"></span>
                            <span onclick="changecouleur('#80FF00'); bigHeight('4')" style="background:#80FF00"></span>
                            <span onclick="changecouleur('#00FF00'); bigHeight('4')" style="background:#00FF00"></span>
                            <span onclick="changecouleur('#00FF80'); bigHeight('4')" style="background:#00FF80"></span>
                            <span onclick="changecouleur('#00FFFF'); bigHeight('4')" style="background:#00FFFF"></span>
                            <span onclick="changecouleur('#0080FF'); bigHeight('4')" style="background:#0080FF"></span>
                            <span onclick="changecouleur('#0000FF'); bigHeight('4')" style="background:#0000FF"></span>
                            <span onclick="changecouleur('#8000FF'); bigHeight('4')" style="background:#8000FF"></span>
                            <span onclick="changecouleur('#FF00FF'); bigHeight('4')" style="background:#FF00FF"></span>
                            <span onclick="changecouleur('#FF0080'); bigHeight('4')" style="background:#FF0080"></span>
                        </div>
                        <div class="gomme">
                            <span onclick="changecouleur('#FFF'); bigHeight('300')" style="background:#FFF"></span>
                        </div>
                        <div id="div_dessin">
                            <p id="id_journal" style="display:none;"><?php echo $id_journal; ?></p>
                            <?php
                            if($langue=="fr"){
                                input("text", "Decrivez votre dessin:", "description_dessin", "description_dessin", "Decrivez votre dessin", true, "");
                            }elseif($langue=="en"){
                                input("text", "Describe your drawing:", "description_dessin", "description_dessin", "Describe your dessin", true, "");
                            }
                            ?>
                            <canvas id="dessin" width="500" height="300"></canvas> 
                            <center><input id="publier_dessin" class="hvr-float-shadow publier_btn btn btn-primary" value="<?php if($langue=="fr"){echo "Publier";}elseif($langue=="en"){echo"Publish";} ?>"></center>
                            <script>
                                $("#publier_dessin").click(function(){
                                    $.ajax({
                                        type: "POST",
                                        url: 'page-connecte/envoi_canvas.php',
                                        dataType: 'text',
                                        data:  {
                                            image : document.getElementById("dessin").toDataURL(),
                                            id : document.getElementById("id_journal").innerHTML,
                                            description: document.getElementById("description_dessin").value
                                        }
                                    });
                                    window.alert('<?php if($langue=="fr"){echo "Pour voir votre dessin cliquez ici.";}elseif($langue=="en"){echo"To see your drawing click here.";} ?>');
                                    window.location.reload(true);
                                });
                            </script>
                        </div>  
                    </div>   
                </div>
                <div id="tabs-3">
                    <form enctype="multipart/form-data" action="modifier-journal-<?php echo $id_journal; ?>.html" method="POST">
                        <div class="telecharger" class="form-group">
                            <p><?php if($langue=="fr"){echo "Modifiez le nom de votre fichier en fonction de ce qu'il contient. Exemple: chateau-versaille.png ou bonjour.gif";}elseif($langue=="en"){echo"Change the name of your file according to what it contains. Example: chateau-versaille.png or hello.gif";} ?></p>
                            <label for="image"><?php if($langue=="fr"){echo "Télécharger une image (JPG, PNG ou GIF)";}elseif($langue=="en"){echo"Download an image (JPG, PNG or GIF)";} ?></label>
                            <input type="file" class="form-control-file" id="image" name="uploaded_file_image">
                            <?php
                            if($langue=="fr"){
                                input("text", "Decrivez votre image:", "description_image", "description_image", "Decrivez votre image", true, "");
                            }elseif($langue=="en"){
                                input("text", "Describe your image:", "description_image", "description_image", "Describe your image", true, "");
                            }
                            ?>
                        </div>
                        <center><input type="submit" class="hvr-float-shadow publier_btn btn btn-primary" value="<?php if($langue=="fr"){echo "Télécharger et publier";}elseif($langue=="en"){echo"Download and publish";} ?>"></center>
                    </form>
                </div>
                <div id="tabs-4">
                    <form enctype="multipart/form-data" action="modifier-journal-<?php echo $id_journal; ?>.html" method="POST">
                        <div class="telecharger" class="form-group">
                            <p><?php if($langue=="fr"){echo "Modifiez le nom de votre fichier en fonction de ce qu'il contient. Exemple: video-de-mon-chien.mp4 ou bonjour.gif";}elseif($langue=="en"){echo"Change the name of your file according to what it contains. Example: video-of-my-dog.mp4";} ?></p>
                            <label for="video"><?php if($langue=="fr"){echo "Télécharger une video (MP4)";}elseif($langue=="en"){echo"Download an video (MP4)";} ?></label>
                            <input type="file" class="form-control-file" id="video" name="uploaded_file_video">
                        </div>
                        <center><input type="submit" class="hvr-float-shadow publier_btn btn btn-primary" value="<?php if($langue=="fr"){echo "Télécharger et publier";}elseif($langue=="en"){echo"Download and publish";} ?>"></center>
                    </form>
                </div>
                <div id="tabs-5">
                    <form enctype="multipart/form-data" action="modifier-journal-<?php echo $id_journal; ?>.html" method="POST">
                        <div class="telecharger" class="form-group">
                            <p><?php if($langue=="fr"){echo "Modifiez le nom de votre fichier en fonction de ce qu'il contient. Exemple: liste-adresse-email.txt";}elseif($langue=="en"){echo"Change the name of your file according to what it contains. Example: liste-email-adresses.txt";} ?></p>
                            <label for="fichier"><?php if($langue=="fr"){echo "Télécharger n'importe quel fichier (max.50Mo)";}elseif($langue=="en"){echo"Download any file (max.50Mo)";} ?></label>
                            <input type="file" class="hvr-float-shadow form-control-file" id="fichier" name="uploaded_file">
                            <?php
                            if($langue=="fr"){
                                input("text", "Decrivez votre Fichier:", "description_fichier", "description_fichier", "Decrivez votre fichier", true, "");
                            }elseif($langue=="en"){
                                input("text", "Describe your file:", "description_fichier", "description_fichier", "Describe your file", true, "");
                            }
                            ?>
                        </div>
                        <center><input type="submit" class="hvr-float-shadow publier_btn btn btn-primary" value="<?php if($langue=="fr"){echo "Télécharger et publier";}elseif($langue=="en"){echo"Download and publish";} ?>"></center>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <?php
        // on recupère l'id de l'utilisateur
        $id_user = $_SESSION["id"];
        // Si un article est publié par la methode post on execute la fonction publier_text
        if (isset($_POST["publier_text_pc"]) && !empty($_POST["texte"])){
            $texte = $_POST["texte"];
            // On publie
            publier_texte($texte, $id_journal);
        }

        // Si un article est publié par la methode post on execute la fonction publier_text
        if (isset($_POST["publier_text_smartphone"]) && !empty($_POST["texte"])){
            $texte = filter_input(INPUT_POST, 'texte', FILTER_SANITIZE_STRING);
            // On publie
            publier_texte($texte, $id_journal);
        }

        // On upload les fichiers
        if(!empty($_FILES['uploaded_file'])){
            if(isset($_POST["description_fichier"])){
                if($_FILES['uploaded_file_image']['size'] < 1048576*50){
                    $path = "publications/fichiers/";
                    $path = $path.basename($_FILES['uploaded_file']['name']);
                    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
                        publier_fichier($path, $_POST["description_fichier"], $id_journal);
                        if($langue=="fr"){        
                            echo "Le fichier ".basename($_FILES['uploaded_file']['name'])." à été télécharger et publier.";
                        }elseif($langue=="en"){
                            echo "The file ".basename($_FILES['uploaded_file']['name'])." has been downloaded and published.";
                        }
                    } else {
                        if($langue=="fr"){echo "Erreur lors du téléchargement du fichier.";}elseif($langue=="en"){echo"Error uploading the file.";}
                    }
                } else {
                    if($langue=="fr"){echo "Erreur lors du téléchargement du fichier.";}elseif($langue=="en"){echo"Error uploading the file.";}
                }
            } else {
                if($langue=="fr"){echo "Erreur dans le formulaire.";}elseif($langue=="en"){echo"Error in form.";}
            }
        }

        // On upload les images
        if(!empty($_FILES['uploaded_file_image'])){
            if(isset($_POST["description_image"])){
                if($_FILES['uploaded_file_image']['type'] == 'image/png' || $_FILES['uploaded_file_image']['type'] == 'image/jpeg' || $_FILES['uploaded_file_image']['type'] == 'image/gif'){
                    $path = "publications/images/";
                    $path = $path.basename($_FILES['uploaded_file_image']['name']);
                    if(move_uploaded_file($_FILES['uploaded_file_image']['tmp_name'], $path)) {
                        publier_image($path, $_POST["description_image"], $id_journal);
                        if($langue=="fr"){        
                            echo "Le fichier ".basename($_FILES['uploaded_file_image']['name'])." à été télécharger et publier.";
                        }elseif($langue=="en"){
                            echo "The file ".basename($_FILES['uploaded_file_image']['name'])." has been downloaded and published.";
                        }
                    } else {
                        if($langue=="fr"){echo "Erreur lors du téléchargement de l'image.";}elseif($langue=="en"){echo"Error uploading the image.";}
                    }
                } else {
                    if($langue=="fr"){echo "Erreur lors du téléchargement de l'image.";}elseif($langue=="en"){echo"Error uploading the image.";}
                }
            } else {
                if($langue=="fr"){echo "Erreur dans le formulaire.";}elseif($langue=="en"){echo"Error in form.";}
            }
        }

        // on upload les videos
        if(!empty($_FILES['uploaded_file_video'])){
            if($_FILES['uploaded_file_video']['type'] == 'video/mp4' && $_FILES['uploaded_file_video']['size'] < 1048576*50){
                $path = "publications/videos/";
                $path = $path . basename($_FILES['uploaded_file_video']['name']);
                if(move_uploaded_file($_FILES['uploaded_file_video']['tmp_name'], $path)) {
                    publier_video($path, $id_journal);
                    if($langue=="fr"){        
                        echo "Le fichier ".basename($_FILES['uploaded_file_video']['name'])." à été télécharger et publier.";
                    }elseif($langue=="en"){
                        echo "The file ".basename($_FILES['uploaded_file_video']['name'])." has been downloaded and published.";
                    }
                } else {
                    if($langue=="fr"){echo "Erreur lors du téléchargement de la video.";}elseif($langue=="en"){echo"Error uploading the video.";}
                }
            } else {
                if($langue=="fr"){echo "Erreur lors du téléchargement de la video.";}elseif($langue=="en"){echo"Error uploading the video.";}
            }
        }
        ?>
        <?php
    // on peut supprimer une publication
        if (isset($_GET["suppr-id"])){
            $id_message = $_GET["suppr-id"];
            supprimmer_publication($id_message);
        }
    // appel a la fonction
        afficher_publications_compte($id_journal);
        ?>
        <script type="text/javascript">
        // Gère la tabulation du MemoPlay
        $(function() {
            $("#tabs").tabs();
        });
        $(document).ready(function(){
            $("#texte").cleditor();
        });  
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script type="text/javascript" src="ressources/js/resize_image.js"></script>
    <script type="text/javascript" src="ressources/js/canvas.js"></script>
    <?php } ?>
    </div>