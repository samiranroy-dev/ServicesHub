<?php
// --- FILE: booking_confirmation.php ---
include 'header.php'; 
?>
<div class="max-w-2xl mx-auto text-center py-16">
    <div class="mx-auto w-24 h-24 flex items-center justify-center bg-green-100 rounded-full text-green-600 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-800">Booking Request Sent!</h1>
    <p class="mt-4 text-lg text-gray-600">The professional will contact you shortly to confirm the booking.</p>
    <a href="index.php" class="mt-8 inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-700">Back to Homepage</a>
</div>
<?php include 'footer.php'; ?>
<?php
// --- END OF booking_confirmation.php ---
?>
