<?php
require_once __DIR__ . '/config/db.php';

$fixes = [
    'Barbell Bench Press' => 'bench_press_video.mp4',
    'Incline Dumbbell Press' => 'incline_bench_video.mp4',
    'Chest Dips' => 'dips_video.mp4',
    'Romanian Deadlifts (RDLs)' => 'romanian_deadlift_video.mp4',
    'Overhead Barbell Press' => 'overhead_press_video.mp4',
    'Reverse Pec Deck Flyes' => 'rear_delt_fly_video.mp4'
];

foreach ($fixes as $title => $filename) {
    $stmt = $conn->prepare("UPDATE workout_exercises SET video_filename = ? WHERE title = ?");
    $stmt->bind_param("ss", $filename, $title);
    $stmt->execute();
    echo "Hard-fixed: $title -> $filename<br>\n";
}
echo "Done hard-fixing.";
?>
