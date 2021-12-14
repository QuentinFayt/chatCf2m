<?php

/**
 * usersValidation
 * @param  mysqli $db : Database connexion
 * @param  int $id  : user Id
 * @param  bool $type : true|false => if true validate, if false unvalidate
 */
function usersValidation(mysqli $db, int $id, bool $type)
{
    $sql = "UPDATE chatcf2m_users SET `valideAccount` = " . (int) $type . " WHERE users_id = $id;";
    mysqli_query($db, $sql) or die(mysqli_error($db));
}

function changeUserName(mysqli $db, int $id, string $name)
{
    $sql = "UPDATE chatcf2m_users SET `displayedName`= '$name'  WHERE users_id = $id;";
    mysqli_query($db, $sql) or die(mysqli_error($db));
}

function deleteUser(mysqli $db, int $id)
{
    $sql = "DELETE FROM `chatcf2m_users` WHERE users_id = $id AND `right`= 0;";
    mysqli_query($db, $sql) or die(mysqli_error($db));
}

function logoutUser(mysqli $db, int $id)
{
    $sql = "UPDATE chatcf2m_users SET `online` = 0 WHERE users_id = $id;";
    mysqli_query($db, $sql) or die(mysqli_error($db));
}

function checkIfOnline(mysqli $db, int $id)
{
    $sql = "SELECT `online` FROM `chatcf2m_users` WHERE `users_id` = $id";

    $result = mysqli_query($db, $sql) or die(mysqli_error($db));

    return mysqli_fetch_assoc($result);
}
