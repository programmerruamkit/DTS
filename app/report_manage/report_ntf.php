<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='รายงานการแจ้งเตือน.html';
    $_SESSION['DROPDOWN']='9';
    $_SESSION['DROPDOWN_ID']='11';
?>
<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;  /* ✅ ใช้ bottom แทน height: 100% เพื่อให้ครอบคลุมจริง ๆ */
        background: rgba(0, 0, 0, 0.6);
        display: none;
        z-index: 999; /* ให้ Overlay อยู่ข้างหลัง Modal */
    }

    
    .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* background: red; */
        width: 20%;
        /* padding: 20px; */
        /* border-radius: 8px; */
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); */
        display: none;
        z-index: 1000;
    }
</style>
<body class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
<div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
    <div class="app-menu w-vertical-menu bg-vertical-menu ltr:border-r rtl:border-l border-vertical-menu-border fixed bottom-0 top-0 z-[1003] transition-all duration-75 ease-linear group-data-[sidebar-size=md]:w-vertical-menu-md group-data-[sidebar-size=sm]:w-vertical-menu-sm group-data-[sidebar-size=sm]:pt-header group-data-[sidebar=dark]:bg-vertical-menu-dark group-data-[sidebar=dark]:border-vertical-menu-dark group-data-[sidebar=brand]:bg-vertical-menu-brand group-data-[sidebar=brand]:border-vertical-menu-brand group-data-[sidebar=modern]:bg-gradient-to-tr group-data-[sidebar=modern]:to-vertical-menu-to-modern group-data-[sidebar=modern]:from-vertical-menu-form-modern group-data-[layout=horizontal]:w-full group-data-[layout=horizontal]:bottom-auto group-data-[layout=horizontal]:top-header hidden md:block print:hidden group-data-[sidebar-size=sm]:absolute group-data-[sidebar=modern]:border-vertical-menu-border-modern group-data-[layout=horizontal]:dark:bg-zink-700 group-data-[layout=horizontal]:border-t group-data-[layout=horizontal]:dark:border-zink-500 group-data-[layout=horizontal]:border-r-0 group-data-[sidebar=dark]:dark:bg-zink-700 group-data-[sidebar=dark]:dark:border-zink-600 group-data-[layout=horizontal]:group-data-[navbar=scroll]:absolute group-data-[layout=horizontal]:group-data-[navbar=bordered]:top-[calc(theme('spacing.header')_+_theme('spacing.4'))] group-data-[layout=horizontal]:group-data-[navbar=bordered]:inset-x-4 group-data-[layout=horizontal]:group-data-[navbar=hidden]:top-0 group-data-[layout=horizontal]:group-data-[navbar=hidden]:h-16 group-data-[layout=horizontal]:group-data-[navbar=bordered]:w-[calc(100%_-_2rem)] group-data-[layout=horizontal]:group-data-[navbar=bordered]:[&.sticky]:top-header group-data-[layout=horizontal]:group-data-[navbar=bordered]:rounded-b-md group-data-[layout=horizontal]:shadow-md group-data-[layout=horizontal]:shadow-slate-500/10 group-data-[layout=horizontal]:dark:shadow-zink-500/10 group-data-[layout=horizontal]:opacity-0">
        <?php require_once($path.'include/sidebar.php'); ?>
    </div>
    <?php require_once($path.'include/navbar.php'); ?>
    <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
        <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
            <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
                <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                    <div class="grow">
                        <div class="flex flex-wrap justify-left gap-2">
                            <div class="flex items-center gap-2">
                                <h5 class="text-16">รายงานการแจ้งเตือน</h5>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <table id="report_monthly" class="table-reportmonthly bordered group">
                                <thead>
                                    <tr>
                                        <th width="5%">ลำดับ.</th>
                                        <th width="20%">ประเภทการแจ้งเตือน</th>
                                        <th width="20%">ช่องทาง</th>
                                        <th width="20%">พิมพ์</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" id="area" value="<?php echo $_SESSION["AD_AREA"]; ?>">
                <!-- Close Section ############################################################## -->
            </div>
        </div>
    <?php require_once($path.'include/footer.php'); ?>
    </div>
