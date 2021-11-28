<?php

function getUsers($db, $logged = false)
{
    $sql = "SELECT `id`,`displayedName`,`online` FROM `users`";
    if ($logged) {
        $sql = $sql . "WHERE `online` = 1";
    } else {
        $sql = $sql . "WHERE `online` = 0";
    }
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}
