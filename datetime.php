<?php
// function needed to createConversation & ask_feedback
function getTime()
{
    date_default_timezone_set('Europe/Brussels');
    date_default_timezone_get();

    $timeLine = date("Y-m-d H:i:s");

    return $timeLine;
}
?>