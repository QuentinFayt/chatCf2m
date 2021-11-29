<?php

require_once "../../../config/config.php";
require_once "../../../model/dataFromDB.php";
require_once "../../../model/getMessages.php";


$json = json_encode(getMessages($DB));

echo $json;
