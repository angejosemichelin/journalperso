<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>R</b>echerche";}elseif($langue=="en"){echo"<b>S</b>earch";} ?></h1>
<div class="contenu-centre">
<?php 
$recherche = isset($_POST["recherche"]) ? filter_input(INPUT_POST, 'recherche', FILTER_SANITIZE_STRING) : null;
afficher_resultats_recherche($recherche);
?>
</div>