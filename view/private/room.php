<?php
?>
<header>
    <p>Welcome: <span id="<?= $_SESSION["userID"] ?>"><?= $_SESSION["name"] ?></span></p><a href=" ?p=logout">Logout</a> <?php if ($_SESSION["right"] === "1") { ?><a href="?p=admin">Administration</a><?php } ?>
</header>
<main class="room">
    <article>
        <button class="loadMore">Load More</button>
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
        <div class="messageLength">
            <p><span>0</span>/500</p>
        </div>
        <form id="messages" method="POST" action="">
            <textarea id="message" name="message" maxlength="500"></textarea>
        </form>
    </footer>
</main>