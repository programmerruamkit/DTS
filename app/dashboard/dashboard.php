<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='ภาพรวม.html';
    $_SESSION['DROPDOWN']='null';

?>
<style>
    /* Overlay */
    #modal-overlay {
        background-color: rgba(0, 0, 0, 0.5); /* สีดำโปร่งแสง */
        z-index: 40; /* อยู่ด้านล่าง modal */
    }

    /* Modal */
    #modal {
        z-index: 50; /* อยู่ด้านบน overlay */
    }
    #modal-table {
        border-collapse: collapse;
        width: 100%;
    }

    #modal-table th,
    #modal-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    #modal-table thead {
        background-color: #f9f9f9;
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
                        <h5 class="text-16">ภาพรวม ประจำวันที่ <?php echo thai_date_dmy(time())?> <font color="red" size="2">***โหลดข้อมูลใหม่ทุก ๆ 5 นาที</font></h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                        <div class="col-span-12 card 2xl:col-span-12">
                            <div class="card-body">
                                <div class="xl:col-span-6">                                    
                                    <ul class="flex flex-wrap w-full gap-2 text-sm font-medium text-center filter-btns grow" data-filter-target="notes-list">
                                        <li>
                                            <a href="javascript:void(0);" data-filter="All" class="active inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zink-200 border border-transparent [&.active]:bg-custom-500 dar:[&.active]:bg-custom-500 [&.active]:text-white dark:[&.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                                ทั้งหมด
                                            </a>
                                        </li>
                                        <?php 
                                            $SESSION_AREA = $_SESSION["AD_AREA"];
                                            if($SESSION_AREA == 'AMT'){
                                                $wh = 'AMATA';
                                            }else{
                                                $wh = 'GATEWAY';
                                            }
                                            $query_company = $conn->prepare("SELECT COMPANYCODE,THAINAME FROM COMPANY WHERE COMPANY_STATUS='1' AND AREA = '$wh' ORDER BY COMPANYCODE ASC");
                                            $query_company->execute();
                                            while($rs_company = $query_company->fetch( PDO::FETCH_OBJ )) { 
                                        ?>
                                            <li>
                                                <a href="javascript:void(0);" data-filter="<?php echo $rs_company->COMPANYCODE ?>" class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zink-200 border border-transparent [&.active]:bg-custom-500 dar:[&.active]:bg-custom-500 [&.active]:text-white dark:[&.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                                    <?php echo $rs_company->COMPANYCODE ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <input type="text" name="" id="inputfiltercom" hidden>
                                <div class="flex items-center justify-center py-5 first:pt-0 md:first:pt-5 md:last:pb-5 last:pb-0 md:px-5 md:ltr:first:pl-0 md:rtl:first:pr-0 md:ltr:last:pr-0 md:rtl:last:pl-0">
                                    <div class="flex mb-4">
                                        <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                                            <div class="col-span-12 md:col-span-12 lg:col-span-12 2xl:col-span-12">
                                            </div>   
                                            <a onclick="openModalDashboard('จำนวนเงินทั้งหมด','All')" class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4 bg-sky-100 dark:bg-sky-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-sky-500/20 relative overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-lg block transition card hover:shadow-lg hover:-translate-y-1" href="javascript:void(0);">
                                                <div class="card-body">
                                                    <i data-lucide="kanban" class="absolute top-0 stroke-1 size-32 text-sky-200/50 dark:text-sky-500/20 ltr:-right-10 rtl:-left-10"></i>
                                                    <div class="flex items-center justify-center rounded-md size-12 bg-sky-500 text-15 text-sky-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-dollar-sign-icon lucide-badge-dollar-sign"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
                                                    </div>
                                                    <h5 class="mt-5 mb-2"><span class="counter-value" data-target="TOTALAMOUNT">0</span></h5>
                                                    <p class="text-slate-500 dark:text-slate-200">จำนวนเงินทั้งหมด</p>
                                                </div>
                                            </a>  
                                            <a onclick="openModalDashboard('ชำระแล้ว','PD')" class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4 bg-green-100 dark:bg-green-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-green-500/20 relative overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-lg block transition card hover:shadow-lg hover:-translate-y-1" href="javascript:void(0);">
                                                <div class="card-body">
                                                    <i data-lucide="kanban" class="absolute top-0 stroke-1 size-32 text-green-200/50 dark:text-green-500/20 ltr:-right-10 rtl:-left-10"></i>
                                                    <div class="flex items-center justify-center rounded-md size-12 bg-green-500 text-15 text-green-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-dollar-sign-icon lucide-badge-dollar-sign"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
                                                    </div>
                                                    <h5 class="mt-5 mb-2"><span class="counter-value" data-target="PAID">0</span></h5>
                                                    <p class="text-slate-500 dark:text-slate-200">ชำระแล้ว</p>
                                                </div>
                                            </a>  
                                            <a onclick="openModalDashboard('ค้างชำระ','PDOD')" class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4 bg-red-100 dark:bg-red-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-red-500/20 relative overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-lg block transition card hover:shadow-lg hover:-translate-y-1" href="javascript:void(0);">
                                                <div class="card-body">
                                                    <i data-lucide="kanban" class="absolute top-0 stroke-1 size-32 text-red-200 dark:text-red-500/20 ltr:-right-10 rtl:-left-10"></i>
                                                    <div class="flex items-center justify-center rounded-md size-12 bg-red-500 text-15 text-red-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-dollar-sign-icon lucide-badge-dollar-sign"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>
                                                    </div>
                                                    <h5 class="mt-5 mb-2"><span class="counter-value" data-target="OVERDUE">0</span></h5>
                                                    <p class="text-slate-500 dark:text-slate-200">ค้างชำระ</p>
                                                </div>
                                            </a>  
                                            <a onclick="openModalDashboard('จำนวนใบวางบิลทั้งหมด','TOTAL')" class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4 bg-yellow-100 dark:bg-yellow-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-yellow-500/20 relative overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-lg block transition card hover:shadow-lg hover:-translate-y-1" href="javascript:void(0);">
                                                <div class="card-body">
                                                    <i data-lucide="kanban" class="absolute top-0 stroke-1 size-32 text-yellow-200 dark:text-yellow-500/20 ltr:-right-10 rtl:-left-10"></i>
                                                    <div class="flex items-center justify-center bg-yellow-500 rounded-md size-12 text-15 text-yellow-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notepad-text-icon lucide-notepad-text"><path d="M8 2v4"/><path d="M12 2v4"/><path d="M16 2v4"/><rect width="16" height="18" x="4" y="4" rx="2"/><path d="M8 10h6"/><path d="M8 14h8"/><path d="M8 18h5"/></svg>
                                                    </div>
                                                    <h5 class="mt-5 mb-2"><span class="counter-value" data-target="TOTAL">0</span></h5>
                                                    <p class="text-slate-500 dark:text-slate-200">จำนวนใบวางบิลทั้งหมด</p>
                                                </div>
                                            </a>  
                                            <a onclick="openModalDashboard('ใบวางบิลที่ยังไม่ชำระ','PENDING')" class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4 bg-orange-100 dark:bg-orange-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-orange-500/20 relative overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-lg block transition card hover:shadow-lg hover:-translate-y-1" href="javascript:void(0);">
                                                <div class="card-body">
                                                    <i data-lucide="kanban" class="absolute top-0 stroke-1 size-32 text-orange-200 dark:text-orange-500/20 ltr:-right-10 rtl:-left-10"></i>
                                                    <div class="flex items-center justify-center bg-orange-500 rounded-md size-12 text-15 text-orange-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock3-icon lucide-clock-3"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16.5 12"/></svg>
                                                    </div>
                                                    <h5 class="mt-5 mb-2"><span class="counter-value" data-target="PENDING">0</span></h5>
                                                    <p class="text-slate-500 dark:text-slate-200">ใบวางบิลที่ยังไม่ชำระ</p>
                                                </div>
                                            </a>  
                                            <a onclick="openModalDashboard('จำนวนแจ้งเตือนที่ส่งแล้วทั้งหมด','NOTI')" class="col-span-12 card md:col-span-6 lg:col-span-4 2xl:col-span-4 bg-purple-100 dark:bg-purple-500/20 card 2xl:col-span-2 group-data-[skin=bordered]:border-purple-500/20 relative overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-lg block transition card hover:shadow-lg hover:-translate-y-1" href="javascript:void(0);">
                                                <div class="card-body">
                                                    <i data-lucide="kanban" class="absolute top-0 stroke-1 size-32 text-purple-200/50 dark:text-purple-500/20 ltr:-right-10 rtl:-left-10"></i>
                                                    <div class="flex items-center justify-center bg-purple-500 rounded-md size-12 text-15 text-purple-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell-ring-icon lucide-bell-ring"><path d="M10.268 21a2 2 0 0 0 3.464 0"/><path d="M22 8c0-2.3-.8-4.3-2-6"/><path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"/><path d="M4 2C2.8 3.7 2 5.7 2 8"/></svg>
                                                    </div>
                                                    <h5 class="mt-5 mb-2"><span class="counter-value" data-target="NOTIFICATION">0</span></h5>
                                                    <p class="text-slate-500 dark:text-slate-200">จำนวนแจ้งเตือนที่ส่งแล้วทั้งหมด</p>
                                                </div>
                                            </a>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Close Section ############################################################## -->
            </div>
        </div>
    <?php require_once($path.'include/footer.php'); ?>
    </div>
</div>
<div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40" onclick="closeModalDashboard()"></div>
<div id="modal" class="fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="bg-white dark:bg-zink-800 rounded-lg shadow-lg p-6 w-full sm:w-11/12 md:w-3/4 lg:w-1/2 xl:w-2/5">
        <div class="flex justify-between items-center">
            <h2 id="modal-title" class="text-xl font-bold text-gray-800 dark:text-white">รายละเอียด</h2>
            <button class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white" onclick="closeModalDashboard()">✖</button>
        </div>
        <div class="mt-4">
            <table id="modal-table" class="display stripe hover w-full">
                <thead>
                    <tr>
                        <th>วันที่</th>
                        <th>ลูกค้า</th>
                        <th>รอบบิล</th>
                        <th>ยอดเงิน</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- ข้อมูลจะถูกเพิ่มผ่าน JavaScript -->
                </tbody>
            </table>
        </div>
        <div class="mt-6 text-right">
            <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition" onclick="closeModalDashboard()">ปิด</button>
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
        document.getElementById('inputfiltercom').value = 'All'; 

        $('#modal-table').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            autoWidth: false,
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/th.json'  
            }
        });
        
        const filterButtons = document.querySelectorAll('.filter-btns a');
        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
        var table = $('#last_check').DataTable({
            paging: false,
            searching: false,
            info: false,
            ordering: false,
            autoWidth: false,
            lengthChange: false,
            pageLength: 10,
            columnDefs: [
                { targets: [0], orderable: false },
                { targets: [5], orderable: false },
            ]
        });
        $('.table-lastcheck tbody').empty();
        $('.table-lastcheck tbody').append('<tr><td colspan="5" align="center" class="p-6 text-xl"><font size="4">กำลังโหลดข้อมูล...</font></td></tr>');
        function fetchDashboard(filterType) {
            $.ajax({
                url: 'api/dashboard/api.php',
                type: 'POST',
                dataType: 'json',
                data: { proc: 'dashboard',filter: filterType },
                success: function(data) {
                    const dailyData = data.dailyData;
                    $(".counter-value[data-target='TOTAL']").text(dailyData.TOTAL);
                    $(".counter-value[data-target='PENDING']").text(dailyData.PENDING);
                    $(".counter-value[data-target='TOTALAMOUNT']").text(
                        parseFloat(dailyData.TOTALAMOUNT).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                    );
                    $(".counter-value[data-target='PAID']").text(
                        parseFloat(dailyData.PAID).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                    );
                    $(".counter-value[data-target='OVERDUE']").text(
                        parseFloat(dailyData.OVERDUE).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
                    );
                    $(".counter-value[data-target='NOTIFICATION']").text(dailyData.NOTIFICATION);

                    const reportData = data.reportData;
                    const reportTable = $(".table-lastcheck tbody"); 
                    reportTable.empty(); 
                    if (reportData.length === 0) {
                        reportTable.append(`
                            <tr>
                                <td colspan="7" class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500">
                                    <font size="4">ไม่มีข้อมูล</font>
                                </td>
                            </tr>
                        `);
                    } else {
                        reportData.forEach(item => {
                            var rowstatus = (item.BLB_STATUS === 'Paid') ? "<img src='assets/images/check_true.gif' alt='pic' width='16' height='16'>" :
                                            (item.BLB_STATUS === 'Pending') ? "<img src='assets/images/imgloading.gif' alt='pic' width='25' height='25'>" :
                                            (item.BLB_STATUS === 'Overdue') ? "<img src='assets/images/warning.png' alt='pic' width='25' height='25'>" :
                                            (item.BLB_STATUS === 'Cancelled') ? "<font color='red'><b>ยกเลิก</b></font>" : "0";
                            var formattedDate = formatDateTimeDashboard(item.BLB_CREATEDATE);
                            reportTable.append(`
                                <tr>
                                    <td class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500">${formattedDate}</td>
                                    <td class="px-2 py-2.5 border-2 border-slate-200 dark:border-zink-500">${item.BLB_DEBTORNAME}</td>
                                    <td class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500">${item.BLB_CYCLE}</td>
                                    <td class="text-right py-2.5 border-2 border-slate-200 dark:border-zink-500">${parseFloat(item.BLB_NUMPRICE).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                    <td class="text-center py-2.5 border-2 border-slate-200 dark:border-zink-500"><center>${rowstatus}</center></td>
                                </tr>
                            `);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.log(xhr.responseText); 
                }
            });
        }
        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filterType = this.getAttribute('data-filter');
                document.getElementById('inputfiltercom').value = filterType; 
                fetchDashboard(filterType);
            });
        });

        setInterval(function () {
            fetchDashboard('All');
            filterButtons.forEach(btn => btn.classList.remove('active'));
            document.querySelector('.filter-btns a[data-filter="All"]').classList.add('active');
        }, 300000);
        fetchDashboard('All');
    });
</script>

</body>
</html>
