@extends('admin')

@section('content')

<head>

    <head>
        <script src="https://cdn.tailwindcss.com"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <script>
        let clients = [];
        let selectedClientIndex = null;

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        function deleteClient() {
            if (selectedClientIndex !== null) {
                trucks.splice(selectedClientIndex, 1);
                renderTable();
                selectedClientIndex = null;
            }
        }

        function renderTable() {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';
            trucks.forEach((client, index) => {
                const row = document.createElement('tr');
                row.classList.add('', 'cursor-pointer');
                row.innerHTML = `
                    <td class="py-2 px-4">${client.clientNo}</td>
                    <td class="py-2 px-4">${client.clientName}</td>
                    <td class="py-2 px-4">${client.placeOfDelivery}</td>
                    <td class="py-2 px-4">${client.contact}</td>
                `;
                row.addEventListener('click', () => {
                    selectedClientIndex = index;
                    document.getElementById('updateClientNo').value = client.clientNo;
                    document.getElementById('updateClientName').value = client.clientName;
                    document.getElementById('updatePlaceOfDelivery').value = client.placeOfDelivery;
                    document.getElementById('updateContact').value = client.contact;
                });
                tbody.appendChild(row);
            });
        }
    </script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Client Management</h1>
        <div class="flex justify-end mb-4">
            <label for="search" class="mr-2">Search:</label>
            <input type="text" id="search" class="border border-gray-300 p-1" oninput="searchTable()">

        </div>
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="w-full bg-gray-200 text-left">
                        <th class="py-2 px-4">Client No.</th>
                        <th class="py-2 px-4">Client Name</th>
                        <th class="py-2 px-4">Place of Delivery</th>
                        <th class="py-2 px-4">Contact</th>
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                        <tr>
                            <td class="py-2 px-4">{{ $client->clientNo }}</td>
                            <td class="py-2 px-4">{{ $client->clientName }}</td>
                            <td class="py-2 px-4">{{ $client->placeOfDelivery }}</td>
                            <td class="py-2 px-4">{{ $client->contact }}</td>
                            <td class="py-2 px-4">
                                <div class="flex justify-center items-center space-x-4">

                                    <!-- View Button (in the Actions column) -->
                                    <button id="openClientModalButton-{{ $client->id }}" class="btn btn-primary"
                                        onclick="openClientViewModal({{ $client->id }}, {{ json_encode($client->deliveries) }})">
                                        <i class="fas fa-eye text-lg"></i>
                                    </button>



                                    <!-- Edit Button -->
                                    <a href="javascript:void(0);" class="text-blue-500 hover:text-blue-700"
                                        onclick="openEditModal({{ $client->id }})">
                                        <i class="fas fa-edit text-lg"></i> <!-- Font Awesome Edit Icon -->
                                    </a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this truck?');"
                                        style="margin-top:17px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash-alt text-lg"></i> <!-- Font Awesome Delete Icon -->
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-2 px-4 text-center">No clients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <!--      <table class="w-full bg-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Client No</th>
                    <th class="py-2 px-4 border-b">Client Name</th>
                    <th class="py-2 px-4 border-b">Place of Delivery</th>
                    <th class="py-2 px-4 border-b">Contact</th>
                </tr>
            </thead>
            <tbody id="clientTable">
                Add rows here as needed 
            </tbody>
        </table>-->
    </div>
    <br><br>
    <div class="mt-4 flex space-x-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">ADD</button>
    </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf
                    <div class="grid grid-cols-5 gap-4">
                        <div class="mb-4">
                            <label for="addClientNo" class="block text-gray-700">Client No.</label>
                            <input type="text" name="clientNo" id="addClientNo"
                                class="w-full border border-gray-300 p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="addClientName" class="block text-gray-700">Client Name</label>
                            <input type="text" name="clientName" id="addClientName"
                                class="w-full border border-gray-300 p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="addPlaceOfDelivery" class="block text-gray-700">Place of Delivery</label>
                            <input type="text" name="placeOfDelivery" id="addPlaceOfDelivery"
                                class="w-full border border-gray-300 p-2 rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="addContact" class="block text-gray-700">Contact</label>
                            <input type="text" name="contact" id="addContact"
                                class="w-full border border-gray-300 p-2 rounded" required>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-gray-700 text-white py-2 px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <!--   <div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Add Client</h2>
            <form id="addForm">
                <div class="mb-4">
                    <label for="addClientNo" class="block text-gray-700">Client No</label>
                    <input type="text" id="addClientNo" class="border border-gray-300 p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="addClientName" class="block text-gray-700">Name</label>
                    <input type="text" id="addClientName" class="border border-gray-300 p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="addPlaceOfDelivery" class="block text-gray-700">Place Of Delivery</label>
                    <input type="text" id="addPlaceOfDelivery" class="border border-gray-300 p-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="addClientContact" class="block text-gray-700">Contact</label>
                    <input type="text" id="addClientContact" class="border border-gray-300 p-2 w-full">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-700 text-white py-2 px-4 mr-2" onclick="closeAddModal()">Cancel</button>
                    <button type="button" class="bg-gray-700 text-white py-2 px-4" onclick="saveClient()">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Modal -->

    <div id="updateModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-lg max-w-lg w-full">
            <h2 class="text-xl font-bold mb-4">Edit Client Details</h2>
            <form id="updateClientForm" action="" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="clientId" name="client_id" value="">
                <div class="mb-4">
                    <label for="updateClientNo" class="block text-gray-700">Client No.</label>
                    <input type="text" id="updateClientNo" name="client_no"
                        class="w-full border border-gray-300 p-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="updateClientName" class="block text-gray-700">Client Name</label>
                    <input type="text" id="updateClientName" name="client_name"
                        class="w-full border border-gray-300 p-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="updatePlaceOfDelivery" class="block text-gray-700">Place Of Delivery</label>
                    <input type="text" id="updatePlaceOfDelivery" name="place_of_delivery"
                        class="w-full border border-gray-300 p-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="updateContact" class="block text-gray-700">Contact</label>
                    <input type="text" id="updateContact" name="contact"
                        class="w-full border border-gray-300 p-2 rounded">
                </div>

                <div class="flex justify-end">
                    <button type="button" class="bg-gray-700 text-white py-2 px-4 mr-2"
                        onclick="closeModal('updateModal')">Cancel</button>
                    <button type="submit" class="bg-gray-700 text-white py-2 px-4">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Client Delivery History Modal -->
