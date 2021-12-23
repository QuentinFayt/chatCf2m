<?php
session_start();
require_once "../../../config/config.php";
require "../../../config/database.php";
require_once "../../../model/userModel.php";

if (isset($_SESSION["sessionID"]) && $_SESSION["sessionID"] == session_id()) {
    echo json_encode(getUsers($DB));
}
