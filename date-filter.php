<?php

$currentDateStr = "20/08/2023";
$eventDateStr = "25/08/2023";

if (isCurrentDateSmaller($currentDateStr, $eventDateStr)) {
    echo "Current date is smaller than event date.";
} else {
    echo "Current date is not smaller than event date.";
}


function isCurrentDateSmaller($currentDateStr, $eventDateStr) {
    $currentDate = DateTime::createFromFormat('d/m/Y', $currentDateStr);
    $eventDate = DateTime::createFromFormat('d/m/Y', $eventDateStr);

    if (!$currentDate || !$eventDate) {
        // Invalid date format
        return false;
    }

    return $currentDate < $eventDate;
}

?>