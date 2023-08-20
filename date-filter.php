<?php

function isCurrentDateSmaller($userDate, $eventDate) {
    $userInputDate = DateTime::createFromFormat('d/m/Y', $userDate);
    $evenStartDate = DateTime::createFromFormat('d/m/Y', $eventDate);

    return $userInputDate && $evenStartDate && $userInputDate <= $evenStartDate;
}

function filterByDate($date, $res) {
    $filteredEvents = array();
    foreach ($res as $event) {
        if (isCurrentDateSmaller($date, $event['start_time'])) {
            $filteredEvents[] = $event;
        }
    }
    return $filteredEvents;
}

?>