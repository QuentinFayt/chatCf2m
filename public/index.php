<?php
session_start();
require_once "../config/config.php";

include_once "../view/head.php";
include_once "../view/" . (isset($logged) ? "private/room" : "public/login") . ".php";
include_once "../view/foot.php";
