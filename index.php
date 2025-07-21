<?php 
include 'db_connect.php'; 
include 'header.php'; 
?>

<!-- Futuristic Hero Section -->
<div class="relative bg-gray-900 overflow-hidden">
    <!-- Animated background gradient -->
    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 animate-gradient-x"></div>
    <!-- SVG Shape Overlays for depth -->
    <div class="absolute inset-0 opacity-20 mix-blend-soft-light">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,50 C25,80 75,20 100,50 L100,100 L0,100 Z" fill="#ffffff"></path>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl drop-shadow-lg">
            <span class="block">Home Services, Reimagined.</span>
            <span class="block text-indigo-200">Effortless. On-Demand.</span>
        </h1>
        <p class="mt-6 max-w-lg mx-auto text-xl text-indigo-100 sm:max-w-3xl">
            Connect with elite, verified professionals instantly. The future of convenience is here—quality service at the tap of a button.
        </p>
        <div class="mt-10 max-w-sm mx-auto sm:max-w-none">
            <a href="browse.php" class="w-full sm:w-auto flex items-center justify-center bg-white text-indigo-600 font-bold py-4 px-10 rounded-full text-lg shadow-2xl hover:bg-indigo-100 transition-all duration-300 transform hover:scale-105">
                Explore Services
            </a>
        </div>
    </div>
</div>

<!-- "Why Choose Us?" Section -->
<div class="bg-white py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base font-semibold text-indigo-600 tracking-wider uppercase">Our Promise</h2>
            <p class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                Experience the Difference
            </p>
        </div>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
            <div class="p-6">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg">
                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="mt-5 text-lg font-semibold text-gray-900">Verified Professionals</h3>
                <p class="mt-2 text-base text-gray-500">Every professional is background-checked, trained, and highly-rated to ensure top-quality service.</p>
            </div>
            <div class="p-6">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 text-white shadow-lg">
                     <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="mt-5 text-lg font-semibold text-gray-900">On-Time Guarantee</h3>
                <p class="mt-2 text-base text-gray-500">Your time is valuable. We ensure our partners arrive on schedule, every time.</p>
            </div>
            <div class="p-6">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-pink-500 to-orange-600 text-white shadow-lg">
                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H7a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                </div>
                <h3 class="mt-5 text-lg font-semibold text-gray-900">Transparent Pricing</h3>
                <p class="mt-2 text-base text-gray-500">No hidden fees. See the final price before you book, and pay securely through the platform.</p>
            </div>
        </div>
    </div>
</div>

<!-- Featured Services Section with Enhanced Styling -->
<div class="bg-gray-50 py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                Explore Popular Services
            </h2>
        </div>
        <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            <?php 
            $featuredServices = array_slice($serviceCategories, 0, 6);
            foreach ($featuredServices as $service): 
            ?>
                <a href="professionals.php?service_id=<?php echo htmlspecialchars($service['id']); ?>" class="group block p-8 bg-white rounded-2xl shadow-lg hover:shadow-indigo-200/50 transition-all duration-300 border border-transparent hover:border-indigo-400">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-16 w-16 rounded-xl flex items-center justify-center bg-indigo-100 text-indigo-600 text-3xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                            <?php echo $service['icon']; ?>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($service['name']); ?></h3>
                            <p class="mt-1 text-base text-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Find Experts &rarr;</p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    @keyframes gradient-x {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .animate-gradient-x {
        background-size: 200% 200%;
        animation: gradient-x 15s ease infinite;
    }
</style>

<?php include 'footer.php'; ?>
