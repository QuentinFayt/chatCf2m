<?php

function deleteMessages(mysqli $db)
{
    $sql = "DELETE FROM `chatcf2m_messages`;";

    return mysqli_query($db, $sql) or die("Erreur : " . mysqli_error($db));
}
