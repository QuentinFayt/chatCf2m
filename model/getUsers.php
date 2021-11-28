<?php

function getUsers($db, $logged = false)
{
    $sql = "SELECT `users_id`,`displayedName`,`online` FROM `chatcf2m_users`";
    if ($logged) {
        $sql = $sql . "WHERE `online` = 1";
    } else {
        $sql = $sql . "WHERE `online` = 0";
    }
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}
