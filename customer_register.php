<?php
// --- NEW FILE: customer_register.php ---
include 'header.php';
?>
<div class="max-w-md mx-auto bg-white p-8 mt-10 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-center mb-6">Create Customer Account</h2>
     <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-md">Registration Successful! You can now <a href="customer_login.php" class="font-bold underline">login</a>.</div>
    <?php endif; ?>
    <form action="customer_register_process.php" method="post" class="space-y-6">
        <div><label>Full Name</label><input type="text" name="name" required class="w-full mt-1 p-2 border rounded-lg"></div>
        <div><label>Email</label><input type="email" name="email" required class="w-full mt-1 p-2 border rounded-lg"></div>
        <div><label>Password</label><input type="password" name="password" required class="w-full mt-1 p-2 border rounded-lg"></div>
        <div><label>Phone</label><input type="tel" name="phone" required class="w-full mt-1 p-2 border rounded-lg"></div>
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold">Register</button>
    </form>
</div>
<?php include 'footer.php'; ?>
<?php
// --- END OF customer_register.php ---
?>