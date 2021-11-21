<?php
?>

<main>
    <section class="login">
        <h1>Connectez-vous!</h1>
        <form method="POST" action="">
            <?php
            if (isset($wrongLog)) {
                echo "<h2>Error!</h2>";
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
        </form>

        <p class="toggleForm">Inscrivez vous sur le chat des webs!</p>
    </section>
    <section class="inscription" style="display:none;">
        <h1>Inscrivez-vous!</h1>
        <form method="POST" action="">
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
                <p class="matches"></p>
            </div>
            <div>
                <label for="mail">Mail du CF2M:</label>
                <input type="email" id="mail" name="mail" required />
                <p class="validation"></p>
            </div>
            <div>
                <input type="submit" />
            </div>
            <p class="toggleForm">Vous aviez déjà un compte?</p>
        </form>
    </section>
</main>