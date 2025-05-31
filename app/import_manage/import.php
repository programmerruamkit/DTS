<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='นำเข้าข้อมูล.html';
    $_SESSION['DROPDOWN']='';
    $_SESSION['DROPDOWN_ID']='';
?>

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
                        <h5 class="text-16">จัดการนำเข้าข้อมูล</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">                             
                            <div class="grid grid-cols-1 gap-5 xl:grid-cols-12" id="Step1AddBilling">
                                <div class="xl:col-span-1"></div>
                                <div class="xl:col-span-4">
                                    <form id="import-form" method="post" enctype="multipart/form-data">   
                                        <div>
                                            <label for="file-input" class="form-label"><b>เลือกไฟล์ CSV/Excel</b></label><br>
                                            <input type="file" id="file-input" accept=".csv, .xls, .xlsx" placeholder="Enter your name" required class="cursor-pointer form-file form-file-lg border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                        </div>
                                    </form>
                                </div>
                                <div class="xl:col-span-1"></div>
                                <div class="xl:col-span-4">
                                    <label class="form-label"><b>โหลดไฟล์ตัวอย่าง CSV Excel</b></label><br>
                                    <button type="button" onclick="DownloadImport()" class="relative px-4 py-2.5 ltr:pl-[calc(theme('spacing.4')_+_44.5px)] rtl:pr-[calc(theme('spacing.4')_+_44.5px)] text-15 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        <i class="ri-download-2-line w-[44.5px] bg-white/10 flex absolute ltr:-left-[1px] rtl:-right-[1px] -bottom-[1px] -top-[1px] items-center justify-center"></i> 
                                        โหลดไฟล์ตัวอย่าง CSV Excel
                                    </button>
                                </div>
                                <div class="xl:col-span-1"></div>
                            </div>
                            <br><hr><br>
                            <h5 class="text-16">แสดงรายการนำเข้าข้อมูล</h5>
                                    <h5 class="text-16">หมายเหตุ</h5>
                                    <p>1. กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนทำการบันทึก</p>
                                    <p>2. หากมีการนำเข้าข้อมูลซ้ำ ระบบจะทำการอัพเดทข้อมูลล่าสุด</p>
                                    <p>3. หากมีการนำเข้าข้อมูลที่ไม่ถูกต้อง ระบบจะทำการแจ้งเตือน</p>
                            <br>
                            <div class="overflow-x-auto">
                                <table id="borderedTable" class="bordered group" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">ลำดับที่</th>
                                            <th rowspan="1" colspan="2" class="text-center">รอบวางบิล</th>
                                            <th rowspan="2" class="text-center">สายงาน /<br>ตัวย่อบริษัท</th>
                                            <th rowspan="2" class="text-center">วันที่เอกสาร</th>
                                            <th rowspan="2" class="text-center">เลขที่เอกสาร</th>
                                            <th rowspan="2" class="text-center">จำนวนเงิน</th>
                                            <th rowspan="2" class="text-center">ภาษีมูลค่าเพิ่ม</th>
                                            <th rowspan="2" class="text-center">จำนวนเงินรวม</th>
                                            <th rowspan="2" class="text-center">ภาษีหัก ณ ที่จ่าย</th>
                                            <th rowspan="2" class="text-center">จำนวนเงินสุทธิ</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">วันที่เริ่ม</th>
                                            <th class="text-center">วันที่สิ้นสุด</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-center" style="background-color:#F1F3F7"><b>รวม</b></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                            <td class="text-right"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="flex justify-center gap-2 mt-4">
                                    <button type="button" id="import-btn" onclick="ImportExcelFromDataTable()" class="relative px-4 py-2.5 ltr:pl-[calc(theme('spacing.4')_+_44.5px)] rtl:pr-[calc(theme('spacing.4')_+_44.5px)] text-15 text-white btn bg-green-500 border-green-500 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/20">
                                        <i class="ri-contract-right-fill w-[44.5px] bg-white/10 flex absolute ltr:-left-[1px] rtl:-right-[1px] -bottom-[1px] -top-[1px] items-center justify-center"></i> 
                                        นำเข้าข้อมูล
                                    </button>
                                </div><br>
                            </div>
                        </div>
                    </div>
                <!-- Close Section ############################################################## -->
            </div>
        </div>
    <?php require_once($path.'include/footer.php'); ?>
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
<!-- เพิ่ม script SheetJS และโค้ดแสดงตัวอย่าง -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script> handleExcelImport('file-input', 'borderedTable'); </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
</body>
</html>