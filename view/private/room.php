<?php
?>
<header>
    <p>Welcome: <?= $_SESSION["name"] ?></p><a href="?p=logout">Logout</a>
</header>
<main class="room">
    <article>
        <?php
        foreach (getMessages($DB) as $message) {
        ?>
            <div class="messages">
                <p><span class="name"><?= $message["displayedName"] ?></span></p>
                <p><?= $message["message"] ?><span class="date"><?= $message["date"] ?></span></p>
            </div>
        <?php
        }
        ?>
    </article>
    <aside>
    </aside>
    <footer>
        <form id="messages" method="POST" action="">
            <textarea name="message"></textarea>
        </form>
    </footer>
    <input type="submit" value="send" form="messages" />
</main>