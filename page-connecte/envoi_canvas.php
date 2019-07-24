<?php
    // On inclus les fonctions php
    include('../fonctions/fonctions.php');
    // Ouvrir session
    ouvrir_session();
    $data = $_POST['image'];
    $id_journal = $_POST['id'];
    $description = $_POST['description'];
    $image = explode('base64,',$data);
    $chemin = "../publications/images/image"."-".rand(1, 100000).".png";
    $fic=fopen($chemin,"wb");
    fwrite($fic,base64_decode($image[1]));
    fclose($fic);
    publier_image($chemin, "Dessin sur Journalperso.fr intitulé: $description", $id_journal);
?>