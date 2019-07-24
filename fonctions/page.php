<?php

// gestion des pages
function gerer_les_pages($connecte, $page){
    if($connecte == false){
        switch ($page) {
            case "accueil":
                include('page-non-connecte/accueil.php');
                break;
            case "mentions-legales":
                include('page-non-connecte/mentionslegales.php');
                break;
            case "validation-connexion-fb":
                include('fbconnect.php');
                break;
            case "paiement-mdp-journal":
                include('paiement/paiement_mdp_journal.php');
                break;
            case "page-mdps":
                include('paiement/page_mdps.php');
                break;
            case "page-mdps2":
                include('paiement/page_mdps2.php');
                break;
            case "paiement":
                include('paiement/paiement.php');
                break;
            case "paiement-valider":
                include('paiement/paiement_valider.php');
                break;
            case "validation-inscription":
                include('page-non-connecte/validation-inscription.php');
                break;
            case "validation-compte":
                include('page-non-connecte/validation-compte.php');
                break;
            case "validation-connexion":
                include('page-non-connecte/validation-connexion.php');
                break;
            case "paiement":
                include('paiement/paiement.php');
                break;
            case "recherche":
                include('page-non-connecte/recherche.php');
                break;
            case "motdepasse-oublie":
                include('page-non-connecte/mdp-oublie.php');
                break;
            case "connexion":
                include('page-non-connecte/connexion.php');
                break;
            case "inscription":
                include('page-non-connecte/inscription.php');
                break;
            case "reglement2":
                include('page-non-connecte/reglement2.php');
                break;
            case null:
                include('page-non-connecte/accueil.php');
                break;
            default:
                include('page-non-connecte/accueil.php');
        }
    } elseif($connecte == true){
        switch ($page) {
            case "accueil-membre":
                include('page-connecte/accueil-membre.php');
                break;
            case "notifications":
                include('page-connecte/notifications.php');
                break;
            case "demande-paiement":
                include('page-connecte/demande-paiement.php');
                break;
            case "modifier-journal":
                include('page-connecte/modifier-journal.php');
                break;
            case "creerunjournal":
                include('page-connecte/creerunjournal.php');
                break;
            case "statistiques":
                include('page-connecte/statistiques.php');
                break;
            case "renvoi_mail_validation_compte":
                include('page-connecte/renvoi_mail_validation_compte.php');
                break;
            case "parrainnage":
                include('page-connecte/parrainnage.php');
                break;
            case "moncompte":
                include('page-connecte/mon_compte.php');
                break;
            case "reglement":
                include('page-connecte/reglement.php');
                break;
            case "parametre":
                include('page-connecte/parametre.php');
                break;
            case null:
                include('page-connecte/accueil-membre.php');
                break; 
            default:
                include('page-connecte/accueil-membre.php');
        }
    }
}

