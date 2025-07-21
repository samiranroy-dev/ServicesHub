<?php
include 'db_connect.php';
include 'header.php'; 

$service_id = isset($_GET['service_id']) ? $conn->real_escape_string($_GET['service_id']) : '';
if (empty($service_id)) {
    echo "<p class='text-center'>No service selected.</p>";
    include 'footer.php';
    exit();
}

$service_name = 'Service';
$service_icon = '⭐';
foreach ($serviceCategories as $cat) {
    if ($cat['id'] == $service_id) {
        $service_name = $cat['name'];
        $service_icon = $cat['icon'];
        break;
    }
}
?>
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-12">
        <div class="text-6xl mb-4"><?php echo htmlspecialchars($service_icon); ?></div>
        <h1 class="text-4xl font-extrabold text-gray-800">Professionals for <?php echo htmlspecialchars($service_name); ?></h1>
    </div>
    <?php
    // Updated SQL query to fetch the price
    $sql = "SELECT id, name, location, price FROM service_professionals WHERE serviceId = '$service_id'";
    $result = $conn->query($sql);
    ?>
    <?php if ($result && $result->num_rows > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while($pro = $result->fetch_assoc()): ?>
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border flex flex-col">
                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($pro['name']); ?></h3>
                        <p class="text-gray-500 mb-4"><?php echo htmlspecialchars($pro['location']); ?></p>
                        <div class="text-3xl font-bold text-indigo-600">
                            ₹<?php echo number_format($pro['price'], 2); ?>
                        </div>
                        <p class="text-sm text-gray-400">Starting price</p>
                    </div>
                    <div class="p-6 bg-slate-50">
                         <a href="booking.php?pro_id=<?php echo $pro['id']; ?>" class="block text-center w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:scale-105 transition-transform">
                            Book Now
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-500 mt-8">No professionals have registered for this service yet.</p>
    <?php endif; ?>
</div>
<?php include 'footer.php'; ?>
