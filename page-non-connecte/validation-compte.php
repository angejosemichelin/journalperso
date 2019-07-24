<?php
$langue = langue();
?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>V</b>alidation compte";}elseif($langue=="en"){echo"<b>A</b>ccount validation";} ?></h1>
<div class="contenu-centre">
<?php
if(isset($_GET['valide'])){
    $chiffre = $_GET['valide'];
    $chiffre_compte = chiffre_compte_valide($_GET['email']);
    if($chiffre == $chiffre_compte){
        ?>
        <?php      
        valide_compte($_GET['email']);
        if($langue=="fr"){echo "Votre compte est validé.";}elseif($langue=="en"){echo"Your account is valided.";}
    }
} else {
    if($langue=="fr"){echo "Erreur.";}elseif($langue=="en"){echo"Error.";}
}
?>
<br>
<center><a href="https://journalperso.fr/connexion.html" alt="Créez votre premier journal"><img class="hvr-grow" style="display:block;margin:0 auto;" src="ressources/img/bouton-aide.png" alt="Créez votre premier journal" /></a></center>
</div>