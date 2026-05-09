<?php
require_once __DIR__ . '/config/db.php';

$dir = __DIR__ . '/videos/';
$files = scandir($dir);
$actual_videos = [];
foreach ($files as $f) {
    if (strpos($f, '.mp4') !== false) {
        $actual_videos[] = $f;
    }
}

$result = $conn->query("SELECT id, title, video_filename FROM workout_exercises");

while ($row = $result->fetch_assoc()) {
    $current_file = $row['video_filename'];
    if (!in_array($current_file, $actual_videos)) {
        // Find closest match
        $best_match = "";
        $highest_percent = 0;
        foreach ($actual_videos as $av) {
            similar_text($current_file, $av, $percent);
            if ($percent > $highest_percent) {
                $highest_percent = $percent;
                $best_match = $av;
            }
        }
        
        if ($highest_percent > 60) {
            $stmt = $conn->prepare("UPDATE workout_exercises SET video_filename = ? WHERE id = ?");
            $stmt->bind_param("si", $best_match, $row['id']);
            $stmt->execute();
            echo "Fixed: {$row['title']} | $current_file -> $best_match ($highest_percent%)<br>\n";
        } else {
            echo "Failed to fix securely: {$row['title']} | best was $best_match ($highest_percent%)<br>\n";
        }
    }
}
echo "Done fixing video filenames in DB.";
?>
