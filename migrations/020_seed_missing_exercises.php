<?php
require_once __DIR__ . '/../config/db.php';

$exercises = [
    // ABS
    ['abs', 'advanced', 'Ab Wheel Rollout', 'ab_wheel_rollout_video.mp4',
        ["Kneel on the floor holding an ab wheel.", "Roll the wheel straight forward, extending your body.", "Use your core to pull yourself back to the starting position."],
        ["Incredible core tension.", "Builds massive anti-extension strength."], 3, '10-15'],
    ['abs', 'intermediate', 'Decline Sit-ups', 'decline_situps_video.mp4',
        ["Secure your feet at the top of a decline bench.", "Lower your torso until you feel a stretch in your abs.", "Crunch up and squeeze at the top."],
        ["Increased range of motion compared to flat sit-ups.", "Strong lower and upper ab engagement."], 3, '15-20'],
    ['abs', 'advanced', 'Weighted Russian Twists', 'weighted_russian_twists_video.mp4',
        ["Sit with your feet elevated and hold a weight plate.", "Twist your torso to tap the plate on each side."],
        ["Builds rotational power.", "Thickens the obliques."], 4, '20-25'],
    ['abs', 'intermediate', 'Leg Raises', 'leg_raises_video.mp4',
        ["Lie flat on your back.", "Raise your legs straight up to a 90-degree angle.", "Slowly lower them without touching the floor."],
        ["Targets lower abdominals.", "Improves hip flexor strength."], 3, '15-20'],
    ['abs', 'intermediate', 'Knee Tucks', 'knee_tucks_video.mp4',
        ["Sit on a bench or floor, leaning back slightly.", "Tuck your knees into your chest while crunching your upper body forward."],
        ["Great isolation for the rectus abdominis.", "Low impact on the lower back."], 3, '15-20'],

    // ARMS
    ['arms', 'intermediate', 'EZ Bar Curl', 'ez_bar_curl_video.mp4',
        ["Hold an EZ bar with a standard grip.", "Curl the bar up, squeezing the biceps."],
        ["Less strain on the wrists than a straight barbell.", "Excellent mass builder."], 3, '10-12'],
    ['arms', 'intermediate', 'Incline Dumbbell Curl', 'incline_curl_video.mp4',
        ["Sit on an incline bench set to 45 degrees.", "Let your arms hang straight down, holding dumbbells.", "Curl up and squeeze."],
        ["Isolates the long head of the bicep.", "Provides an extreme stretch at the bottom of the movement."], 3, '10-12'],
    ['arms', 'advanced', 'Weighted Dips', 'weighted_dips_video.mp4',
        ["Attach a plate using a dip belt.", "Lower yourself on parallel bars until your triceps are parallel to the floor.", "Press back up."],
        ["Incredible triceps and chest mass builder.", "Forces high central nervous system recruitment."], 4, '8-10'],

    // BACK
    ['back', 'intermediate', 'Chest-Supported Row', 'chest_supported_row_video.mp4',
        ["Lie face down on an incline bench holding dumbbells or a barbell.", "Row the weight up, squeezing your shoulder blades together."],
        ["Removes lower back strain from the row.", "Pure isolation for the lats and rhomboids."], 3, '10-12'],
    ['back', 'intermediate', 'Straight Arm Pulldown', 'straight_arm_pulldown_video.mp4',
        ["Use a cable machine with a straight bar attached high.", "With straight arms, pull the bar down to your thighs.", "Squeeze the lats and return slowly."],
        ["Isolates the lats without engaging the biceps.", "Great pre-exhaust or finishing movement."], 3, '12-15'],
    ['back', 'advanced', 'T-Bar Row', 'tbar_row_video.mp4',
        ["Stand over a loaded T-bar or landmine setup.", "Hinge at the hips and row the bar into your chest.", "Use plates emphasizing the back stretch."],
        ["Massive thickness builder for the mid back.", "Allows very heavy loading."], 4, '8-10'],
    ['back', 'intermediate', 'Back Extension', 'back_extension_video.mp4',
        ["Lock your legs into a back extension machine.", "Lower your upper body until you feel a stretch in your hamstrings.", "Raise back up until your body is straight."],
        ["Strengthens the spinal erectors.", "Excellent for lower back health."], 3, '15-20'],
    ['back', 'advanced', 'Deadlift', 'deadlift_video.mp4',
        ["Stand over a loaded barbell with a shoulder-width stance.", "Hinge at the hips, grab the bar, and drive through the floor to stand up.", "Keep your back incredibly straight."],
        ["The king of posterior chain exercises.", "Builds total body strength."], 4, '5-8'],

    // CHEST
    ['chest', 'intermediate', 'Dumbbell Bench Press', 'dumbbell_bench_press_video.mp4',
        ["Lie flat on a bench holding dumbbells at your chest.", "Press them straight up and squeeze your pecs together.", "Lower with control."],
        ["Allows a deeper range of motion than a barbell.", "Fixes muscular imbalances between arms."], 3, '8-10'],
    ['chest', 'advanced', 'Dumbbell Pullover', 'dumbbell_pullover_video.mp4',
        ["Lie across a bench with your upper back resting on it.", "Hold a single dumbbell with both hands above your chest.", "Lower it behind your head until you feel a deep stretch, then pull it back up."],
        ["Expands the rib cage and stretches the chest.", "Works the lats and the pecs simultaneously."], 3, '10-12'],
    ['chest', 'advanced', 'Weighted Push-ups', 'weighted_pushup_video.mp4',
        ["Place a weight plate securely on your upper back.", "Perform standard push-ups with strict form."],
        ["Turns push-ups into a true strength-building movement.", "Forces core stabilization."], 4, '10-15'],

    // LEGS
    ['legs', 'advanced', 'Bulgarian Split Squat', 'bulgarian_split_squat_video.mp4',
        ["Place your rear foot elevated on a bench behind you.", "Hold dumbbells and squat down until your front thigh is parallel to the ground."],
        ["Isolates quads and glutes intensely.", "Corrects leg strength imbalances."], 4, '8-12'],
    ['legs', 'advanced', 'Front Squat', 'front_squat_video.mp4',
        ["Rest the barbell across your front deltoids (front rack position).", "Keep your chest up and squat down deeply."],
        ["Targets the quadriceps heavily.", "Requires extreme core strength to stay upright."], 4, '8-10'],
    ['legs', 'intermediate', 'Hack Squat', 'hack_squat_video.mp4',
        ["Use a hack squat machine.", "Keep your back flat against the pad and press the platform up.", "Lower deeply."],
        ["Takes the lower back out of the squat equation.", "Allows total quad isolation."], 3, '10-12'],
    ['legs', 'intermediate', 'Hamstring Curl', 'hamstring_curl_video.mp4',
        ["Use a lying leg curl machine.", "Curl the pad towards your glutes and squeeze."],
        ["Direct isolation for the hamstring muscles.", "Prevents knee injuries."], 3, '12-15'],
    ['legs', 'intermediate', 'Seated Hamstring Curl', 'seated_hamstring_curl_video.mp4',
        ["Sit in the machine and press your legs down against the pad.", "Control the eccentric phase."],
        ["Hits the hamstrings from a stretched hip position.", "Great for hamstring hypertrophy."], 3, '12-15'],
    ['legs', 'intermediate', 'Leg Extension', 'leg_extension_video.mp4',
        ["Sit in the machine and extend your legs straight.", "Squeeze the quads hard at the top."],
        ["Pure isolation for the quadriceps (especially the teardrop).", "Excellent finishing movement."], 3, '12-15'],
    ['legs', 'advanced', 'Nordic Curl', 'nordic_curl_video.mp4',
        ["Kneel on a pad and secure your ankles under a heavy weight.", "Lower your upper body slowly forward, using your hamstrings to brake.", "Push back up when you catch yourself."],
        ["Extreme eccentric hamstring strength builder.", "Bulletproofs the knees against injury."], 3, '5-8'],
    ['legs', 'advanced', 'Sumo Squat', 'sumo_squat_video.mp4',
        ["Take an ultra-wide stance with toes pointed outward.", "Squat straight down, keeping the chest up."],
        ["Heavily recruits the adductors and glutes.", "Allows a more upright torso than a standard squat."], 4, '8-10'],
    ['legs', 'advanced', 'Jump Squats', 'jump_squat_video.mp4',
        ["Perform a bodyweight squat, then explode upward into a jump.", "Land softly and smoothly transition into the next rep."],
        ["Builds explosive lower body power.", "Great for athletic conditioning."], 3, '15-20'],

    // SHOULDER
    ['shoulder', 'advanced', 'Standing Arnold Press', 'arnold_press_standing_video.mp4',
        ["Stand holding dumbbells in front of your chest with palms facing you.", "Press up while rotating your palms forward.", "Lower and twist back."],
        ["Hits all three heads of the deltoid.", "Requires immense core stability."], 4, '8-10'],
    ['shoulder', 'intermediate', 'Machine Shoulder Press', 'machine_shoulder_press_video.mp4',
        ["Sit in the press machine and grab the handles.", "Press overhead and control the descent."],
        ["Safe way to load heavy weight on the shoulders.", "Isolates the anterior deltoids."], 4, '10-12'],
    ['shoulder', 'intermediate', 'Cable Lateral Raise', 'cable_lateral_raise_video.mp4',
        ["Use a low cable pulley.", "Raise the handle out to your side, keeping a slight elbow bend."],
        ["Provides continuous tension unmatched by dumbbells.", "Excellent for side delt hypertrophy."], 3, '12-15'],
    ['shoulder', 'advanced', 'Cable Y-Raises', 'cable_y_raises_video.mp4',
        ["Stand between two low pulleys, crossing the cables.", "Raise them up and out into a 'Y' shape."],
        ["Isolates the lower traps and side delts.", "Improves shoulder posture and health."], 3, '12-15'],
    ['shoulder', 'advanced', 'Push Press', 'push_press_video.mp4',
        ["Hold a barbell in the front rack position.", "Dip slightly with your knees and explode up to drive the bar overhead."],
        ["Builds incredible total body pressing power.", "Overloads the shoulders and triceps."], 4, '5-8'],
    ['shoulder', 'advanced', 'Lateral Raise Dropset', 'lateral_raise_dropset_video.mp4',
        ["Perform a set of lateral raises to failure.", "Immediately drop the weight by 20% and go to failure again.", "Repeat once more."],
        ["Forces extreme blood flow and metabolic stress.", "Incredible shoulder pump."], 3, 'Mechanical Failure'],
        
    // CARDIO / EXTRAS (Mapped as Beginner/Intermediate)
    ['legs', 'advanced', 'Burpees', 'burpees_video.mp4',
        ["Drop into a push-up position, execute a push-up.", "Jump your feet back in.", "Explode up into a vertical jump."],
        ["The ultimate full-body conditioning movement.", "Burns massive calories."], 3, '15-20'],
    ['abs', 'beginner', 'Flutter Kicks', 'flutter_kicks_video.mp4',
        ["Lie flat on your back, raising your legs six inches.", "Kick them up and down in a fluttering motion."],
        ["Burns the lower abs.", "Builds endurance."], 3, '30-45s'],
    ['legs', 'beginner', 'Jumping Jacks', 'jumping_jacks_video.mp4',
        ["Jump while spreading your legs and raising your arms.", "Return to start."],
        ["Great warm-up movement.", "Increases heart rate rapidly."], 3, '60s']
];

$inserted = 0;
foreach ($exercises as $ex) {
    // Check if it already exists to avoid duplicates
    $check = $conn->prepare("SELECT id FROM workout_exercises WHERE video_filename = ?");
    $check->bind_param("s", $ex[3]);
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO workout_exercises (target_muscle, difficulty, title, video_filename, instructions_json, benefits_json, sets, reps) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $inst = json_encode($ex[4]);
        $ben = json_encode($ex[5]);
        $stmt->bind_param("ssssssis", $ex[0], $ex[1], $ex[2], $ex[3], $inst, $ben, $ex[6], $ex[7]);
        if ($stmt->execute()) {
            $inserted++;
            echo "Inserted: {$ex[2]}<br>\n";
        }
    }
}
echo "Done. Inserted $inserted new exercises to fill out Intermediate/Advanced layers.";
?>
