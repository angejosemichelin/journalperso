<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>S</b>tatistiques";}elseif($langue=="en"){echo"<b>S</b>tatistics";}?></h1>
<div class="contenu-centre">
<div>
    <?php if($langue=="fr"){echo "Votre solde:";}elseif($langue=="en"){echo"Your balance:";} ?> <strong><?php echo affiche_solde($_SESSION['id']); ?>€</strong><br>
    <?php if($langue=="fr"){echo "Nombre total de vues sur vos journaux:";}elseif($langue=="en"){echo"Total number of views on your journals";} ?> <strong><?php echo nbr_vues_journaux($_SESSION['id']); ?></strong><br>
</div>
</div>