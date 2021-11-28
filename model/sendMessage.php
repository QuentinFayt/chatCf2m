<?php
function sendMessage($db, $message)
{
    if ($message) {
        $id = $_SESSION["userID"];
        $sql = "INSERT INTO `chatcf2m_messages`(`message`,`users_id`) VALUES ('$message','$id');";
        mysqli_query($db, $sql);
    }
}
