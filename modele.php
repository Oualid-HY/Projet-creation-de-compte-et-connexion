<?php
require("connect.php");

// Connexion à la BDD
function connect_db()
{
    $dsn = "mysql:dbname=" . BASE . ";host=" . SERVER;
    try {
        $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $connexion = new PDO($dsn, USER, PASSWD,$option);
    } catch (PDOException $e) {
        printf("Echec connexion : %s\n", $e->getMessage());
        exit();
    }
    return $connexion;
}

//Fonction pour creé un membre
function create_membre($mail,$utilisateur,$motdepasse,$fonction){
    $connexion = connect_db();
    
    $sql = "INSERT INTO utilisateurs(email_user, login_user, pwd_user, fonction) VALUES (:email, :utilisateur, :motdepasse, :fonction)";
    $reponse = $connexion->prepare($sql);

    $mail = securite($mail);
    $utiliseateur = securite($utilisateur);
    $motdepasse = password_hash($motdepasse,PASSWORD_BCRYPT);
    $fonction = securite($fonction);

    $reponse->bindValue(":email",$mail, PDO::PARAM_STR);
    $reponse->bindValue(":utilisateur", $utilisateur, PDO::PARAM_STR);
    $reponse->bindValue(":motdepasse", $motdepasse, PDO::PARAM_STR);
    $reponse->bindValue(":fonction", $fonction, PDO::PARAM_STR);

    $reponse->execute();
}

//fonction controle de doublon depuis la base de données sur les mail et utilisateur
function duplicate_value($mail,$utilisateur){
    $connexion = connect_db();

    $sql = "SELECT * FROM utilisateurs WHERE email_user = :email AND login_user = :utilisateur";
    $reponse = $connexion->prepare($sql);
    $reponse->bindValue(":email",$mail, PDO::PARAM_STR);
    $reponse->bindValue(":utilisateur", $utilisateur, PDO::PARAM_STR);
    $reponse->execute();
    // var_dump($reponse);

    //var_dump($reponse->rowCount());
    return $reponse->rowCount();
}

//Fonction pour se connecter controle si le mail et utilsateur est identique avec la base de donnee 
function log_membre($mail,$utilisateur){
    $connexion = connect_db();

    $sql = "SELECT * FROM utilisateurs WHERE email_user = :email AND login_user = :utilisateur" ;
    $reponse = $connexion->prepare($sql);
    $reponse->bindValue(":email",$mail, PDO::PARAM_STR);
    $reponse->bindValue(":utilisateur", $utilisateur, PDO::PARAM_STR);
    $reponse->execute();
    
    // var_dump($reponse);
    //var_dump($reponse->rowCount());
    return $reponse->fetch();
    
}

//Fonction passe le paramatre dans une serie de fonction natif pour eviter les injection.
function securite($input){
    $input = trim($input);
    $input = stripcslashes($input);
    $input = strip_tags($input);
    
    return $input; //Retourne la valeur
}
?>