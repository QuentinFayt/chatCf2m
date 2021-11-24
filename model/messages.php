<?php

function getMessages($db)
{
    $sql = "SELECT m.message, m.date,u.displayedName FROM messages m INNER JOIN users u ON m.users_id = u.id;";

    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}
