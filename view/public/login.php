<?php
?>

<main>
    <section class="login">
        <form method="POST" action="">
            <h1>Connectez-vous!</h1>
            <?php
            if (isset($wrongLog)) {
                echo '<h2 class="error">Erreur de connexion, vérifiez votre login/mot-de-passe!</h2>';
            }
            if (isset($error)) {
                echo $error;
            }
            ?>
            <div>
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" required />
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required />
            </div>
            <div>
                <input type="submit" />
            </div>
            <p class="toggleForm">Inscrivez vous sur le chat des webs!</p>
        </form>
    </section>
    <section class="inscription" style="display:none;">
        <form method="POST" action="">
            <h1>Inscrivez-vous!</h1>
            <div>
                <label for="loginInsc">Login:</label>
                <input type="text" id="loginInsc" name="loginInsc" required />
            </div>
            <div>
                <label for="nom">Nom que vous voulez afficher:</label>
                <input type="text" id="nom" name="nom" required />
            </div>
            <div>
                <label for="mdp">Mot-de-passe:</label>
                <input type="password" id="mdp" name="mdp" required />
            </div>
            <div>
                <label for="mdpConfirm">Confirmez votre mot-de-passe:</label>
                <input type="password" id="mdpConfirm" name="mdpConfirm" required />
                <p class="matches error"></p>
            </div>
            <div>
                <label for="mail">Mail du CF2M:</label>
                <input type="email" id="mail" name="mail" required />
                <p class="validation error"></p>
            </div>
            <div>
                <input type="submit" />
            </div>
            <p class="toggleForm">Vous aviez déjà un compte?</p>
        </form>
    </section>
</main>