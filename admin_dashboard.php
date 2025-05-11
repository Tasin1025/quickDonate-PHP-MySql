<?php
// Start session
session_start();

// Include the database connection file
include('config.php');

// Check if the user is logged in and has an admin role
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch admin data (optional, but can be useful for displaying admin info)
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();

// Handle user account actions (deactivate, activate, delete)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $user_id_to_manage = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'deactivate') {
        // Deactivate the user's account
        $sql = "UPDATE users SET status = 'inactive' WHERE id = '$user_id_to_manage'";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin_dashboard.php");
            exit;
        }
    } elseif ($action == 'activate') {
        // Activate the user's account
        $sql = "UPDATE users SET status = 'active' WHERE id = '$user_id_to_manage'";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin_dashboard.php");
            exit;
        }
    } elseif ($action == 'delete') {
        // Delete the user
        $sql = "DELETE FROM users WHERE id = '$user_id_to_manage'";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin_dashboard.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - QuickDonate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Admin Header Section -->
    <header class="bg-red-600 text-white text-center py-16">
        <h1 class="text-5xl font-bold">Admin Dashboard</h1>
        <p class="mt-4 text-lg">Manage users, donations, and more.</p>
    </header>

    <!-- Admin Controls -->
    <section class="max-w-4xl mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-semibold text-red-600">Welcome, Admin <?php echo $admin['name']; ?></h2>
            <a href="logout.php" class="bg-white text-red-600 px-6 py-2 rounded-full font-semibold text-lg shadow-lg hover:bg-red-100 transition">Logout</a>
        </div>
    </section>

    <!-- User Management Section -->
    <section class="max-w-4xl mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-center text-red-600">Manage Users</h2>

        <!-- Display Users in Table -->
        <div class="mt-6">
            <table class="w-full mt-4 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="border border-gray-300 p-2">Name</th>
                        <th class="border border-gray-300 p-2">Blood Group</th>
                        <th class="border border-gray-300 p-2">Location</th>
                        <th class="border border-gray-300 p-2">Phone Number</th> <!-- New Column for Phone -->
                        <th class="border border-gray-300 p-2">Status</th>
                        <th class="border border-gray-300 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query all users (both donor and recipient)
                    $sql_users = "SELECT * FROM users";
                    $result_users = $conn->query($sql_users);
                    if ($result_users->num_rows > 0) {
                        while ($row = $result_users->fetch_assoc()) {
                            echo "<tr class='text-center'>";
                            echo "<td class='border border-gray-300 p-2'>{$row['name']}</td>";
                            echo "<td class='border border-gray-300 p-2'>{$row['blood_group']}</td>";
                            echo "<td class='border border-gray-300 p-2'>{$row['area']}</td>";
                            echo "<td class='border border-gray-300 p-2'>{$row['phone']}</td>"; 
                            echo "<td class='border border-gray-300 p-2'><span class='text-" . ($row['status'] == 'active' ? 'green' : 'red') . "-600'>" . ucfirst($row['status']) . "</span></td>";
                            echo "<td class='border border-gray-300 p-2'>
                                    <a href='admin_dashboard.php?action=deactivate&id={$row['id']}' class='bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition'>Deactivate</a>
                                    <a href='admin_dashboard.php?action=activate&id={$row['id']}' class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition ml-2'>Activate</a>
                                    <a href='admin_dashboard.php?action=delete&id={$row['id']}' class='bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition ml-2'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center p-4'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>© 2025 QuickDonate | All Rights Reserved</p>
    </footer>

</body>
</html>
