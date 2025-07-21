<?php
// --- FILE: db_connect.php ---

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'servicehub_db';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$serviceCategories = [
    ['id' => 'home-cleaning', 'name' => 'Home Cleaning', 'icon' => '🧹'],
    ['id' => 'plumbing', 'name' => 'Plumbing', 'icon' => '🔧'],
    ['id' => 'appliance-repair', 'name' => 'Appliance Repair', 'icon' => '🛠️'],
    ['id' => 'salon-at-home', 'name' => 'Salon at Home', 'icon' => '💇‍♀️'],
    ['id' => 'electrician', 'name' => 'Electrician', 'icon' => '💡'],
    ['id' => 'painting', 'name' => 'Painting', 'icon' => '🎨'],
];
?>