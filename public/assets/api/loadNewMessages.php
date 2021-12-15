<?php
session_start();
require_once "../../../config/config.php";
require_once "../../../model/dbConnexion.php";
require_once "../../../model/getMessages.php";


/* if (isset($_SESSION["sessionID"]) && $_SESSION["sessionID"] == session_id()) {
    echo json_encode(getMessages($DB));
} */
