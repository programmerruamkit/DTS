<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='จัดการลูกหนี้.html';
    $_SESSION['DROPDOWN']='null'; 
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
                        <h5 class="text-16">จัดการลูกหนี้</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <div class="shrink-0">
                                <button aria-label="button" data-modal-target="AddDebtorModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มลูกหนี้</span>
                                </button>
                            </div>
                            <br>
                            <table id="table-debtor" class="table-debtor bordered group" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10%">ลำดับ</th>
                                        <th width="20%">สังกัดบริษัท</th>
                                        <th width="10%">รหัสลูกค้า</th>
                                        <th width="30%">ตัวย่อลูกหนี้</th>
                                        <th width="30%">ชื่อลูกหนี้</th>
                                        <th width="10%">อีเมล</th>
                                        <th width="10%">เบอร์โทร</th>
                                        <th width="10%">ประเภทการจ่ายเงิน</th>
                                        <th width="10%">เครดิต</th>
                                        <th width="10%">กำหนดจ่ายเงิน</th>
                                        <th width="10%">หัก ณ ที่จ่าย (%)</th>
                                        <th width="10%">vat (%)</th>
                                        <th width="10%">หมายเหตุ</th>
                                        <th width="20%">สถานะใช้งาน</th>
                                        <th width="20%">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                <!-- Close Section ############################################################## -->
            </div>
        </div>
    <?php require_once($path.'include/footer.php'); ?>
    </div>
