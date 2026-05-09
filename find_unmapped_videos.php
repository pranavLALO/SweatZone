<?php
require_once __DIR__ . '/config/db.php';

$dir = __DIR__ . '/videos/';
$files = scandir($dir);
$videos = [];
foreach ($files as $f) {
    if (strpos($f, '.mp4') !== false) {
        $videos[] = trim($f);
    }
}

$res = $conn->query("SELECT video_filename FROM workout_exercises");
$mapped = [];
while ($row = $res->fetch_assoc()) {
    $mapped[] = trim($row['video_filename']);
}

$unmapped = array_diff($videos, $mapped);
echo "Unmapped Videos:\n";
foreach ($unmapped as $u) {
    echo $u . "\n";
}
?>
