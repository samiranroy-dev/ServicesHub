<?php
// --- FILE: browse.php ---
include 'db_connect.php';
include 'header.php'; 
?>
<div class="container mx-auto">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Our Services</h2>
    <p class="text-center text-gray-500 mb-12">Select a category to find skilled professionals near you.</p>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($serviceCategories as $service): ?>
            <a href="professionals.php?service_id=<?php echo htmlspecialchars($service['id']); ?>"
               class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer flex flex-col items-center text-center">
                <div class="text-5xl mb-4"><?php echo $service['icon']; ?></div>
                <h3 class="text-lg font-semibold text-gray-700"><?php echo htmlspecialchars($service['name']); ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'footer.php'; ?>
<?php
// --- END OF browse.php ---
?>