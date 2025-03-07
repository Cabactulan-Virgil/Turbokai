@extends('admin')

@section('content')
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Delivery Management</h1>
        <div class="flex items-center space-x-4 mb-4">
            <button class="tab text-black" onclick="openTab(event, 'Delivery')">Delivery</button>
            <button class="tab text-black" onclick="openTab(event, 'Pending')">Pending</button>
            <button class="tab text-black" onclick="openTab(event, 'OnTheWay')">On the Way</button>
            <button class="tab text-black" onclick="openTab(event, 'Delivered')">Delivered</button>
            <div class="flex items-center ml-auto">
                <label for="search" class="mr-2">Search:</label>
                <input type="text" id="search" class="border border-gray-300 rounded p-1">
                <button class="ml-2">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <hr class="border-gray-300">

        <div id="Delivery" class="tabcontent hidden">
            <br>
            <button class="bg-gray-800 text-white py-2 px-4 mr-2" onclick="openModal()">Add Delivery</button>
        </div>
        <div id="Pending" class="tabcontent hidden">
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">DO Number</th>
                                <th class="px-4 py-2 border-b">Dimension</th>
                                <th class="px-4 py-2 border-b">Pullout Date</th>
                                <th class="px-4 py-2 border-b">Container No.</th>
                                <th class="px-4 py-2 border-b">Client</th>
                                <th class="px-4 py-2 border-b">Assign Driver</th>
                                <th class="px-4 py-2 border-b">Cargo Details</th>
                                <th class="px-4 py-2 border-b">Place of Delivery</th>
                                <th class="px-4 py-2 border-b">Return Date</th>
                                <th class="px-4 py-2 border-b">Status</th>
                                <th class="px-4 py-2 border-b">Trucking Fee</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data rows will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- on the way -->
        <div id="OnTheWay" class="tabcontent hidden">
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">DO Number</th>
                                <th class="px-4 py-2 border-b">Dimension</th>
                                <th class="px-4 py-2 border-b">Pullout Date</th>
                                <th class="px-4 py-2 border-b">Container No.</th>
                                <th class="px-4 py-2 border-b">Client</th>
                                <th class="px-4 py-2 border-b">Assign Driver</th>
                                <th class="px-4 py-2 border-b">Cargo Details</th>
                                <th class="px-4 py-2 border-b">Place of Delivery</th>
                                <th class="px-4 py-2 border-b">Return Date</th>
                                <th class="px-4 py-2 border-b">Status</th>
                                <th class="px-4 py-2 border-b">Trucking Fee</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data rows will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="Delivered" class="tabcontent hidden">
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">DO Number</th>
                                <th class="px-4 py-2 border-b">Dimension</th>
                                <th class="px-4 py-2 border-b">Pullout Date</th>
                                <th class="px-4 py-2 border-b">Container No.</th>
                                <th class="px-4 py-2 border-b">Client</th>
                                <th class="px-4 py-2 border-b">Assign Driver</th>
                                <th class="px-4 py-2 border-b">Cargo Details</th>
                                <th class="px-4 py-2 border-b">Place of Delivery</th>
                                <th class="px-4 py-2 border-b">Return Date</th>
                                <th class="px-4 py-2 border-b">Status</th>
                                <th class="px-4 py-2 border-b">Trucking Fee</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data rows will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-1/2">
            <h2 class="text-xl font-bold mb-4">Add Delivery</h2>
  

            <form action="{{ route('delivery-store') }}" method="POST">
                @csrf 
                <div class="mb-4">
                    <label for="doNumber" class="block text-gray-700">DO Number</label>
                    <input type="text" id="doNumber" name="doNo" class="border border-gray-300 rounded p-2 w-full"
                        required>
                </div>
                <div class="mb-4">
                    <label for="dimension" class="block text-gray-700">Dimension</label>
                    <select id="dimension" name="dimension" class="border border-gray-300 rounded p-2 w-full" required>
                        <option value="1x20">1x20</option>
                        <option value="1x40">1x40</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="pulloutDate" class="block text-gray-700">Pullout Date</label>
                    <input type="date" id="pulloutDate" name="pulloutDate"
                        class="border border-gray-300 rounded p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="containerNo" class="block text-gray-700">Container No.</label>
                    <input type="text" id="containerNo" name="vanNo" class="border border-gray-300 rounded p-2 w-full"
                        required>
                </div>
                <div class="mb-4">
                    <label for="client" class="block text-gray-700">Client</label>
                    <select id="client" name="client" class="border border-gray-300 rounded p-2 w-full">
                        @foreach ($clientNames as $clientName)
                            <option value="{{ $clientName }}">{{ $clientName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="assignDriver" class="block text-gray-700">Assign Driver</label>
                    <select id="assignDriver" name="driver" class="border border-gray-300 rounded p-2 w-full">
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver }}">{{ $driver }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="cargoDetails" class="block text-gray-700">Cargo Details</label>
                    <textarea id="cargoDetails" name="cargoDetails"
                        class="border border-gray-300 rounded p-2 w-full"></textarea>
                </div>
                <div class="mb-4">
                    <label for="placeOfDelivery" class="block text-gray-700">Place of Delivery</label>
                    <select id="placeOfDelivery" name="location" class="border border-gray-300 rounded p-2 w-full">
                        @foreach ($placesOfDelivery as $place)
                            <option value="{{ $place }}">{{ $place }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="returnDate" class="block text-gray-700">Return Date</label>
                    <input type="date" id="returnDate" name="returnDate"
                        class="border border-gray-300 rounded p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select id="status" name="status" class="border border-gray-300 rounded p-2 w-full">
                        <option value="pending">Pending</option>
                        <option value="onTheWay">On the Way</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="truckingFee" class="block text-gray-700">Trucking Fee</label>
                    <input type="text" id="truckingFee" name="truckingFee"
                        class="border border-gray-300 rounded p-2 w-full" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                        onclick="closeModal()">Cancel</button>
                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.add("hidden");
            }
            tablinks = document.getElementsByClassName("tab");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("font-bold");
            }
            document.getElementById(tabName).classList.remove("hidden");
            evt.currentTarget.classList.add("font-bold");
        }

        function openModal() {
            document.getElementById("modal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("modal").classList.add("hidden");
        }
    </script>
</body>

</html>
@endsection