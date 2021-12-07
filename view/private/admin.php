<?php
?>
<header>
    <p>Welcome: <span><?= $_SESSION["name"] ?></span></p><a href="?p=logout">Logout</a>
    <a href="./">Chat</a>
</header>
<h1 class="list">Liste des utilisateurs</h1>
<main class="admin">
    <div class="row">
        <div>
            <p>ID</p>
        </div>
        <div>
            <p>Nom</p>
        </div>
        <div>
            <p>Mail</p>
        </div>
        <div>
            <p>Validation</p>
        </div>
        <div>

        </div>
    </div>
    <?php
    foreach ($users as $user) {
    ?>
        <div class="row">
            <div>
                <p><?= $user["users_id"] ?></p>
            </div>
            <div>
                <p class="displayedName"><?= $user["displayedName"] ?></p>
                <form method="POST" class="changeName">
                    <textarea name="changeName"><?= $user["displayedName"] ?></textarea>
                    <input type=hidden value="<?= $user["users_id"] ?>" name="userIdToChangeName" />
                    <button type="submit">Yes</button>
                    <a href="./?p=admin">No</a>
                </form>
            </div>
            <div>
                <p><?= $user["mailCF2M"] ?></p>
            </div>
            <div>
                <form method="POST">
                    <?php
                    if ($user["valideAccount"] == 1) {
                    ?>
                        <input type="hidden" value="<?= $user["users_id"] ?>" name="Unvalidate" />
                        <button type="submit" class="unvalid">Unvalidate</button>
                    <?php
                    } else {
                    ?>
                        <input type="hidden" value="<?= $user["users_id"] ?>" name="validate" />
                        <button type="submit" class="valid">Validate</button>
                    <?php
                    }
                    ?>
                </form>
            </div>
            <div>
                <button type="submit" class="deleteButton">Delete</button>
                <form method="POST" class="delete">
                    <p>Are you sure?</p>
                    <input type="hidden" value="<?= $user["users_id"] ?>" name="delete" />
                    <button type="submit">Yes</button>
                    <a href="./?p=admin">No</a>
                </form>
            </div>
        </div>
    <?php
    }
    ?>
</main>