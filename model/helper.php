<?php

function manageText(string $text, int $length): string
{
    if (strlen($text) > $length) {
        $part1 = substr($text, 0, strpos(substr($text, 0, $length), " "));
        $part2 = substr($text, strpos(substr($text, 0, $length), " "), strlen($text));
        if (strlen($part2) > $length) {
            $part2 = manageText($part2, $length);
        }
        return $part1 . "</br>" . $part2;
    } else {
        return $text;
    }
}
