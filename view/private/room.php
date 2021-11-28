<?php
?>
<header>
    <p>Welcome: <span><?= $_SESSION["name"] ?></span></p><a href="?p=logout">Logout</a>
</header>
<main class="room">
    <article>
        <?php
        $messageJson = file_get_contents(MESSAGES_URL_API, "loadMessages.php");
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
        $users = file_get_contents(USERS_URL_API, "loadUsers.php");
        $users = json_decode($users);
        ?>
        <div>
            <h3>Connected</h3>
            <?php
            foreach ($users as $user) {
                if ($user->online === "1") {
            ?>
                    <p><?= $user->displayedName ?></p>
            <?php
                }
            }
            ?>
        </div>
        <div>
            <h3>Members</h3>
            <?php
            foreach ($users as $user) {
                if (!($user->online === "1")) {
            ?>
                    <p><?= $user->displayedName ?></p>
            <?php
                }
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