<?php 
// Fonction de connection
function connection_bdd(){
    $bdd = new PDO('mysql:host=db750512336.db.1and1.com;dbname=db750512336;charset=utf8', 'dbo750512336', 'Aeromode758+');
    //$bdd = new PDO('mysql:host=localhost;dbname=journalperso;charset=utf8', 'root', '');
    return $bdd;
}

// Insertion dans la base de données
function insert_bdd($table, $valeurs){
    $bdd = connection_bdd();
    $requete1 = "INSERT INTO ".$table."(";
    $requete3 = " VALUES(";
    $requete2 = "";
    $requete4 = "";
    $i = 1;
    foreach ($valeurs as $key => $value) {
        if(count($valeurs) == $i){
            $requete2 .= $key.")";
            $requete4 .= ":".$key.")";     
        } else {
            $requete2 .= $key.",";
            $requete4 .= ":".$key.",";           
        }
        $i++;
    }
    $requete = $requete1.$requete2.$requete3.$requete4;
    $req = $bdd->prepare($requete);
    $req->execute($valeurs);
    $req->closeCursor();
}

// Insertion dans la base de données
function delete_bdd($table, $ligne){
    $bdd = connection_bdd();
    $bdd->exec("DELETE FROM `$table` WHERE id = '$ligne'");
}

// execute une requete en base de donnée et retourne le resultat
function select_bdd($requete){
    $bdd = connection_bdd();
    $reponse = $bdd->query($requete);
    return $reponse;
}

// execute une requete en base de donnée et retourne le resultat
function update_bdd($requete, $valeurs){
    $bdd = connection_bdd();
    $bdd->prepare($requete)->execute($valeurs);
}
?>