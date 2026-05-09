<?php
/**
 * 014_seed_chest_exercises.php
 * Seeds the initial Beginner Chest workout exercises.
 */
require_once __DIR__ . '/../config/db.php';

$exercises = [
    [
        'target_muscle' => 'chest',
        'difficulty' => 'beginner',
        'title' => 'Push Up',
        'video_filename' => 'pushup_video.mp4',
        'instructions' => ["Get on the floor on all fours.", "Straighten arms and legs.", "Lower chest to floor.", "Push back up."],
        'benefits' => ["Strengthens chest.", "Targets core."]
    ],
    [
        'target_muscle' => 'chest',
        'difficulty' => 'beginner',
        'title' => 'Incline Push Up',
        'video_filename' => 'incline_pushup_video.mp4',
        'instructions' => ["Hands on bench.", "Lower chest to edge.", "Push back up."],
        'benefits' => ["Easier on shoulders.", "Targets lower chest."]
    ],
    [
        'target_muscle' => 'chest',
        'difficulty' => 'beginner',
        'title' => 'Knee Push Up',
        'video_filename' => 'knee_pushup_video.mp4',
        'instructions' => ["Knees on floor.", "Lower chest.", "Push up."],
        'benefits' => ["Good for beginners.", "Builds strength."]
    ],
    [
        'target_muscle' => 'chest',
        'difficulty' => 'beginner',
        'title' => 'Barbell Bench Press',
        'video_filename' => 'bench_press_video.mp4',
        'instructions' => ["Lie on bench.", "Lower bar to chest.", "Press up."],
        'benefits' => ["Mass builder.", "Full chest activation."]
    ],
    [
        'target_muscle' => 'chest',
        'difficulty' => 'beginner',
        'title' => 'Incline Bench Press',
        'video_filename' => 'incline_bench_video.mp4',
        'instructions' => ["Set bench to 30 degrees.", "Press weight up.", "Lower slowly."],
        'benefits' => ["Upper chest focus.", "Shoulder strength."]
    ]
];

$stmt = $conn->prepare("INSERT INTO workout_exercises (target_muscle, difficulty, title, video_filename, instructions_json, benefits_json) VALUES (?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

$count = 0;
foreach ($exercises as $ex) {
    // Check if duplicate exists
    $check = $conn->prepare("SELECT id FROM workout_exercises WHERE target_muscle=? AND difficulty=? AND title=?");
    $check->bind_param("sss", $ex['target_muscle'], $ex['difficulty'], $ex['title']);
    $check->execute();
    if ($check->get_result()->num_rows == 0) {
        $inst = json_encode($ex['instructions']); // encode array to string
        $ben = json_encode($ex['benefits']);
        $stmt->bind_param("ssssss", $ex['target_muscle'], $ex['difficulty'], $ex['title'], $ex['video_filename'], $inst, $ben);
        $stmt->execute();
        $count++;
    }
}

echo "✓ Seeded $count new beginner chest exercises.<br>";
