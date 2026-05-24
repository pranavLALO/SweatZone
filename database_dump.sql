-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2026 at 05:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sweatzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `body_profiles`
--

CREATE TABLE `body_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `height_cm` decimal(5,2) NOT NULL,
  `weight_kg` decimal(5,2) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `age` int(11) DEFAULT NULL,
  `goal` varchar(50) DEFAULT 'maintain',
  `activity_level` varchar(50) DEFAULT 'moderate',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `body_profiles`
--

INSERT INTO `body_profiles` (`id`, `user_id`, `height_cm`, `weight_kg`, `gender`, `age`, `goal`, `activity_level`, `created_at`) VALUES
(1, 1, 167.00, 69.00, 'Female', 25, 'Strength Training for Muscle Gain', 'Beginner', '2026-03-28 13:56:22'),
(2, 2, 183.00, 65.00, 'Male', 25, 'Strength Training for Muscle Gain', 'Intermediate', '2026-03-31 07:04:01'),
(3, 3, 175.00, 67.00, 'Male', 25, 'High-Intensity Interval Training for Fat Loss', 'Intermediate', '2026-04-03 03:59:29'),
(4, 4, 175.00, 77.00, 'Male', 25, 'Functional Training for Overall Fitness', 'Advanced', '2026-04-03 04:18:58'),
(5, 5, 184.00, 65.00, 'Male', 25, 'Strength Training for Muscle Gain', 'Advanced', '2026-04-05 14:49:50'),
(6, 6, 175.00, 67.00, 'Male', 25, 'High-Intensity Interval Training for Fat Loss', 'Intermediate', '2026-04-06 05:00:55'),
(7, 7, 183.00, 68.00, 'Male', 25, 'Functional Training for Overall Fitness', 'Advanced', '2026-05-07 07:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `custom_routine_exercises`
--

CREATE TABLE `custom_routine_exercises` (
  `id` int(11) NOT NULL,
  `routine_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `order_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_routine_exercises`
--

