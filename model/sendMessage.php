<?php
function sendMessage($db, $message)
{
    if ($message) {
        $id = $_SESSION["userID"];
        $sql = "INSERT INTO `messages`(`message`,`users_id`) VALUES ('$message','$id');";
        mysqli_query($db, $sql);
    }
}
