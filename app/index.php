<?php
require_once 'helpers.php';

$seconds = secondsUntilMeeting();

$days = floor($seconds / 86400);
$hours = floor(($seconds % 86400) / 3600);
$minutes = floor(($seconds % 3600) / 60);
?>

<!DOCTYPE html>
<html  lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Meeting Countdown</title>
</head>
<body>
    <h1>📅 Weekly Meeting Countdown</h1>

    <?php if ($seconds > 0): ?>
        <p>
            ⏳ <?= $days ?> روز،
            <br>
            <?= $hours ?> ساعت،
            <br>

            <?= $minutes ?> دقیقه تا جلسه بعدی
        </p>
    <?php else: ?>
        <p>🚀 جلسه شروع شده یا در حال برگزاری است</p>
    <?php endif; ?>
</body>
</html>