</div>
<!-- Overlay -->
<div id="overlay" class="overlay" onclick="closeModal_report_ntf()"></div>
<!-- Modal -->
<div id="monthYearModal" class="modal fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b dark:border-zink-300/20">
            <h5 class="text-16">รายงานการแจ้งเตือน "<span id='comcode1'></span>"</h5>
            <button aria-label="button" onclick="closeModal_report_ntf()" data-modal-close="billingModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <form id="monthYearForm">
                <h5 class="text-16">เลือกช่วงเดือนและปี</h5>
                <div class="mb-4">
                    <label for="month" class="block text-sm font-medium">เดือน</label>
                    <select id="month" class="w-full border rounded p-2">
                        <?php
                        $currentMonth = date("n"); 
                        $months = array(
                            1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน',
                            5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม',
                            9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'
                        );
                        foreach ($months as $key => $value) {
                            $selected = ($key == $currentMonth) ? 'selected' : ''; 
                            echo "<option value=\"$key\" $selected>$value</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="year" class="block text-sm font-medium">ปี</label>
                    <select id="year" class="w-full border rounded p-2">
                        <!-- ตัวเลือกปีจะถูกสร้างโดย JavaScript -->
                    </select>
                </div>
                <input type="text" id="comcode" name="comcode" class="hidden" value="">
                <input type="hidden" id="fileType" name="fileType" value="">
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal_report_ntf()" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">ยกเลิก</button>
                    <button type="button" onclick="sendModal_report_ntf()" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once($path.'include/settingtheme.php'); ?>
<?php require_once($path.'include/script.php'); ?>
<script src="assets/js/app.js"></script>
<script src="assets/js/datatables/data-tables.min.js"></script>
<script src="assets/js/datatables/data-tables.tailwindcss.min.js"></script>
<script src="assets/js/datatables/datatables.buttons.min.js"></script>
<!-- <script src="assets/js/datatables/jszip.min.js"></script> -->
<!-- <script src="assets/js/datatables/pdfmake.min.js"></script> -->
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<!-- <script src="assets/js/datatables/buttons.print.min.js"></script> -->
<script src="assets/js/datatables/datatables.init.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#report_monthly').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            autoWidth: false,
            lengthChange: true,
            pageLength: 10,
            columnDefs: [
                { targets: [0], orderable: false },
                { targets: [3], orderable: false },
            ]
        });
        $('.table-reportmonthly tbody').empty();
        $('.table-reportmonthly tbody').append('<tr><td colspan="5" align="center" class="p-6 text-xl"><font size="4">กำลังโหลดข้อมูล...</font></td></tr>');
        function fetch_reportmonthly() {
            var area = $('#area').val();
            $.ajax({
                url: 'api/report/api.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    proc: 'report_ntf',
                    a1: area
                },
                success: function(data) {
                    if (data.length === 0) {
                        table.clear();
                        table.draw();
                    } else {
                        table.clear();
                        data.forEach(function(item, index) {
                            var rowNumber = index + 1;
                            var rowcolor = (rowNumber % 2 === 0) ? 'bg-slate-50' : 'bg-white';
                        
                            var ntfGroupText = '';
                            if (item.NTF_GROUP === "Paid") {
                                ntfGroupText = "ชำระเงินเสร็จสิ้น";
                            } else if (item.NTF_GROUP === "Pending") {
                                ntfGroupText = "รอการชำระเงิน";
                            } else if (item.NTF_GROUP === "Overdue") {
                                ntfGroupText = "เกินกำหนดชำระ";
                            } else if (item.NTF_GROUP === "Cancelled") {
                                ntfGroupText = "ยกเลิก";
                            } else if (item.NTF_GROUP === "Payment") {
                                ntfGroupText = "แจ้งเตือนชำระเงิน";
                            } else {
                                ntfGroupText = item.NTF_GROUP;
                            }
                        
                            table.row.add([
                                '<div class="text-center">' + rowNumber + '</div>',
                                '<div class="text-left">' + ntfGroupText + '</div>', 
                                '<div class="text-left">' + item.NTF_TYPE + '</div>',
                                '<div class="flex justify-center gap-2">' +
                                    '<button aria-label="button" onclick="openModal_report_ntf(\'' + item.NTF_GROUP + '\',\'' + ntfGroupText + '\', \'EXCEL\')" class="text-green-500 bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:ring active:ring-green-100 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">' +
                                        'EXCEL' +
                                    '</button>' +
                                    '<button aria-label="button" onclick="openModal_report_ntf(\'' + item.NTF_GROUP + '\',\'' + ntfGroupText + '\', \'PDF\')" class="text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">' +
                                        'PDF' +
                                    '</button>' +
                                '</div>'
                            ]).draw();
                        
                            var row = table.row(index).node();
                            $(row).addClass(rowcolor);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        }
        fetch_reportmonthly();
    });
    
    document.addEventListener("DOMContentLoaded", function () {
        const currentYear = new Date().getFullYear(); 
        const yearSelect = document.getElementById("year");
    
        const years = [
            currentYear - 2,
            currentYear - 1,
            currentYear,    
            currentYear + 1,
            currentYear + 2 
        ];
    
        years.forEach(year => {
            const option = document.createElement("option");
            option.value = year;
            option.textContent = year + 543; 
            yearSelect.appendChild(option);
        });
    
        yearSelect.value = currentYear;
    });
</script>
</body>
</html>