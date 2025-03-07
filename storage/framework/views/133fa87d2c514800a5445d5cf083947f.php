

<?php $__env->startSection('content'); ?>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let trucks = [];
        let selectedTruckIndex = null;

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // function saveTruck(event) {


        function deleteTruck() {
            if (selectedTruckIndex !== null) {
                trucks.splice(selectedTruckIndex, 1);
                renderTable();
                selectedTruckIndex = null;
            }
        }

        function renderTable() {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';
            trucks.forEach((truck, index) => {
                const row = document.createElement('tr');
                row.classList.add('', 'cursor-pointer');
                row.innerHTML = `
                    <td class="py-2 px-4">${truck.truckNo}</td>
                    <td class="py-2 px-4">${truck.truckModel}</td>
                    <td class="py-2 px-4">${truck.plateNo}</td>
                    <td class="py-2 px-4">${truck.expireDate}</td>
                    <td class="py-2 px-4">${truck.renewalDate}</td>
                    <td class="py-2 px-4">${truck.driverName}</td>
                    <td class="py-2 px-4">${truck.status}</td>
                `;
                row.addEventListener('click', () => {
                    selectedTruckIndex = index;
                    document.getElementById('updateTruckNo').value = truck.truckNo;
                    document.getElementById('updateTruckModel').value = truck.truckModel;
                    document.getElementById('updatePlateNo').value = truck.plateNo;
                    document.getElementById('updateExpireDate').value = truck.expireDate;
                    document.getElementById('updateRenewalDate').value = truck.renewalDate;
                    document.getElementById('updateDriverName').value = truck.driverName;
                    document.getElementById('updateStatus').value = truck.status;
                });
                tbody.appendChild(row);
            });
        }
        Function searchTable() {
            // Get the search term and normalize it
            var searchTerm = document.getElementById('search').value.trim().toLowerCase();

            // Select all rows in the table body
            var rows = document.querySelectorAll('table tbody tr');

            // Loop through the rows and check for matches
            rows.forEach(row => {
                // Check if any cell in the row matches the search term
                var match = Array.from(row.cells).some(cell =>
                    cell.textContent.trim().toLowerCase().includes(searchTerm)
                );
                // Show or hide the row based on the match
                row.style.display = match ? '' : 'none';
            });
        }
    </script>
