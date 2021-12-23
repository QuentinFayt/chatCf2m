<?php

/**
 * usersValidation
 * @param  mysqli $db : Database connexion
 * @param  int $id  : user Id
 * @param  bool $type : true|false => if true validate, if false unvalidate
 */
function usersValidation(mysqli $db, int $id, bool $type)
{
    $sql = "UPDATE chatcf2m_users SET `valideAccount` = " . (int) $type . " WHERE users_id = $id AND `right` = 0;";
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
function getUsers(mysqli $db)
{
    $sql = "SELECT `users_id`,`displayedName`,`online` FROM `chatcf2m_users` WHERE `valideAccount`= 1";
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}

function getUsersForAdmin(mysqli $db)
{
    $sql = "SELECT `users_id`,`displayedName`,`mailCF2M`,`valideAccount`,`online` FROM `chatcf2m_users`;";
    return mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
}

function userInscription(mysqli $db, string $login, string $name, string $pwd, string $mail)
{
    $sql = "INSERT INTO `chatcf2m_users`(`login`, `displayedName`, `pwd`, `mailCF2M`) VALUES ('$login','$name','$pwd','$mail');";

    mysqli_query($db, $sql);
}
function createEventToLogOut(mysqli $db, string $userName, int $userId)
{
    dropEventOnLogOut($db, $userName);
    $sql = "CREATE EVENT `$userName` ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 HOUR ON COMPLETION NOT PRESERVE ENABLE DO UPDATE chatcf2m_users SET `online` = 0 WHERE users_id = $userId;";

    mysqli_query($db, $sql) or die(mysqli_error($db));
}

function dropEventOnLogOut(mysqli $db, string $userName)
{
    $sql = "DROP EVENT IF EXISTS `$userName`;";

    mysqli_query($db, $sql) or die(mysqli_error($db));
}
function alterEventOnPost(mysqli $db, string $userName)
{
    $sql = "ALTER EVENT `$userName` ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 HOUR;";

    mysqli_query($db, $sql) or die(mysqli_error($db));
}

function userEntryProtection(
    string $entry,
    int $flags = ENT_QUOTES,
    string $characters = " \n\r\t\v\0",
    $allowed_tags = null,
    ?string $encoding = null,
    bool $double_encode = true
): string {
    return htmlspecialchars(strip_tags(trim($entry, $characters), $allowed_tags), $flags, $encoding, $double_encode);
}

function loginVerification(mysqli $db, string $login)
{

    $sql = "SELECT `login` FROM `chatcf2m_users` WHERE `login` = '$login' AND `valideAccount`= 1;";
    $verification = mysqli_query($db, $sql) or die(mysqli_error($db));

    return mysqli_fetch_assoc($verification);
}

function passwordVerification(mysqli $db, string $login)
{
    $sql = "SELECT `pwd` FROM `chatcf2m_users` WHERE `login` = '$login';";
    $verification = mysqli_query($db, $sql) or die(mysqli_error($db));

    return mysqli_fetch_assoc($verification);
}

function setUserOnline(mysqli $db, int $userId)
{
    $sql = "UPDATE `chatcf2m_users` SET `online`= 1 WHERE `users_id` = $userId;";

    mysqli_query($db, $sql);
}

function getUserInfoForSession(mysqli $db, string $login)
{
    $sql =  "SELECT `displayedName`,`users_id`,`right` FROM `chatcf2m_users` WHERE `login` = '$login'";
    $query = mysqli_query($db, $sql);

    return  mysqli_fetch_assoc($query);
}
