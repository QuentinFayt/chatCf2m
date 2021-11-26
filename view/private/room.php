<?php
?>
<header>
    <p>Welcome: <?= $_SESSION["name"] ?></p><a href="?p=logout">Logout</a>
</header>
<main class="room">
    <article>
        <?php
        $messageJson = file_get_contents("http://chat/assets/api/loadMessages.php", "loadMessages.php");
        $messageJson = json_decode($messageJson);
        foreach ($messageJson as $message) {
        ?>
            <div class="messages">
                <p><span class="name"><?= $message->displayedName ?></span></p>
                <p><?= $message->message ?></p>
                <p><span class="date"><?= $message->date ?></span></p>
            </div>
        <?php
        }
        ?>
    </article>
    <aside>
    </aside>
    <footer>
        <form id="messages" method="POST" action="">
            <textarea id="message" name="message"></textarea>
        </form>
    </footer>
    <input type="submit" value="send" form="messages" class="send" />
</main>