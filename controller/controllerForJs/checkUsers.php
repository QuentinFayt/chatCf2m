<?php

$users = checkIfOnline($DB);
foreach ($users as $user) {
    if ($user["users_id"] === $userId) {
        setUserOnlineStatus($DB, $user["users_id"]);
    }
    $minutes = (int) (time() - strtotime($user["lastPingTime"])) / 60;
    if ($minutes > 15 && $user["online"] === "1") {
        setUserOnlineStatus($DB, $user["users_id"], false);
    }
}