INSERT INTO `custom_routine_exercises` (`id`, `routine_id`, `exercise_id`, `order_index`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 11, 3),
(4, 1, 20, 4),
(5, 1, 15, 5),
(6, 1, 6, 6),
(7, 1, 16, 7),
(8, 2, 1, 1),
(9, 2, 2, 2),
(10, 2, 11, 3),
(11, 2, 20, 4),
(12, 2, 6, 5),
(13, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `diet_plans`
--

CREATE TABLE `diet_plans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_date` date NOT NULL,
  `total_calories` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diet_plans`
--

INSERT INTO `diet_plans` (`id`, `user_id`, `plan_date`, `total_calories`) VALUES
(1, 1, '2026-03-30', 2172),
(4, 2, '2026-03-31', 2262),
(6, 5, '2026-04-27', 2271),
(8, 7, '2026-05-07', 2355),
(9, 7, '2026-05-08', 2327);

-- --------------------------------------------------------

--
-- Table structure for table `diet_plan_meals`
--

CREATE TABLE `diet_plan_meals` (
  `id` int(11) NOT NULL,
  `diet_plan_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `meal_time` enum('breakfast','lunch','snack','dinner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diet_plan_meals`
--

INSERT INTO `diet_plan_meals` (`id`, `diet_plan_id`, `meal_id`, `meal_time`) VALUES
(17, 1, 45, 'breakfast'),
(18, 1, 49, 'breakfast'),
(19, 1, 46, 'lunch'),
(20, 1, 50, 'lunch'),
(21, 1, 52, 'snack'),
(22, 1, 48, 'snack'),
(23, 1, 47, 'dinner'),
(24, 1, 51, 'dinner'),
(33, 4, 45, 'breakfast'),
(34, 4, 49, 'breakfast'),
(35, 4, 50, 'lunch'),
(36, 4, 46, 'lunch'),
(37, 4, 52, 'snack'),
(38, 4, 48, 'snack'),
(39, 4, 47, 'dinner'),
(40, 4, 51, 'dinner'),
(49, 6, 45, 'breakfast'),
(50, 6, 49, 'breakfast'),
(51, 6, 50, 'lunch'),
(52, 6, 46, 'lunch'),
(53, 6, 48, 'snack'),
(54, 6, 52, 'snack'),
(55, 6, 51, 'dinner'),
(56, 6, 47, 'dinner'),
(57, 8, 45, 'breakfast'),
(58, 8, 49, 'breakfast'),
(59, 8, 50, 'lunch'),
(60, 8, 46, 'lunch'),
(61, 8, 52, 'snack'),
(62, 8, 48, 'snack'),
(63, 8, 47, 'dinner'),
(64, 8, 51, 'dinner'),
(65, 9, 49, 'breakfast'),
(66, 9, 45, 'breakfast'),
(67, 9, 50, 'lunch'),
(68, 9, 46, 'lunch'),
(69, 9, 48, 'snack'),
(70, 9, 52, 'snack'),
(71, 9, 51, 'dinner'),
(72, 9, 47, 'dinner');

-- --------------------------------------------------------

--
-- Table structure for table `form_scores`
--

CREATE TABLE `form_scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exercise_name` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `metrics_json` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_scores`
--

INSERT INTO `form_scores` (`id`, `user_id`, `exercise_name`, `score`, `metrics_json`, `created_at`) VALUES
(1, 1, 'Squat', 80, NULL, '2026-03-30 03:34:30'),
(2, 1, 'Squat', 80, NULL, '2026-03-30 04:01:29'),
(3, 2, 'Squat', 80, NULL, '2026-03-31 07:05:50'),
(4, 2, 'Push-up', 75, NULL, '2026-03-31 07:06:25'),
(5, 2, 'Push-up', 75, NULL, '2026-03-31 07:06:52'),
(6, 2, 'Push-up', 70, NULL, '2026-03-31 07:07:13'),
(7, 2, 'Plank', 60, NULL, '2026-03-31 07:07:50'),
(8, 2, 'Plank', 60, NULL, '2026-03-31 07:08:04'),
(9, 5, 'Squat', 80, NULL, '2026-04-27 13:57:30'),
(10, 7, 'Squat', 100, NULL, '2026-05-08 03:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `meal_name` varchar(100) NOT NULL,
  `calories` int(11) NOT NULL,
  `protein` int(11) NOT NULL,
  `carbs` int(11) NOT NULL,
  `fats` int(11) NOT NULL,
  `meal_type` enum('breakfast','lunch','snack','dinner') NOT NULL,
  `purpose` enum('weight_loss','muscle_gain','maintain') NOT NULL,
  `is_vegetarian` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `meal_name`, `calories`, `protein`, `carbs`, `fats`, `meal_type`, `purpose`, `is_vegetarian`) VALUES
(1, 'Oatmeal with Whey Protein', 450, 30, 50, 10, 'breakfast', 'muscle_gain', 1),
(2, 'Scrambled Eggs (4) & Toast', 500, 28, 30, 25, 'breakfast', 'muscle_gain', 1),
(3, 'Greek Yogurt Parfait', 350, 20, 40, 5, 'breakfast', 'muscle_gain', 1),
(4, 'Avocado Toast with Eggs', 480, 20, 35, 25, 'breakfast', 'muscle_gain', 1),
(5, 'Peanut Butter Banana Smoothie', 600, 25, 60, 20, 'breakfast', 'muscle_gain', 1),
(6, 'Protein Pancakes', 550, 40, 50, 10, 'breakfast', 'muscle_gain', 1),
(7, 'Chicken Breast & Rice', 600, 50, 70, 10, 'lunch', 'muscle_gain', 0),
(8, 'Beef Stir Fry', 700, 45, 60, 25, 'lunch', 'muscle_gain', 0),
(9, 'Turkey Burger with Sweet Potato', 550, 40, 50, 15, 'lunch', 'muscle_gain', 0),
(10, 'Pasta with Meat Sauce', 800, 40, 90, 20, 'lunch', 'muscle_gain', 0),
(11, 'Salmon & Quinoa', 600, 35, 50, 25, 'lunch', 'muscle_gain', 0),
(12, 'Tuna Sandwich (2)', 500, 40, 50, 10, 'lunch', 'muscle_gain', 0),
(13, 'Protein Bar', 250, 20, 25, 8, 'snack', 'muscle_gain', 0),
(14, 'Handful of Almonds', 200, 7, 6, 15, 'snack', 'muscle_gain', 1),
(15, 'Cottage Cheese', 150, 15, 5, 2, 'snack', 'muscle_gain', 1),
(16, 'Boiled Eggs (2)', 140, 12, 1, 10, 'snack', 'muscle_gain', 1),
(17, 'Steak & Potatoes', 800, 60, 60, 30, 'dinner', 'muscle_gain', 0),
(18, 'Chicken Alfredo', 900, 45, 80, 40, 'dinner', 'muscle_gain', 0),
(19, 'Burrito Bowl', 750, 40, 80, 25, 'dinner', 'muscle_gain', 0),
(20, 'Fish Tacos (3)', 600, 35, 50, 20, 'dinner', 'muscle_gain', 0),
(21, 'Lean Ground Beef & Rice', 700, 50, 60, 20, 'dinner', 'muscle_gain', 0),
(22, 'Chicken Curry & Naan', 800, 45, 70, 30, 'dinner', 'muscle_gain', 0),
(23, 'Egg White Omelet', 250, 25, 5, 10, 'breakfast', 'weight_loss', 1),
(24, 'Oatmeal with Berries', 300, 10, 50, 5, 'breakfast', 'weight_loss', 1),
(25, 'Green Smoothie', 200, 5, 30, 2, 'breakfast', 'weight_loss', 1),
(26, 'Greek Yogurt (Low Fat)', 150, 15, 10, 0, 'breakfast', 'weight_loss', 1),
(27, 'Boiled Eggs (2)', 140, 12, 1, 10, 'breakfast', 'weight_loss', 1),
(28, 'Slice of Toast & Apple', 200, 4, 40, 2, 'breakfast', 'weight_loss', 1),
(29, 'Grilled Chicken Salad', 350, 40, 10, 15, 'lunch', 'weight_loss', 0),
(30, 'Turkey Wrap', 400, 30, 30, 10, 'lunch', 'weight_loss', 0),
(31, 'Tuna Salad', 300, 25, 5, 15, 'lunch', 'weight_loss', 0),
(32, 'Lentil Soup', 350, 15, 50, 5, 'lunch', 'weight_loss', 1),
(33, 'Grilled Fish & High Veggies', 350, 35, 10, 10, 'lunch', 'weight_loss', 1),
(34, 'Zucchini Noodles with Sauce', 250, 5, 30, 10, 'lunch', 'weight_loss', 1),
(35, 'Apple', 80, 0, 20, 0, 'snack', 'weight_loss', 1),
(36, 'Carrot Sticks', 50, 1, 10, 0, 'snack', 'weight_loss', 1),
(37, 'Rice Cake', 40, 1, 8, 0, 'snack', 'weight_loss', 1),
(38, 'Greek Yogurt Cup', 100, 10, 5, 0, 'snack', 'weight_loss', 1),
(39, 'Salmon & Asparagus', 450, 35, 5, 25, 'dinner', 'weight_loss', 0),
(40, 'Chicken Stir Fry (No Rice)', 400, 40, 15, 15, 'dinner', 'weight_loss', 0),
(41, 'Shrimp Salad', 350, 30, 10, 10, 'dinner', 'weight_loss', 0),
(42, 'Stuffed Peppers', 400, 25, 30, 15, 'dinner', 'weight_loss', 0),
(43, 'Vegetable Soup with Chicken', 300, 25, 20, 5, 'dinner', 'weight_loss', 0),
(44, 'Lean Beef Patty (No Bun)', 400, 30, 0, 25, 'dinner', 'weight_loss', 0),
(45, 'Balanced Breakfast Plate', 500, 25, 50, 20, 'breakfast', 'maintain', 0),
(46, 'Sandwich & Fruit', 450, 20, 60, 15, 'lunch', 'maintain', 1),
(47, 'Chicken & Veggies', 500, 40, 30, 20, 'dinner', 'maintain', 1),
(48, 'Yogurt & Nuts', 300, 15, 20, 15, 'snack', 'maintain', 1),
(49, 'Smoothie', 400, 20, 50, 10, 'breakfast', 'maintain', 1),
(50, 'Wrap', 500, 30, 50, 20, 'lunch', 'maintain', 0),
(51, 'Pasta', 600, 20, 80, 15, 'dinner', 'maintain', 1),
(52, 'Fruit Salad', 200, 2, 45, 1, 'snack', 'maintain', 1),
(53, 'Lentil & Spinach Curry with Rice', 600, 25, 80, 10, 'lunch', 'muscle_gain', 1),
(54, 'Tofu Stir Fry with Quinoa', 550, 30, 60, 20, 'lunch', 'muscle_gain', 1),
(55, 'Chickpea Salad Sandwich (2)', 500, 20, 70, 15, 'lunch', 'muscle_gain', 1),
(56, 'Black Bean Burrito Bowl', 700, 25, 90, 20, 'lunch', 'muscle_gain', 1),
(57, 'Paneer Tikka Masala & Roti', 700, 30, 60, 35, 'dinner', 'muscle_gain', 1),
(58, 'Soy Chunk Pulao', 650, 35, 80, 15, 'dinner', 'muscle_gain', 1),
(59, 'Quinoa & Black Bean Chili', 550, 25, 70, 15, 'dinner', 'muscle_gain', 1),
(60, 'Tempeh Tacos (3)', 600, 30, 50, 25, 'dinner', 'muscle_gain', 1),
(61, 'Grilled Tofu Salad', 350, 25, 10, 20, 'lunch', 'weight_loss', 1),
(62, 'Cauliflower Rice Stir Fry', 300, 15, 20, 15, 'dinner', 'weight_loss', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_otp` varchar(6) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `reset_otp`, `reset_expires`) VALUES
(1, 'sudhi', 'sudhi@gmail.com', '$2y$10$cdM3j84PB0pg32k7BGD96.Bk/rFIYYs3wolIY/4nWx3G7SFgwPVQ6', '2026-03-28 13:55:49', NULL, NULL),
(2, 'Pranav', 'pranav45@gmail.com', '$2y$10$pmDu.sV4J9y1pOItxIN9Bu8gU7aW0.aAeXK7lVKwRrKi9ghwUsiY2', '2026-03-31 07:03:23', NULL, NULL),
(3, 'rush', 'rust12@gmail.com', '$2y$10$SpxL.PJq3W.98EuIop9.UuOXgxPYjV7vhcyz5ONUQrxaiWvb.uhJa', '2026-04-03 03:59:17', NULL, NULL),
(4, 'advance', 'ad@gmail.com', '$2y$10$GzgA2pcskwVvOkY5dVeBYOinEb9fVDsSbInpkGz0KfAKNbGNaEWcC', '2026-04-03 04:18:50', NULL, NULL),
(5, 'Pranav', 'pranavravi2005@gmail.com', '$2y$10$ZtftWviIYe4wnlY2QJG7iu6rZdMylpJTHoyRtWtP7TYOo4axknROG', '2026-04-05 14:49:40', NULL, NULL),
(6, 'Pranav', 'narendrankoti1973@gmail.com', '$2y$10$AIldb6/630nR6KtPbARfsu1OFhpoDNvNNGAHt0JZOoIiGJJ5PPoXG', '2026-04-06 05:00:28', NULL, NULL),
(7, 'Dhanacheziyan', '252534051.sclas@saveetha.com', '$2y$10$sKxSFU96I6qrzndiivervesU6zUMDsA357EmkiVRwD5OAr.hIXsd2', '2026-05-07 07:37:18', '549391', '2026-05-12 05:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `user_achievements`
--

CREATE TABLE `user_achievements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `routine_id` int(11) NOT NULL,
  `badge_type` enum('consistency','progression') NOT NULL,
  `tier` enum('bronze','silver','gold') NOT NULL,
  `unlocked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_custom_routines`
--

CREATE TABLE `user_custom_routines` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `routine_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_custom_routines`
--

INSERT INTO `user_custom_routines` (`id`, `user_id`, `routine_name`, `created_at`) VALUES
(1, 6, 'FirstWorkout', '2026-04-06 08:07:09'),
(2, 5, 'New', '2026-04-27 13:56:34'),
(3, 7, 'New', '2026-05-08 04:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_workouts`
--

CREATE TABLE `user_workouts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `workout_date` date NOT NULL,
  `muscle_group` varchar(50) NOT NULL,
  `intensity` varchar(20) DEFAULT 'medium',
  `duration_seconds` int(11) DEFAULT 0,
  `progress_percentage` int(11) DEFAULT 0,
  `weight_kg` int(11) DEFAULT 0,
  `completed_sets` int(11) DEFAULT 0,
  `completed_reps` int(11) DEFAULT 0,
  `timer_seconds_used` int(11) DEFAULT 0,
  `routine_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_workouts`
--

INSERT INTO `user_workouts` (`id`, `user_id`, `workout_date`, `muscle_group`, `intensity`, `duration_seconds`, `progress_percentage`, `weight_kg`, `completed_sets`, `completed_reps`, `timer_seconds_used`, `routine_id`) VALUES
(1, 1, '2026-03-30', 'shoulder', 'medium', 39, 30, 0, 0, 0, 0, NULL),
(2, 2, '2026-03-31', 'chest', 'medium', 17, 30, 0, 0, 0, 0, NULL),
(3, 2, '2026-03-31', 'shoulder', 'medium', 10, 30, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `water_logs`
--

CREATE TABLE `water_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_date` date NOT NULL,
  `glasses` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_logs`
--

INSERT INTO `water_logs` (`id`, `user_id`, `log_date`, `glasses`, `created_at`) VALUES
(1, 7, '2026-05-08', 1, '2026-05-08 03:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `workout_exercises`
--

CREATE TABLE `workout_exercises` (
  `id` int(11) NOT NULL,
  `target_muscle` varchar(50) NOT NULL,
  `difficulty` enum('beginner','intermediate','advanced') NOT NULL,
  `title` varchar(150) NOT NULL,
  `video_filename` varchar(255) NOT NULL,
  `instructions_json` text NOT NULL,
  `benefits_json` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sets` int(11) DEFAULT 3,
  `reps` varchar(50) DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_exercises`
--

INSERT INTO `workout_exercises` (`id`, `target_muscle`, `difficulty`, `title`, `video_filename`, `instructions_json`, `benefits_json`, `created_at`, `sets`, `reps`) VALUES
(1, 'chest', 'beginner', 'Push Up', 'pushup_video.mp4', '[\"Get on the floor on all fours.\",\"Straighten arms and legs.\",\"Lower chest to floor.\",\"Push back up.\"]', '[\"Strengthens chest.\",\"Targets core.\"]', '2026-03-31 15:33:02', 3, '10'),
(2, 'chest', 'beginner', 'Incline Push Up', 'incline_pushup_video.mp4', '[\"Hands on bench.\",\"Lower chest to edge.\",\"Push back up.\"]', '[\"Easier on shoulders.\",\"Targets lower chest.\"]', '2026-03-31 15:33:02', 3, '10'),
(3, 'chest', 'beginner', 'Knee Push Up', 'knee_pushup_video.mp4', '[\"Knees on floor.\",\"Lower chest.\",\"Push up.\"]', '[\"Good for beginners.\",\"Builds strength.\"]', '2026-03-31 15:33:02', 3, '10'),
(4, 'chest', 'beginner', 'Barbell Bench Press', 'bench_press_video.mp4', '[\"Lie on bench.\",\"Lower bar to chest.\",\"Press up.\"]', '[\"Mass builder.\",\"Full chest activation.\"]', '2026-03-31 15:33:02', 3, '10'),
(5, 'chest', 'beginner', 'Incline Bench Press', 'incline_bench_video.mp4', '[\"Set bench to 30 degrees.\",\"Press weight up.\",\"Lower slowly.\"]', '[\"Upper chest focus.\",\"Shoulder strength.\"]', '2026-03-31 15:33:02', 3, '10'),
(6, 'shoulder', 'beginner', 'Dumbbell Shoulder Press', 'shoulder_press_video.mp4', '[\"Sit on a bench with back support.\",\"Hold dumbbells at shoulder height.\",\"Press weights up until arms are extended.\",\"Lower back to start.\"]', '[\"Targets anterior and lateral deltoids.\",\"Engages triceps and upper chest.\",\"Improves overhead stability.\"]', '2026-03-31 15:33:02', 3, '10'),
(7, 'shoulder', 'beginner', 'Front Raises', 'front_raises_video.mp4', '[\"Stand with dumbbells in front of thighs.\",\"Lift weights to shoulder height.\",\"Lower slowly.\"]', '[\"Isolates anterior deltoid.\",\"Improves shoulder flexion.\",\"Strengthens upper chest.\"]', '2026-03-31 15:33:02', 3, '10'),
(8, 'shoulder', 'beginner', 'Lateral Raises', 'lateral_raises_video.mp4', '[\"Stand with dumbbells at sides.\",\"Raise arms out to sides until shoulder height.\",\"Lower slowly.\"]', '[\"Isolates lateral deltoid.\",\"Builds shoulder width.\",\"Improves shoulder stability.\"]', '2026-03-31 15:33:02', 3, '10'),
(9, 'shoulder', 'beginner', 'Seated Arnold Press', 'arnold_press_video.mp4', '[\"Start with dumbbells in front of chest, palms facing you.\",\"Press up while rotating palms forward.\",\"Reverse motion on way down.\"]', '[\"Targets all three deltoid heads.\",\"Increases range of motion.\",\"Engages stabilizer muscles.\"]', '2026-03-31 15:33:02', 3, '10'),
(10, 'shoulder', 'beginner', 'Face Pulls', 'face_pulls_video.mp4', '[\"Attach rope to high pulley.\",\"Pull rope towards face, separating hands.\",\"Squeeze rear delts.\"]', '[\"Targets rear deltoids and rotator cuff.\",\"Improves posture.\",\"Balances shoulder strength.\"]', '2026-03-31 15:33:02', 3, '10'),
(11, 'arms', 'beginner', 'Dumbbell Bicep Curls', 'bicep_curls_video.mp4', '[\"Stand upright with a dumbbell in each hand.\",\"Curl the weights while contracting your biceps.\",\"Lower slowly.\"]', '[\"Isolates the biceps brachii.\",\"Improves arm strength.\"]', '2026-03-31 15:33:02', 3, '10'),
(12, 'arms', 'beginner', 'Hammer Curls', 'hammer_curls_video.mp4', '[\"Stand upright with a dumbbell in each hand, palms facing torsos.\",\"Curl weights forward.\",\"Lower slowly.\"]', '[\"Targets brachialis.\",\"Builds thicker arms.\"]', '2026-03-31 15:33:02', 3, '10'),
(13, 'arms', 'beginner', 'Tricep Rope Pushdown', 'rope_pushdown_video.mp4', '[\"Attach rope to high pulley.\",\"Push rope down extending elbows.\",\"Return slowly.\"]', '[\"Isolates triceps.\",\"Improves lockout strength.\"]', '2026-03-31 15:33:02', 3, '10'),
(14, 'arms', 'beginner', 'Overhead Tricep Extension', 'tricep_extension_video.mp4', '[\"Stand or sit holding dumbbell overhead.\",\"Lower dumbbell behind head.\",\"Extend arms back up.\"]', '[\"Isolates long head of triceps.\",\"Improves arm stability.\"]', '2026-03-31 15:33:02', 3, '10'),
(15, 'back', 'beginner', 'Pull-ups (Assisted)', 'pullups_video.mp4', '[\"Grasp bar with wide grip.\",\"Pull body up until chin is over the bar.\",\"Lower slowly.\"]', '[\"Builds a wide back.\",\"Strengthens biceps and grip.\"]', '2026-03-31 15:33:02', 3, '10'),
(16, 'back', 'beginner', 'Lat Pulldowns', 'lat_pulldowns_video.mp4', '[\"Sit at machine.\",\"Pull bar down to chest.\",\"Slowly return bar.\"]', '[\"Excellent for latissimus dorsi.\",\"Good for beginners to build back strength.\"]', '2026-03-31 15:33:02', 3, '10'),
(17, 'back', 'beginner', 'Dumbbell Rows', 'dumbbell_rows_video.mp4', '[\"Place knee and hand on bench.\",\"Pull dumbbell up to chest.\",\"Lower slowly.\"]', '[\"Works sides of back independently.\",\"Improves core stability.\"]', '2026-03-31 15:33:02', 3, '10'),
(18, 'abs', 'beginner', 'Crunches', 'crunches_video.mp4', '[\"Lie on back, knees bent.\",\"Lift upper body towards knees.\",\"Lower back down slowly.\"]', '[\"Strengthens core.\",\"Improves balance.\"]', '2026-03-31 15:33:02', 3, '10'),
(19, 'abs', 'beginner', 'Plank', 'plank_video.mp4', '[\"Hold body in straight line resting on forearms.\",\"Engage core.\",\"Hold position.\"]', '[\"Builds endurance.\",\"Engages entire core.\"]', '2026-03-31 15:33:02', 3, '10'),
(20, 'legs', 'beginner', 'Bodyweight Squats', 'squats_video.mp4', '[\"Stand shoulder width apart.\",\"Bend knees and lower hips.\",\"Stand back up.\"]', '[\"Builds leg strength.\",\"Improves mobility.\"]', '2026-03-31 15:33:02', 3, '10'),
(21, 'legs', 'beginner', 'Walking Lunges', 'walking_lunges_video.mp4', '[\"Step forward and bend knees.\",\"Push off rear leg and step forward again.\"]', '[\"Great for glutes and quads.\",\"Improves balance.\"]', '2026-03-31 15:33:02', 3, '10'),
(22, 'abs', 'intermediate', 'Hanging Knee Raises', 'hanging_knee_raises_video.mp4', '[\"Hang from a pull-up bar with an overhand grip.\",\"Keeping your legs straight, raise them until they are parallel to the floor.\",\"Slowly lower your legs back down.\"]', '[\"Excellent for lower abs and grip strength.\",\"Decompresses the spine.\"]', '2026-04-03 04:07:28', 3, '10-12'),
(23, 'abs', 'intermediate', 'Cable Crunches', 'cable_crunches_video.mp4', '[\"Kneel below a high pulley with a rope attachment.\",\"Grasp the rope and pull it down until your hands are next to your face.\",\"Flex your hips slightly and allow the weight to hyperextend your lower back.\",\"Keeping your hips stationary, crunch your upper body down towards your knees.\",\"Squeeze your abs hard at the bottom and slowly return to the start.\"]', '[\"Allows you to add weight for progressive overload on your abs.\",\"Provides constant tension throughout the entire movement.\"]', '2026-04-03 04:07:28', 3, '12-15'),
(24, 'abs', 'intermediate', 'Russian Twists', 'russian_twists_video.mp4', '[\"Sit on the floor with your knees bent and feet slightly off the ground.\",\"Lean back to a 45-degree angle, keeping your back straight.\",\"Hold a weight or clasp your hands together in front of you.\",\"Twist your torso from side to side, touching the weight to the floor on each side.\",\"Keep your core engaged throughout.\"]', '[\"Targets the obliques for a stronger, more defined waistline.\",\"Improves rotational strength and core stability.\"]', '2026-04-03 04:07:28', 3, '20-24'),
(25, 'abs', 'intermediate', 'Side Plank', 'side_plank_video.mp4', '[\"Lie on your side with your legs straight and stacked.\",\"Prop your upper body up on your forearm, ensuring your elbow is directly under your shoulder.\",\"Lift your hips off the floor until your body forms a straight line from head to heels.\",\"Hold this position for the desired amount of time, then switch sides.\"]', '[\"Strengthens the obliques, lower back, and shoulder stabilizers.\",\"Improves anti-rotational core strength.\"]', '2026-04-03 04:07:28', 3, '30-45s'),
(26, 'abs', 'intermediate', 'Reverse Crunches', 'reverse_crunches_video.mp4', '[\"Lie on your back with your hands by your sides or under your lower back for support.\",\"Bring your knees towards your chest until they are bent at a 90-degree angle.\",\"Using your lower abs, lift your hips off the floor and bring your knees towards your chest.\",\"Slowly lower your hips back down to the starting position.\"]', '[\"Effectively targets the often hard-to-reach lower abdominals.\",\"Less strain on the neck and spine compared to traditional crunches.\"]', '2026-04-03 04:07:28', 3, '12-15'),
(27, 'arms', 'intermediate', 'Barbell Curls', 'barbell_curl_video.mp4', '[\"Stand tall holding a barbell with a shoulder-width supinated (underhand) grip.\",\"Keep your elbows close to your torso.\",\"Curl the weights while contracting your biceps.\",\"Slowly lower the barbell back to the starting position.\"]', '[\"Builds total bicep mass.\",\"Allows heavier weight to be lifted.\"]', '2026-04-03 04:07:28', 3, '8-10'),
(28, 'arms', 'intermediate', 'Skull Crushers', 'skull_crushers_video.mp4', '[\"Lie on a bench holding an EZ curl bar with a close grip above your chest.\",\"Lower the bar towards your forehead by bending your elbows.\",\"Extend your arms back up to the starting position, squeezing the triceps.\"]', '[\"Targets the long head of the triceps.\",\"Improves pressing strength.\"]', '2026-04-03 04:07:28', 3, '10-12'),
(29, 'arms', 'intermediate', 'Hammer Curls', 'hammer_curls_video.mp4', '[\"Stand holding a dumbbell in each hand with a neutral grip.\",\"Curl the weights up while keeping your palms facing each other.\",\"Lower slowly back to the start.\"]', '[\"Targets the brachialis, improving arm thickness.\",\"Builds strong forearms.\"]', '2026-04-03 04:07:28', 3, '10-12'),
(30, 'arms', 'intermediate', 'Tricep Rope Pushdowns', 'rope_pushdown_video.mp4', '[\"Attach a rope to a high cable pulley.\",\"Push the rope down by extending your elbows, spreading the rope at the bottom.\",\"Slowly return to the start.\"]', '[\"Excellent for tricep isolation and lockout.\",\"Constant tension from the cable.\"]', '2026-04-03 04:07:28', 3, '12-15'),
(31, 'back', 'intermediate', 'Pull-Ups', 'pullups_video.mp4', '[\"Grab the pull-up bar with an overhand grip, slightly wider than shoulder-width.\",\"Pull your body up until your chin is over the bar.\",\"Lower yourself in a controlled motion.\"]', '[\"Builds incredible lat width.\",\"A fundamental bodyweight movement for upper body pulling strength.\"]', '2026-04-03 04:07:28', 3, '6-10'),
(32, 'back', 'intermediate', 'Bent-Over Barbell Rows', 'barbell_rows_video.mp4', '[\"Bend your knees and lean forward, maintaining a flat back.\",\"Grab a barbell with an overhand grip.\",\"Pull the bar towards your lower chest\\/upper abdomen.\",\"Lower the bar back down until arms are extended.\"]', '[\"Builds overall back thickness.\",\"Engages stabilizers in the lower back and core.\"]', '2026-04-03 04:07:28', 3, '8-10'),
(33, 'back', 'intermediate', 'Seated Cable Rows', 'seated_row_video.mp4', '[\"Sit at a cable row station with a V-handle.\",\"Keep your back straight and pull the handle to your abdomen, squeezing your shoulder blades together.\",\"Return to starting position slowly.\"]', '[\"Great for mid-back thickness.\",\"Safe movement for progressive overload.\"]', '2026-04-03 04:07:28', 3, '10-12'),
(34, 'back', 'intermediate', 'Lat Pulldowns', 'lat_pulldowns_video.mp4', '[\"Sit at a lat pulldown machine and grab the bar with a wide grip.\",\"Pull the bar down towards your upper chest, squeezing your lats.\",\"Slowly return the bar to the top.\"]', '[\"Isolates the lats efficiently.\",\"Great alternative if pull-ups are too difficult.\"]', '2026-04-03 04:07:28', 3, '10-12'),
(35, 'chest', 'intermediate', 'Barbell Bench Press', 'bench_press_video.mp4', '[\"Lie flat on a bench, grab the barbell with a medium-width grip.\",\"Unrack the bar and hold it straight over your chest.\",\"Slowly lower the bar until it touches your mid-chest.\",\"Press the bar back up to the starting position.\"]', '[\"The king of chest exercises for overall mass and strength.\",\"Engages triceps and anterior deltoids as secondary muscles.\"]', '2026-04-03 04:07:28', 3, '8-10'),
(36, 'chest', 'intermediate', 'Incline Dumbbell Press', 'incline_bench_video.mp4', '[\"Set an adjustable bench to an incline of 30-45 degrees.\",\"Press dumbbells straight up above your upper chest.\",\"Lower them down to your shoulders and repeat.\"]', '[\"Targets the upper pectoral muscles.\",\"Allows for an increased range of motion.\"]', '2026-04-03 04:07:28', 3, '8-10'),
(37, 'chest', 'intermediate', 'Cable Crossovers', 'cable_crossover_video.mp4', '[\"Stand between two high cable pulleys, holding a D-handle in each hand.\",\"Step forward slightly and bring your arms together in an arc motion.\",\"Squeeze your chest at the bottom of the movement and slowly return.\"]', '[\"Excellent for chest isolation.\",\"Great for the pump at the end of a workout.\"]', '2026-04-03 04:07:28', 3, '12-15'),
(38, 'chest', 'intermediate', 'Chest Dips', 'dips_video.mp4', '[\"Mount a set of dip bars. Lean your torso forward to emphasize the chest.\",\"Lower yourself until your elbows form a 90-degree angle.\",\"Press yourself back up.\"]', '[\"Excellent for the lower chest.\",\"Engages triceps strongly.\"]', '2026-04-03 04:07:28', 3, '8-12'),
(39, 'legs', 'intermediate', 'Barbell Back Squats', 'barbell_squat_video.mp4', '[\"Place a barbell across your upper back\\/traps.\",\"Squat down by bending your knees and pushing your hips back.\",\"Keep your chest up and back straight.\",\"Drive through your heels to return to a standing position.\"]', '[\"The ultimate lower body builder.\",\"Increases overall core strength and athletic performance.\"]', '2026-04-03 04:07:28', 3, '8-10'),
(40, 'legs', 'intermediate', 'Romanian Deadlifts (RDLs)', 'romanian_deadlift_video.mp4', '[\"Hold a barbell or dumbbells in front of your thighs.\",\"Keeping a slight bend in your knees, push your hips back and lower the weight.\",\"Lower until you feel a deep stretch in your hamstrings, keeping your back flat.\",\"Return to a standing position by driving your hips forward.\"]', '[\"Fantastic for hamstring development and flexibility.\",\"Strengthens the posterior chain and lower back.\"]', '2026-04-03 04:07:28', 3, '8-10'),
(41, 'legs', 'intermediate', 'Leg Press', 'leg_press_video.mp4', '[\"Sit on a leg press machine with your feet shoulder-width apart on the platform.\",\"Release the safety catches and lower the platform towards you.\",\"Press the platform back up until your legs are fully extended, without locking your knees.\"]', '[\"Allows heavy volume on the quads without stressing the lower back.\",\"Excellent for quadriceps hypertrophy.\"]', '2026-04-03 04:07:28', 3, '10-12'),
(42, 'legs', 'intermediate', 'Calf Raises', 'calf_raises_video.mp4', '[\"Stand on a platform with the balls of your feet, letting your heels hang off.\",\"Raise your heels as high as possible, squeezing the calves.\",\"Lower your heels below the platform for a deep stretch.\"]', '[\"Isolates the calf muscles effectively.\",\"Improves ankle strength and mobility.\"]', '2026-04-03 04:07:28', 3, '15-20'),
(43, 'shoulder', 'intermediate', 'Overhead Barbell Press', 'overhead_press_video.mp4', '[\"Stand with a barbell resting on your front deltoids\\/clavicle.\",\"Brace your core and press the bar straight overhead until your arms are fully extended.\",\"Lower the bar back to your upper chest under control.\"]', '[\"Builds total shoulder strength and mass.\",\"Engages the core heavily.\"]', '2026-04-03 04:07:28', 3, '8-10'),
(44, 'shoulder', 'intermediate', 'Dumbbell Lateral Raises', 'lateral_raises_video.mp4', '[\"Hold a dumbbell in each hand by your sides.\",\"Keeping a slight bend in your elbows, raise the weights out to your sides until they are shoulder-level.\",\"Slowly lower the weights back to the start.\"]', '[\"Isolates the lateral head of the deltoid for wide, capped shoulders.\",\"Vital for achieving the \'V-taper\' look.\"]', '2026-04-03 04:07:28', 3, '12-15'),
(45, 'shoulder', 'intermediate', 'Face Pulls', 'face_pulls_video.mp4', '[\"Attach a rope to a cable pulley fixed at upper-chest height.\",\"Pull the rope towards your face, pulling your hands apart as they near your ears.\",\"Squeeze your rear deltoids and upper back.\",\"Return to the start slowly.\"]', '[\"Crucial for rear deltoid development.\",\"Promotes excellent shoulder health and posture.\"]', '2026-04-03 04:07:28', 3, '12-15'),
(46, 'shoulder', 'intermediate', 'Reverse Pec Deck Flyes', 'rear_delt_fly_video.mp4', '[\"Sit facing the pad of a pec deck machine.\",\"Grasp the handles and pull them back in a sweeping arc, focusing on your rear deltoids.\",\"Slowly return to the starting position.\"]', '[\"Safely isolates the rear deltoids.\",\"Great for adding finishing volume to the shoulders.\"]', '2026-04-03 04:07:28', 3, '12-15'),
(47, 'chest', 'advanced', 'Butterfly (pec deck)', 'butterfly_pec_deck_video.mp4', '[\"Sit on the machine with your back flat on the pad.\",\"Adjust the seat so the handles are at chest level.\",\"Place your forearms on the padded levers (if using pec deck) or grab handles with arms parallel to floor.\",\"Push the levers together while you squeeze your chest muscles.\",\"Return to the starting position slowly, keeping tension on your chest.\"]', '[\"Effectively isolates the pectoral muscles for targeted growth.\",\"Limit the involvement of shoulder and triceps muscles.\",\"Controlled movement reduces the risk of shoulder injury compared to free weights.\",\"Easy to learn form making it suitable for beginners.\"]', '2026-04-03 04:07:41', 4, '10-12'),
(48, 'chest', 'advanced', 'Decline Bench Press', 'decline_bench_press_video.mp4', '[\"Lie on a decline bench with your feet securely locked under the leg brace.\",\"Grasp the barbell with a medium width grip, wider than shoulder width.\",\"Unrack the barbell and hold it straight over your torso above with your arms locked.\",\"Lower the bar slowly to your lower chest, keeping your elbows tucked in at a 45-degree angle.\",\"Push the barbell back up to the starting position until your arms are fully extended.\"]', '[\"Primarily targets the lower pectoral (chest) muscles.\",\"Engages the anterior deltoids (front shoulders) and triceps as secondary muscles.\",\"Allows for lifting heavier weight compared to flat or incline bench press.\",\"Reduces stress on the lower back and shoulders compared to other bench variations.\"]', '2026-04-03 04:07:41', 4, '8-10'),
(49, 'chest', 'advanced', 'Wide Grip Bench Press', 'wide_grip_bench_video.mp4', '[\"Lie flat on a bench and position your hands on the barbell significantly wider than shoulder-width apart.\",\"Unrack the bar and hold it straight over your sternum with arms locked.\",\"Lower the bar slowly to your chest, flaring your elbows slightly out.\",\"Pause for a second when the bar touches your chest.\",\"Press the bar back up forcefully to full extension.\"]', '[\"Targets the pectoral muscles more intensely than standard press.\",\"Shifts focus away from triceps, putting more load on the chest.\",\"Increases upper body pressing power.\",\"Activates outer chest fibers for a wider chest look.\"]', '2026-04-03 04:07:41', 3, '10-12'),
(50, 'chest', 'advanced', 'Chest Fly (Dumbbell)', 'dumbbell_fly_video.mp4', '[\"Lie on a flat bench holding a dumbbell in each hand, palms facing each other.\",\"Start with arms extended directly above your chest with a slight bend in your elbows.\",\"Slowly lower the weights out to your sides in a wide arc until you feel a stretch in your chest.\",\"Pause briefly at the bottom.\",\"Squeeze your chest muscles to bring the dumbbells back up to the starting position in the same arc motion.\"]', '[\"Effectively isolates and strengthens the pectoral muscles.\",\"Improves flexibility and range of motion in the chest.\",\"Helps to widen the look of the muscular appearance.\",\"Engages stabilizer muscles in the shoulders and back.\"]', '2026-04-03 04:07:41', 3, '12-15'),
(51, 'chest', 'advanced', 'Low Cable Fly Crossovers', 'low_cable_fly_video.mp4', '[\"Set the pulleys to the lowest setting on the cable machine.\",\"Stand in the middle of the machine, grabbing a handle in each hand.\",\"Step forward to create tension, with your arms extended low at your sides.\",\"With a slight bend in your elbows, bring your hands together in an upward arc in front of your chest.\",\"Squeeze your chest muscles at the peak of the movement, then slowly return to the starting position.\"]', '[\"Targets the upper pectoral muscles, giving the chest a full, uplifted look.\",\"Provides constant tension throughout the entire range of motion.\",\"Improves chest sculpting, definition and detail in the center line.\",\"Allows for a good stretch and full contraction of the pectoral muscles.\"]', '2026-04-03 04:07:41', 3, '12-15'),
(52, 'arms', 'advanced', 'Preacher Curl', 'preacher_curl_video.mp4', '[\"Adjust the seat height so your armpits rest comfortably over the top of the pad.\",\"Hold the barbell or EZ-bar with an underhand grip, hands about shoulder-width apart.\",\"With your upper arms flat against the pad and your chest pressed against the support.\",\"Slowly curl the weight up towards your shoulders, squeezing your biceps at the top.\",\"Lower the weight back down in a controlled manner until your arms are fully extended.\"]', '[\"Isolates the biceps by preventing body movement and cheating.\",\"Focuses heavily on the short head of the biceps for peak development.\",\"Allows for a full range of motion with strict form, reducing injury risk.\",\"Effective for building strength and definition in the upper arms.\"]', '2026-04-03 04:07:41', 4, '8-10'),
(53, 'arms', 'advanced', 'Cable Bayesian Curl', 'bayesian_curl_video.mp4', '[\"Set up a single cable pulley at the lowest position.\",\"Face away from the machine, holding the handle with one hand, arm extended behind you.\",\"Step forward slightly to create tension on the cable.\",\"Curl the handle forward while keeping your elbow behind your torso.\",\"Squeeze the bicep hard at the peak contraction, then slowly lower back.\"]', '[\"Maximizes the stretch on the long head of the biceps.\",\"Provides constant tension throughout the entire movement.\",\"Unique angle stimulates muscle fibers differently than standard curls.\"]', '2026-04-03 04:07:41', 3, '12-15'),
(54, 'arms', 'advanced', 'Close Grip Bench Press', 'close_grip_bench_video.mp4', '[\"Lie back on a flat bench. Lift the bar with a close grip (hands shoulder-width or slightly narrower).\",\"Lower the bar slowly to your lower chest, keeping your elbows tucked close to your torso.\",\"Push the bar back up explosively to the starting position.\",\"Focus on using your triceps to drive the weight up rather than your chest.\"]', '[\"One of the best compound movements for building tricep mass and strength.\",\"Allows for heavier loading compared to isolation exercises.\",\"Has significant carryover to standard bench press strength.\"]', '2026-04-03 04:07:41', 4, '6-8'),
(55, 'arms', 'advanced', 'Tricep Rope Pushdown', 'rope_pushdown_video.mp4', '[\"Attach a rope to a high pulley cable machine and hold the ends with a neutral grip.\",\"Stand upright with a slight forward lean, keeping your elbows tucked firmly by your sides.\",\"Push the rope down until arms are fully extended, pulling the handles apart at the bottom.\",\"Squeeze your triceps hard, then control the weight back up slowly.\",\"Maintain strict form; immediately reduce the weight if you use momentum.\"]', '[\"Sharpens isolation on outer triceps head for horseshoe muscle detail.\",\"The rope allows for a greater range of motion and stronger peak contraction.\",\"Increases lockout power for pressing movements.\",\"Constant tension from the cable machine maximizes muscle hypertrophy.\"]', '2026-04-03 04:07:41', 3, '12-15'),
(56, 'back', 'advanced', 'Weighted Pull-ups', 'weighted_pullups_video.mp4', '[\"Attach a weight to a dip belt or hold a dumbbell between your feet.\",\"Perform a pull-up as you would normally.\",\"This is for advanced athletes who can do many bodyweight pull-ups.\"]', '[\"Maximizes back and bicep strength.\",\"The ultimate back-building exercise.\"]', '2026-04-03 04:07:41', 4, '6-8'),
(57, 'abs', 'advanced', 'Dragon Flags', 'dragon_flags_video.mp4', '[\"Lie on a bench and hold the edge behind your head.\",\"Lift your entire body up until only your upper back is touching the bench.\",\"Lower your body in a straight line slowly and with control.\",\"This requires immense core strength.\"]', '[\"One of the hardest ab exercises.\",\"Builds incredible core strength and control.\"]', '2026-04-03 04:07:41', 3, '8-10'),
(58, 'legs', 'advanced', 'Pistol Squats', 'pistol_squats_video.mp4', '[\"Stand on one leg, with the other leg extended out in front of you.\",\"Squat down on your standing leg until your hamstring is on your calf.\",\"Keep your balance and drive back up to the starting position.\",\"This is a highly advanced movement requiring great balance and strength.\"]', '[\"Ultimate single-leg strength and stability test.\",\"Dramatically improves balance and coordination.\"]', '2026-04-03 04:07:41', 3, '10-12'),
(59, 'shoulder', 'advanced', 'Handstand Push-ups', 'handstand_pushups_video.mp4', '[\"Kick up into a handstand against a wall.\",\"Lower your body until your head nearly touches the floor.\",\"Press back up to the starting position.\",\"This is an advanced movement; ensure you have sufficient strength.\"]', '[\"Ultimate shoulder strength and mass builder.\",\"Develops incredible balance and core control.\"]', '2026-04-03 04:07:41', 3, '8-10'),
(60, 'abs', 'advanced', 'Ab Wheel Rollout', 'ab_wheel_rollout_video.mp4', '[\"Kneel on the floor holding an ab wheel.\",\"Roll the wheel straight forward, extending your body.\",\"Use your core to pull yourself back to the starting position.\"]', '[\"Incredible core tension.\",\"Builds massive anti-extension strength.\"]', '2026-04-03 04:26:06', 3, '10-15'),
(61, 'abs', 'intermediate', 'Decline Sit-ups', 'decline_situps_video.mp4', '[\"Secure your feet at the top of a decline bench.\",\"Lower your torso until you feel a stretch in your abs.\",\"Crunch up and squeeze at the top.\"]', '[\"Increased range of motion compared to flat sit-ups.\",\"Strong lower and upper ab engagement.\"]', '2026-04-03 04:26:06', 3, '15-20'),
(62, 'abs', 'advanced', 'Weighted Russian Twists', 'weighted_russian_twists_video.mp4', '[\"Sit with your feet elevated and hold a weight plate.\",\"Twist your torso to tap the plate on each side.\"]', '[\"Builds rotational power.\",\"Thickens the obliques.\"]', '2026-04-03 04:26:06', 4, '20-25'),
(63, 'abs', 'intermediate', 'Leg Raises', 'leg_raises_video.mp4', '[\"Lie flat on your back.\",\"Raise your legs straight up to a 90-degree angle.\",\"Slowly lower them without touching the floor.\"]', '[\"Targets lower abdominals.\",\"Improves hip flexor strength.\"]', '2026-04-03 04:26:06', 3, '15-20'),
(64, 'abs', 'intermediate', 'Knee Tucks', 'knee_tucks_video.mp4', '[\"Sit on a bench or floor, leaning back slightly.\",\"Tuck your knees into your chest while crunching your upper body forward.\"]', '[\"Great isolation for the rectus abdominis.\",\"Low impact on the lower back.\"]', '2026-04-03 04:26:06', 3, '15-20'),
(65, 'arms', 'intermediate', 'EZ Bar Curl', 'ez_bar_curl_video.mp4', '[\"Hold an EZ bar with a standard grip.\",\"Curl the bar up, squeezing the biceps.\"]', '[\"Less strain on the wrists than a straight barbell.\",\"Excellent mass builder.\"]', '2026-04-03 04:26:06', 3, '10-12'),
(66, 'arms', 'intermediate', 'Incline Dumbbell Curl', 'incline_curl_video.mp4', '[\"Sit on an incline bench set to 45 degrees.\",\"Let your arms hang straight down, holding dumbbells.\",\"Curl up and squeeze.\"]', '[\"Isolates the long head of the bicep.\",\"Provides an extreme stretch at the bottom of the movement.\"]', '2026-04-03 04:26:06', 3, '10-12'),
(67, 'arms', 'advanced', 'Weighted Dips', 'weighted_dips_video.mp4', '[\"Attach a plate using a dip belt.\",\"Lower yourself on parallel bars until your triceps are parallel to the floor.\",\"Press back up.\"]', '[\"Incredible triceps and chest mass builder.\",\"Forces high central nervous system recruitment.\"]', '2026-04-03 04:26:06', 4, '8-10'),
(68, 'back', 'intermediate', 'Chest-Supported Row', 'chest_supported_row_video.mp4', '[\"Lie face down on an incline bench holding dumbbells or a barbell.\",\"Row the weight up, squeezing your shoulder blades together.\"]', '[\"Removes lower back strain from the row.\",\"Pure isolation for the lats and rhomboids.\"]', '2026-04-03 04:26:06', 3, '10-12'),
(69, 'back', 'intermediate', 'Straight Arm Pulldown', 'straight_arm_pulldown_video.mp4', '[\"Use a cable machine with a straight bar attached high.\",\"With straight arms, pull the bar down to your thighs.\",\"Squeeze the lats and return slowly.\"]', '[\"Isolates the lats without engaging the biceps.\",\"Great pre-exhaust or finishing movement.\"]', '2026-04-03 04:26:06', 3, '12-15'),
(70, 'back', 'advanced', 'T-Bar Row', 'tbar_row_video.mp4', '[\"Stand over a loaded T-bar or landmine setup.\",\"Hinge at the hips and row the bar into your chest.\",\"Use plates emphasizing the back stretch.\"]', '[\"Massive thickness builder for the mid back.\",\"Allows very heavy loading.\"]', '2026-04-03 04:26:06', 4, '8-10'),
(71, 'back', 'intermediate', 'Back Extension', 'back_extension_video.mp4', '[\"Lock your legs into a back extension machine.\",\"Lower your upper body until you feel a stretch in your hamstrings.\",\"Raise back up until your body is straight.\"]', '[\"Strengthens the spinal erectors.\",\"Excellent for lower back health.\"]', '2026-04-03 04:26:06', 3, '15-20'),
(72, 'back', 'advanced', 'Deadlift', 'deadlift_video.mp4', '[\"Stand over a loaded barbell with a shoulder-width stance.\",\"Hinge at the hips, grab the bar, and drive through the floor to stand up.\",\"Keep your back incredibly straight.\"]', '[\"The king of posterior chain exercises.\",\"Builds total body strength.\"]', '2026-04-03 04:26:06', 4, '5-8'),
(73, 'chest', 'intermediate', 'Dumbbell Bench Press', 'dumbbell_bench_press_video.mp4', '[\"Lie flat on a bench holding dumbbells at your chest.\",\"Press them straight up and squeeze your pecs together.\",\"Lower with control.\"]', '[\"Allows a deeper range of motion than a barbell.\",\"Fixes muscular imbalances between arms.\"]', '2026-04-03 04:26:06', 3, '8-10'),
(74, 'chest', 'advanced', 'Dumbbell Pullover', 'dumbbell_pullover_video.mp4', '[\"Lie across a bench with your upper back resting on it.\",\"Hold a single dumbbell with both hands above your chest.\",\"Lower it behind your head until you feel a deep stretch, then pull it back up.\"]', '[\"Expands the rib cage and stretches the chest.\",\"Works the lats and the pecs simultaneously.\"]', '2026-04-03 04:26:06', 3, '10-12'),
(75, 'chest', 'advanced', 'Weighted Push-ups', 'weighted_pushup_video.mp4', '[\"Place a weight plate securely on your upper back.\",\"Perform standard push-ups with strict form.\"]', '[\"Turns push-ups into a true strength-building movement.\",\"Forces core stabilization.\"]', '2026-04-03 04:26:06', 4, '10-15'),
(76, 'legs', 'advanced', 'Bulgarian Split Squat', 'bulgarian_split_squat_video.mp4', '[\"Place your rear foot elevated on a bench behind you.\",\"Hold dumbbells and squat down until your front thigh is parallel to the ground.\"]', '[\"Isolates quads and glutes intensely.\",\"Corrects leg strength imbalances.\"]', '2026-04-03 04:26:06', 4, '8-12'),
(77, 'legs', 'advanced', 'Front Squat', 'front_squat_video.mp4', '[\"Rest the barbell across your front deltoids (front rack position).\",\"Keep your chest up and squat down deeply.\"]', '[\"Targets the quadriceps heavily.\",\"Requires extreme core strength to stay upright.\"]', '2026-04-03 04:26:06', 4, '8-10'),
(78, 'legs', 'intermediate', 'Hack Squat', 'hack_squat_video.mp4', '[\"Use a hack squat machine.\",\"Keep your back flat against the pad and press the platform up.\",\"Lower deeply.\"]', '[\"Takes the lower back out of the squat equation.\",\"Allows total quad isolation.\"]', '2026-04-03 04:26:06', 3, '10-12'),
(79, 'legs', 'intermediate', 'Hamstring Curl', 'hamstring_curl_video.mp4', '[\"Use a lying leg curl machine.\",\"Curl the pad towards your glutes and squeeze.\"]', '[\"Direct isolation for the hamstring muscles.\",\"Prevents knee injuries.\"]', '2026-04-03 04:26:07', 3, '12-15'),
(80, 'legs', 'intermediate', 'Seated Hamstring Curl', 'seated_hamstring_curl_video.mp4', '[\"Sit in the machine and press your legs down against the pad.\",\"Control the eccentric phase.\"]', '[\"Hits the hamstrings from a stretched hip position.\",\"Great for hamstring hypertrophy.\"]', '2026-04-03 04:26:07', 3, '12-15'),
(81, 'legs', 'intermediate', 'Leg Extension', 'leg_extension_video.mp4', '[\"Sit in the machine and extend your legs straight.\",\"Squeeze the quads hard at the top.\"]', '[\"Pure isolation for the quadriceps (especially the teardrop).\",\"Excellent finishing movement.\"]', '2026-04-03 04:26:07', 3, '12-15'),
(82, 'legs', 'advanced', 'Nordic Curl', 'nordic_curl_video.mp4', '[\"Kneel on a pad and secure your ankles under a heavy weight.\",\"Lower your upper body slowly forward, using your hamstrings to brake.\",\"Push back up when you catch yourself.\"]', '[\"Extreme eccentric hamstring strength builder.\",\"Bulletproofs the knees against injury.\"]', '2026-04-03 04:26:07', 3, '5-8'),
(83, 'legs', 'advanced', 'Sumo Squat', 'sumo_squat_video.mp4', '[\"Take an ultra-wide stance with toes pointed outward.\",\"Squat straight down, keeping the chest up.\"]', '[\"Heavily recruits the adductors and glutes.\",\"Allows a more upright torso than a standard squat.\"]', '2026-04-03 04:26:07', 4, '8-10'),
(84, 'legs', 'advanced', 'Jump Squats', 'jump_squat_video.mp4', '[\"Perform a bodyweight squat, then explode upward into a jump.\",\"Land softly and smoothly transition into the next rep.\"]', '[\"Builds explosive lower body power.\",\"Great for athletic conditioning.\"]', '2026-04-03 04:26:07', 3, '15-20'),
(85, 'shoulder', 'advanced', 'Standing Arnold Press', 'arnold_press_standing_video.mp4', '[\"Stand holding dumbbells in front of your chest with palms facing you.\",\"Press up while rotating your palms forward.\",\"Lower and twist back.\"]', '[\"Hits all three heads of the deltoid.\",\"Requires immense core stability.\"]', '2026-04-03 04:26:07', 4, '8-10'),
(86, 'shoulder', 'intermediate', 'Machine Shoulder Press', 'machine_shoulder_press_video.mp4', '[\"Sit in the press machine and grab the handles.\",\"Press overhead and control the descent.\"]', '[\"Safe way to load heavy weight on the shoulders.\",\"Isolates the anterior deltoids.\"]', '2026-04-03 04:26:07', 4, '10-12'),
(87, 'shoulder', 'intermediate', 'Cable Lateral Raise', 'cable_lateral_raise_video.mp4', '[\"Use a low cable pulley.\",\"Raise the handle out to your side, keeping a slight elbow bend.\"]', '[\"Provides continuous tension unmatched by dumbbells.\",\"Excellent for side delt hypertrophy.\"]', '2026-04-03 04:26:07', 3, '12-15'),
(88, 'shoulder', 'advanced', 'Cable Y-Raises', 'cable_y_raises_video.mp4', '[\"Stand between two low pulleys, crossing the cables.\",\"Raise them up and out into a \'Y\' shape.\"]', '[\"Isolates the lower traps and side delts.\",\"Improves shoulder posture and health.\"]', '2026-04-03 04:26:07', 3, '12-15'),
(89, 'shoulder', 'advanced', 'Push Press', 'push_press_video.mp4', '[\"Hold a barbell in the front rack position.\",\"Dip slightly with your knees and explode up to drive the bar overhead.\"]', '[\"Builds incredible total body pressing power.\",\"Overloads the shoulders and triceps.\"]', '2026-04-03 04:26:07', 4, '5-8'),
(90, 'shoulder', 'advanced', 'Lateral Raise Dropset', 'lateral_raise_dropset_video.mp4', '[\"Perform a set of lateral raises to failure.\",\"Immediately drop the weight by 20% and go to failure again.\",\"Repeat once more.\"]', '[\"Forces extreme blood flow and metabolic stress.\",\"Incredible shoulder pump.\"]', '2026-04-03 04:26:07', 3, 'Mechanical Failure'),
(91, 'legs', 'advanced', 'Burpees', 'burpees_video.mp4', '[\"Drop into a push-up position, execute a push-up.\",\"Jump your feet back in.\",\"Explode up into a vertical jump.\"]', '[\"The ultimate full-body conditioning movement.\",\"Burns massive calories.\"]', '2026-04-03 04:26:07', 3, '15-20'),
(92, 'abs', 'beginner', 'Flutter Kicks', 'flutter_kicks_video.mp4', '[\"Lie flat on your back, raising your legs six inches.\",\"Kick them up and down in a fluttering motion.\"]', '[\"Burns the lower abs.\",\"Builds endurance.\"]', '2026-04-03 04:26:07', 3, '30-45s'),
(93, 'legs', 'beginner', 'Jumping Jacks', 'jumping_jacks_video.mp4', '[\"Jump while spreading your legs and raising your arms.\",\"Return to start.\"]', '[\"Great warm-up movement.\",\"Increases heart rate rapidly.\"]', '2026-04-03 04:26:07', 3, '60s');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `body_profiles`
--
ALTER TABLE `body_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `custom_routine_exercises`
--
ALTER TABLE `custom_routine_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `routine_id` (`routine_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indexes for table `diet_plans`
--
ALTER TABLE `diet_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_date` (`user_id`,`plan_date`);

--
-- Indexes for table `diet_plan_meals`
--
ALTER TABLE `diet_plan_meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_scores`
--
ALTER TABLE `form_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_routine_badge` (`user_id`,`routine_id`,`badge_type`,`tier`),
  ADD KEY `routine_id` (`routine_id`);

--
-- Indexes for table `user_custom_routines`
--
ALTER TABLE `user_custom_routines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_workouts`
--
ALTER TABLE `user_workouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `fk_routine` (`routine_id`);

--
-- Indexes for table `water_logs`
--
ALTER TABLE `water_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_date_unique` (`user_id`,`log_date`);

--
-- Indexes for table `workout_exercises`
--
ALTER TABLE `workout_exercises`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `body_profiles`
--
ALTER TABLE `body_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `custom_routine_exercises`
--
ALTER TABLE `custom_routine_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `diet_plans`
--
ALTER TABLE `diet_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `diet_plan_meals`
--
ALTER TABLE `diet_plan_meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `form_scores`
--
ALTER TABLE `form_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_achievements`
--
ALTER TABLE `user_achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_custom_routines`
--
ALTER TABLE `user_custom_routines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_workouts`
--
ALTER TABLE `user_workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `water_logs`
--
ALTER TABLE `water_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workout_exercises`
--
ALTER TABLE `workout_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `body_profiles`
--
ALTER TABLE `body_profiles`
  ADD CONSTRAINT `body_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `custom_routine_exercises`
--
ALTER TABLE `custom_routine_exercises`
  ADD CONSTRAINT `custom_routine_exercises_ibfk_1` FOREIGN KEY (`routine_id`) REFERENCES `user_custom_routines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `custom_routine_exercises_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `workout_exercises` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `form_scores`
--
ALTER TABLE `form_scores`
  ADD CONSTRAINT `form_scores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_achievements_ibfk_2` FOREIGN KEY (`routine_id`) REFERENCES `user_custom_routines` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_custom_routines`
--
ALTER TABLE `user_custom_routines`
  ADD CONSTRAINT `user_custom_routines_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_workouts`
--
ALTER TABLE `user_workouts`
  ADD CONSTRAINT `fk_routine` FOREIGN KEY (`routine_id`) REFERENCES `user_custom_routines` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_workouts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `water_logs`
--
ALTER TABLE `water_logs`
  ADD CONSTRAINT `water_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
