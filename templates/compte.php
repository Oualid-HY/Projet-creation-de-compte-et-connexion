<?php

$title = "Mon compte";
ob_start();
?>
    <main id="background-img">
        <video id="background-video" autoplay loop muted>
            <source src="./img/pexels-cottonbro-9669050.mp4" type="video/mp4">
        </video>
        <h1>Compte utilisateur</h1>
        <table class="montableau">
            <tbody>
                <tr>
                    <td colspan="2">
                        <p  id="info"><?= $_SESSION['usrnom']," vous etes connecte";?></p>
                    </td>
                </tr>
                <tr>
                    <td>Utilisateur :</td>
                    <td><p><?= $_SESSION["usrnom"];?></p>
                    </td>
                </tr>
                <tr>
                    <td>Fonction :</td>
                    <td><p><?= $_SESSION["usrfonction"];?></p>
                    </td>
                </tr>
                <tr>
                    <td>Mail :</td>
                    <td><p><?= $_SESSION["usrmail"];?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" id="foottab"><a href="index.php">Retour à l'accueil</a></td>
                </tr>
            </tbody>
            </table>
        </main>
<?php
$content = ob_get_clean();
include "templates/baselayout.php"
?>