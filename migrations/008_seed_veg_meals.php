<?php
require __DIR__ . '/../config/db.php';

// Veg Muscle Gain Meals (High Protein, No Meat)
$meals = [
    // Lunch
    ["Lentil & Spinach Curry with Rice", 600, 25, 80, 10, 'lunch', 'muscle_gain', 1],
    ["Tofu Stir Fry with Quinoa", 550, 30, 60, 20, 'lunch', 'muscle_gain', 1],
    ["Chickpea Salad Sandwich (2)", 500, 20, 70, 15, 'lunch', 'muscle_gain', 1],
    ["Black Bean Burrito Bowl", 700, 25, 90, 20, 'lunch', 'muscle_gain', 1],

    // Dinner
    ["Paneer Tikka Masala & Roti", 700, 30, 60, 35, 'dinner', 'muscle_gain', 1],
    ["Soy Chunk Pulao", 650, 35, 80, 15, 'dinner', 'muscle_gain', 1],
    ["Quinoa & Black Bean Chili", 550, 25, 70, 15, 'dinner', 'muscle_gain', 1],
    ["Tempeh Tacos (3)", 600, 30, 50, 25, 'dinner', 'muscle_gain', 1],
    
    // Weight Loss Veg Lunch/Dinner (just in case)
    ["Grilled Tofu Salad", 350, 25, 10, 20, 'lunch', 'weight_loss', 1],
    ["Cauliflower Rice Stir Fry", 300, 15, 20, 15, 'dinner', 'weight_loss', 1],
];

$stmt = $conn->prepare("INSERT INTO meals (meal_name, calories, protein, carbs, fats, meal_type, purpose, is_vegetarian) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($meals as $m) {
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        break; // Stop if prepare fails
    }
    // s i i i i s s i
    $stmt->bind_param("siiiissi", $m[0], $m[1], $m[2], $m[3], $m[4], $m[5], $m[6], $m[7]);
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
}

echo "Vegetarian Muscle Gain Meals seeded!<br>";
?>
