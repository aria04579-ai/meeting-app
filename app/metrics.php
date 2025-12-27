<?php
require_once 'helpers.php';

/* Basic Auth */
$user = loadEnv('METRICS_USER', 'metrics');
$pass = loadEnv('METRICS_PASS', 'secret');

if (
    !isset($_SERVER['PHP_AUTH_USER']) ||
    $_SERVER['PHP_AUTH_USER'] !== $user ||
    $_SERVER['PHP_AUTH_PW'] !== $pass
) {
    header('WWW-Authenticate: Basic realm="Metrics"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}

/* Simple counter (file-based) */
$counterFile = '/tmp/requests.count';
$count = file_exists($counterFile) ? (int) file_get_contents($counterFile) : 0;
$count++;
file_put_contents($counterFile, $count);

header('Content-Type: text/plain');

echo "# HELP meeting_seconds_remaining Seconds until next meeting\n";
echo "# TYPE meeting_seconds_remaining gauge\n";
echo "meeting_seconds_remaining " . secondsUntilMeeting() . "\n\n";

echo "# HELP app_requests_total Total HTTP requests\n";
echo "# TYPE app_requests_total counter\n";
echo "app_requests_total $count\n";
