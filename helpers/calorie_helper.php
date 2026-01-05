<?php

/**
 * This function calculates daily calorie needs
 * based on body details and fitness goal.
 */
function calculateDailyCalories($height_cm, $weight_kg, $age, $gender, $goal)
{
    // Step 1: Calculate BMR (Basal Metabolic Rate)
    // BMR = calories your body burns at rest

    if ($gender === 'male') {
        // Formula for males
        $bmr = (10 * $weight_kg) + (6.25 * $height_cm) - (5 * $age) + 5;
    } else {
        // Formula for females
        $bmr = (10 * $weight_kg) + (6.25 * $height_cm) - (5 * $age) - 161;
    }

    // Step 2: Add activity factor
    // 1.5 = moderate daily activity
    $maintenanceCalories = $bmr * 1.5;

    // Step 3: Adjust calories based on goal
    if ($goal === 'muscle_gain') {
        return round($maintenanceCalories + 300);
    }

    if ($goal === 'fat_loss') {
        return round($maintenanceCalories - 300);
    }

    // maintain body weight
    return round($maintenanceCalories);
}
