<?php
require __DIR__ . '/../config/db.php';

// 1. Add Column if not exists
// We use a safe try-catch or check existence. MySQL ADD COLUMN IF NOT EXISTS is 8.0+. 
// Simple way: Try to add, suppress error or check logic.
// Better: SELECT count(*) FROM information_schema.COLUMNS WHERE TABLE_NAME='meals' AND COLUMN_NAME='is_vegetarian'

$checkCol = $conn->query("SHOW COLUMNS FROM meals LIKE 'is_vegetarian'");
if ($checkCol->num_rows == 0) {
    $sql = "ALTER TABLE meals ADD COLUMN is_vegetarian TINYINT(1) DEFAULT 0";
    if ($conn->query($sql) === TRUE) {
        echo "Column 'is_vegetarian' added.<br>";
    } else {
        echo "Error adding column: " . $conn->error . "<br>";
    }
} else {
    echo "Column 'is_vegetarian' already exists.<br>";
}

// 2. Seed Data (Update existing meals)
// Veg Items: Oatmeal, Yogurt, Toast, Smoothie, Pancakes, Pasta (some), Salad (some), Nuts, Cheese, Eggs (Ovo-veg)
// Non-Veg: Chicken, Beef, Turkey, Fish, Tuna, Shrimp, Steak

// Set everything to 0 first (Non-Veg default)
$conn->query("UPDATE meals SET is_vegetarian = 0");

// Update Vegeterian Items
$veg_keywords = [
    'Oatmeal', 'Yogurt', 'Toast', 'Smoothie', 'Pancakes', 'Cheese', 'Egg', 'Nuts', 'Apple', 'Carrot', 'Rice Cake', 'Pasta', 'Curry' // Assuming Curry & Naan is veg for now or we check specifically
];

// Specific updates for known seeds
$updates = [
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Oatmeal%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Yogurt%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Toast%'", // Avocado Toast with Eggs
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Smoothie%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Pancakes%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Egg%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Cheese%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Almonds%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Apple%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Carrot%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Rice Cake%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Lentil%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Zucchini%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Fruit%'",
    "UPDATE meals SET is_vegetarian = 1 WHERE meal_name LIKE '%Pasta%'", // Pasta with Meat Sauce might be an issue, but standard Pasta valid
    "UPDATE meals SET is_vegetarian = 0 WHERE meal_name LIKE '%Meat Sauce%'", // Fix Pasta with Meat Sauce
];

foreach ($updates as $q) {
    $conn->query($q);
}

echo "Vegetarian status updated for meals.<br>";
?>