</head>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Truck and Driver Management</h1>
    <div class="flex justify-end mb-4">
        <label for="search" class="mr-2">Search:</label>
        <input type="text" id="search" class="border border-gray-300 p-1" oninput="searchTable()">

    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <div class="overflow-x-auto">

        <table class="min-w-full bg-white" style="width: 100%;">
            <thead>
                <tr class="w-full bg-gray-200 text-left">
                    <th class="py-2 px-4">Truck No.</th>
                    <th class="py-2 px-4">Truck Model</th>
                    <th class="py-2 px-4">Plate No</th>
                    <th class="py-2 px-4">Expire Date</th>
                    <th class="py-2 px-4">Renewal Date</th>
                    <th class="py-2 px-4">Driver Name</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Actions</th> <!-- New Actions Column -->
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $trucks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truck): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="py-2 px-4"><?php echo e($truck->truckNo); ?></td>
                        <td class="py-2 px-4"><?php echo e($truck->model); ?></td>
                        <td class="py-2 px-4"><?php echo e($truck->licensePlate); ?></td>
                        <td class="py-2 px-4"><?php echo e($truck->expireDate); ?></td>
                        <td class="py-2 px-4"><?php echo e($truck->renewalDate); ?></td>
                        <td class="py-2 px-4"><?php echo e($truck->driverName); ?></td>
                        <td class="py-2 px-4"><?php echo e($truck->status); ?></td>
                        <td class="py-2 px-4">
                            <div class="flex justify-center items-center space-x-4">

                                <!-- View Button (in the Actions column) -->
                                <button id="openTruckModalButton-<?php echo e($truck->id); ?>" 
                                            class="btn btn-primary" 
                                            onclick="openViewModal(<?php echo e($truck->id); ?>, <?php echo e(json_encode($truck->deliveries)); ?>)">
                                            <i class="fas fa-eye text-lg"></i>
                                    </button>


                                <!-- Edit Button -->
                                <a href="javascript:void(0);" class="text-blue-500 hover:text-blue-700"
                                    onclick="openEditModal(<?php echo e($truck->id); ?>)">
                                    <i class="fas fa-edit text-lg"></i> <!-- Font Awesome Edit Icon -->
                                </a>

                                <!-- Delete Button -->
                                <form action="<?php echo e(route('trucks.destroy', $truck->id)); ?>" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this truck?');"
                                    style="margin-top:17px;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash-alt text-lg"></i> <!-- Font Awesome Delete Icon -->
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="py-2 px-4 text-center">No trucks found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
    <br><br>
    <div class="mt-4 flex space-x-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">ADD</button>
        <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">UPDATE</button>
        <button class="bg-gray-800 text-white py-2 px-4" onclick="openModal('updateModal')">UPDATE</button>
        <button class="bg-gray-800 text-white py-2 px-4" onclick="deleteTruck()">REMOVE</button> -->
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Truck</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <form onsubmit="saveTruck(event)">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="addTruckNo" class="form-label">Truck No.</label>
                            <input type="text" id="addTruckNo" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="addTruckModel" class="form-label">Truck Model</label>
                            <input type="text" id="addTruckModel" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="addPlateNo" class="form-label">Plate No</label>
                            <input type="text" id="addPlateNo" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="addExpireDate" class="form-label">Expire Date</label>
                            <input type="date" id="addExpireDate" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="addRenewalDate" class="form-label">Renewal Date</label>
                            <input type="date" id="addRenewalDate" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="addDriverName" class="form-label">Driver Name</label>
                            <input type="text" id="addDriverName" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="addStatus" class="form-label">Status</label>
                            <input type="text" id="addStatus" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form> -->
            <form method="POST" action="<?php echo e(route('trucks.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-5 gap-4">
                    <div class="mb-4">
                        <label for="addTruckNo" class="block text-gray-700">Truck No.</label>
                        <input type="text" name="truckNo" id="addTruckNo"
                            class="w-full border border-gray-300 p-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="addTruckModel" class="block text-gray-700">Truck Model</label>
                        <input type="text" name="model" id="addTruckModel"
                            class="w-full border border-gray-300 p-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="addPlateNo" class="block text-gray-700">Plate No</label>
                        <input type="text" name="licensePlate" id="addPlateNo"
                            class="w-full border border-gray-300 p-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="addExpireDate" class="block text-gray-700">Expire Date</label>
                        <input type="date" name="expireDate" id="addExpireDate"
                            class="w-full border border-gray-300 p-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="addRenewalDate" class="block text-gray-700">Renewal Date</label>
                        <input type="date" name="renewalDate" id="addRenewalDate"
                            class="w-full border border-gray-300 p-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="addDriverName" class="block text-gray-700">Driver Name</label>
                        <input type="text" name="driverName" id="addDriverName"
                            class="w-full border border-gray-300 p-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="addStatus" class="block text-gray-700">Status</label>
                        <input type="text" name="status" id="addStatus"
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

<!-- Update Modal -->
<div id="updateModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white p-8 rounded-lg max-w-lg w-full">
        <h2 class="text-xl font-bold mb-4">Edit Truck Details</h2>
        <form id="updateTruckForm" action="" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <input type="hidden" id="truckId" name="truck_id" value="">

            <!-- Truck Number -->
            <div class="mb-4">
                <label for="updateTruckNo" class="block text-gray-700">Truck No.</label>
                <input type="text" id="updateTruckNo" name="truck_no" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Truck Model -->
            <div class="mb-4">
                <label for="updateTruckModel" class="block text-gray-700">Truck Model</label>
                <input type="text" id="updateTruckModel" name="truck_model"
                    class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Plate No -->
            <div class="mb-4">
                <label for="updatePlateNo" class="block text-gray-700">Plate No</label>
                <input type="text" id="updatePlateNo" name="plate_no" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Expiry Date -->
            <div class="mb-4">
                <label for="updateExpireDate" class="block text-gray-700">Expire Date</label>
                <input type="date" id="updateExpireDate" name="expire_date"
                    class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Renewal Date -->
            <div class="mb-4">
                <label for="updateRenewalDate" class="block text-gray-700">Renewal Date</label>
                <input type="date" id="updateRenewalDate" name="renewal_date"
                    class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Driver Name -->
            <div class="mb-4">
                <label for="updateDriverName" class="block text-gray-700">Driver Name</label>
                <input type="text" id="updateDriverName" name="driver_name"
                    class="w-full border border-gray-300 p-2 rounded">
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="updateStatus" class="block text-gray-700">Status</label>
                <input type="text" id="updateStatus" name="status" class="w-full border border-gray-300 p-2 rounded">
            </div>

            <div class="flex justify-end">
                <button type="button" class="bg-gray-700 text-white py-2 px-4 mr-2"
                    onclick="closeModal('updateModal')">Cancel</button>
                <button type="submit" class="bg-gray-700 text-white py-2 px-4">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- View Truck Modal -->
