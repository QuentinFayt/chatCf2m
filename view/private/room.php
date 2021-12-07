<?php
?>
<header>
    <p>Welcome: <span><?= $_SESSION["name"] ?></span></p><a href="?p=logout">Logout</a> <?php if ($_SESSION["right"] === "1") { ?><a href="?p=admin">Administration</a><?php } ?>
</header>
<main class="room">
    <article>
    </article>
    <aside>
        <div class="onlineContainer">
            <h3 class="online">Connected</h3>
        </div>
        <div class="offlineContainer">
            <h3 class="offline">Members</h3>
        </div>
    </aside>
    <footer>
        <form id="messages" method="POST" action="">
            <textarea id="message" name="message"></textarea>
        </form>
    </footer>
</main>