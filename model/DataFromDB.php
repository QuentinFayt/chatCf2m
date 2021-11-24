<?php

$DB = mysqli_connect(HOST, USER, PWD, TABLE, PORT);

if (!$DB) {
    die(utf8_encode(mysqli_connect_error($DB)));
}

mysqli_set_charset($DB, CHARSET);

if (isset($_POST["message"])) {
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])), ENT_QUOTES);
    if ($message) {
        $id = $_SESSION["userID"];
        $sql = "INSERT INTO `messages`(`message`,`users_id`) VALUES ('$message','$id');";
        mysqli_query($DB, $sql);
    }
}
