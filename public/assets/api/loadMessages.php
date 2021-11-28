<?php

require_once "../../../config/config.php";
require_once "../../../model/dataFromDB.php";
require_once "../../../model/getMessages.php";

if (!$loaded) {
    $json = json_encode(getMessages($DB));
    $loaded = true;
} else {
    $json = json_encode(getMessages($DB, json_decode($json)[array_key_last($json)]->id));
}

echo $json;
