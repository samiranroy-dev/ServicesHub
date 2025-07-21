<?php
// --- NEW FILE: customer_login.php (Corrected) ---
// All PHP logic is now processed before any HTML is output.
session_start();

// If already logged in, redirect to the dashboard immediately
if (isset($_SESSION['customer_loggedin']) && $_SESSION['customer_loggedin'] === true) {
    header("location: my_bookings.php");
    exit;
}

include 'db_connect.php';
$error = '';

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT id, name, email, password, phone FROM customers WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $db_email, $hashed_password, $phone);
                    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
                        // Password is correct, so start a new session and save variables
                        $_SESSION['customer_loggedin'] = true;
                        $_SESSION['customer_id'] = $id;
                        $_SESSION['customer_name'] = $name;
                        $_SESSION['customer_email'] = $db_email;
                        $_SESSION['customer_phone'] = $phone;
                        
                        // Redirect to the bookings page
                        header("location: my_bookings.php");
                        exit; // Important: stop script execution after redirect
                    } else { $error = 'The password you entered was not valid.'; }
                } else { $error = 'No account found with that email.'; }
            } else { $error = 'Oops! Something went wrong. Please try again later.'; }
            $stmt->close();
        }
    }
    $conn->close();
}

// If we reach this point, it means the user needs to see the login form.
// Now it's safe to include the header and output HTML.
include 'header.php';
?>
<div class="max-w-md mx-auto bg-white p-8 mt-10 rounded-xl shadow-lg">
    <h2 class="text-3xl font-bold text-center mb-6">Customer Login</h2>
    <?php if(!empty($error)): ?><div class="bg-red-100 text-red-700 p-3 mb-4 rounded-md"><?php echo $error; ?></div><?php endif; ?>
    <form action="customer_login.php" method="post" class="space-y-6">
        <div><label>Email</label><input type="email" name="email" required class="w-full mt-1 p-2 border rounded-lg"></div>
        <div><label>Password</label><input type="password" name="password" required class="w-full mt-1 p-2 border rounded-lg"></div>
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold">Login</button>
    </form>
</div>
<?php include 'footer.php'; ?>
<?php
// --- END OF customer_login.php ---
?>