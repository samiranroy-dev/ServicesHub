<?php
// --- NEW FILE: customer_register_process.php ---
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $phone = $conn->real_escape_string($_POST['phone']);

    if (empty($name) || empty($email) || empty($password) || empty($phone)) { die("Please fill all fields."); }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO customers (name, email, password, phone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $phone);

    if ($stmt->execute()) {
        header("Location: customer_register.php?status=success");
    } else {
        // Handle potential duplicate email error
        header("Location: customer_register.php?status=error");
    }
    $stmt->close();
    $conn->close();
}
?>
<?php
// --- END OF customer_register_process.php ---
?>