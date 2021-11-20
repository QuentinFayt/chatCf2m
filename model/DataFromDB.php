<?php

$DB = mysqli_connect(HOST, USER, PWD, TABLE, PORT);

if (!$DB) {
    die(utf8_encode(mysqli_connect_error($DB)));
}

mysqli_set_charset($DB, CHARSET);
