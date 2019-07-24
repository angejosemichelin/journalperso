<?php 
// affiche un input avec les caractéristiques de bootstrap
function input($type, $titre, $id, $name, $placeholder, $required, $value){
    $required = $required ? "required" : "";
    ?>
        <div class="form-group">
            <label for="<?php echo $id; ?>"><?php echo $titre; ?></label>
            <input type="<?php echo $type; ?>" value="<?php echo $value; ?>" class="form-control" id="<?php echo $id; ?>" <?php echo $required; ?> name="<?php echo $name; ?>" placeholder="<?php echo $placeholder; ?>">
        </div>
    <?php
}

// ouvrir une session
function ouvrir_session(){
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
}

//Pagination
function pagination($nombreDePages, $pageActuelle, $url, $ancre){
    echo '<p align="center">Page(s) : '; //Pour l'affichage, on centre la liste des pages
    for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
    {
         //On va faire notre condition
         if($i==$pageActuelle) //Si il s'agit de la page actuelle...
         {
             echo ' [ '.$i.' ] ';
         }	
         else //Sinon...
         {
              echo '<a href="'.$url.'-'.$i.'.html'.$ancre.'">'.$i.'</a> ';
         }
    }
    echo '</p>';
}
?>