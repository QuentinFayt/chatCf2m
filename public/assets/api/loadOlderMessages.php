<?php
session_start();
require_once "../../../config/config.php";
require_once "../../../model/dbConnexion.php";
require_once "../../../model/getMessages.php";

if (isset($_SESSION["sessionID"]) && $_SESSION["sessionID"] == session_id()) {
    if (isset(array_keys($_GET)[0])) {
        echo json_encode(getMessages($DB, NUMBER_TO_DISPLAY, array_keys($_GET)[0]));
    }
}
