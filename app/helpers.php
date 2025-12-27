<?php

function secondsUntilMeeting(): int
{
    // تنظیم تایم‌زون (خیلی مهم)
    date_default_timezone_set('Asia/Tehran');

    $now = new DateTime();

    // جلسه: شنبه ساعت 10 صبح
    $meeting = new DateTime('next saturday 10:00');

    // اگر امروز شنبه است
    if ($now->format('w') == 6) { // 6 = Saturday
        $todayMeeting = new DateTime('today 10:00');

        // اگر هنوز ساعت جلسه نرسیده
        if ($now < $todayMeeting) {
            $meeting = $todayMeeting;
        }
    }

    return max(0, $meeting->getTimestamp() - $now->getTimestamp());
}

function loadEnv($key,$default = null)
{
    $value = getenv($key);
    return $value !== false ? $value : $default;

}