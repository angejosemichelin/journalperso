<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>D</b>emande de paiement";}elseif($langue=="en"){echo"<b>P</b>ayment";}?></h1>
<div class="contenu-centre">
<?php 
if(affiche_solde($_SESSION['id']) >= 1){
?>
<form action="" method="post">
<input type="hidden" name="paiement" value="ok">
<center><button type="submit" style="margin:20px auto;display:block;" class="hvr-float-shadow btn btn-primary" data-toggle="modal" data-target="#creer">
  <?php if($langue=="fr"){echo "Etre payé ".affiche_solde($_SESSION['id'])."€";}elseif($langue=="en"){echo "Be pay ".affiche_solde($_SESSION['id'])."€";}?>
</button></center>
</form>
<?php
} else {
    if($langue=="fr"){
        echo "Pour être payer un minimum de 1€ est demander, alors au travail!";
    }elseif($langue=="en"){
        echo"To be pay 1€ minimum.";
    }
}
if(isset($_POST["paiement"])){
    $solde = affiche_solde($_SESSION['id']);
    if(mail("angejosemichelin@gmail.com", 'Demande de paiement', 'L utilisateur dont l id est '.$_SESSION['id'].' demande un paiement de '.$solde.'€')){
        $valeurs = [
            "id" => null,
            "id_user" => $_SESSION['id'],
            "montant" => -$solde,
            "date" => date("Y-m-d H:i:s"),
            "description" => "Demande de paiement id=".$_SESSION['id']
        ];
        insert_bdd("paiements", $valeurs);
        notifier($_SESSION['id'], date("Y-m-d"), "Paiement de ".$solde."€");
        echo "<script>alert('Votre demande de paiement a bien été effectuer vous receverez votre paiement dans les 10 jours.');window.location.replace('https://www.journalperso.fr/demande-paiement.html');</script>";
    }
}
?>
</div>