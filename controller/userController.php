<?php

if (isset($_POST["Unvalidate"])) {
    $id = (int) $_POST["Unvalidate"];
    if ($id) {
        usersValidation($DB, $id, false);
        header("Location: ./?p=admin");
    }
}
if (isset($_POST["validate"])) {
    $id = (int) $_POST["validate"];
    if ($id) {
        usersValidation($DB, $id, true);
        header("Location: ./?p=admin");
    }
}
if (isset($_POST["changeName"]) && isset($_POST["userIdToChangeName"])) {
    $id = (int) $_POST["userIdToChangeName"];
    $name = htmlspecialchars(strip_tags(trim($_POST["changeName"])), ENT_QUOTES);

    if ($name && strlen($name) <= 100 && $id) {
        changeUserName($DB, $id, $name);
    }
}

if (isset($_POST["delete"])) {
    $id = (int) $_POST["delete"];

    if ($id) {
        deleteUser($DB, $id);
        header("Location: ./?p=admin");
    }
}

if (isset($_POST["logout"])) {
    $id = (int) $_POST["logout"];

    if ($id) {
        logoutUser($DB, $id);
        header("Location: ./?p=admin");
    }
}
