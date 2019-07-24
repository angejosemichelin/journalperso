<?php $langue = langue(); ?>
<h1 class="h1"><?php if($langue=="fr"){echo "<b>P</b>arrainnage";}elseif($langue=="en"){echo"<b>S</b>ponsorship";} ?></h1>
<div class="contenu-centre">
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
<?php
    if($langue=="fr"){
        ?>
        <div style="text-align:center">
            <p>A chaque fois qu'un filleul de niveau 1 vend un journal vous toucher 30%.</p>
            <p>A chaque fois qu'un filleul de niveau 2 vend un journal vous toucher 10%.</p>
            <p>Utilisez les réseaux sociaux ou tout autres moyens de transmissions mise à votre disposition.</p>
            <p>Vous avez <strong><?php echo nombre_filleul($_SESSION["id"]); ?> filleuls au total</strong>.</p>
            <p>Votre lien de parrainnage est le suivant: <a href="https://www.journalperso.fr?parrain=<?php echo $_SESSION['id']; ?>">https://www.journalperso.fr?parrain=<?php echo $_SESSION['id']; ?></a></p>
        </div>
        <br><br>
        <center>
        <p><b>Voici une bannière de parrainnage faites pour vous (installez la ou vous voulez):</b></p>
        <a href="https://www.journalperso.fr?parrain=<?php echo $_SESSION['id']; ?>"><img src="https://www.journalperso.fr/plus/banniere-468-glob.png" alt="bannières parrainage"></a>
        <br><textarea cols="60"><a href="https://www.journalperso.fr?parrain=<?php echo $_SESSION['id']; ?>"><img src="https://www.journalperso.fr/plus/banniere-468-glob.png" alt="bannières parrainage"></a></textarea>
        </center>
        <?php
    }elseif($langue=="en"){
        ?>
        <div style="text-align:center">
            <p>Whenever a level 1 godson sells a newspaper you get 30%.</p>
            <p>Every time a level 2 godson sells a newspaper, you get 10%.</p>
            <p>Use social networks or any other means of communication available to you.</p>
            <p>You have <strong><?php echo nombre_filleul($_SESSION["id"]); ?> godson</strong>.</p>
            <p>Your referral link is: <a href="https://www.journalperso.fr?parrain=<?php echo $_SESSION['id']; ?>">https://www.journalperso.fr?parrain=<?php echo $_SESSION['id']; ?></a></p>
        </div>
        <br><br>
        <center>
        <p><b>Here is a sponsorship banner made for you (install where you want):</b></p>
        <a href="https://www.journalperso.fr?parrain=<?php echo $_SESSION['id']; ?>"><img src="https://www.journalperso.fr/plus/banniere-468-glob.png" alt="bannières parrainage"></a>
        <br><textarea cols="60"><a href="https://www.journalperso.fr?parrain=<?php echo $_SESSION['id']; ?>"><img src="https://www.journalperso.fr/plus/banniere-468-glob.png" alt="bannières parrainage"></a></textarea>
        <?php
    }
?>
</div>
</div>