<?php
?>

<main>
    <form method="POST" action="">
        <?php
        if (isset($wrongLog)) {
            echo "<h2>Error!</h2>";
        }
        ?>
        <div>
            <label for="login">Login</label>
            <input type="text" id="login" name="login" required />
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
</main>