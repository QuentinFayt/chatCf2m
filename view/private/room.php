<?php
?>
<header>
    <p>Welcome: <span><?= $_SESSION["name"] ?></span></p><a href="?p=logout">Logout</a>
</header>
<main class="room">
    <article>
    </article>
    <aside>
        <div>
            <h3 class="online">Connected</h3>
        </div>
        <div>
            <h3 class="offline">Members</h3>
        </div>
    </aside>
    <footer>
        <form id="messages" method="POST" action="">
            <textarea id="message" name="message"></textarea>
        </form>
    </footer>
</main>