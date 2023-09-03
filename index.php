<?php
require_once 'controller.php';

try {
    //Si aucune action n'existe alors utilise la fonction membre
    if (!isset($_GET["action"])) { 
        connexion_membre();
    //Sinon si un action existe execute la l'action en question
    }elseif(isset($_GET["action"])){
        //Si l'action est egale à create excute la serie d'instruction pour ajouter un membre
        if ($_GET["action"]=="create") {
            //Si tout les champ nom,mdp,mail,fonction n'existe pas affiche le template
            /*Sinon dans le cas les champ existe
            **Execute le controle de champ et stock les dans la variable d'erreur.
            ***Controle si la variable est vide alors
            *******Si la fonction de controle de doublon sur mail et nom est égale à zero alors
            **********Utilise la fonction ajoute un membre dans la base donneé
            ***Sinon Stock dans la variable infoValue un message d'information
                     Renvoie vers la page ajouter un membre
            ***Sinon renvoie vers la ajouter membre
             */
            if (!isset($_POST["nom"]) || !isset($_POST["mdp"]) || !isset($_POST["mail"]) || !isset($_POST["fonction"])) {
                require "templates/create.php";
            }else{
                $erreurs = control_field($_POST["mail"],$_POST["nom"],$_POST["mdp"],$_POST["fonction"]);
                if(empty($erreurs)){
                    if (controle_doublon($_POST["mail"],$_POST["nom"]) == 0) {
                        ajouter_membre($_POST["mail"],$_POST["nom"],$_POST["mdp"],$_POST["fonction"]);
                    }else{
                        $infoValue = "Donneés déja existante";
                        require "templates/create.php";
                    }
                }else{
                    $infoValue = "";
                    require "templates/create.php";
                }
            }
        }
        //Si l'action est egale à log excute la serie d'instruction pour se connecter
        if ($_GET["action"]=="log"){
            
            session_start();//Demmarre un session
            $_SESSION["usrnom"] = $_POST["nom"];//Stock le champ dans une variable usrnom

            /** 
            ***Si $_SESSION["usrnom"] n'existe pas alors
            *****Re Affiche le template connexion
            ***Sinon
            *****Utilise la fonction controle de connexion et stocker dans une variable
            *****Si la variable d'erreur est vide alors
            ********Utilise la fonction connecter membre et sotck le resultat dans une variable
            ********Renvoie le template compte
            *****Sinon 
            ********Renvoie sur le template connexion
            */
            if(!isset($_SESSION["usrnom"])){
                require "templates/connexion.php";
            }else{
                $erreurs = control_connexion($_POST["mail"],$_POST["nom"],$_POST["mdp"]);
                if(empty($erreurs)){
                    $reponse = connecter_membre($_POST["mail"],$_POST["nom"],$_POST["mdp"]);
                    require "templates/compte.php";
                }else{
                    connexion_membre();
                }
            }
        }
    }

    else{
        throw new Exception("<h1>Page non trouvée !!!</h1>");
    }
//Attrape les messages d'erreur et renvoie vers la fonction obtenir message
} catch (Exception $e) {
    $msgErreur = $e->getMessage();
    echo erreur($msgErreur);
}
?>