<?php

require_once "../../../config/config.php";
require_once "../../../model/DataFromDB.php";
require_once "../../../model/getUsers.php";

$json = json_encode(getUsers($DB));

echo $json;
