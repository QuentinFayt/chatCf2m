<?php

function getMessages($db, $id = null)
{
    if (!$id) {
        $sql = "SELECT m.id,m.message, m.date,u.displayedName FROM messages m INNER JOIN users u ON m.users_id = u.id;";
    } else {
        $sql = "SELECT m.id,m.message, m.date,u.displayedName FROM messages m INNER JOIN users u ON m.users_id = u.id WHERE `id` < $id;";
    }
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}