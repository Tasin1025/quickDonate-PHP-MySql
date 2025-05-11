<?php
// Start session
session_start();

// Include database connection file
include('config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize user inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Prepare SQL query to check if user exists with the provided email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect to index.php upon successful login
            header("Location: user_dashboard.php");
            exit;
        } else {
            // Incorrect password
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        // No user found with that email
        $error_message = "No user found with that email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - QuickDonate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Login Form Section -->
    <section class="max-w-lg mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center text-red-600">Login to QuickDonate</h2>
        <p class="text-center text-gray-600 mt-2">Access your account and start helping.</p>

        <!-- Display error message if login failed -->
        <?php if (isset($error_message)): ?>
            <div class="text-red-600 text-center mb-4">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="mt-6 space-y-4">
            <input type="email" name="email" placeholder="Email Address" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
            <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required>

            <button type="submit" class="w-full bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Login</button>
        </form>

        <p class="text-center text-gray-600 mt-4">Don't have an account? 
            <a href="register.php" class="text-red-600 font-semibold hover:underline">Register here</a>
        </p>

        <!-- Return Home Button -->
        <p class="text-center text-gray-600 mt-4">
            <a href="index.php" class="bg-white text-red-600 px-6 py-2 rounded-full font-semibold text-lg shadow-lg hover:bg-red-100 transition">Return Home</a>
        </p>
    </section>

</body>
</html>
