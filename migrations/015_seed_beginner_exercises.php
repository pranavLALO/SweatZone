<?php
/**
 * 015_seed_beginner_exercises.php
 * Seeds all Beginner exercises.
 */
require_once __DIR__ . '/../config/db.php';

$exercises = [
    // --- CHEST ---
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
    ],

    // --- SHOULDER ---
    [
        'target_muscle' => 'shoulder',
        'difficulty' => 'beginner',
        'title' => 'Dumbbell Shoulder Press',
        'video_filename' => 'shoulder_press_video.mp4',
        'instructions' => ["Sit on a bench with back support.", "Hold dumbbells at shoulder height.", "Press weights up until arms are extended.", "Lower back to start."],
        'benefits' => ["Targets anterior and lateral deltoids.", "Engages triceps and upper chest.", "Improves overhead stability."]
    ],
    [
        'target_muscle' => 'shoulder',
        'difficulty' => 'beginner',
        'title' => 'Front Raises',
        'video_filename' => 'front_raises_video.mp4',
        'instructions' => ["Stand with dumbbells in front of thighs.", "Lift weights to shoulder height.", "Lower slowly."],
        'benefits' => ["Isolates anterior deltoid.", "Improves shoulder flexion.", "Strengthens upper chest."]
    ],
    [
        'target_muscle' => 'shoulder',
        'difficulty' => 'beginner',
        'title' => 'Lateral Raises',
        'video_filename' => 'lateral_raises_video.mp4',
        'instructions' => ["Stand with dumbbells at sides.", "Raise arms out to sides until shoulder height.", "Lower slowly."],
        'benefits' => ["Isolates lateral deltoid.", "Builds shoulder width.", "Improves shoulder stability."]
    ],
    [
        'target_muscle' => 'shoulder',
        'difficulty' => 'beginner',
        'title' => 'Seated Arnold Press',
        'video_filename' => 'arnold_press_video.mp4',
        'instructions' => ["Start with dumbbells in front of chest, palms facing you.", "Press up while rotating palms forward.", "Reverse motion on way down."],
        'benefits' => ["Targets all three deltoid heads.", "Increases range of motion.", "Engages stabilizer muscles."]
    ],
    [
        'target_muscle' => 'shoulder',
        'difficulty' => 'beginner',
        'title' => 'Face Pulls',
        'video_filename' => 'face_pulls_video.mp4',
        'instructions' => ["Attach rope to high pulley.", "Pull rope towards face, separating hands.", "Squeeze rear delts."],
        'benefits' => ["Targets rear deltoids and rotator cuff.", "Improves posture.", "Balances shoulder strength."]
    ],

    // --- ARMS ---
    [
        'target_muscle' => 'arms',
        'difficulty' => 'beginner',
        'title' => 'Dumbbell Bicep Curls',
        'video_filename' => 'bicep_curls_video.mp4',
        'instructions' => ["Stand upright with a dumbbell in each hand.", "Curl the weights while contracting your biceps.", "Lower slowly."],
        'benefits' => ["Isolates the biceps brachii.", "Improves arm strength."]
    ],
    [
        'target_muscle' => 'arms',
        'difficulty' => 'beginner',
        'title' => 'Hammer Curls',
        'video_filename' => 'hammer_curls_video.mp4',
        'instructions' => ["Stand upright with a dumbbell in each hand, palms facing torsos.", "Curl weights forward.", "Lower slowly."],
        'benefits' => ["Targets brachialis.", "Builds thicker arms."]
    ],
    [
        'target_muscle' => 'arms',
        'difficulty' => 'beginner',
        'title' => 'Tricep Rope Pushdown',
        'video_filename' => 'rope_pushdown_video.mp4',
        'instructions' => ["Attach rope to high pulley.", "Push rope down extending elbows.", "Return slowly."],
        'benefits' => ["Isolates triceps.", "Improves lockout strength."]
    ],
    [
        'target_muscle' => 'arms',
        'difficulty' => 'beginner',
        'title' => 'Overhead Tricep Extension',
        'video_filename' => 'tricep_extension_video.mp4',
        'instructions' => ["Stand or sit holding dumbbell overhead.", "Lower dumbbell behind head.", "Extend arms back up."],
        'benefits' => ["Isolates long head of triceps.", "Improves arm stability."]
    ],

    // --- BACK ---
    [
        'target_muscle' => 'back',
        'difficulty' => 'beginner',
        'title' => 'Pull-ups (Assisted)',
        'video_filename' => 'pullups_video.mp4',
        'instructions' => ["Grasp bar with wide grip.", "Pull body up until chin is over the bar.", "Lower slowly."],
        'benefits' => ["Builds a wide back.", "Strengthens biceps and grip."]
    ],
    [
        'target_muscle' => 'back',
        'difficulty' => 'beginner',
        'title' => 'Lat Pulldowns',
        'video_filename' => 'lat_pulldowns_video.mp4',
        'instructions' => ["Sit at machine.", "Pull bar down to chest.", "Slowly return bar."],
        'benefits' => ["Excellent for latissimus dorsi.", "Good for beginners to build back strength."]
    ],
    [
        'target_muscle' => 'back',
        'difficulty' => 'beginner',
        'title' => 'Dumbbell Rows',
        'video_filename' => 'dumbbell_rows_video.mp4',
        'instructions' => ["Place knee and hand on bench.", "Pull dumbbell up to chest.", "Lower slowly."],
        'benefits' => ["Works sides of back independently.", "Improves core stability."]
    ],

    // --- ABS ---
    [
        'target_muscle' => 'abs',
        'difficulty' => 'beginner',
        'title' => 'Crunches',
        'video_filename' => 'crunches_video.mp4',
        'instructions' => ["Lie on back, knees bent.", "Lift upper body towards knees.", "Lower back down slowly."],
        'benefits' => ["Strengthens core.", "Improves balance."]
    ],
    [
        'target_muscle' => 'abs',
        'difficulty' => 'beginner',
        'title' => 'Plank',
        'video_filename' => 'plank_video.mp4',
        'instructions' => ["Hold body in straight line resting on forearms.", "Engage core.", "Hold position."],
        'benefits' => ["Builds endurance.", "Engages entire core."]
    ],

    // --- LEGS ---
    [
        'target_muscle' => 'legs',
        'difficulty' => 'beginner',
        'title' => 'Bodyweight Squats',
        'video_filename' => 'squats_video.mp4',
        'instructions' => ["Stand shoulder width apart.", "Bend knees and lower hips.", "Stand back up."],
        'benefits' => ["Builds leg strength.", "Improves mobility."]
    ],
    [
        'target_muscle' => 'legs',
        'difficulty' => 'beginner',
        'title' => 'Walking Lunges',
        'video_filename' => 'walking_lunges_video.mp4',
        'instructions' => ["Step forward and bend knees.", "Push off rear leg and step forward again."],
        'benefits' => ["Great for glutes and quads.", "Improves balance."]
    ]
];

