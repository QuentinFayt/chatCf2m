<?php

function getMessages(mysqli $db, $limit, $offset = 0)
{

    $sql = "SELECT m.messages_id,m.message, m.date,u.displayedName,u.users_id FROM `chatcf2m_messages` m INNER JOIN chatcf2m_users u ON m.users_id = u.users_id ORDER BY m.date DESC LIMIT $limit OFFSET $offset;";

    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}