</div>
<!-- INSERT MODAL -->
<div id="AddDebtorModal" modal-center="" style="width: 1000px; max-width: 90vw;" class="fixed flex flex-col w-[700px] max-w-full mx-auto transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-full max-w-[1000px] mx-auto bg-white shadow rounded-md dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b dark:border-zink-300/20">
            <h5 class="text-16">เพิ่มลูกหนี้</h5>
            <button aria-label="button" data-modal-close="AddDebtorModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <form name="form1" method="post">
                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">                            
                    <div class="xl:col-span-4">
                        <label for="param1" class="inline-block mb-2 text-base font-medium">สังกัดบริษัท</label>
                        <select name="param1" id="param1" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices="">
                            <option value="">------โปรดเลือก------</option>
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
                                <option value="<?php echo $rs_company->COMPANYCODE ?>"><?php echo $rs_company->COMPANYCODE ?> - <?php echo $rs_company->THAINAME ?></option>
                            <?php } ?>
                        </select>
                    </div>  
                    <div class="xl:col-span-2">
                        <label for="param2" class="inline-block mb-2 text-base font-medium">รหัสลูกหนี้</label>
                        <input type="text" name="param2" id="param2" placeholder="กรอกรหัสลูกหนี้" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>          
                    <div class="xl:col-span-2">
                        <label for="param3" class="inline-block mb-2 text-base font-medium">ตัวย่อลูกหนี้</label>
                        <input type="text" name="param3" id="param3" placeholder="กรอกตัวย่อลูกหนี้" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>          
                    <div class="xl:col-span-4">
                        <label for="param4" class="inline-block mb-2 text-base font-medium">ชื่อลูกหนี้</label>
                        <input type="text" name="param4" id="param4" placeholder="กรอกชื่อลูกหนี้" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>                
                    <div class="xl:col-span-3">
                        <label for="param5" class="inline-block mb-2 text-base font-medium">อีเมล</label>
                        <input type="email" name="param5" id="param5" class="form-input" placeholder="example@email.com">
                    </div>                
                    <div class="xl:col-span-2">
                        <label for="param6" class="inline-block mb-2 text-base font-medium">เบอร์โทรศัพท์</label>
                        <input type="number" name="param6" id="param6" class="form-input" placeholder="กรอกเบอร์โทรศัพท์" pattern="[0-9]{10}">
                    </div>                
                    <div class="xl:col-span-7">
                        <label for="param7" class="inline-block mb-2 text-base font-medium">ที่อยู่</label>
                        <input type="text" name="param7" id="param7" placeholder="กรอกที่อยู่ลูกหนี้" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div> 
                    <div class="xl:col-span-2">
                        <label for="param8" class="inline-block mb-2 text-base font-medium">ประเภทการจ่ายเงิน</label>
                        <input type="text" name="param8" id="param8" placeholder="-" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>     
                    <div class="xl:col-span-2">
                        <label for="param9" class="inline-block mb-2 text-base font-medium">เครดิต</label>
                        <input type="number" name="param9" id="param9" placeholder="-" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>     
                    <div class="xl:col-span-2">
                        <label for="param10" class="inline-block mb-2 text-base font-medium">กำหนดจ่ายเงิน</label>
                        <input type="text" name="param10" id="param10" placeholder="-" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>     
                    <div class="xl:col-span-2">
                        <label for="param11" class="inline-block mb-2 text-base font-medium">หัก ณ ที่จ่าย (%)</label>
                        <input type="number" name="param11" id="param11" placeholder="-" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>    
                    <div class="xl:col-span-1">
                        <label for="param12" class="inline-block mb-2 text-base font-medium">vat (%)</label>
                        <input type="number" name="param12" id="param12" placeholder="-" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>    
                    <div class="xl:col-span-3">
                        <label for="param13" class="inline-block mb-2 text-base font-medium">หมายเหตุ</label>
                        <input type="text" name="param13" id="param13" placeholder="-" autocomplete="off" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>  
                    <div class="xl:col-span-12 flex gap-2 items-center">
                        <input type="hidden" name="param14" id="param14" value="Y">
                        <input type="hidden" name="PROC" id="PROC" value="add">
                        <button aria-label="button" type="button" data-modal-close="AddDebtorModal" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10" data-modal-close="AddMenuModal">ปิด</button>
                        <button aria-label="button" type="button" onclick="ManageDebtor('ADD','')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">เพิ่มข้อมูล</button>
                    </div>
                    </div>
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
<script src="assets/js/datatables/jszip.min.js"></script>
<script src="assets/js/datatables/pdfmake.min.js"></script>
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<script src="assets/js/datatables/buttons.print.min.js"></script>
<script src="assets/js/datatables/datatables.init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    const modalCloseButton = document.querySelector('[data-modal-close="AddDebtorModal"]');
    if (modalCloseButton) {modalCloseButton.click();}
    
    document.addEventListener('DOMContentLoaded', function () {
        
        var table = $('#table-debtor').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            autoWidth: false,
            lengthChange: true,
            pageLength: 10,
            columnDefs: [
                { targets: [0], orderable: false },
                { targets: [7], orderable: false },
            ]
        });
        $('.table-debtor tbody').empty();
        $('.table-debtor tbody').append('<tr><td colspan="8" align="center" class="p-6 text-xl"><font size="4">กำลังโหลดข้อมูล...</font></td></tr>');

        function fetch_debtors() {
            $.ajax({
                url: 'api/debtor/api.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    proc: 'debtor'
                },
                success: function(data) {
                    if (data.length === 0) {
                        table.clear();
                        table.draw();
                    } else {
                        table.clear();
                        data.forEach(function(debtor, index) {
                            var rowNumber = index + 1;
                            var rowColor = (rowNumber % 2 === 0) ? 'bg-slate-50' : 'bg-white';
                            var rowCompany = (debtor.DT_COMPANY !== null && debtor.DT_COMPANY !== '') ? debtor.DT_COMPANY : '';
                            var rowCodeCus = (debtor.DT_CODECUS !== null && debtor.DT_CODECUS !== '') ? debtor.DT_CODECUS : '';
                            var rowShortName = (debtor.DT_SHORTNAME !== null && debtor.DT_SHORTNAME !== '') ? debtor.DT_SHORTNAME : '';
                            var rowName = (debtor.DT_NAME !== null && debtor.DT_NAME !== '') ? debtor.DT_NAME : '';
                            var rowEmail = (debtor.DT_EMAIL !== null && debtor.DT_EMAIL !== '') ? debtor.DT_EMAIL : '';
                            var rowPhone = (debtor.DT_PHONE !== null && debtor.DT_PHONE !== '') ? debtor.DT_PHONE : '';
                            var rowAddress = (debtor.DT_ADDRESS !== null && debtor.DT_ADDRESS !== '') ? debtor.DT_ADDRESS : '';
                            var rowPmt = (debtor.DT_PMT !== null && debtor.DT_PMT !== '') ? debtor.DT_PMT : '';
                            var rowCd = (debtor.DT_CD !== null && debtor.DT_CD !== '') ? debtor.DT_CD : '';
                            var rowPms = (debtor.DT_PMS !== null && debtor.DT_PMS !== '') ? debtor.DT_PMS : '';
                            var rowWhdt = (debtor.DT_WHDT !== null && debtor.DT_WHDT !== '') ? debtor.DT_WHDT : '';
                            var rowVat = (debtor.DT_VAT !== null && debtor.DT_VAT !== '') ? debtor.DT_VAT : '';
                            var rowRemark = (debtor.DT_RAMARK !== null && debtor.DT_RAMARK !== '') ? debtor.DT_RAMARK : '';
                            var rowStatus = (debtor.DT_STATUS === 'Y') ? "<img src='assets/images/check_true.gif' alt='Active' width='16' height='16'>" :
                                            "<img src='assets/images/check_del.gif' alt='Inactive' width='16' height='16'>";

                            table.row.add([
                                '<div class="text-center">'+rowNumber+'</div>',
                                '<div class="text-center">'+rowCompany+'</div>',
                                '<div class="text-left">'+rowCodeCus+'</div>',
                                '<div class="text-left">'+rowShortName+'</div>',
                                '<div class="text-left">'+rowName+'</div>',
                                '<div class="text-left">'+rowEmail+'</div>',
                                '<div class="text-left">'+rowPhone+'</div>',
                                '<div class="text-left">'+rowPmt+'</div>',
                                '<div class="text-left">'+rowCd+'</div>',
                                '<div class="text-left">'+rowPms+'</div>',
                                '<div class="text-left">'+rowWhdt+'</div>',
                                '<div class="text-left">'+rowVat+'</div>',
                                '<div class="text-left">'+rowRemark+'</div>',
                                '<div class="flex items-center justify-center h-full">'+rowStatus+'</div>',
                                '<div class="flex justify-center gap-2">'+
                                    '<a href="แก้ไขลูกหนี้-'+debtor.DT_ID+'.html">'+
                                        '<button aria-label="button" class="py-1 text-xs text-black btn bg-yellow-500 border-yellow-500 hover:text-black hover:bg-yellow-600 hover:border-yellow-600 focus:text-black focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-black active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20 edit-item-btn">'+
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil">'+
                                                '<path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/>'+
                                            '</svg>'+
                                        '</button>'+
                                    '</a>'+
                                    '<a href="javascript:void(0);" onclick="swaldelete_debtor_main(\''+debtor.DT_CODE+'\','+rowNumber+')">'+
                                        '<button aria-label="button" type="button" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">'+
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">'+
                                                '<path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/>'+
                                            '</svg>'+
                                        '</button>'+
                                    '</a>'+
                                '</div>'
                            ]).draw();
                            var row = table.row(index).node();
                            $(row).addClass(rowColor);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        }
        setInterval(fetch_debtors, 60000);
        fetch_debtors();
    });
    


</script>

</script>
</body>
</html>