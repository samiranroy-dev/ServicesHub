<?php
// --- FILE: header.php (Corrected) ---
// This now safely starts a session, preventing the "already active" notice.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceHub - Your Home Services Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-blue-600">ServiceHub</a>
            <div class="flex items-center space-x-6">
                <a href="index.php" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="browse.php" class="text-gray-600 hover:text-blue-600">Find Services</a>
                
                <?php if (isset($_SESSION['customer_loggedin']) && $_SESSION['customer_loggedin'] === true): ?>
                    <!-- Show these links if customer is logged in -->
                    <a href="my_bookings.php" class="text-gray-600 hover:text-blue-600">My Bookings</a>
                    <a href="customer_logout.php" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 text-sm">Logout</a>
                <?php else: ?>
                    <!-- Show these links if customer is a guest -->
                    <a href="customer_login.php" class="text-gray-600 hover:text-blue-600">Login</a>
                    <a href="customer_register.php" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main class="p-4 md:p-8">
<?php
// --- END OF header.php ---
?>
