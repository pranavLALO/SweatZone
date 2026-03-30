<?php
// Bypass API authentication for testing purposes
require_once __DIR__ . '/../config/db.php';

// Get parameters from URL or use defaults
// Example usage: http://localhost/SweatZone/workouts/test_stats.php?user_id=1&period=week
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 1; 
$period = isset($_GET['period']) ? $_GET['period'] : 'week';

echo "<h1>Testing Workout Stats</h1>";
echo "<p>User ID: $user_id</p>";
echo "<p>Period: $period</p>";
echo "<hr>";

$interval = "6 DAY"; // Default week
$dateFormat = "%Y-%m-%d"; // Daily
$phpDateFormat = "Y-m-d";
$groupByInfo = "DATE(created_at)";
$selectDate = "DATE(created_at)";

if ($period === 'month') {
    $interval = "29 DAY";
} elseif ($period === 'year') {
    $interval = "11 MONTH";
    $dateFormat = "%Y-%m"; // Monthly
    $phpDateFormat = "Y-m";
    $groupByInfo = "DATE_FORMAT(created_at, '%Y-%m')";
    $selectDate = "DATE_FORMAT(created_at, '%Y-%m')";
}

// debug: show sql vars
// echo "<pre>Interval: $interval</pre>";

// Query
$sql = "SELECT $selectDate as workout_date, COUNT(*) as count 
        FROM user_workouts 
        WHERE user_id = ? 
        AND created_at >= DATE_SUB(CURDATE(), INTERVAL $interval)
        GROUP BY $groupByInfo
        ORDER BY workout_date ASC";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$stats = [];
while ($row = $result->fetch_assoc()) {
    $label = "";
    if ($period === 'year') {
        $label = date('M', strtotime($row['workout_date'] . "-01")); // Jan, Feb...
    } else {
        $label = date('D', strtotime($row['workout_date'])); // Mon, Tue...
    }

    $stats[] = [
        "date" => $row['workout_date'],
        "count" => (int)$row['count'],
        "day" => $label // reusing 'day' field as label
    ];
}

echo "<h3>Raw Database Results (before filling gaps):</h3>";
echo "<pre>" . json_encode($stats, JSON_PRETTY_PRINT) . "</pre>";

// Gap Filling
$filled_stats = [];
// Logic to fill gaps based on period
if ($period === 'year') {
    for ($i = 11; $i >= 0; $i--) {
        $d = date('Y-m', strtotime("-$i months"));
        $label = date('M', strtotime("-$i months"));
        
        $found = false;
        foreach ($stats as $stat) {
            if ($stat['date'] === $d) {
                $filled_stats[] = $stat;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $filled_stats[] = ["date" => $d, "count" => 0, "day" => $label];
        }
    }
} else {
    // Daily (Week or Month)
    $daysCount = $period === 'month' ? 29 : 6;
    for ($i = $daysCount; $i >= 0; $i--) {
        // IMPORTANT: The original code used just "-$i days" which relies on current server time.
        // Make sure this aligns with DB CURDATE() if testing across timezones, but usually fine for local dev.
        $d = date('Y-m-d', strtotime("-$i days"));
        $label = date('D', strtotime("-$i days"));
        
        $found = false;
        foreach ($stats as $stat) {
            // Note: Original code logic comparison
            if ($stat['date'] === $d) {
                $filled_stats[] = $stat;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $filled_stats[] = ["date" => $d, "count" => 0, "day" => $label];
        }
    }
}

echo "<h3>Final Processed Response (with gap filling):</h3>";
echo "<pre>" . json_encode($filled_stats, JSON_PRETTY_PRINT) . "</pre>";
?>
