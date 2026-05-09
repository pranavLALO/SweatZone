<?php
require __DIR__ . '/../config/db.php';

// 1. Create Meals Table
$sql = "CREATE TABLE IF NOT EXISTS meals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    meal_name VARCHAR(100) NOT NULL,
    calories INT NOT NULL,
    protein INT NOT NULL,
    carbs INT NOT NULL,
    fats INT NOT NULL,
    meal_type ENUM('breakfast', 'lunch', 'snack', 'dinner') NOT NULL,
    purpose ENUM('weight_loss', 'muscle_gain', 'maintain') NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'meals' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// 2. Clear existing meals to avoid duplicates during dev
$conn->query("TRUNCATE TABLE meals");

// 3. Seed Data
$meals = [
    // --- MUSCLE GAIN ---
    // Breakfast
    ["Oatmeal with Whey Protein", 450, 30, 50, 10, 'breakfast', 'muscle_gain'],
    ["Scrambled Eggs (4) & Toast", 500, 28, 30, 25, 'breakfast', 'muscle_gain'],
    ["Greek Yogurt Parfait", 350, 20, 40, 5, 'breakfast', 'muscle_gain'],
    ["Avocado Toast with Eggs", 480, 20, 35, 25, 'breakfast', 'muscle_gain'],
    ["Peanut Butter Banana Smoothie", 600, 25, 60, 20, 'breakfast', 'muscle_gain'],
    ["Protein Pancakes", 550, 40, 50, 10, 'breakfast', 'muscle_gain'],
    
    // Lunch
    ["Chicken Breast & Rice", 600, 50, 70, 10, 'lunch', 'muscle_gain'],
    ["Beef Stir Fry", 700, 45, 60, 25, 'lunch', 'muscle_gain'],
    ["Turkey Burger with Sweet Potato", 550, 40, 50, 15, 'lunch', 'muscle_gain'],
    ["Pasta with Meat Sauce", 800, 40, 90, 20, 'lunch', 'muscle_gain'],
    ["Salmon & Quinoa", 600, 35, 50, 25, 'lunch', 'muscle_gain'],
    ["Tuna Sandwich (2)", 500, 40, 50, 10, 'lunch', 'muscle_gain'],

    // Snack
    ["Protein Bar", 250, 20, 25, 8, 'snack', 'muscle_gain'],
    ["Handful of Almonds", 200, 7, 6, 15, 'snack', 'muscle_gain'],
    ["Cottage Cheese", 150, 15, 5, 2, 'snack', 'muscle_gain'],
    ["Boiled Eggs (2)", 140, 12, 1, 10, 'snack', 'muscle_gain'],

    // Dinner
    ["Steak & Potatoes", 800, 60, 60, 30, 'dinner', 'muscle_gain'],
    ["Chicken Alfredo", 900, 45, 80, 40, 'dinner', 'muscle_gain'],
    ["Burrito Bowl", 750, 40, 80, 25, 'dinner', 'muscle_gain'],
    ["Fish Tacos (3)", 600, 35, 50, 20, 'dinner', 'muscle_gain'],
    ["Lean Ground Beef & Rice", 700, 50, 60, 20, 'dinner', 'muscle_gain'],
    ["Chicken Curry & Naan", 800, 45, 70, 30, 'dinner', 'muscle_gain'],

    // --- WEIGHT LOSS ---
    // Breakfast
    ["Egg White Omelet", 250, 25, 5, 10, 'breakfast', 'weight_loss'],
    ["Oatmeal with Berries", 300, 10, 50, 5, 'breakfast', 'weight_loss'],
    ["Green Smoothie", 200, 5, 30, 2, 'breakfast', 'weight_loss'],
    ["Greek Yogurt (Low Fat)", 150, 15, 10, 0, 'breakfast', 'weight_loss'],
    ["Boiled Eggs (2)", 140, 12, 1, 10, 'breakfast', 'weight_loss'],
    ["Slice of Toast & Apple", 200, 4, 40, 2, 'breakfast', 'weight_loss'],

    // Lunch
    ["Grilled Chicken Salad", 350, 40, 10, 15, 'lunch', 'weight_loss'],
    ["Turkey Wrap", 400, 30, 30, 10, 'lunch', 'weight_loss'],
    ["Tuna Salad", 300, 25, 5, 15, 'lunch', 'weight_loss'],
    ["Lentil Soup", 350, 15, 50, 5, 'lunch', 'weight_loss'],
    ["Grilled Fish & High Veggies", 350, 35, 10, 10, 'lunch', 'weight_loss'],
    ["Zucchini Noodles with Sauce", 250, 5, 30, 10, 'lunch', 'weight_loss'],

    // Snack
    ["Apple", 80, 0, 20, 0, 'snack', 'weight_loss'],
    ["Carrot Sticks", 50, 1, 10, 0, 'snack', 'weight_loss'],
    ["Rice Cake", 40, 1, 8, 0, 'snack', 'weight_loss'],
    ["Greek Yogurt Cup", 100, 10, 5, 0, 'snack', 'weight_loss'],

    // Dinner
    ["Salmon & Asparagus", 450, 35, 5, 25, 'dinner', 'weight_loss'],
    ["Chicken Stir Fry (No Rice)", 400, 40, 15, 15, 'dinner', 'weight_loss'],
    ["Shrimp Salad", 350, 30, 10, 10, 'dinner', 'weight_loss'],
    ["Stuffed Peppers", 400, 25, 30, 15, 'dinner', 'weight_loss'],
    ["Vegetable Soup with Chicken", 300, 25, 20, 5, 'dinner', 'weight_loss'],
    ["Lean Beef Patty (No Bun)", 400, 30, 0, 25, 'dinner', 'weight_loss'],
    
    // --- MAINTAIN (Mix of both, mapped to maintain) ---
    ["Balanced Breakfast Plate", 500, 25, 50, 20, 'breakfast', 'maintain'],
    ["Sandwich & Fruit", 450, 20, 60, 15, 'lunch', 'maintain'],
    ["Chicken & Veggies", 500, 40, 30, 20, 'dinner', 'maintain'],
    ["Yogurt & Nuts", 300, 15, 20, 15, 'snack', 'maintain'],
    ["Smoothie", 400, 20, 50, 10, 'breakfast', 'maintain'],
    ["Wrap", 500, 30, 50, 20, 'lunch', 'maintain'],
    ["Pasta", 600, 20, 80, 15, 'dinner', 'maintain'],
    ["Fruit Salad", 200, 2, 45, 1, 'snack', 'maintain'],
];

$stmt = $conn->prepare("INSERT INTO meals (meal_name, calories, protein, carbs, fats, meal_type, purpose) VALUES (?, ?, ?, ?, ?, ?, ?)");

foreach ($meals as $m) {
    // Check if enough params. $m has 7 items.
    // bind_param: s i i i i s s
    $stmt->bind_param("siiiiss", $m[0], $m[1], $m[2], $m[3], $m[4], $m[5], $m[6]);
    $stmt->execute();
}

echo "Meals seeded successfully!";
?>
