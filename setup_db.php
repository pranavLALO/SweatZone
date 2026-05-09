<?php
echo "Starting Database Setup...<br>";

// Get all php files in migrations folder
$files = glob(__DIR__ . '/migrations/*.php');
sort($files); // Ensure 000 runs before 001, etc.

foreach ($files as $file) {
    echo "Running " . basename($file) . "...<br>";
    // Use include so variables like $conn from db.php are available or re-established if needed
    // But since they all include db.php, we might have issue with redeclaration if using require
    // So usually migrations should be self-contained or check if connection exists.
    // However, our migrations use 'require', which errors if included twice.
    // Let's rely on standard include here, but we might hit 'cannot redeclare class/function' or 'variables overwritten'.
    // A safer way for this simple script is just to shell_exec or include carefully.
    // Or, we expect the user to run them one by one.
    // Be safer: we will modify migrations to use require_once in the future, but for now:
    
    // We will just include it. The simple db.php just sets $conn. it's fine.
    include $file;
    echo "<br><hr>";
}

echo "Database Setup Completed!";
?>