// Re-create the table just in case it doesn't exist
$conn->query("CREATE TABLE IF NOT EXISTS workout_exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    target_muscle VARCHAR(50) NOT NULL,
    difficulty ENUM('beginner', 'intermediate', 'advanced') NOT NULL,
    title VARCHAR(150) NOT NULL,
    video_filename VARCHAR(255) NOT NULL,
    instructions_json TEXT NOT NULL,
    benefits_json TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$stmt = $conn->prepare("INSERT INTO workout_exercises (target_muscle, difficulty, title, video_filename, instructions_json, benefits_json) VALUES (?, ?, ?, ?, ?, ?)");

$count = 0;
foreach ($exercises as $ex) {
    // Check if duplicate exists
    $check = $conn->prepare("SELECT id FROM workout_exercises WHERE target_muscle=? AND difficulty=? AND title=?");
    $check->bind_param("sss", $ex['target_muscle'], $ex['difficulty'], $ex['title']);
    $check->execute();
    if ($check->get_result()->num_rows == 0) {
        $inst = json_encode($ex['instructions']); 
        $ben = json_encode($ex['benefits']);
        $stmt->bind_param("ssssss", $ex['target_muscle'], $ex['difficulty'], $ex['title'], $ex['video_filename'], $inst, $ben);
        $stmt->execute();
        $count++;
    }
}

echo "Seeded $count new beginner exercises across all muscles.<br>";
// Set header so we can consume as an API? No, this is just a script.
?>
