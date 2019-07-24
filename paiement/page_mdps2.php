<?php 
$langue = langue();
$id_journal_mod = $_GET["id"];
$id_journal = substr($id_journal_mod,3);

//on recupere le mot de passe du journal
$requete = "SELECT mot_de_passe FROM `journaux` WHERE id = '$id_journal'";
$reponse = select_bdd($requete);
while ($rep = $reponse->fetch()){
    if($langue=="fr"){
        echo "<center>Le mot de passe est : <strong>".$rep["mot_de_passe"]."</strong></center>";
    }elseif($langue=="en"){
        echo "<center>The password is : <strong>".$rep["mot_de_passe"]."</strong></center>";
    }
}
?>