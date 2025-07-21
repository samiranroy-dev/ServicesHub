<?php
// --- FILE: booking.php (Updated) ---
// This file now requires login and pre-fills user data.
include 'db_connect.php';
include 'header.php';

// Check if customer is logged in. If not, redirect them.
if (!isset($_SESSION['customer_loggedin']) || $_SESSION['customer_loggedin'] !== true) {
    // Save the intended page to redirect back to after login
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("location: customer_login.php?notice=login_required");
    exit;
}

$pro_id = isset($_GET['pro_id']) ? (int)$_GET['pro_id'] : 0;
if ($pro_id <= 0) { die("Invalid professional ID."); }

// Fetch professional details
$stmt = $conn->prepare("SELECT name, slot_capacity FROM service_professionals WHERE id = ?");
$stmt->bind_param("i", $pro_id);
$stmt->execute();
$professional = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$professional) { die("Professional not found."); }

// Time slot availability logic (remains the same)
$today_date = date('Y-m-d');
$booked_slot_counts = [];
$slot_stmt = $conn->prepare("SELECT time_slot, COUNT(*) as booking_count FROM bookings WHERE professional_id = ? AND booking_date = ? AND status = 'Accepted' GROUP BY time_slot");
$slot_stmt->bind_param("is", $pro_id, $today_date);
$slot_stmt->execute();
$slot_result = $slot_stmt->get_result();
while($row = $slot_result->fetch_assoc()) {
    $booked_slot_counts[$row['time_slot']] = $row['booking_count'];
}
$slot_stmt->close();
$time_slots = ["09:00 AM - 11:00 AM", "11:00 AM - 01:00 PM", "02:00 PM - 04:00 PM", "04:00 PM - 06:00 PM"];
?>
<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-2xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Book an Appointment with <?php echo htmlspecialchars($professional['name']); ?></h2>
    <form action="booking_process.php" method="POST" class="space-y-4">
        <!-- Hidden inputs to pass IDs -->
        <input type="hidden" name="professional_id" value="<?php echo $pro_id; ?>">
        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id']; ?>">
        
        <!-- Pre-filled customer details -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION['customer_name']); ?>" readonly class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-100">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="tel" value="<?php echo htmlspecialchars($_SESSION['customer_phone']); ?>" readonly class="mt-1 block w-full px-4 py-2 border rounded-lg bg-gray-100">
        </div>
        
        <!-- Editable fields -->
        <div>
            <label for="customer_address" class="block text-sm font-medium text-gray-700">Service Address</label>
            <textarea name="customer_address" id="customer_address" rows="3" required class="mt-1 block w-full px-4 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>
        <div>
            <label for="booking_date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="booking_date" id="booking_date" required min="<?php echo date('Y-m-d'); ?>" class="mt-1 block w-full px-4 py-2 border rounded-lg">
        </div>
        <div>
            <label for="time_slot" class="block text-sm font-medium text-gray-700">Time Slot</label>
            <select name="time_slot" id="time_slot" required class="mt-1 block w-full px-4 py-2 border rounded-lg bg-white">
                <option value="" disabled selected>Select a time</option>
                <?php foreach($time_slots as $slot): ?>
                    <?php
                        $current_bookings = isset($booked_slot_counts[$slot]) ? $booked_slot_counts[$slot] : 0;
                        $is_full = $current_bookings >= $professional['slot_capacity'];
                    ?>
                    <option value="<?php echo htmlspecialchars($slot); ?>" <?php if ($is_full) echo 'disabled'; ?>>
                        <?php echo htmlspecialchars($slot); ?>
                        <?php if ($is_full) echo ' (Full)'; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-700">Confirm Booking</button>
    </form>
</div>
<?php include 'footer.php'; ?>
<?php
// --- END OF booking.php ---
?>