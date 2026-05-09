<?php
/**
 * 018_seed_advanced_exercises.php
 * Seeds the database with advanced exercise data for all muscle groups.
 */
require_once __DIR__ . '/../config/db.php';

$exercises = [
    // --- Chest (Advanced) ---
    [
        'target_muscle' => 'chest',
        'difficulty' => 'advanced',
        'title' => 'Butterfly (pec deck)',
        'video_filename' => 'butterfly_pec_deck_video.mp4',
        'instructions' => [
            "Sit on the machine with your back flat on the pad.",
            "Adjust the seat so the handles are at chest level.",
            "Place your forearms on the padded levers (if using pec deck) or grab handles with arms parallel to floor.",
            "Push the levers together while you squeeze your chest muscles.",
            "Return to the starting position slowly, keeping tension on your chest."
        ],
        'benefits' => [
            "Effectively isolates the pectoral muscles for targeted growth.",
            "Limit the involvement of shoulder and triceps muscles.",
            "Controlled movement reduces the risk of shoulder injury compared to free weights.",
            "Easy to learn form making it suitable for beginners."
        ],
        'sets' => 4,
        'reps' => '10-12'
    ],
    [
        'target_muscle' => 'chest',
        'difficulty' => 'advanced',
        'title' => 'Decline Bench Press',
        'video_filename' => 'decline_bench_press_video.mp4',
        'instructions' => [
            "Lie on a decline bench with your feet securely locked under the leg brace.",
            "Grasp the barbell with a medium width grip, wider than shoulder width.",
            "Unrack the barbell and hold it straight over your torso above with your arms locked.",
            "Lower the bar slowly to your lower chest, keeping your elbows tucked in at a 45-degree angle.",
            "Push the barbell back up to the starting position until your arms are fully extended."
        ],
        'benefits' => [
            "Primarily targets the lower pectoral (chest) muscles.",
            "Engages the anterior deltoids (front shoulders) and triceps as secondary muscles.",
            "Allows for lifting heavier weight compared to flat or incline bench press.",
            "Reduces stress on the lower back and shoulders compared to other bench variations."
        ],
        'sets' => 4,
        'reps' => '8-10'
    ],
    [
        'target_muscle' => 'chest',
        'difficulty' => 'advanced',
        'title' => 'Wide Grip Bench Press',
        'video_filename' => 'wide_grip_bench_video.mp4',
        'instructions' => [
            "Lie flat on a bench and position your hands on the barbell significantly wider than shoulder-width apart.",
            "Unrack the bar and hold it straight over your sternum with arms locked.",
            "Lower the bar slowly to your chest, flaring your elbows slightly out.",
            "Pause for a second when the bar touches your chest.",
            "Press the bar back up forcefully to full extension."
        ],
        'benefits' => [
            "Targets the pectoral muscles more intensely than standard press.",
            "Shifts focus away from triceps, putting more load on the chest.",
            "Increases upper body pressing power.",
            "Activates outer chest fibers for a wider chest look."
        ],
        'sets' => 3,
        'reps' => '10-12'
    ],
    [
        'target_muscle' => 'chest',
        'difficulty' => 'advanced',
        'title' => 'Chest Fly (Dumbbell)',
        'video_filename' => 'dumbbell_fly_video.mp4',
        'instructions' => [
            "Lie on a flat bench holding a dumbbell in each hand, palms facing each other.",
            "Start with arms extended directly above your chest with a slight bend in your elbows.",
            "Slowly lower the weights out to your sides in a wide arc until you feel a stretch in your chest.",
            "Pause briefly at the bottom.",
            "Squeeze your chest muscles to bring the dumbbells back up to the starting position in the same arc motion."
        ],
        'benefits' => [
            "Effectively isolates and strengthens the pectoral muscles.",
            "Improves flexibility and range of motion in the chest.",
            "Helps to widen the look of the muscular appearance.",
            "Engages stabilizer muscles in the shoulders and back."
        ],
        'sets' => 3,
        'reps' => '12-15'
    ],
    [
        'target_muscle' => 'chest',
        'difficulty' => 'advanced',
        'title' => 'Low Cable Fly Crossovers',
        'video_filename' => 'low_cable_fly_video.mp4',
        'instructions' => [
            "Set the pulleys to the lowest setting on the cable machine.",
            "Stand in the middle of the machine, grabbing a handle in each hand.",
            "Step forward to create tension, with your arms extended low at your sides.",
            "With a slight bend in your elbows, bring your hands together in an upward arc in front of your chest.",
            "Squeeze your chest muscles at the peak of the movement, then slowly return to the starting position."
        ],
        'benefits' => [
            "Targets the upper pectoral muscles, giving the chest a full, uplifted look.",
            "Provides constant tension throughout the entire range of motion.",
            "Improves chest sculpting, definition and detail in the center line.",
            "Allows for a good stretch and full contraction of the pectoral muscles."
        ],
        'sets' => 3,
        'reps' => '12-15'
    ],

    // --- Arms (Advanced) ---
    [
        'target_muscle' => 'arms',
        'difficulty' => 'advanced',
        'title' => 'Preacher Curl',
        'video_filename' => 'preacher_curl_video.mp4',
        'instructions' => [
            "Adjust the seat height so your armpits rest comfortably over the top of the pad.",
            "Hold the barbell or EZ-bar with an underhand grip, hands about shoulder-width apart.",
            "With your upper arms flat against the pad and your chest pressed against the support.",
            "Slowly curl the weight up towards your shoulders, squeezing your biceps at the top.",
            "Lower the weight back down in a controlled manner until your arms are fully extended."
        ],
        'benefits' => [
            "Isolates the biceps by preventing body movement and cheating.",
            "Focuses heavily on the short head of the biceps for peak development.",
            "Allows for a full range of motion with strict form, reducing injury risk.",
            "Effective for building strength and definition in the upper arms."
        ],
        'sets' => 4,
        'reps' => '8-10'
    ],
    [
        'target_muscle' => 'arms',
        'difficulty' => 'advanced',
        'title' => 'Cable Bayesian Curl',
        'video_filename' => 'bayesian_curl_video.mp4',
        'instructions' => [
            "Set up a single cable pulley at the lowest position.",
            "Face away from the machine, holding the handle with one hand, arm extended behind you.",
            "Step forward slightly to create tension on the cable.",
            "Curl the handle forward while keeping your elbow behind your torso.",
            "Squeeze the bicep hard at the peak contraction, then slowly lower back."
        ],
        'benefits' => [
            "Maximizes the stretch on the long head of the biceps.",
            "Provides constant tension throughout the entire movement.",
            "Unique angle stimulates muscle fibers differently than standard curls."
        ],
        'sets' => 3,
        'reps' => '12-15'
    ],
    [
        'target_muscle' => 'arms',
        'difficulty' => 'advanced',
        'title' => 'Close Grip Bench Press',
        'video_filename' => 'close_grip_bench_video.mp4',
        'instructions' => [
            "Lie back on a flat bench. Lift the bar with a close grip (hands shoulder-width or slightly narrower).",
            "Lower the bar slowly to your lower chest, keeping your elbows tucked close to your torso.",
            "Push the bar back up explosively to the starting position.",
            "Focus on using your triceps to drive the weight up rather than your chest."
        ],
        'benefits' => [
            "One of the best compound movements for building tricep mass and strength.",
            "Allows for heavier loading compared to isolation exercises.",
            "Has significant carryover to standard bench press strength."
        ],
        'sets' => 4,
        'reps' => '6-8'
    ],
    [
        'target_muscle' => 'arms',
        'difficulty' => 'advanced',
        'title' => 'Tricep Rope Pushdown',
        'video_filename' => 'rope_pushdown_video.mp4',
        'instructions' => [
            "Attach a rope to a high pulley cable machine and hold the ends with a neutral grip.",
            "Stand upright with a slight forward lean, keeping your elbows tucked firmly by your sides.",
            "Push the rope down until arms are fully extended, pulling the handles apart at the bottom.",
            "Squeeze your triceps hard, then control the weight back up slowly.",
            "Maintain strict form; immediately reduce the weight if you use momentum."
        ],
        'benefits' => [
            "Sharpens isolation on outer triceps head for horseshoe muscle detail.",
            "The rope allows for a greater range of motion and stronger peak contraction.",
            "Increases lockout power for pressing movements.",
            "Constant tension from the cable machine maximizes muscle hypertrophy."
        ],
        'sets' => 3,
        'reps' => '12-15'
    ],

    // --- Back (Advanced) ---
    [
        'target_muscle' => 'back',
        'difficulty' => 'advanced',
        'title' => 'Weighted Pull-ups',
        'video_filename' => 'weighted_pullups_video.mp4',
        'instructions' => [
            "Attach a weight to a dip belt or hold a dumbbell between your feet.",
            "Perform a pull-up as you would normally.",
            "This is for advanced athletes who can do many bodyweight pull-ups."
        ],
        'benefits' => [
            "Maximizes back and bicep strength.",
            "The ultimate back-building exercise."
        ],
        'sets' => 4,
        'reps' => '6-8'
    ],

    // --- Abs (Advanced) ---
    [
        'target_muscle' => 'abs',
        'difficulty' => 'advanced',
        'title' => 'Dragon Flags',
        'video_filename' => 'dragon_flags_video.mp4',
        'instructions' => [
            "Lie on a bench and hold the edge behind your head.",
            "Lift your entire body up until only your upper back is touching the bench.",
            "Lower your body in a straight line slowly and with control.",
            "This requires immense core strength."
        ],
        'benefits' => [
            "One of the hardest ab exercises.",
            "Builds incredible core strength and control."
        ],
        'sets' => 3,
        'reps' => '8-10'
    ],

    // --- Legs (Advanced) ---
    [
        'target_muscle' => 'legs',
        'difficulty' => 'advanced',
        'title' => 'Pistol Squats',
        'video_filename' => 'pistol_squats_video.mp4',
        'instructions' => [
            "Stand on one leg, with the other leg extended out in front of you.",
            "Squat down on your standing leg until your hamstring is on your calf.",
            "Keep your balance and drive back up to the starting position.",
            "This is a highly advanced movement requiring great balance and strength."
        ],
        'benefits' => [
            "Ultimate single-leg strength and stability test.",
            "Dramatically improves balance and coordination."
        ],
        'sets' => 3,
        'reps' => '10-12'
    ],

    // --- Shoulder (Advanced) ---
    [
        'target_muscle' => 'shoulder',
        'difficulty' => 'advanced',
        'title' => 'Handstand Push-ups',
        'video_filename' => 'handstand_pushups_video.mp4',
        'instructions' => [
            "Kick up into a handstand against a wall.",
            "Lower your body until your head nearly touches the floor.",
            "Press back up to the starting position.",
            "This is an advanced movement; ensure you have sufficient strength."
        ],
        'benefits' => [
            "Ultimate shoulder strength and mass builder.",
            "Develops incredible balance and core control."
        ],
        'sets' => 3,
        'reps' => '8-10'
    ]
];

foreach ($exercises as $exercise) {
    $stmt = $conn->prepare("INSERT INTO workout_exercises (target_muscle, difficulty, title, video_filename, instructions_json, benefits_json, sets, reps) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    $instructions_json = json_encode($exercise['instructions']);
    $benefits_json = json_encode($exercise['benefits']);
    
    $stmt->bind_param(
        "ssssssis",
        $exercise['target_muscle'],
        $exercise['difficulty'],
        $exercise['title'],
        $exercise['video_filename'],
        $instructions_json,
        $benefits_json,
        $exercise['sets'],
        $exercise['reps']
    );

    if ($stmt->execute()) {
        echo "✓ Seeded exercise: " . $exercise['title'] . "<br>";
    } else {
        echo "x Error seeding " . $exercise['title'] . ": " . $stmt->error . "<br>";
    }
}
?>
