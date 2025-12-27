<?php

function loadEnv($key, $default = null) {
    $value = getenv($key);
    return $value !== false ? $value : $default;
}

function getNextMeeting(DateTime $now): DateTime {
    $day    = loadEnv('MEETING_DAY', 'Saturday');
    $hour   = (int) loadEnv('MEETING_HOUR', 14);
    $minute = (int) loadEnv('MEETING_MINUTE', 0);

    $meeting = new DateTime("next $day");
    $meeting->setTime($hour, $minute);

    if ($now > $meeting) {
        $meeting->modify('+1 week');
    }

    return $meeting;
}

function secondsUntilMeeting(): int {
    $timezone = loadEnv('APP_TIMEZONE', 'UTC');
    date_default_timezone_set($timezone);

    $now = new DateTime();
    $meeting = getNextMeeting($now);

    return max(0, $meeting->getTimestamp() - $now->getTimestamp());
}
