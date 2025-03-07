@extends('admin')

@section('content')
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-gray-100 p-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
        <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
            <img alt="Truck icon" class="w-12 h-12 mr-4" src="https://storage.googleapis.com/a1aa/image/nS8hLN13n75fdCsPdaNhOpGlW2pf9jx3mEVFEeGmKQG4wbxnA.jpg" />
            <div>
                <p class="text-sm font-semibold">Total Trucks</p>
                <p class="text-lg font-bold">{{ $totalTrucks }}</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
            <img alt="Driver icon" class="w-12 h-12 mr-4" src="https://storage.googleapis.com/a1aa/image/3Bibdc04cl6wGFXVheeJetIPWflb3C35sCj8DLfdVWOzDvFfE.jpg" />
            <div>
                <p class="text-sm font-semibold">Total Drivers</p>
                <p class="text-lg font-bold">{{ $totalTrucks }}</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
            <img alt="Customer icon" class="w-12 h-12 mr-4" src="https://storage.googleapis.com/a1aa/image/rA2osMFo6w64FhyWgfpeqalyYafT8beoUX03fn1vMzsJDvFfE.jpg" />
            <div>
                <p class="text-sm font-semibold">Total Clients</p>
                <p class="text-lg font-bold">{{ $totalClients }}</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md flex items-center">
            <img alt="Trip icon" class="w-12 h-12 mr-4" src="https://storage.googleapis.com/a1aa/image/3TmEzNiefSjnVkjnLT8h3j9edYFyWzu7HGbOoYEfFSxph3iPB.jpg" />
            <div>
                <p class="text-sm font-semibold">Total Deliveries</p>
                <p class="text-lg font-bold">{{ $totalDeliveries }}</p>
            </div>
        </div>
    </div>
    <br><br>
    <h2 class="text-lg font-bold mb-4">Truck Running Status</h2>
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700" for="search">Search:</label>
    <input 
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
        id="search" 
        type="text" 
        placeholder="Search drivers or status" 
        onkeyup="filterTable()" />
</div>
<table class="min-w-full divide-y divide-gray-200" id="statusTable">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Drivers</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach($driverStatuses as $status)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $status->driverName }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($status->status === 'In Trip' || $status->status === 'In Delivery')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            {{ $status->status }}
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Available
                        </span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
<script>
    // Search functionality for the table
    function filterTable() {
        var searchInput = document.getElementById('search').value.toLowerCase();
        var rows = document.querySelectorAll('#statusTable tbody tr');
        rows.forEach(row => {
            var driverName = row.cells[0].textContent.toLowerCase();
            var status = row.cells[1].textContent.toLowerCase();
            if (driverName.includes(searchInput) || status.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
</html>
@endsection
