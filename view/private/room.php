<?php
?>
<header>
    <p>Welcome: <span><?= $_SESSION["name"] ?></span></p><a href="?p=logout">Logout</a>
</header>
<main class="room">
    <article>
        <?php
        $messageJson = file_get_contents("http://chat/assets/api/loadMessages.php", "loadMessages.php");
        $messageJson = json_decode($messageJson);
        foreach ($messageJson as $message) {
        ?>
            <div class="<?php echo $message->users_id === $_SESSION["userID"] ? "right" : ""; ?>">
                <div class="messages">
                    <p><span class="name"><?= $message->displayedName ?></span></p>
                    <p><?= $message->message ?></p>
                    <p><span class="date"><?= $message->date ?></span></p>
                </div>
            </div>
        <?php
        }
        ?>
    </article>
    <aside>
        <?php
        $onlineUsers = getUsers($DB, true);
        $offlineUsers = getUsers($DB);
        ?>
        <div>
            <h3>Connected</h3>
            <?php
            if ($onlineUsers) {
                foreach ($onlineUsers as $user) {
            ?>
                    <p><?= $user["displayedName"] ?></p>
            <?php
                }
            }
            ?>
        </div>
        <div>
            <h3>Members</h3>
            <?php
            foreach ($offlineUsers as $user) {
            ?>
                <p><?= $user["displayedName"] ?></p>
            <?php
            }
            ?>
        </div>
    </aside>
    <footer>
        <form id="messages" method="POST" action="">
            <textarea id="message" name="message"></textarea>
        </form>
    </footer>
</main>