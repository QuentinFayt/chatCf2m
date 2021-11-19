<?php

require_once "../config/config.php";

include_once "../view/public/head.php";
include_once "../view/public/" . (isset($_GET["p"]) && in_array($_GET["p"], WHITE_LIST) ? $_GET["p"] : "Homepage") . ".php";
include_once "../view/public/foot.php";
