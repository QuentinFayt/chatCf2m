<?php

if (isset($_POST["clear"])) {
    deleteMessages($DB);
    header("Location: ./");
}
