<?php 
// On inclus les fonctions php
include('../fonctions/fonctions.php');
if($_GET["mdp"] === MDP_ADMIN){
    envoi_mail_groupe();
} else {
    echo "Ecrire le mot de passe.";
}
?>