// gestion des description
function description_page($page){
    $langue = langue();
    switch ($page) {
        case "validation-connexion-fb":
            $retour = $langue == "en" ? "Facebook connection." : "Connexion avec Facebook.";
            return $retour;
            break;
        case "statistiques":
            $retour = $langue == "en" ? "Your account statistics." : "Statistiques de votre compte.";
            return $retour;
            break;
        case "notifications":
            $retour = $langue == "en" ? "Your account notifications." : "Notifications de votre compte.";
            return $retour;
            break;
        case "mentions-legales":
            $retour = $langue == "en" ? "Mentions legales." : "Mentions legales.";
            return $retour;
            break;
        case "demande-paiement":
            $retour = $langue == "en" ? "Your payment, minimum of 15€." : "Faire une demande de paiement si votre solde a atteint un minimum de 10€.";
            return $retour;
            break;
        case "accueil-membre":
            $retour = $langue == "en" ? "Home for users." : "Accueil des membres.";
            return $retour;
            break;
        case "creerunjournal":
            $retour = $langue == "en" ? "Create a journal." : "Créer un journal.";
            return $retour;
            break;
        case "renvoi_mail_validation_compte":
            $retour = $langue == "en" ? "Return the account validation email." : "Renvoi du mail de validation du compte.";
            return $retour;
            break;
        case "accueil":
            $retour = $langue == "en" ? "Access your space and create your personal journal to record your thoughts, your notes or others and share it, make the best views, make a diary or public." : "Accédez à votre espace et créez votre journal personnel pour y noter vos pensées, vos notes ou autres et partagez-le, faites les meilleures vues, faites en un journal intime ou publique.";
            return $retour;
            break;
        case "parrainnage":
            $retour = $langue == "en" ? "Page of sponsorshipt." : "Page de parrainnage.";
            return $retour;
            break;
        case "reglement":
            $retour = $langue == "en" ? "Page of regulations." : "Page du reglement.";
            return $retour;
            break;
        case "parametre":
            $retour = $langue == "en" ? "Page of settings." : "Page des parametres.";
            return $retour;
            break;
        case "validation-inscription":
            $retour = $langue == "en" ? "Validate your registration at journalperso.fr." : "Valider votre inscription à journalperso.fr.";
            return $retour;
            break;
        case "validation-connexion":
            $retour = $langue == "en" ? "Confirm your connection to journalperso.fr." : "Valider votre connexion à journalperso.fr.";
            return $retour;
            break;
        case "paiement":
            $retour = $langue == "en" ? "Make your payment online to activate your account." : "Effectuez votre paiement en ligne pour activé votre compte.";
            return $retour;
            break;
        case "paiement_valider":
            $retour = $langue == "en" ? "Validate your payment." : "Validez votre paiement.";
            return $retour;
            break;
        case "paiement-mdp-journal":
            $retour = $langue == "en" ? "Make your payment online to get code." : "Effectuez votre paiement en ligne pour obtenir le code.";
            return $retour;
            break;
        case "page-mdps":
            $retour = $langue == "en" ? "Validate your payment." : "Validez votre paiement.";
            return $retour;
            break;
        case "recherche":
            $retour = $langue == "en" ? "Do a search on the entire site users." : "Effectuez une recherche sur l'ensemble des utilisateus du site.";
            return $retour;
            break;
        case "reglement2":
            $retour = $langue == "en" ? "Page of regulations." : "Page du reglement.";
            return $retour;
            break;
        case "inscription":
            $retour = $langue == "en" ? "Register on the site." : "S'inscrire sur le site.";
            return $retour;
            break;
        case "connexion":
            $retour = $langue == "en" ? "Login to the site." : "Se connecter sur le site.";
            return $retour;
            break;
        case "motdepasse-oublie":
            return "";
            $retour = $langue == "en" ? "Come to this page if you have forgotten your password." : "Venez sur cette page si vous avez oublié votre mot de passe.";
            return $retour;
            break;
        case "modifier-journal":
            $retour = $langue == "en" ? "Access your space and create your personal journal to record your thoughts, your notes or others and share it, make the best views, make a diary or public." : "Accédez à votre espace et créez votre journal personnel pour y noter vos pensées, vos notes ou autres et partagez-le, faites les meilleures vues, faites en un journal intime ou publique.";
            return $retour;
            break;   
        case null:
            $retour = $langue == "en" ? "Access your space and create your personal journal to record your thoughts, your notes or others and share it, make the best views, make a diary or public." : "Accédez à votre espace et créez votre journal personnel pour y noter vos pensées, vos notes ou autres et partagez-le, faites les meilleures vues, faites en un journal intime ou publique.";
            return $retour;
            break;
        default:
            $retour = $langue == "en" ? "Access your space and create your personal journal to record your thoughts, your notes or others and share it, make the best views, make a diary or public." : "Accédez à votre espace et créez votre journal personnel pour y noter vos pensées, vos notes ou autres et partagez-le, faites les meilleures vues, faites en un journal intime ou publique.";
            return $retour;
    }
}


