<?php
// Start session
session_start();

// Include the database connection file
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Fetch user data from the database for the dashboard
$user_id = $_SESSION['user_id']; // Get user ID from session
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_name = $user['name'];
} else {
    // If no user found, redirect to login page
    header("Location: login.php");
    exit;
}

// Handle search request
$donors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // Query database to search for matching donors
    $sql_search = "SELECT * FROM users WHERE blood_group = '$blood_group' AND area = '$location' AND role = 'user' AND status = 'active'";
    $donors_result = $conn->query($sql_search);

    if ($donors_result->num_rows > 0) {
        while ($row = $donors_result->fetch_assoc()) {
            $donors[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Donors - QuickDonate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

      <!-- Header Section -->
    <header class="bg-red-600 text-white text-center py-16">
        <h1 class="text-5xl font-bold">Welcome to Your Dashboard</h1>
        <p class="mt-4 text-lg">Manage your blood donations and requests here.</p>
        <h2 class="mt-6 text-3xl font-semibold italic">Welcome, <span class="bg-white text-red-600 px-4 py-1 rounded-md shadow-lg"><?php echo $user_name; ?></span></h2>

        <!-- User Controls -->
        <div class="mt-6 text-white">
            <a href="logout.php" class="bg-white text-red-600 px-6 py-2 rounded-full font-semibold text-lg shadow-lg hover:bg-red-100 transition mt-4 inline-block">Logout</a>
            <a href="user_dashboard.php" class="bg-white text-red-600 px-6 py-2 rounded-full font-semibold text-lg shadow-lg hover:bg-red-100 transition mt-4 inline-block">Home</a>
            
            
        </div>
    </header>
    <!-- Search Donors Section -->
    <section class="max-w-4xl mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center text-red-600">Search for Blood Donors</h2>
        <form action="search.php" method="POST" class="mt-6 flex flex-col sm:flex-row gap-4">
            <select name="blood_group" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                <option>Select Blood Group</option>
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>O+</option>
                <option>O-</option>
                <option>AB+</option>
                <option>AB-</option>
            </select>
            <select name="location" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" required>
                <option>Select Your Location</option>
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
            </select>
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Search</button>
        </form>

        <!-- Display Search Results -->
        <?php if (!empty($donors)): ?>
            <h3 class="mt-8 text-2xl font-semibold text-center text-red-600">Available Donors</h3>
            <table class="w-full mt-6 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="border border-gray-300 p-2">Name</th>
                        <th class="border border-gray-300 p-2">Blood Group</th>
                        <th class="border border-gray-300 p-2">Location</th>
                        <th class="border border-gray-300 p-2">Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donors as $donor): ?>
                        <tr class="bg-gray-100 text-center">
                            <td class="border border-gray-300 p-2"><?php echo $donor['name']; ?></td>
                            <td class="border border-gray-300 p-2"><?php echo $donor['blood_group']; ?></td>
                            <td class="border border-gray-300 p-2"><?php echo $donor['area']; ?></td>
                            <td class="border border-gray-300 p-2"><?php echo $donor['phone']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p class="text-center text-red-600 mt-4">No donors found with the selected blood group and location.</p>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>© 2025 QuickDonate | All Rights Reserved</p>
    </footer>

</body>
</html>
