<?php
// Include database connection file
include('config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize user inputs
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
$area = mysqli_real_escape_string($conn, $_POST['area']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);  // New field for phone number

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL to insert data into the users table
$sql = "INSERT INTO users (name, email, password, blood_group, area, role, phone) 
        VALUES ('$name', '$email', '$hashed_password', '$blood_group', '$area', '$role', '$phone')";

// Execute query and check if it was successful
if ($conn->query($sql) === TRUE) {
    // Registration success, show alert and redirect to login page
    echo "<script>
            alert('Registration successful! Please login.');
            window.location.href = 'login.php'; // Redirect to login page
          </script>";
} else {
    // Registration failed, show error alert and stay on the page
    echo "<script>
            alert('Error: " . $conn->error . "');
          </script>";
}

}
?>

<!-- Registration Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - QuickDonate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Registration Form Section -->
    <section class="max-w-lg mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center text-red-600">Register to QuickDonate</h2>
        <p class="text-center text-gray-600 mt-2">Join our life-saving community today.</p>

        <form action="register.php" method="POST" class="mt-6 space-y-4">
            <input type="text" name="name" placeholder="Full Name" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required><br>
            <input type="email" name="email" placeholder="Email Address" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required><br>
            <input type="text" name="phone" placeholder="Phone Number" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required><br>
            <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required><br>

            <select name="blood_group" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                <option value="">Select Blood Group</option>
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>O+</option>
                <option>O-</option>
                <option>AB+</option>
                <option>AB-</option>
            </select><br>

            <select name="area" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                <option value="">Select Your Area</option>
                <option>Gulshan</option>
                <option>Banani</option>
                <option>Dhanmondi</option>
                <option>Uttara</option>
                <option>Mohammadpur</option>
                <option>Mirpur</option>
                <option>Motijheel</option>
                <option>Bashundhara</option>
                <option>Shyamoli</option>
                <option>Farmgate</option>
                <option>Puran Dhaka</option>
            </select><br>

            <!-- Role Selection Dropdown -->
            <select name="role" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                <option value="user">User (Donor/Recipient)</option>
                <option value="admin">Admin</option>
            </select><br>

            <button type="submit" class="w-full bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Register</button>
        </form>

        <p class="text-center text-gray-600 mt-4">Already have an account? 
            <a href="login.php" class="text-red-600 font-semibold hover:underline">Login here</a>
        </p>

        <!-- Return Home Button -->
        <div class="text-center mt-4">
            <a href="index.php" class="bg-white text-red-600 px-6 py-2 rounded-full font-semibold text-lg shadow-lg hover:bg-red-100 transition">Return Home</a>
        </div>
    </section>

</body>
</html>
