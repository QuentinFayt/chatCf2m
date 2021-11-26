<?php
session_start();
require_once "../../../config/config.php";
require_once "../../../model/DataFromDB.php";
require_once "../../../model/sendMessage.php";

if (isset($_POST["message"])) {
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])), ENT_QUOTES);
    sendMessage($DB, $message);
}
