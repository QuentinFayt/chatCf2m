<?php

function getMessages($db, $id = null)
{
    if (!$id) {
        $sql = "SELECT m.messages_id,m.message, m.date,u.displayedName,u.users_id FROM `chatcf2m_messages` m INNER JOIN chatcf2m_users u ON m.users_id = u.users_id;";
    } else {
        $sql = "SELECT m.messages_id,m.message, m.date,u.displayedName,u.users_id FROM `chatcf2m_messages` m INNER JOIN chatcf2m_users u ON m.users_id = u.users_id WHERE `id` < $id;";
    }
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}
