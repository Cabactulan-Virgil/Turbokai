

<?php $__env->startSection('content'); ?>
<html>
<head>
    
    <!-- Flatpickr CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Reports</h1>
        <div class="flex items-center space-x-4 mb-4">
            <button class="tab text-black" onclick="openTab(event, 'DeliveryReport')">Delivery Report</button>
            <button class="tab text-black" onclick="openTab(event, 'ClientHistory')">Client History</button>
             <button class="tab text-black" onclick="openTab(event, 'TruckDriverHistory')">Trucks Transaction History</button>
            <div class="flex items-center ml-auto">
                <label for="search" class="mr-2">Search:</label>
                <input type="text" id="search" class="border border-gray-300 rounded p-1" placeholder="Search" onkeyup="searchTable()">
                <button class="ml-2" title="Search Table">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="flex items-center space-x-2 border border-gray-800 p-2">
                <i class="fas fa-calendar-alt text-black"></i>
                <span id="dateRange" class="text-black cursor-pointer">Select Date Range</span>
                <input type="text" id="startDate" class="hidden">
                <input type="text" id="endDate" class="hidden">
            </div>
        </div>
        <hr class="border-gray-300">

        <!-- Delivery Report Tab Content -->
        <div id="DeliveryReport" class="tabcontent hidden printSection">
            <div class="container mx-auto">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200" id="deliveryTable">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-400">
                                <th class="px-4 py-2 text-left">PullOut Date</th>
                                <th class="px-4 py-2 text-left">Dimension</th>
                                <th class="px-4 py-2 text-left">Container No.</th>
                                <th class="px-4 py-2 text-left">Assigned Driver</th>
                                <th class="px-4 py-2 text-left">Truck Plate No</th>
                                <th class="px-4 py-2 text-left">Place of Delivery</th>
                                <th class="px-4 py-2 text-left">Cargo Details</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Return Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-4 py-2" data-pullout="<?php echo e($delivery->pulloutDate); ?>"><?php echo e($delivery->pulloutDate); ?></td>
                                    <td class="px-4 py-2"><?php echo e($delivery->dimension); ?></td>
                                    <td class="px-4 py-2"><?php echo e($delivery->vanNo); ?></td>
                                    <td class="px-4 py-2"><?php echo e($delivery->driver); ?></td>
                                    <td class="px-4 py-2"><?php echo e($delivery->licensePlate); ?></td>
                                    <td class="px-4 py-2"><?php echo e($delivery->location); ?></td>
                                    <td class="px-4 py-2"><?php echo e($delivery->cargoDetails); ?></td>
                                    <td class="px-4 py-2"><?php echo e($delivery->status); ?></td>
                                    <td class="px-4 py-2" data-return="<?php echo e($delivery->returnDate); ?>"><?php echo e($delivery->returnDate); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="ClientHistory" class="tabcontent hidden printSection">
    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-400">
                        <th class="px-4 py-2 text-left">Client</th>
                        <th class="px-4 py-2 text-left">Pullout Date</th>
                        <th class="px-4 py-2 text-left">Container No.</th>
                        <th class="px-4 py-2 text-left">Dimension</th>
                        <th class="px-4 py-2 text-left">Cargo Details</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Trucking Fee</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalFee = 0;
                    ?>

                    
                    <?php $__currentLoopData = $groupedDeliveriesByClient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client => $deliveries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <tr>
                            <td colspan="7" class="px-4 py-2 font-bold"><?php echo e($client); ?></td>
                        </tr>

                        
                        <?php $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-4 py-2"></td> <!-- Empty cell for client name -->
                                <td class="px-4 py-2"><?php echo e($delivery->pulloutDate); ?></td>
                                <td class="px-4 py-2"><?php echo e($delivery->vanNo); ?></td>
                                <td class="px-4 py-2"><?php echo e($delivery->dimension); ?></td>
                                <td class="px-4 py-2"><?php echo e($delivery->cargoDetails); ?></td>
                                <td class="px-4 py-2"><?php echo e($delivery->status); ?></td>
                                <td class="px-4 py-2"><?php echo e(number_format($delivery->truckingFee, 2)); ?></td>
                            </tr>
                            <?php
                                $totalFee += $delivery ->truckingFee; // Accumulate total trucking fee
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="px-4 py-2 font-bold text-right">Total Fee:</td>
                        <td class="px-4 py-2 font-bold"><?php echo e(number_format($totalFee, 2)); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div id="TruckDriverHistory" class="tabcontent hidden printSection">
    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200" id="deliveryTable">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-400">
                        <th class="px-4 py-2 text-left">Truck Plate No.</th>
                        <th class="px-4 py-2 text-left">Assigned Driver</th>
                        <th class="px-4 py-2 text-left">PullOut Date</th>
                        <th class="px-4 py-2 text-left">Container No.</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $groupedDeliveriesByLicensePlate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $licensePlate => $deliveries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="bg-gray-200">
                            <td colspan="5" class="px-4 py-2 font-bold"><?php echo e($licensePlate); ?></td>
                        </tr>
                        <?php $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-4 py-2"></td> <!-- Empty cell for grouping -->
                                <td class="px-4 py-2"><?php echo e($delivery->driver); ?></td>
                                <td class="px-4 py-2" data-pullout="<?php echo e($delivery->pulloutDate); ?>"><?php echo e($delivery->pulloutDate); ?></td>
                                <td class="px-4 py-2"><?php echo e($delivery->vanNo); ?></td>
                                <td class="px-4 py-2"><?php echo e($delivery->status); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            // Tab switching logic
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

            // Print the active tab
            function printTab() {
        // Identify the active tab
        var activeTab = document.querySelector(".tabcontent:not(.hidden)");
        var tabName = activeTab.id === "DeliveryReport" ? "Delivery Report" : "Client Report";

        // Create the print window and set up its content
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Report</title>');
        printWindow.document.write('<style>body { font-family: Arial, sans-serif; margin: 20px; }');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-top: 20px; }');
        printWindow.document.write('th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }');
        printWindow.document.write('h1 { text-align: center; font-size: 24px; margin-bottom: 20px; }</style></head><body>');

        // Add the label and active tab content
        printWindow.document.write('<h1>' + tabName + '</h1>');
        printWindow.document.write(activeTab.innerHTML);

        // Close the document and trigger the print dialog
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

            // Filter table rows by search
            function searchTable() {
    var searchTerm = document.getElementById('search').value.toLowerCase();
    var rows = document.querySelectorAll('table tbody tr');
    rows.forEach(row => {
        var match = Array.from(row.cells).some(cell => cell.textContent.toLowerCase().includes(searchTerm));
        row.style.display = match ? '' : 'none';
    });

    // Recalculate the total after filtering the rows
    calculateTotal();
}

            // Initialize date picker
            flatpickr("#dateRange", {
                mode: "range",
                onChange: function(selectedDates) {
                    if (selectedDates.length === 2) {
                        filterByDate(selectedDates[0], selectedDates[1]);
                    }
                }
            });

            // Filter rows by date range
            function filterByDate(startDate, endDate) {
                var rows = document.querySelectorAll('#deliveryTable tbody tr');
                rows.forEach(row => {
                    var pullOutDate = new Date(row.cells[0].textContent);
                    var returnDate = new Date(row.cells[7].textContent);
                    row.style.display = (pullOutDate >= startDate && returnDate <= endDate) ? '' : 'none';
                });
            }
            function calculateTotal() {
    const rows = document.querySelectorAll('#ClientHistory table tbody tr');
    let total = 0;
    rows.forEach(row => {
        if (row.style.display !== 'none') { // Only calculate for visible rows
            const fee = parseFloat(row.cells[6].textContent.replace(/[^0-9.-]+/g, "")) || 0;
            total += fee;
        }
    });
    // Format the total with commas and update the display
    document.querySelector('#ClientHistory .totalFee').textContent = `₱${total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
}

        </script>

        <br><br>
        <button onclick="printTab()" class="bg-gray-800 text-white px-4 py-2 rounded">Print Report</button>
    </div>
</body>
</html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Desktop\TruckingMS\tms\resources\views/reports.blade.php ENDPATH**/ ?>