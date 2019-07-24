<?php $langue = langue(); ?>
    <!-- Bloc inscription -->
    <div id="inscription">
            <h1 class="h1"><?php if($langue=="fr"){echo "<b>D</b>evenez journaliste !";}elseif($langue=="en"){echo"<b>B</b>ecome journalist !";} ?></h1>
            <div class="contenu-centre">
            <form action="validation-inscription.html" method="post">
                    <?php
                    if($langue=="fr"){
                        input("email", "Adresse e-mail:", "email_inscription", "email", "Entrez votre adresse e-mail", true, "");
                        input("text", "Nom et prenom:", "nom_prenom", "nom_prenom", "Entrez votre nom et prénom", true, "");
                        input("password", "Mot de passe:", "password", "mdp", "Mot de passe", true, "");
                    }elseif($langue=="en"){
                        input("email", "E-mail adress:", "email_inscription", "email", "Enter your e-mail adress", true, "");
                        input("text", "Last name and first name", "nom_prenom", "nom_prenom", "Enter your name and surname in full", true, "");
                        input("password", "Password:", "password", "mdp", "Password", true, "");
                    }
                        $parrain = isset($_GET["parrain"]) ? $_GET["parrain"] : $_COOKIE["parrain"];
                    ?>
                    <input type="hidden" name="parrain" value="<?php echo $parrain; ?>">
                    <div class="g-recaptcha" data-sitekey="6LcSRXEUAAAAAAMk7u5oZGHx1QtV4-IoeRPxazwn"></div><br>
                    <center><button type="submit" class="hvr-float-shadow centrer btn btn-primary">Inscription</button></center>
            </form>
    </div>
    </div>