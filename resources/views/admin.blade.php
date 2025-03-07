<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trucking Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .active {
            background-color: #fbbf24; /* Tailwind yellow-500 */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col h-screen">
        <!-- Top Bar -->
        <div class="bg-white-700 text-white flex items-center justify-between p-2">
            <div class="flex-1 flex justify-center">
                <div class="bg-gray-800 text-white py-1 px-11 rounded">
                <h2 class="text-2x1 font-bold">Trucking Management System</h2>
                </div>
            </div>
        </div>

        <!-- Admin Bar -->
        <div class="bg-yellow-600 p-4 flex items-center justify-between">
            <div class="flex items-center">
                <span class="ml-2 font-bold">Admin</span>
            </div>
            <span class="ml-50"><p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Manage your trucking operations efficiently with our easy-to-use system.</p></span>
            <div class="flex items-center">
                <span id="dateTime" class="mr-4"></span>
            <button id="logoutBtn" style="color: #000; border: 0px solid #000;" type="button">
                Logout <i class="fas fa-sign-out-alt cursor-pointer"></i>
            </button>
        </div>
        </div>

        <div class="flex flex-1">
            <!-- Sidebar -->
            <div class="w-64 bg-gray-800 text-white flex flex-col">
                <nav class="flex-1">
                    <ul>
                        <li class="flex items-center p-4 hover:bg-gray-700 cursor-pointer 
                            {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class="flex items-center w-full">
                                <i class="fas fa-tachometer-alt"></i>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <!-- <li class="flex items-center p-4 hover:bg-gray-700 cursor-pointer 
                            {{ Route::currentRouteName() == 'truckNdriver' ? 'active' : '' }}">
                            <a href="{{ route('truckNdriver') }}" class="flex items-center w-full">
                                <i class="fas fa-truck"></i>
                                <span class="ml-2">Trucks&Drivers</span>
                            </a>
                        </li> -->
                        <li class="flex items-center p-4 hover:bg-gray-700 cursor-pointer 
                            {{ Route::currentRouteName() == 'truck-index' ? 'active' : '' }}">
                            <a href="{{ route('truck-index') }}" class="flex items-center w-full">
                                <i class="fas fa-truck"></i>
                                <span class="ml-2">Trucks&Drivers</span>
                            </a>
                        </li>
                        <li class="flex items-center p-4 hover:bg-gray-700 cursor-pointer 
                            {{ Route::currentRouteName() == 'client-index' ? 'active' : '' }}">
                            <a href="{{ route('client-index') }}" class="flex items-center w-full">
                                <i class="fas fa-users"></i>
                                <span class="ml-2">Clients</span>
                            </a>
                        </li>
                        <!-- <li class="flex items-center p-4 hover:bg-gray-700 cursor-pointer 
                            {{ Route::currentRouteName() == 'delivery' ? 'active' : '' }}">
                            <a href="{{ route('delivery') }}" class="flex items-center w-full">
                                <i class="fas fa-shipping-fast"></i>
                                <span class="ml-2">Delivery</span>
                            </a>
                        </li> -->
                        <li class="flex items-center p-4 hover:bg-gray-700 cursor-pointer 
                            {{ Route::currentRouteName() == 'delivery-index' ? 'active' : '' }}">
                            <a href="{{ route('delivery-index') }}" class="flex items-center w-full">
                                <i class="fas fa-shipping-fast"></i>
                                <span class="ml-2">Delivery</span>
                            </a>
                        </li>
                        
                        <li class="flex items-center p-4 hover:bg-gray-700 cursor-pointer 
                            {{ Route::currentRouteName() == 'reports' ? 'active' : '' }}">
                            <a href="{{ route('reports') }}" class="flex items-center w-full">
                                <i class="fas fa-chart-line"></i>
                                <span class="ml-2">Reports</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="p-4 text-gray-400 text-sm text-right">
                    Team Cipher
                </div>
            </div>
            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <main class="flex-1 p-10">
                    @yield('content') <!-- This is where the page content will be injected -->
                    
                </main>
            </div>
        </div>
    </div>

    <script>
        // Logout button functionality
        document.getElementById('logoutBtn').addEventListener('click', function() {
            // Redirect to login page
            window.location.href = '/login'; // Change this URL to your login page
        });

        function updateDateTime() {
            const now = new Date();
            const formattedDateTime = now.toLocaleString();
            document.getElementById('dateTime').textContent = formattedDateTime;
        }

        // Update date and time every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call to set the date and time immediately
    </script>

</body>
</html>