<div class="modal fade" id="viewTruckModal" tabindex="-1" aria-labelledby="viewTruckModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"  style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTruckModalLabel">Truck Delivery History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Truck: <span id="viewTruckNo"></span></h5>

                <!-- Delivery History Table -->
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            
                            <th>Dimension</th>
                            <th>Pullout Date</th>
                            <th>Container No</th>
                            <th>Client</th>
                            <th>Driver</th>
                            <th>Cargo Details</th>
                            <th>Location</th>
                            <th>Return Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="deliveryHistoryTable">
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="path/to/your/js/trucks-view.js" defer></script>



<!-- <script>
    // Function to open the modal and fetch truck data
    function openEditModal(truckId) {
        // Send an AJAX request to fetch truck data
        fetch(`/trucks/${truckId}/edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // Log the fetched data to the console
            // Populate the modal with truck data
            document.getElementById('truckId').value = data.id;
            document.getElementById('updateTruckNo').value = data.truckNo;
            document.getElementById('updateTruckModel').value = data.model;
            document.getElementById('updatePlateNo').value = data.licensePlate;
            document.getElementById('updateExpireDate').value = data.expireDate;
            document.getElementById('updateRenewalDate').value = data.renewalDate;
            document.getElementById('updateDriverName').value = data.driverName;
            document.getElementById('updateStatus').value = data.status;

            // Show the modal
            document.getElementById('updateModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error fetching truck data:', error);
        });
    }
    // Function to close the modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script> -->

<script>

function openViewModal(truckId, deliveries) {
    // Set the Truck Number or ID (optional)
    document.getElementById('viewTruckNo').textContent = truckId;

    // Clear any existing rows in the delivery history table
    const deliveryHistoryTable = document.getElementById('deliveryHistoryTable');
    deliveryHistoryTable.innerHTML = ''; // Clear any existing rows

    // Loop through deliveries and populate the table
    deliveries.forEach(delivery => {
        const row = `
            <tr>
              
                <td>${delivery.dimension || 'N/A'}</td>
                <td>${delivery.pulloutDate || 'N/A'}</td>
                <td>${delivery.vanNo || 'N/A'}</td>
                <td>${delivery.client || 'N/A'}</td>
                <td>${delivery.driver || 'N/A'}</td>
                <td>${delivery.cargoDetails || 'N/A'}</td>
                <td>${delivery.location || 'N/A'}</td>
                <td>${delivery.returnDate || 'N/A'}</td>
                <td>${delivery.status || 'N/A'}</td>
            </tr>
        `;
        deliveryHistoryTable.innerHTML += row;
    });

    // Show the modal using Bootstrap
    const modal = new bootstrap.Modal(document.getElementById('viewTruckModal'));
    modal.show();
}



// Ensuring the DOM is fully loaded before attaching event listeners
document.addEventListener('DOMContentLoaded', function () {
    // Ensure the button exists before adding the event listener
    const button = document.getElementById('openTruckModalButton');
    if (button) {
        button.addEventListener('click', function () {
            // You can pass a truckId dynamically here, for example:
            openViewModal(); // Example truckId
        });
    } else {
        console.error('Button with ID "openTruckModalButton" not found!');
    }
});




    function openEditModal(truckId) {
        // Send an AJAX request to fetch truck data
        fetch(`/trucks/${truckId}/edit`)
            .then(response => response.json())
            .then(data => {
                // Format the dates to YYYY-MM-DD
                const formatDate = (dateStr) => {
                    const date = new Date(dateStr);
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0');  // Month is 0-indexed
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                };

                // Set the action URL dynamically
                const formAction = `/trucks/${truckId}`;
                document.getElementById('updateTruckForm').action = formAction;

                // Populate the modal fields with truck data
                document.getElementById('truckId').value = data.id;
                document.getElementById('updateTruckNo').value = data.truckNo;
                document.getElementById('updateTruckModel').value = data.model;
                document.getElementById('updatePlateNo').value = data.licensePlate;

                // Format the dates before inserting them into the inputs
                document.getElementById('updateExpireDate').value = formatDate(data.expireDate);
                document.getElementById('updateRenewalDate').value = formatDate(data.renewalDate);

                document.getElementById('updateDriverName').value = data.driverName;
                document.getElementById('updateStatus').value = data.status;

                // Show the modal
                document.getElementById('updateModal').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching truck data:', error);
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Desktop\TruckingMS\tms\resources\views/truckNdriver.blade.php ENDPATH**/ ?>