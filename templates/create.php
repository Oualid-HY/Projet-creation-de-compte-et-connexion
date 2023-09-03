<?php
$title = "Ajouter un utilisateur";
ob_start();
?>
    <main id="background-img">
    <h1>Ajouter un utilisateur</h1>
    <p id="info"><?= (isset($infoValue)) ? $infoValue : ""?>
    </p>
    <form action="" method="post" id="form">
        <table class="montableau">
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>Utilisateur :</td>
                <td><input type="text" name="nom" value="<?= (isset($_POST["nom"])) ? $_POST["nom"] : ""?>"></td>
                <td><p class ="erreur"><?php if(isset($erreurs["nom"])){//Verifie existance du tableau erreur avec la clé concerné
                                                    echo $erreurs["nom"];//Alors affiche le message d'erreur selon l'erreur
                                            }
                                        ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><input type="text" name="mdp" value="<?= (isset($_POST["mdp"])) ? $_POST["mdp"] : ""?>"></td>
                <td><p class ="erreur"><?php if(isset($erreurs["mdp"])){//Verifie existance du tableau erreur avec la clé concerné
                                                    echo $erreurs["mdp"];//Alors affiche le message d'erreur selon l'erreur
                                            }
                                        ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text" name="mail" value="<?= (isset($_POST["mail"])) ? $_POST["mail"] : ""?>"></td>
                <td><p class ="erreur"><?php if(isset($erreurs["mail"])){//Verifie existance du tableau erreur avec la clé concerné
                                                    echo $erreurs["mail"];//Alors affiche le message d'erreur selon l'erreur
                                            }
                                        ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>Fonction :</td>
                <td><input type="text" name="fonction" value="<?= (isset($_POST["fonction"])) ? $_POST["fonction"] : ""?>"></td>
                <td><p class ="erreur"><?php if(isset($erreurs["fonction"])){//Verifie existance du tableau erreur avec la clé concerné
                                                    echo $erreurs["fonction"];//Alors affiche le message d'erreur selon l'erreur
                                            }
                                        ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" id="submit" name='submit' value="Valider">
                    <input type="reset" id="reset" value="Annuler">
                </td>
                <td></td>
            </tr>
            <tr>
                <td><a href="index.php">Retour à l'accueil</a></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </form>
    </main>
<?php
$content = ob_get_clean();
include "templates/baselayout.php"
?>