<div class="modal fade" id="viewClientModal" tabindex="-1" aria-labelledby="viewClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewClientModalLabel">Client Delivery History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Client: <span id="viewClientName"></span></h5>

                <!-- Delivery History Table -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Dimension</th>
                            <th>Delivery Date</th>
                            <th>Container No</th>
                            <th>Driver</th>
                            <th>Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="clientDeliveryHistoryTable">
                        <!-- Populated by JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <script>

function openClientViewModal(clientId, deliveries) {
    // Set the Client Name or ID
    document.getElementById('viewClientName').textContent = clientId;

    // Clear any existing rows in the delivery history table
    const deliveryHistoryTable = document.getElementById('clientDeliveryHistoryTable');
    deliveryHistoryTable.innerHTML = ''; // Clear existing rows

    // Loop through deliveries and populate the table
    deliveries.forEach(delivery => {
        const row = `
            <tr>
                <td>${delivery.dimension || 'N/A'}</td>
                <td>${delivery.pulloutDate || 'N/A'}</td>
                <td>${delivery.vanNo || 'N/A'}</td>
                
                <td>${delivery.driver || 'N/A'}</td>
                <td>${delivery.location || 'N/A'}</td>
                <td>${delivery.status || 'N/A'}</td>
            </tr>
        `;
        deliveryHistoryTable.innerHTML += row;
    });

    // Show the modal using Bootstrap
    const modal = new bootstrap.Modal(document.getElementById('viewClientModal'));
    modal.show();
    //console.log('Deliveries:', deliveries);

    document.addEventListener('DOMContentLoaded', function () {
    // Ensure the button exists before adding the event listener
    const button = document.getElementById('openClientModalButton');
    if (button) {
        button.addEventListener('click', function () {
            // You can pass a truckId dynamically here, for example:
            openViewModal(); // Example truckId
        });
    } else {
        console.error('Button with ID "openModalButton" not found!');
    }
});

}

        function openEditModal(clientId) {
            // Send an AJAX request to fetch truck data
            fetch(`/clients/${clientId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Set the action URL dynamically
                    const formAction = `/clients/${clientId}`;
                    document.getElementById('updateClientForm').action = formAction;

                    // Populate the modal fields with truck data
                    document.getElementById('clientId').value = data.id;
                    document.getElementById('updateClientNo').value = data.clientNo;
                    document.getElementById('updateClientName').value = data.clientName;
                    document.getElementById('updatePlaceOfDelivery').value = data.placeOfDelivery;
                    document.getElementById('updateContact').value = data.contact;

                    // Show the modal
                    document.getElementById('updateModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching client data:', error);
                });

        }

        function searchTable() {
            var searchTerm = document.getElementById('search').value.toLowerCase();
            var rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                var match = Array.from(row.cells).some(cell => cell.textContent.toLowerCase().includes(searchTerm));
                row.style.display = match ? '' : 'none';
            });
        }



        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

    </script>
</body>

</html>
@endsection