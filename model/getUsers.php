<?php

function getUsers($db)
{
    $sql = "SELECT `users_id`,`displayedName`,`online` FROM `chatcf2m_users` WHERE `valideAccount`= 1";
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}

function getUsersForAdmin($db)
{
    $sql = "SELECT `users_id`,`displayedName`,`mailCF2M`,`valideAccount`,`online` FROM `chatcf2m_users`;";
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}
