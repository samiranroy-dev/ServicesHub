<?php
// --- FILE: booking_process.php (Updated) ---
// This file now saves the customer_id with the booking.
include 'db_connect.php';
session_start(); // Ensure session is started to access customer_id

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get IDs and other data from the form
    $professional_id = (int)$_POST['professional_id'];
    $customer_id = (int)$_POST['customer_id']; // <-- The crucial new field

    // Get details from session to ensure data integrity
    $customer_name = $_SESSION['customer_name'];
    $customer_phone = $_SESSION['customer_phone'];
    
    // Get details from form
    $customer_address = $conn->real_escape_string($_POST['customer_address']);
    $booking_date = $conn->real_escape_string($_POST['booking_date']);
    $time_slot = $conn->real_escape_string($_POST['time_slot']);

    // Validation
    if (empty($professional_id) || empty($customer_id) || empty($customer_address) || empty($booking_date) || empty($time_slot)) {
        die("A required field was missing. Please try again.");
    }

    // Server-side capacity validation (remains the same)
    $cap_stmt = $conn->prepare("SELECT slot_capacity FROM service_professionals WHERE id = ?");
    $cap_stmt->bind_param("i", $professional_id);
    $cap_stmt->execute();
    $capacity = $cap_stmt->get_result()->fetch_assoc()['slot_capacity'];
    $cap_stmt->close();

    $count_stmt = $conn->prepare("SELECT COUNT(*) as booking_count FROM bookings WHERE professional_id = ? AND booking_date = ? AND time_slot = ? AND status = 'Accepted'");
    $count_stmt->bind_param("iss", $professional_id, $booking_date, $time_slot);
    $count_stmt->execute();
    $current_bookings = $count_stmt->get_result()->fetch_assoc()['booking_count'];
    $count_stmt->close();

    if ($current_bookings >= $capacity) {
        die("Sorry, this time slot has just reached its maximum capacity. Please go back and select a different time.");
    }

    // Prepare the new INSERT statement with customer_id
    $sql = "INSERT INTO bookings (professional_id, customer_id, customer_name, customer_phone, customer_address, booking_date, time_slot) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    // Add the customer_id to the bind_param function
    $stmt->bind_param("iisssss", $professional_id, $customer_id, $customer_name, $customer_phone, $customer_address, $booking_date, $time_slot);
    
    if ($stmt->execute()) {
        header("Location: booking_confirmation.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
<?php
// --- END OF booking_process.php ---
?>
