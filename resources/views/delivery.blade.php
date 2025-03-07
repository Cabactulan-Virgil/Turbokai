@extends('admin')

@section('content')
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Delivery Management</h1>
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('delivery-index', ['status' => 'delivery']) }}"
                class="tab text-black {{ $status === 'delivery' ? 'font-bold' : '' }}">Delivery</a>
            <a href="{{ route('delivery-index', ['status' => 'pending']) }}"
                class="tab text-black {{ $status === 'pending' ? 'font-bold' : '' }}">Pending</a>
            <a href="{{ route('delivery-index', ['status' => 'onTheWay']) }}"
                class="tab text-black {{ $status === 'onTheWay' ? 'font-bold' : '' }}">On the Way</a>
            <a href="{{ route('delivery-index', ['status' => 'delivered']) }}"
                class="tab text-black {{ $status === 'delivered' ? 'font-bold' : '' }}">Delivered</a>
            <div class="flex items-center ml-auto">
                <label for="search" class="mr-2">Search:</label>
                <input type="text" id="search" class="border border-gray-300 rounded p-1" placeholder="Search"
                    onkeyup="searchTable()">
                <button class="ml-2" title="Search Table">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <hr class="border-gray-300">

        <!-- MODAL -->
        <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-1/2">
                <h2 class="text-xl font-bold mb-4">Add Delivery</h2>


                <form action="{{ route('delivery-store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="grid grid-cols-3 gap-1">

                        <div class="mb-4">
                            <label for="doNumber" class="block text-gray-700">DO Number</label>
                            <input type="text" id="doNumber" name="doNo"
                                class="border border-gray-300 rounded p-2 w-full" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="pulloutDate" class="block text-gray-700">Pullout Date</label>
                            <input type="date" id="pulloutDate" name="pulloutDate"
                                class="border border-gray-300 rounded p-2 w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="containerNo" class="block text-gray-700">Container No.</label>
                            <input type="text" id="containerNo" name="vanNo"
                                class="border border-gray-300 rounded p-2 w-full" required>
                        </div>
                        <div class="mb-3">
                            <label for="dimension" class="block text-gray-700">Dimension</label>
                            <select id="dimension" name="dimension" class="border border-gray-300 rounded p-2 w-full"
                                required>
                                <option value="1x20">1x20</option>
                                <option value="1x40">1x40</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="truck" class="block text-gray-700">Truck</label>
                            <select id="truck" name="truck_id" class="border border-gray-300 rounded p-2 w-full">
                                @foreach ($trucks as $truck)
                                    <option value="{{ $truck->id }}">{{ $truck->model }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="client" class="block text-gray-700">Client</label>
                            <select id="client" name="client" class="border border-gray-300 rounded p-2 w-full">
                                @foreach ($clientNames as $clientName)
                                    <option value="{{ $clientName }}">{{ $clientName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assignDriver" class="block text-gray-700">Assign Driver</label>
                            <select id="assignDriver" name="driver" class="border border-gray-300 rounded p-2 w-full">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver }}">{{ $driver }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="licensePlate" class="block text-gray-700">Truck Plate No</label>
                            <select id="licensePlate" name="licensePlate"
                                class="border border-gray-300 rounded p-2 w-full" required>
                                @foreach ($licensePlates as $licensePlate)
                                    <option value="{{ $licensePlate }}">{{ $licensePlate }}</option>
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
                            <select id="placeOfDelivery" name="location"
                                class="border border-gray-300 rounded p-2 w-full">
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
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                            onclick="closeModal()">Cancel</button>
                        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded">Save</button>
                    </div>

                </form>

            </div>
        </div>

        <div id="delivery" class="tabcontent {{ $status === 'delivery' ? '' : 'hidden' }}">
            <br><button class="bg-gray-800 text-white py-2 px-4 mr-2" onclick="openModal()">Add Delivery</button>
        </div>

        <!-- Pending Tab -->
        <div id="Pending" class="tabcontent {{ $status === 'pending' ? '' : 'hidden' }}">
            <br>
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="w-full bg-gray-200 text-left">
                                <th class="py-1 px-3">DO No.</th>
                                <th class="py-1 px-3">Dimension</th>
                                <th class="py-1 px-3">Pullout Date</th>
                                <th class="py-1 px-3">Container No.</th>
                                <th class="py-1 px-3">Client</th>
                                <th class="py-1 px-3">Assign Driver</th>
                                <th class="py-1 px-3">Truck Plate No</th>
                                <th class="py-1 px-3">Cargo Details</th>
                                <th class="py-1 px-3">Place of Delivery</th>
                                <th class="py-1 px-3">Return Date</th>
                                <th class="py-1 px-3">Status</th>
                                <th class="py-1 px-3">Trucking Fee</th>
                                <th class="py-1 px-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $delivery)
                                <tr>
                                    <td class="py-1 px-3">{{ $delivery->doNo }}</td>
                                    <td class="py-1 px-3">{{ $delivery->dimension }}</td>
                                    <td class="py-1 px-3">{{ $delivery->pulloutDate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->vanNo }}</td>
                                    <td class="py-1 px-3">{{ $delivery->client }}</td>
                                    <td class="py-1 px-3">{{ $delivery->driver }}</td>
                                    <td class="py-1 px-3">{{ $delivery->licensePlate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->cargoDetails }}</td>
                                    <td class="py-1 px-3">{{ $delivery->location }}</td>
                                    <td class="py-1 px-3">{{ $delivery->returnDate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->status }}</td>
                                    <td class="py-1 px-3">{{ $delivery->truckingFee }}</td>
                                    <!-- Actions Section for Pending, On the Way, Delivered tabs -->
                                    <td class="py-1 px-3">
                                        <div class="flex space-x-2">
                                            <!-- Change status button -->
                                            <button class="bg-blue-500 text-white py-1 px-3 rounded"
                                                onclick="openStatusModal('{{ $delivery->id }}', '{{ $delivery->status }}')">
                                                <i class="fas fa-wrench"></i>
                                            </button>

                                            <!-- Edit Icon -->
                                            <button class="bg-yellow-500 text-white py-1 px-3 rounded"
                                                onclick="openEditModal('{{ $delivery->id }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Delete Icon -->
                                            <!-- Delete Form -->
                                            <form action="{{ route('delivery.destroy', $delivery->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this delivery?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- On The Way Tab -->
        <div id="OnTheWay" class="tabcontent {{ $status === 'onTheWay' ? '' : 'hidden' }}">
            <br>
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="w-full bg-gray-200 text-left">
                                <th class="py-1 px-3">DO No.</th>
                                <th class="py-1 px-3">Dimension</th>
                                <th class="py-1 px-3">Pullout Date</th>
                                <th class="py-1 px-3">Container No.</th>
                                <th class="py-1 px-3">Client</th>
                                <th class="py-1 px-3">Assign Driver</th>
                                <th class="py-1 px-3">Truck Plate No</th>
                                <th class="py-1 px-3">Cargo Details</th>
                                <th class="py-1 px-3">Place of Delivery</th>
                                <th class="py-1 px-3">Return Date</th>
                                <th class="py-1 px-3">Status</th>
                                <th class="py-1 px-3">Trucking Fee</th>
                                <th class="py-1 px-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $delivery)
                                <tr>
                                    <td class="py-1 px-3">{{ $delivery->doNo }}</td>
                                    <td class="py-1 px-3">{{ $delivery->dimension }}</td>
                                    <td class="py-1 px-3">{{ $delivery->pulloutDate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->vanNo }}</td>
                                    <td class="py-1 px-3">{{ $delivery->client }}</td>
                                    <td class="py-1 px-3">{{ $delivery->driver }}</td>
                                    <td class="py-1 px-3">{{ $delivery->licensePlate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->cargoDetails }}</td>
                                    <td class="py-1 px-3">{{ $delivery->location }}</td>
                                    <td class="py-1 px-3">{{ $delivery->returnDate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->status }}</td>
                                    <td class="py-1 px-3">{{ $delivery->truckingFee }}</td>
                                    <!-- Actions Section for Pending, On the Way, Delivered tabs -->
                                    <td class="px-4 py-2 border-b">
                                        <div class="flex space-x-2">
                                            <!-- Change status button -->
                                            <button class="bg-blue-500 text-white py-1 px-3 rounded"
                                                onclick="openStatusModal('{{ $delivery->id }}', '{{ $delivery->status }}')">
                                                <i class="fas fa-wrench"></i>
                                            </button>

                                            <!-- Edit Icon -->
                                            <button class="bg-yellow-500 text-white py-1 px-3 rounded"
                                                onclick="openEditModal('{{ $delivery->id }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Delete Icon -->
                                            <form action="{{ route('delivery.destroy', $delivery->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this delivery?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Delivered Tab -->
        <div id="Delivered" class="tabcontent {{ $status === 'delivered' ? '' : 'hidden' }}">
            <br>
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="w-full bg-gray-200 text-left">
                            <th class="py-1 px-3">DO No.</th>
                                <th class="py-1 px-3">Dimension</th>
                                <th class="py-1 px-3">Pullout Date</th>
                                <th class="py-1 px-3">Container No.</th>
                                <th class="py-1 px-3">Client</th>
                                <th class="py-1 px-3">Assign Driver</th>
                                <th class="py-1 px-3">Truck Plate No</th>
                                <th class="py-1 px-3">Cargo Details</th>
                                <th class="py-1 px-3">Place of Delivery</th>
                                <th class="py-1 px-3">Return Date</th>
                                <th class="py-1 px-3">Status</th>
                                <th class="py-1 px-3">Trucking Fee</th>
                                <th class="py-1 px-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $delivery)
                                <tr>
                                    <td class="py-1 px-3">{{ $delivery->doNo }}</td>
                                    <td class="py-1 px-3">{{ $delivery->dimension }}</td>
                                    <td class="py-1 px-3">{{ $delivery->pulloutDate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->vanNo }}</td>
                                    <td class="py-1 px-3">{{ $delivery->client }}</td>
                                    <td class="py-1 px-3">{{ $delivery->driver }}</td>
                                    <td class="py-1 px-3">{{ $delivery->licensePlate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->cargoDetails }}</td>
                                    <td class="py-1 px-3">{{ $delivery->location }}</td>
                                    <td class="py-1 px-3">{{ $delivery->returnDate }}</td>
                                    <td class="py-1 px-3">{{ $delivery->status }}</td>
                                    <td class="py-1 px-3">{{ $delivery->truckingFee }}</td>
                                    <!-- Actions Section for Pending, On the Way, Delivered tabs -->
                                    <td class="px-4 py-2 border-b">
                                        <div class="flex space-x-2">
                                            <!-- Change status button -->
                                            <button class="bg-blue-500 text-white py-1 px-3 rounded"
                                                onclick="openStatusModal('{{ $delivery->id }}', '{{ $delivery->status }}')">
                                                <i class="fas fa-wrench"></i>
                                            </button>

                                            <!-- Edit Icon -->
                                            <button class="bg-yellow-500 text-white py-1 px-3 rounded"
                                                onclick="openEditModal('{{ $delivery->id }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Delete Icon -->
                                            <form action="{{ route('delivery.destroy', $delivery->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this delivery?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Edit Modal -->
    <div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Edit Delivery Status</h2>
            <form action="{{ route('delivery-update-status') }}" method="POST">
                @csrf
                <input type="hidden" id="deliveryId" name="deliveryId">
                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select id="newStatus" name="status" class="border border-gray-300 rounded p-2 w-full" required>
                        <option value="Pending">Pending</option>
                        <option value="OnTheWay">On the Way</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                        onclick="closeStatusModal()">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Delivery</h2>
        <form id="editDeliveryForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-3 gap-1">
                <input type="hidden" id="editDeliveryId" name="deliveryId">

                <!-- DO Number -->
                <div class="mb-4">
                    <label for="editDoNumber" class="block text-gray-700">DO Number</label>
                    <input type="text" id="editDoNumber" name="doNo"
                        class="border border-gray-300 rounded p-2 w-full" required>
                </div>

                <!-- Dimension -->
                <div class="mb-4">
                    <label for="editDimension" class="block text-gray-700">Dimension</label>
                    <select id="editDimension" name="dimension" class="border border-gray-300 rounded p-2 w-full"
                        required>
                        <option value="1x20">1x20</option>
                        <option value="1x40">1x40</option>
                    </select>
                </div>

                <!-- Pullout Date -->
                <div class="mb-4">
                    <label for="editPulloutDate" class="block text-gray-700">Pullout Date</label>
                    <input type="date" id="editPulloutDate" name="pulloutDate"
                        class="border border-gray-300 rounded p-2 w-full" required>
                </div>

                <!-- Container No. -->
                <div class="mb-4">
                    <label for="editContainerNo" class="block text-gray-700">Container No.</label>
                    <input type="text" id="editContainerNo" name="vanNo"
                        class="border border-gray-300 rounded p-2 w-full" required>
                </div>

                <!-- Truck -->
                <div class="mb-3">
                    <label for="editTruck" class="block text-gray-700 font-medium">Truck</label>
                    <select id="editTruck" name="truck_id" class="border border-gray-300 rounded p-2 w-full" required>
                        <option value="" disabled selected>Select a truck</option>
                        @foreach ($trucks as $truck)
                            <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                                {{ $truck->model }}
                            </option>
                        @endforeach
                    </select>
                    @error('truck_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Client -->
                <div class="mb-4">
                    <label for="editClient" class="block text-gray-700 font-medium">Client</label>
                    <select id="editClient" name="client" class="border border-gray-300 rounded p-2 w-full" required>
                        <option value="" disabled selected>Select a client</option>
                        @foreach ($clientNames as $clientName)
                            <option value="{{ $clientName }}" {{ old('client') == $clientName ? 'selected' : '' }}>
                                {{ $clientName }}
                            </option>
                        @endforeach
                    </select>
                    @error('client')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Driver -->
                <div class="mb-4">
                    <label for="editDriver" class="block text-gray-700 font-medium">Assign Driver</label>
                    <select id="editDriver" name="driver" class="border border-gray-300 rounded p-2 w-full" required>
                        <option value="" disabled selected>Select a driver</option>
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver }}" {{ old('driver') == $driver ? 'selected' : '' }}>
                                {{ $driver }}
                            </option>
                        @endforeach
                    </select>
                    @error('driver')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Truck Plate No -->
                <div class="mb-4">
                    <label for="editLicensePlate" class="block text-gray-700 font-medium">Truck Plate No</label>
                    <select id="editLicensePlate" name="licensePlate" class="border border-gray-300 rounded p-2 w-full"
                        required>
                        <option value="" disabled selected>Select a plate number</option>
                        @foreach ($licensePlates as $licensePlate)
                            <option value="{{ $licensePlate }}"
                                {{ old('licensePlate') == $licensePlate ? 'selected' : '' }}>
                                {{ $licensePlate }}
                            </option>
                        @endforeach
                    </select>
                    @error('licensePlate')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cargo Details -->
                <div class="mb-4">
                    <label for="editCargoDetails" class="block text-gray-700">Cargo Details</label>
                    <textarea id="editCargoDetails" name="cargoDetails" class="border border-gray-300 rounded p-2 w-full"></textarea>
                </div>

                <!-- Place of Delivery -->
                <div class="mb-4">
                    <label for="editPlaceOfDelivery" class="block text-gray-700 font-medium">Place of Delivery</label>
                    <select id="editPlaceOfDelivery" name="location"
                        class="border border-gray-300 rounded p-2 w-full">
                        <option value="" disabled selected>Select a place</option>
                        @foreach ($placesOfDelivery as $place)
                            <option value="{{ $place }}" {{ old('location') == $place ? 'selected' : '' }}>
                                {{ $place }}
                            </option>
                        @endforeach
                    </select>
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Return Date -->
                <div class="mb-4">
                    <label for="editReturnDate" class="block text-gray-700">Return Date</label>
                    <input type="date" id="editReturnDate" name="returnDate"
                        class="border border-gray-300 rounded p-2 w-full">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="editStatus" class="block text-gray-700">Status</label>
                    <select id="editStatus" name="status" class="border border-gray-300 rounded p-2 w-full">
                        <option value="pending">Pending</option>
                        <option value="onTheWay">On the Way</option>
                        <option value="delivered">Delivered</option>
                    </select>
                </div>

                <!-- Trucking Fee -->
                <div class="mb-4">
                    <label for="editTruckingFee" class="block text-gray-700">Trucking Fee</label>
                    <input type="text" id="editTruckingFee" name="truckingFee"
                        class="border border-gray-300 rounded p-2 w-full" required>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                    onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>

    <script>
        function openModal() {
            document.getElementById("modal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("modal").classList.add("hidden");
        }

    </script>

    <script>
        function openStatusModal(deliveryId, currentStatus) {
            // Set the delivery ID and current status in the modal
            document.getElementById("deliveryId").value = deliveryId;
            document.getElementById("newStatus").value = currentStatus;

            // Show the modal
            document.getElementById("statusModal").classList.remove("hidden");
        }

        function closeStatusModal() {
            // Hide the modal
            document.getElementById("statusModal").classList.add("hidden");
        }
    </script>

    <script>
        function openEditModal(deliveryId) {
        // Send an AJAX request to fetch delivery data
        // console.log(deliveryId);
        fetch(`/delivery/${deliveryId}/edit`) 
        // here the error ` you skip this symbol
            .then(response => response.json())
            .then(data => {
                // Set the form action dynamically based on deliveryId
                const formAction =` /delivery/${deliveryId}`;
                const form = document.getElementById('editDeliveryForm');
                form.action = formAction; // Dynamically set the form action

                // Populate the modal fields with delivery data
                document.getElementById('editDeliveryId').value = data.id;
                document.getElementById('editDoNumber').value = data.doNo;
                document.getElementById('editDimension').value = data.dimension;
                document.getElementById('editPulloutDate').value = data.pulloutDate;
                document.getElementById('editContainerNo').value = data.vanNo;
                document.getElementById('editTruck').value = data.truckModel;
                document.getElementById('editClient').value = data.client;
                document.getElementById('editDriver').value = data.driver;
                document.getElementById('editLicensePlate').value = data.licensePlate;
                document.getElementById('editCargoDetails').value = data.cargoDetails;
                document.getElementById('editPlaceOfDelivery').value = data.location;
                document.getElementById('editReturnDate').value = data.returnDate;
                document.getElementById('editStatus').value = data.status;
                document.getElementById('editTruckingFee').value = data.truckingFee;

                // Show the modal
                document.getElementById('editModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching delivery data:', error);
            });
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');

    }


        
        function searchTable() {
            var searchTerm = document.getElementById('search').value.toLowerCase();
            var rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                var match = Array.from(row.cells).some(cell => cell.textContent.toLowerCase().includes(searchTerm));
                row.style.display = match ? '' : 'none';
            });
        }


        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

    </script>





</body>

</html>

@endsection