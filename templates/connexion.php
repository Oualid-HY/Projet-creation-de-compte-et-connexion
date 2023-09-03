<?php
$title = "Connexion";
ob_start();
?>
<main id="background-img">
    <h1>Connexion MVC</h1>
    <form action="index.php?action=log" method="post">
        <table class="montableau">
            <tr>
                <th></th>
                <th></th>
                <th><a href="index.php?action=create">Créer un compte</a></th>
            </tr>
            <tr>
                <td>Utilisateur :</td>
                <td><input type="text" name="nom"></td>
                <td></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text" name="mail"></td>
                <td></td>
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><input type="text" name="mdp"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Valider">
                    <input id="reset" type="reset">
                </td>
                <td></td>
            </tr>
        </table>
    </form>
</main>
<?php
$content = ob_get_clean();
include "templates/baselayout.php"
?>