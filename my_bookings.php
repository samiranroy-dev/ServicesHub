<?php
// --- FILE: my_bookings.php (Updated) ---
// This file now displays remarks for declined bookings.
include 'db_connect.php';
include 'header.php'; 

if (!isset($_SESSION['customer_loggedin']) || $_SESSION['customer_loggedin'] !== true || !isset($_SESSION['customer_id'])) {
    header("location: customer_login.php");
    exit;
}

$customer_id = $_SESSION['customer_id'];

// Updated SQL to select the new 'remarks' column
$sql = "SELECT b.booking_date, b.time_slot, b.status, b.remarks, p.name as pro_name, p.phone as pro_phone
        FROM bookings b
        JOIN service_professionals p ON b.professional_id = p.id
        WHERE b.customer_id = ?
        ORDER BY b.booking_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<div class="container mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">My Bookings</h1>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-slate-50"><tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Professional</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr></thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if ($result->num_rows > 0): while($booking = $result->fetch_assoc()): ?>
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium"><?php echo date("D, M j, Y", strtotime($booking['booking_date'])); ?></div>
                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($booking['time_slot']); ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium"><?php echo htmlspecialchars($booking['pro_name']); ?></div>
                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($booking['pro_phone']); ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php if($booking['status']=='Pending') echo 'bg-yellow-100 text-yellow-800'; elseif($booking['status']=='Accepted') echo 'bg-green-100 text-green-800'; else echo 'bg-red-100 text-red-800'; ?>">
                                <?php echo htmlspecialchars($booking['status']); ?>
                            </span>
                            <?php // Display remarks if the booking was declined and remarks exist
                            if ($booking['status'] == 'Declined' && !empty($booking['remarks'])): ?>
                                <p class="text-xs text-gray-500 mt-1 italic">Reason: "<?php echo htmlspecialchars($booking['remarks']); ?>"</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; else: ?>
                    <tr><td colspan="3" class="p-6 text-center text-gray-500">You have not made any bookings yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<?php
// --- END OF my_bookings.php ---
?>