// gestion des titres
function titre_page($page){
    $langue = langue();
        switch ($page) {
            case "validation-connexion-fb":
                $retour = $langue == "en" ? "Journalperso.fr - Facebook Connexion" : "Journalperso.fr - Connexion avec Facebook";
                return $retour;
                break;
            case "renvoi_mail_validation_compte":
                $retour = $langue == "en" ? "Journalperso.fr - Resend email" : "Journalperso.fr - Renvoi du mail";
                return $retour;
                break;
            case "notifications":
                $retour = $langue == "en" ? "Journalperso.fr - Notifications" : "Journalperso.fr - Notifications";
                return $retour;
                break;
            case "statistiques":
                $retour = $langue == "en" ? "Journalperso.fr - Statistics" : "Journalperso.fr - Statistiques";
                return $retour;
                break;
            case "mentions-legales":
                $retour = $langue == "en" ? "Journalperso.fr - Mentions Legales" : "Journalperso.fr - Mentions Legales";
                return $retour;
                break;
            case "demande-paiement":
                $retour = $langue == "en" ? "Journalperso.fr - Payement" : "Journalperso.fr - Demande de paiement";
                return $retour;
                break;
            case "accueil-membre":
                $retour = $langue == "en" ? "Journalperso.fr - User home" : "Journalperso.fr - Accueil membre";
                return $retour;
                break;
            case "creerunjournal":
                $retour = $langue == "en" ? "Journalperso.fr - Create a journal" : "Journalperso.fr - Creer un journal";
                return $retour;
                break;
            case "parrainnage":
                $retour = $langue == "en" ? "Journalperso.fr - Sponsorship" : "Journalperso.fr - Parrainnage";
                return $retour;
                break;
            case "reglement":
                $retour = $langue == "en" ? "Journalperso.fr - Regulations" : "Journalperso.fr - Reglement";
                return $retour;
                break;
            case "reglement2":
                $retour = $langue == "en" ? "Journalperso.fr - Regulations" : "Journalperso.fr - Reglement";
                return $retour;
                break;
            case "inscription":
                $retour = $langue == "en" ? "Journalperso.fr - Sign up" : "Journalperso.fr - Inscription";
                return $retour;
                break;
            case "connexion":
                $retour = $langue == "en" ? "Journalperso.fr - Sign in" : "Journalperso.fr - Connexion";
                return $retour;
                break;
            case "parametre":
                $retour = $langue == "en" ? "Journalperso.fr - Settings" : "Journalperso.fr - Parametre";
                return $retour;
                break;
            case "accueil":
                $retour = $langue == "en" ? "Journalperso.fr - Write personnal journals online !" : "Journalperso.fr - Ecrivez des journaux en ligne !";
                return $retour;
                break;
            case "validation-inscription":
                $retour = $langue == "en" ? "Journalperso.fr - Validate registration" : "Journalperso.fr - Valider l'inscription";
                return $retour;
                break;
            case "validation-connexion":
                $retour = $langue == "en" ? "Journalperso.fr - Confirm login" : "Journalperso.fr - Valider connexion";
                return $retour;
                break;
            case "paiement":
                $retour = $langue == "en" ? "Journalperso.fr - Payment" : "Journalperso.fr - Paiement";
                return $retour;
                break;
            case "paiement_valider":
                $retour = $langue == "en" ? "Journalperso.fr - Payment validated" : "Journalperso.fr - Paiement validé";
                return $retour;
                break;
            case "paiement-mdp-journal":
                $retour = $langue == "en" ? "Journalperso.fr - Payment code" : "Journalperso.fr - Paiement code";
                return $retour;
                break;
            case "page-mdps":
                $retour = $langue == "en" ? "Journalperso.fr - Validate your payment" : "Journalperso.fr - Validez votre paiement";
                return $retour;
                break;
            case "recherche":
                $retour = $langue == "en" ? "Journalperso.fr - Search" : "Journalperso.fr - Recherche";
                return $retour;
                break;
            case "motdepasse-oublie":
                $retour = $langue == "en" ? "Journalperso.fr - Forgot your password" : "Journalperso.fr - Mot de passe oublié";
                return $retour;
                break;
            case "modifier-journal":
                $retour = $langue == "en" ? "Journalperso.fr - Journal" : "Journalperso.fr - Journal";
                return $retour;
                break;   
            case null:
                $retour = $langue == "en" ? "Journalperso.fr - Write personnal journals online!" : "Journalperso.fr - Ecrivez des journaux en ligne!";
                return $retour;
                break;
            default:
                $retour = $langue == "en" ? "Journalperso.fr - Write personnal journals online!" : "Journalperso.fr - Ecrivez des journaux en ligne!";
                return $retour;
        }
}
?>