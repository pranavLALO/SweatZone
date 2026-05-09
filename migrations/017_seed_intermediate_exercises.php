<?php
/**
 * 017_seed_intermediate_exercises.php
 * Seeds intermediate exercises for all muscle groups into the database.
 */
require_once __DIR__ . '/../config/db.php';

$exercises = [
    // ABS INTERMEDIATE
    ['abs', 'intermediate', 'Hanging Knee Raises', 'hanging_knee_raises.mp4',
        ["Hang from a pull-up bar with an overhand grip.", "Keeping your legs straight, raise them until they are parallel to the floor.", "Slowly lower your legs back down."],
        ["Excellent for lower abs and grip strength.", "Decompresses the spine."], 3, '10-12'
    ],
    ['abs', 'intermediate', 'Cable Crunches', 'cable_crunches_video.mp4',
        ["Kneel below a high pulley with a rope attachment.", "Grasp the rope and pull it down until your hands are next to your face.", "Flex your hips slightly and allow the weight to hyperextend your lower back.", "Keeping your hips stationary, crunch your upper body down towards your knees.", "Squeeze your abs hard at the bottom and slowly return to the start."],
        ["Allows you to add weight for progressive overload on your abs.", "Provides constant tension throughout the entire movement."], 3, '12-15'
    ],
    ['abs', 'intermediate', 'Russian Twists', 'russian_twists_video.mp4',
        ["Sit on the floor with your knees bent and feet slightly off the ground.", "Lean back to a 45-degree angle, keeping your back straight.", "Hold a weight or clasp your hands together in front of you.", "Twist your torso from side to side, touching the weight to the floor on each side.", "Keep your core engaged throughout."],
        ["Targets the obliques for a stronger, more defined waistline.", "Improves rotational strength and core stability."], 3, '20-24'
    ],
    ['abs', 'intermediate', 'Side Plank', 'side_plank_video.mp4',
        ["Lie on your side with your legs straight and stacked.", "Prop your upper body up on your forearm, ensuring your elbow is directly under your shoulder.", "Lift your hips off the floor until your body forms a straight line from head to heels.", "Hold this position for the desired amount of time, then switch sides."],
        ["Strengthens the obliques, lower back, and shoulder stabilizers.", "Improves anti-rotational core strength."], 3, '30-45s'
    ],
    ['abs', 'intermediate', 'Reverse Crunches', 'reverse_crunches_video.mp4',
        ["Lie on your back with your hands by your sides or under your lower back for support.", "Bring your knees towards your chest until they are bent at a 90-degree angle.", "Using your lower abs, lift your hips off the floor and bring your knees towards your chest.", "Slowly lower your hips back down to the starting position."],
        ["Effectively targets the often hard-to-reach lower abdominals.", "Less strain on the neck and spine compared to traditional crunches."], 3, '12-15'
    ],

    // ARMS INTERMEDIATE (Examples from IntermediateArmsWorkoutsScreen generally. We'll summarize common ones)
    ['arms', 'intermediate', 'Barbell Curls', 'barbell_curls.mp4',
        ["Stand tall holding a barbell with a shoulder-width supinated (underhand) grip.", "Keep your elbows close to your torso.", "Curl the weights while contracting your biceps.", "Slowly lower the barbell back to the starting position."],
        ["Builds total bicep mass.", "Allows heavier weight to be lifted."], 3, '8-10'
    ],
    ['arms', 'intermediate', 'Skull Crushers', 'skull_crushers.mp4',
        ["Lie on a bench holding an EZ curl bar with a close grip above your chest.", "Lower the bar towards your forehead by bending your elbows.", "Extend your arms back up to the starting position, squeezing the triceps."],
        ["Targets the long head of the triceps.", "Improves pressing strength."], 3, '10-12'
    ],
    ['arms', 'intermediate', 'Hammer Curls', 'hammer_curls.mp4',
        ["Stand holding a dumbbell in each hand with a neutral grip.", "Curl the weights up while keeping your palms facing each other.", "Lower slowly back to the start."],
        ["Targets the brachialis, improving arm thickness.", "Builds strong forearms."], 3, '10-12'
    ],
    ['arms', 'intermediate', 'Tricep Rope Pushdowns', 'tricep_rope_pushdowns.mp4',
        ["Attach a rope to a high cable pulley.", "Push the rope down by extending your elbows, spreading the rope at the bottom.", "Slowly return to the start."],
        ["Excellent for tricep isolation and lockout.", "Constant tension from the cable."], 3, '12-15'
    ],

    // BACK INTERMEDIATE
    ['back', 'intermediate', 'Pull-Ups', 'pull_ups_video.mp4',
        ["Grab the pull-up bar with an overhand grip, slightly wider than shoulder-width.", "Pull your body up until your chin is over the bar.", "Lower yourself in a controlled motion."],
        ["Builds incredible lat width.", "A fundamental bodyweight movement for upper body pulling strength."], 3, '6-10'
    ],
    ['back', 'intermediate', 'Bent-Over Barbell Rows', 'barbell_rows.mp4',
        ["Bend your knees and lean forward, maintaining a flat back.", "Grab a barbell with an overhand grip.", "Pull the bar towards your lower chest/upper abdomen.", "Lower the bar back down until arms are extended."],
        ["Builds overall back thickness.", "Engages stabilizers in the lower back and core."], 3, '8-10'
    ],
    ['back', 'intermediate', 'Seated Cable Rows', 'seated_cable_rows.mp4',
        ["Sit at a cable row station with a V-handle.", "Keep your back straight and pull the handle to your abdomen, squeezing your shoulder blades together.", "Return to starting position slowly."],
        ["Great for mid-back thickness.", "Safe movement for progressive overload."], 3, '10-12'
    ],
    ['back', 'intermediate', 'Lat Pulldowns', 'lat_pulldowns.mp4',
        ["Sit at a lat pulldown machine and grab the bar with a wide grip.", "Pull the bar down towards your upper chest, squeezing your lats.", "Slowly return the bar to the top."],
        ["Isolates the lats efficiently.", "Great alternative if pull-ups are too difficult."], 3, '10-12'
    ],

    // CHEST INTERMEDIATE
    ['chest', 'intermediate', 'Barbell Bench Press', 'barbell_bench_press.mp4',
        ["Lie flat on a bench, grab the barbell with a medium-width grip.", "Unrack the bar and hold it straight over your chest.", "Slowly lower the bar until it touches your mid-chest.", "Press the bar back up to the starting position."],
        ["The king of chest exercises for overall mass and strength.", "Engages triceps and anterior deltoids as secondary muscles."], 3, '8-10'
    ],
    ['chest', 'intermediate', 'Incline Dumbbell Press', 'incline_db_press.mp4',
        ["Set an adjustable bench to an incline of 30-45 degrees.", "Press dumbbells straight up above your upper chest.", "Lower them down to your shoulders and repeat."],
        ["Targets the upper pectoral muscles.", "Allows for an increased range of motion."], 3, '8-10'
    ],
    ['chest', 'intermediate', 'Cable Crossovers', 'cable_crossovers.mp4',
        ["Stand between two high cable pulleys, holding a D-handle in each hand.", "Step forward slightly and bring your arms together in an arc motion.", "Squeeze your chest at the bottom of the movement and slowly return."],
        ["Excellent for chest isolation.", "Great for the pump at the end of a workout."], 3, '12-15'
    ],
    ['chest', 'intermediate', 'Chest Dips', 'chest_dips.mp4',
        ["Mount a set of dip bars. Lean your torso forward to emphasize the chest.", "Lower yourself until your elbows form a 90-degree angle.", "Press yourself back up."],
        ["Excellent for the lower chest.", "Engages triceps strongly."], 3, '8-12'
    ],

    // LEGS INTERMEDIATE
    ['legs', 'intermediate', 'Barbell Back Squats', 'barbell_squats.mp4',
        ["Place a barbell across your upper back/traps.", "Squat down by bending your knees and pushing your hips back.", "Keep your chest up and back straight.", "Drive through your heels to return to a standing position."],
        ["The ultimate lower body builder.", "Increases overall core strength and athletic performance."], 3, '8-10'
    ],
    ['legs', 'intermediate', 'Romanian Deadlifts (RDLs)', 'rdl.mp4',
        ["Hold a barbell or dumbbells in front of your thighs.", "Keeping a slight bend in your knees, push your hips back and lower the weight.", "Lower until you feel a deep stretch in your hamstrings, keeping your back flat.", "Return to a standing position by driving your hips forward."],
        ["Fantastic for hamstring development and flexibility.", "Strengthens the posterior chain and lower back."], 3, '8-10'
    ],
    ['legs', 'intermediate', 'Leg Press', 'leg_press.mp4',
        ["Sit on a leg press machine with your feet shoulder-width apart on the platform.", "Release the safety catches and lower the platform towards you.", "Press the platform back up until your legs are fully extended, without locking your knees."],
        ["Allows heavy volume on the quads without stressing the lower back.", "Excellent for quadriceps hypertrophy."], 3, '10-12'
    ],
    ['legs', 'intermediate', 'Calf Raises', 'calf_raises.mp4',
        ["Stand on a platform with the balls of your feet, letting your heels hang off.", "Raise your heels as high as possible, squeezing the calves.", "Lower your heels below the platform for a deep stretch."],
        ["Isolates the calf muscles effectively.", "Improves ankle strength and mobility."], 3, '15-20'
    ],

    // SHOULDER INTERMEDIATE
    ['shoulder', 'intermediate', 'Overhead Barbell Press', 'ohp.mp4',
        ["Stand with a barbell resting on your front deltoids/clavicle.", "Brace your core and press the bar straight overhead until your arms are fully extended.", "Lower the bar back to your upper chest under control."],
        ["Builds total shoulder strength and mass.", "Engages the core heavily."], 3, '8-10'
    ],
    ['shoulder', 'intermediate', 'Dumbbell Lateral Raises', 'lateral_raises.mp4',
        ["Hold a dumbbell in each hand by your sides.", "Keeping a slight bend in your elbows, raise the weights out to your sides until they are shoulder-level.", "Slowly lower the weights back to the start."],
        ["Isolates the lateral head of the deltoid for wide, capped shoulders.", "Vital for achieving the 'V-taper' look."], 3, '12-15'
    ],
    ['shoulder', 'intermediate', 'Face Pulls', 'face_pulls.mp4',
        ["Attach a rope to a cable pulley fixed at upper-chest height.", "Pull the rope towards your face, pulling your hands apart as they near your ears.", "Squeeze your rear deltoids and upper back.", "Return to the start slowly."],
        ["Crucial for rear deltoid development.", "Promotes excellent shoulder health and posture."], 3, '12-15'
    ],
    ['shoulder', 'intermediate', 'Reverse Pec Deck Flyes', 'reverse_pec_deck.mp4',
        ["Sit facing the pad of a pec deck machine.", "Grasp the handles and pull them back in a sweeping arc, focusing on your rear deltoids.", "Slowly return to the starting position."],
        ["Safely isolates the rear deltoids.", "Great for adding finishing volume to the shoulders."], 3, '12-15'
    ]
];

$inserted = 0;
foreach ($exercises as $ex) {
    // Check if it already exists to avoid duplicates
    $check = $conn->prepare("SELECT id FROM workout_exercises WHERE title = ? AND difficulty = ?");
    $check->bind_param("ss", $ex[2], $ex[1]);
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO workout_exercises (target_muscle, difficulty, title, video_filename, instructions_json, benefits_json, sets, reps) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $inst = json_encode($ex[4]);
        $ben = json_encode($ex[5]);
        $stmt->bind_param("ssssssis", $ex[0], $ex[1], $ex[2], $ex[3], $inst, $ben, $ex[6], $ex[7]);
        if ($stmt->execute()) {
            $inserted++;
        }
    }
}

echo "✓ Seeded $inserted Intermediate exercises.<br>";
?>
