<?php
require_once 'modele.php';

//Initialisation des variable
$errUtilisateur = "";
$errMdp = "";
$errMail="";
$errFonction="";

//Fonction pour aller sur connexion
function connexion_membre(){
    require "templates/connexion.php";
}

function ajouter_membre($mail,$utilisateur,$motdepasse,$fonction){
    create_membre($mail,$utilisateur,$motdepasse,$fonction);
    $infoValue = "Enregistrement réussi";

    require "templates/create.php";
    header("refresh:5;url=index.php");
}

function connecter_membre($mail,$utilisateur,$motdepasse){
    $user = log_membre($mail,$utilisateur);
    if($user!= false){
        if(password_verify($motdepasse,$user["pwd_user"])){
            $_SESSION["usrfonction"] = $user["fonction"];
            $_SESSION["usrmail"] = $user["email_user"];
            return $user;
            // require "templates/compte.php";
        }else{
            session_unset();
            require "templates/connexion.php";
        }
    }else{
        require "templates/connexion.php";
    }
}

function control_field($mail,$utilisateur,$motdepasse,$fonction){
    $erreurs = array();//initialise un tableau d'erreur
    $regMail = "/(^[a-zA-Z0-9_.]+[@]{1}[a-z0-9]+[.][a-z]{2,6}$)/";
    $regPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@%*+\\-_!])(?=.*[^\s]).{6,}$/";
    $regLog="/^[A-Z][\p{L}\p{M}]{2,29}$/u";

        //Verifie si les parametre nom et prenom sont different de vide 
        if ((!empty($mail)) && (!empty($utilisateur)) && (!empty($motdepasse)) && (!empty($fonction))) { // alors Execute le controle des champ et affiche le message en fonction
            
            if (!preg_match($regMail, $mail)) {

                $erreurs["mail"] = "Veuillez saisir un mail valide !";
            }
            if (!preg_match($regLog, $utilisateur)) {

                $erreurs["nom"] = "Veuillez saisir un utilisateur valide !";
            }
            if (!preg_match($regPassword, $motdepasse)) {

                $erreurs["mdp"] = "Veuillez saisir un mots de passe valide !";
            }
            if (!preg_match($regLog, $fonction)) {

                $erreurs["fonction"] = "Veuillez saisir une fonction valide !";
            }
        }else{  
            /*********************************************************
            Sinon si les paramettre de nom et prenom son vide 
            ******Affiche le message d'erreur avec le tableay d'erreur et la clé concerné
            ******Sinon Effectue le controle du champ
            ******Et affiche le message dans le cas d'une erreur eventuel
            *******************************************************/ 
            if (empty($mail)) {

                $erreurs["mail"] = "Veuillez saisir un mail !";
            } else {

                if (!preg_match($regMail, $mail)) {

                    $erreurs["mail"] = "Veuillez saisir un mail valide !";
                }
            }
            if (empty($utilisateur)) {

                $erreurs["nom"] = "Veuillez saisir un utilisateur !";
            } else {

                if (!preg_match($regLog, $utilisateur)) {

                    $erreurs["nom"] = "Veuillez saisir un utilisateur valide !";
                }
            }
            if (empty($motdepasse)) {

                $erreurs["mdp"] = "Veuillez saisir un mot de passe !";
            } else {

                if (!preg_match($regPassword, $motdepasse)) {

                    $erreurs["mdp"] = "Veuillez saisir un mot de passe valide !";
                }
            }
            if (empty($fonction)) {

                $erreurs["fonction"] = "Veuillez saisir votre fonction!";
            } else {

                if (!preg_match($regLog, $fonction)) {

                    $erreurs["fonction"] = "Veuillez saisir une fonction valide !";
                }
            }
        }
        return $erreurs;//Retourne la resultat de la variable $erreurs
}

//Fonction qui controle le doublon
function controle_doublon($mail,$utilisateur){
    duplicate_value($mail,$utilisateur);
    return duplicate_value($mail,$utilisateur);
}

//Fonction qui verifie les champ à la connexion
function control_connexion($mail,$utilisateur,$motdepasse){
    $erreurs = array();//initialise un tableau d'erreur
    $regMail = "/(^[a-zA-Z0-9_.]+[@]{1}[a-z0-9]+[.][a-z]{2,6}$)/";
    $regPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@%*+\\-_!])(?=.*[^\s]).{6,}$/";
    $regLog="/^[A-Z][\p{L}\p{M}]{2,29}$/u";

        //Verifie si les parametre nom et prenom sont different de vide 
        if ((!empty($mail)) && (!empty($utilisateur)) && (!empty($motdepasse))) { // alors Execute le controle des champ et affiche le message en fonction
            
            if (!preg_match($regMail, $mail)) {

                $erreurs["mail"] = "Veuillez saisir un mail valide !";
            }
            if (!preg_match($regLog, $utilisateur)) {

                $erreurs["nom"] = "Veuillez saisir un utilisateur valide !";
            }
            if (!preg_match($regPassword, $motdepasse)) {

                $erreurs["mdp"] = "Veuillez saisir un mots de passe valide !";
            }
        }else{  
            /*********************************************************
            Sinon si les paramettre de nom et prenom son vide 
            ******Affiche le message d'erreur avec le tableay d'erreur et la clé concerné
            ******Sinon Effectue le controle du champ
            ******Et affiche le message dans le cas d'une erreur eventuel
            *******************************************************/ 
            if (empty($mail)) {

                $erreurs["mail"] = "Veuillez saisir un mail !";
            } else {

                if (!preg_match($regMail, $mail)) {

                    $erreurs["mail"] = "Veuillez saisir un mail valide !";
                }
            }
            if (empty($utilisateur)) {

                $erreurs["nom"] = "Veuillez saisir un utilisateur !";
            } else {

                if (!preg_match($regLog, $utilisateur)) {

                    $erreurs["nom"] = "Veuillez saisir un utilisateur valide !";
                }
            }
            if (empty($motdepasse)) {

                $erreurs["mdp"] = "Veuillez saisir un mot de passe !";
            } else {

                if (!preg_match($regPassword, $motdepasse)) {

                    $erreurs["mdp"] = "Veuillez saisir un mot de passe valide !";
                }
            }
        }
        return $erreurs;//Retourne la resultat de la variable $erreurs
}

function erreur($msgErreur) {
    require 'templates/erreur.php';
}
?>