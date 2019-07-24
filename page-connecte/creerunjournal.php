<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>C</b>réer un journal";}elseif($langue=="en"){echo"<b>C</b>reate a journal";}?></h1>
<div class="contenu-centre">
<!-- Button trigger modal -->
<button type="button" style="margin:20px auto;display:block;" class="hvr-float-shadow btn btn-primary" data-toggle="modal" data-target="#creer">
  --- <?php if($langue=="fr"){echo "Creer un journal";}elseif($langue=="en"){echo "Create a journal";}?> ---
</button>
<p style="text-align:center;"><?php if($langue=="fr"){echo "En écrivant un journal il sera présent sur le site et sur Google.";}elseif($langue=="en"){echo "By writing a newspaper he will be present on the site and on Google.";}?></p>
<!-- Modal -->
<div class="modal fade" id="creer" tabindex="-1" role="dialog" aria-labelledby="creer" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="creerunjournal.html" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="creer"><?php if($langue=="fr"){echo "Créer un journal";}elseif($langue=="en"){echo "Create a journal";}?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
            if($langue=="fr"){
                input("text", "Nom du Journal:", "nom_journal", "nom_journal", "Nom du Journal", true, "");
            }elseif($langue=="en"){
                input("text", "Name of Journal:", "nom_journal", "nom_journal", "Nom du Journal", true, "");
            }
        ?>
      <div class="form-group">
        <label for="description"><?php if($langue=="fr"){echo "Description";}elseif($langue=="en"){echo "Description";}?></label>
        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php if($langue=="fr"){echo "Fermer";}elseif($langue=="en"){echo "Close";}?></button>
        <button type="submit" class="btn btn-primary"><?php if($langue=="fr"){echo "Enregistrer";}elseif($langue=="en"){echo "Save";}?></button>
      </div>
      </form>
    </div>
  </div>
</div>
<style>
  @media screen and (max-width: 800px){
    .table-crea {
      width:350px;
      display:block;
      margin:0 auto;
    }
    .contenu-centre{
      padding:0;
    }
  }
</style>
<div class="table-crea table-responsive">
<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"><?php if($langue=="fr"){echo "Nom du Journal";}elseif($langue=="en"){echo "Name of journal";}?></th>
      <th scope="col"><?php if($langue=="fr"){echo "Lien du journal";}elseif($langue=="en"){echo "Link of journal";}?></th>
      <th scope="col"><?php if($langue=="fr"){echo "Mot de passe";}elseif($langue=="en"){echo "Password";}?></th>
      <th scope="col"><?php if($langue=="fr"){echo "Nombre de vues";}elseif($langue=="en"){echo "Number of views";}?></th>
      <th scope="col"><?php if($langue=="fr"){echo "Options";}elseif($langue=="en"){echo "Options";}?></th>
    </tr>
  </thead>
  <tbody>
  <?php 
  //Affiche les journaux créé dans le tableau
    afficher_les_journaux($_SESSION["id"]);
  ?>
  </tbody>
</table>
</div>
<?php
// Si un article est publié par la methode post on execute la fonction publier_text
    if (isset($_POST["nom_journal"]) && isset($_POST["description"])){
        if(!empty($_POST["description"]) && !empty($_POST["nom_journal"]) && strlen($_POST['nom_journal']) < 60 && strlen($_POST['description']) < 400){
            $nom_journal = filter_input(INPUT_POST, 'nom_journal', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            creer_journal($_SESSION["id"], $description, $nom_journal);
            notifier($_SESSION['id'], date("Y-m-d"), "Vous avez créez le journal ".$nom_journal);
        } else {
            echo "Veuillez remplir correctement le formulaire.";
        }
    }
?>
<?php
// on peut supprimer une publication
if (isset($_GET["suppr-id"])){
    $id_journal = $_GET["suppr-id"];
    supprimmer_journal($id_journal);
}
?>
</div>