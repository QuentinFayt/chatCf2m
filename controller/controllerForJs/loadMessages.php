<?php

echo json_encode(array_reverse(getMessages($DB, NUMBER_TO_DISPLAY)));
