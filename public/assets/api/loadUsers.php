<?php

require_once "../../../config/config.php";
require_once "../../../model/dataFromDB.php";
require_once "../../../model/getUsers.php";

$json = json_encode(getUsers($DB));

echo $json;
