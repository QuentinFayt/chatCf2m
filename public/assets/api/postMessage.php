<?php
session_start();
require_once "../../../config/config.php";
require "../../../config/database.php";
require_once "../../../model/messagesModel.php";
require_once "../../../model/userModel.php";

if (isset($_SESSION["sessionID"]) && $_SESSION["sessionID"] == session_id()) {
    if (isset($_POST["message"])) {
        if (checkIfOnline($DB, $_SESSION["userID"])["online"] === "1") {
            $message = htmlspecialchars(strip_tags($_POST["message"]), ENT_QUOTES);
            sendMessage($DB, $message);
            alterEventOnPost($DB, $_SESSION["name"]);
        }
    }
}
