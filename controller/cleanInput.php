<?php
function cleanInput($input)
{
    //$clean_input = strip_tags($input,"<p>");
    //$clean_input = htmlentities($input);
    $clean_input = htmlspecialchars($input);
    return $clean_input;
}