<?php $langue = langue(); ?> 
    <!-- Bloc connexion -->
    <div id="connexion">
        <h1 class="h1"><?php if($langue=="fr"){echo "<b>C</b>onnexion";}elseif($langue=="en"){echo"<b>L</b>og in";} ?></h1>
        <div class="contenu-centre">
        <form action="validation-connexion.html" method="post">
            <?php
                if($langue=="fr"){
                    input("email", "Adresse e-mail:", "email_connexion", "email", "Entrez votre adresse e-mail", true, "");
                    input("password", "Mot de passe:", "mdp_connexion", "mdp", "Mot de passe", true, "");           
                }elseif($langue=="en"){
                    input("email", "E-mail adress:", "email_connexion", "email", "Enter your e-mail adress", true, "");
                    input("password", "Password:", "mdp_connexion", "mdp", "Password", true, "");
                }
                ?>
            <center><button type="submit" class="hvr-float-shadow centrer btn btn-primary"><?php if($langue=="fr"){echo "Connexion";}elseif($langue=="en"){echo"Log in";} ?></button></center>
        </form>
        <p style="text-align:right;margin-top:10px;"><a id="mdp_oublie" href="motdepasse-oublie.html"><?php if($langue=="fr"){echo "Mot de passe oublié ?";}elseif($langue=="en"){echo"Forgotten password ?";} ?></a></p>
        </div>
    </div>