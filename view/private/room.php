<?php
?>
<header>
    <p>Welcome: <?= $_SESSION["name"] ?></p><a href="?p=logout">Logout</a>
</header>
<main class="room">
    <article>
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