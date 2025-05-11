<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickDonate - Blood Donation System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-red-600 text-white text-center py-16">
        <h1 class="text-5xl font-bold">Donate Blood, Save Lives</h1>
        <p class="mt-4 text-lg">Find donors or donate blood to those in need.</p>
        <h2 class="mt-6 text-3xl font-semibold italic">Welcome to <span class="bg-white text-red-600 px-4 py-1 rounded-md shadow-lg">QuickDonate</span></h2>
        <div class="mt-6">
            <a href="register.php" class="bg-white text-red-600 px-6 py-2 rounded-full font-semibold text-lg shadow-lg hover:bg-red-100 transition">Become a Donor</a>
            <a href="login.php" class="ml-4 bg-white text-red-600 px-6 py-2 rounded-full font-semibold text-lg shadow-lg hover:bg-red-100 transition">Find a Donor</a>
        </div>
    </header>

    <!-- Search Donors Section -->
    <section class="max-w-4xl mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center text-red-600">Search for Blood Donors</h2>
        <form action="login.php" method="GET" class="mt-6 flex flex-col sm:flex-row gap-4">
            <select class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500">
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
            <select class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500">
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
            </select>
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition">Search</button>
        </form>
    </section>

        <!-- Why Donate Blood Section -->
        <section class="max-w-4xl mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg text-center">
            <h2 class="text-3xl font-bold text-red-600">Why Donate Blood?</h2>
            <p class="mt-4 text-gray-600">
                Blood donation can save lives in medical emergencies, surgeries, and for patients with diseases like **thalassemia & cancer**.  
                One donation can help up to **three people**. Be a hero today! 🩸
            </p>
        </section>

    <!-- How It Works Section -->
    <section class="max-w-4xl mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg text-center">
        <h2 class="text-3xl font-bold text-red-600">How QuickDonate Works?</h2>
        <div class="mt-6 text-gray-600 space-y-4">
            <p>✅ Register as a donor or recipient.</p>
            <p>✅ Search for donors based on blood type & location.</p>
            <p>✅ Contact the donor and arrange the donation.</p>
            <p>✅ Help save lives with your contribution.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="max-w-4xl mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg text-center">
        <h2 class="text-3xl font-bold text-red-600">Contact Us</h2>
        <p class="mt-4 text-gray-600">Have questions? Reach out to us at <span class="font-semibold text-red-600">support@quickdonate.com</span></p>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>© 2025 QuickDonate | All Rights Reserved</p>
        
    </footer>

</body>
</html>
