<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='สมุดคุมเลขที่วางบิล.html';
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
    .datetimeContainer {
        cursor: pointer;
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
                        <h5 class="text-16">สมุดคุมเลขที่วางบิล</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                                <div class="xl:col-span-6">
                                    <div class="shrink-0">                                        
                                        <!-- <button aria-label="button" data-modal-target="AddBilling" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"> -->
                                        <button aria-label="button" data-modal-target="AddBilling" type="button" onclick="resetFormAndStartStep1();" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                            <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มใบวางบิล</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="xl:col-span-6">                                    
                                    <ul class="flex flex-wrap w-full gap-2 text-sm font-medium text-center filter-btns grow" data-filter-target="notes-list">
                                        <li>
                                            <a href="javascript:void(0);" data-filter="All" class="active inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zink-200 border border-transparent [&.active]:bg-custom-500 dar:[&.active]:bg-custom-500 [&.active]:text-white dark:[&.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                                ทั้งหมด
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-filter="Paid" class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zink-200 border border-transparent [&.active]:bg-custom-500 dar:[&.active]:bg-custom-500 [&.active]:text-white dark:[&.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                                ชำระเงินแล้ว
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-filter="Pending" class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zink-200 border border-transparent [&.active]:bg-custom-500 dar:[&.active]:bg-custom-500 [&.active]:text-white dark:[&.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                                รอการชำระเงิน
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-filter="Overdue" class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zink-200 border border-transparent [&.active]:bg-custom-500 dar:[&.active]:bg-custom-500 [&.active]:text-white dark:[&.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                                เกินกำหนดชำระ
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-filter="Cancelled" class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zink-200 border border-transparent [&.active]:bg-custom-500 dar:[&.active]:bg-custom-500 [&.active]:text-white dark:[&.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                                ยกเลิก
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <table id="table-billing" class="table-billing bordered group" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">ลำดับ</th>
                                        <th width="15%">รอบการวางบิล</th>
                                        <th width="15%">เลขที่ใบแจ้งหนี้</th>
                                        <th width="20%">รายชื่อลูกค้า</th>
                                        <th width="15%">จำนวนเงิน</th>
                                        <th width="15%">หมายเหตุ</th>
                                        <th width="10%">สถานะ</th>
                                        <th width="15%">วันที่แจ้งเตือน</th>
                                        <th width="10%">จัดการ</th>
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
<div id="AddBilling" modal-center="" style="width: 1200px; max-width: 90vw;" class="fixed flex flex-col w-[700px] max-w-full mx-auto transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-full max-w-[1000px] mx-auto bg-white shadow rounded-md dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b dark:border-zink-300/20">
            <h5 class="text-16">เพิ่มใบวางบิล เลขที่: <span id="next_invoice_number"></span></h5>
            <button aria-label="button" data-modal-close="AddBilling" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <form action="#!">
                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12" id="Step1AddBilling">
                    <div class="xl:col-span-2"></div>
                    <div class="xl:col-span-4">
                        <label for="param_com" class="inline-block mb-2 text-base font-medium">เลือกบริษัท</label>
                        <select name="param_com" id="param_com" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
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
                    <div class="xl:col-span-4">
                        <label for="param_month" class="inline-block mb-2 text-base font-medium">เลือกเดือน</label>
                        <select name="param_month" id="param_month" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            <option value="">------โปรดเลือก------</option>
                            <option value="01">มกราคม</option>
                            <option value="02">กุมภาพันธ์</option>
                            <option value="03">มีนาคม</option>
                            <option value="04">เมษายน</option>
                            <option value="05">พฤษภาคม</option>
                            <option value="06">มิถุนายน</option>
                            <option value="07">กรกฎาคม</option>
                            <option value="08">สิงหาคม</option>
                            <option value="09">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                        </select>
                    </div>
                    <div class="xl:col-span-2"></div>
                    <div class="xl:col-span-12 flex justify-center gap-3" id="ShowHideDiv">
                        <button aria-label="button" type="button" data-modal-close="AddBilling" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10" data-modal-close="AddBilling">ปิด</button>
                        <button type="button" onclick="nextStepAddBilling();" class="btn bg-custom-500 text-white">ถัดไป</button>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12" id="Step2AddBilling">
                    <div class="xl:col-span-3 relative group cursor-pointer">
                        <label for="param1" class="inline-block mb-2 text-base font-medium">รอบการวางบิล</label>
                        <input type="text" id="param1" placeholder="เลือกรอบการวางบิล" value="" autocomplete="off"  class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-provider="flatpickr" data-date-format="d M Y" data-range-date="true" readonly="readonly">
                    </div>
                    <div class="xl:col-span-2">
                        <label for="param11" class="inline-block mb-2 text-base font-medium">วันที่ใบวางบิล</label>
                        <input type="text" id="param11" placeholder="เลือกวันที่ใบวางบิล" value="" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-provider="flatpickr" data-date-format="d M Y" readonly="readonly">
                    </div>
                    <div class="xl:col-span-4 hidden">
                        <label for="param2" class="inline-block mb-2 text-base font-medium">เลขที่ใบแจ้งหนี้</label>
                        <input type="text" id="param2" placeholder="กรอกเลขที่ใบแจ้งหนี้" value="<?php echo $next_invoice_number; ?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>
                    <div class="xl:col-span-4">
                        <label for="param3" class="inline-block mb-2 text-base font-medium">รายชื่อลูกค้า</label>
                        <select name="param3" id="param3" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                            <option value="">------โปรดเลือก------</option>
                        </select>
                    </div>
                    <div class="xl:col-span-1">
                        <label for="param12" class="inline-block mb-2 text-base font-medium">เครดิต</label>
                        <input type="text" id="param12" placeholder="เครดิต" value="" autocomplete="off" disabled class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                    </div>
                    <div class="xl:col-span-2">
                        <label for="param13" class="inline-block mb-2 text-base font-medium">วันครบกำหนด</label>
                        <input type="text" id="param13" placeholder="---วันครบกำหนด---" autocomplete="off" readonly class="form-input ...">
                    </div>
                    
                    <div class="xl:col-span-12">
                        <table id="AddRowBilling" class="display stripe group" style="width:100%;border: 1px;;">
                            <thead>
                                <tr>
                                    <td style="width: 5%;"></td>           
                                    <td style="width: 20%;">เลขที่ PO</td>    
                                    <td style="width: 10%;">จำนวนตัน</td>     
                                    <td style="width: 10%;">จำนวนเที่ยว</td>   
                                    <td style="width: 10%;">จำนวนเงิน</td>    
                                    <td style="width: 20%;">หมายเหตุ</td>    
                                    <td style="width: 20%;">วันที่รับเงิน / แจ้งเตือน</td>    
                                    <td style="width: 5%;"></td>           
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><button type="button" class="btn btn-add bg-green-500 text-white px-2 py-1 rounded">เพิ่ม</button></td>
                                    <td><input type="text" id="param4" placeholder="-" value="" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></td>
                                    <td><input type="number" id="param5" placeholder="-" value="" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></td>
                                    <td><input type="number" id="param6" placeholder="-" value="" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></td>
                                    <td><input type="number" id="param7" placeholder="-" value="" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></td>
                                    <td><input type="text" id="param8" placeholder="-" value="" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></td>
                                    <td id="datetimeContainer"><input type="datetime-local" id="param9" placeholder="-" value="" autocomplete="off" style="cursor:pointer" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-black dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="xl:col-span-12 flex justify-between items-center">
                        <div class="xl:col-span-12 text-left">
                            <button type="button" onclick="prevStepAddBilling();" class="text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">ย้อนกลับ</button>
                        </div>
                        <div class="xl:col-span-12 text-right">
                            <input type="hidden" name="param10" id="param10" value="Pending">
                            <input type="hidden" name="PROC" id="PROC" value="add">
                            <button aria-label="button" type="button" data-modal-close="AddBilling" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">ปิด</button>
                            <button aria-label="button" type="button" onclick="ManageBilling('ADD','')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">เพิ่มข้อมูล</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="overlay" class="overlay" onclick="closeBillingDetails()"></div>
<div id="billingModal" class="modal fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b dark:border-zink-300/20">
            <h5 class="text-16">รายละเอียดใบแจ้งหนี้</h5>
            <button aria-label="button" onclick="closeBillingDetails()" data-modal-close="billingModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <div id="billingDetails" class="text-sm"></div>
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
    document.getElementById('param_com').addEventListener('change', toggleShowHideDiv);
    document.getElementById('param_month').addEventListener('change', toggleShowHideDiv);
    
    function toggleShowHideDiv() {
        var companySelected = document.getElementById('param_com').value !== "";
        var monthSelected = document.getElementById('param_month').value !== "";
        var nextButton = document.getElementById('ShowHideDiv');
    
        if (companySelected && monthSelected) {
            nextButton.classList.remove('hidden');
        } else {
            nextButton.classList.add('hidden');
        }
    }
    const datetimeInput = document.getElementById("param9");

    const datetimeContainer = document.getElementById("datetimeContainer");
    datetimeContainer.addEventListener("click", function() {
        datetimeInput.showPicker();
    });

    const modalCloseButton = document.querySelector('[data-modal-close="AddBilling"]');
    if (modalCloseButton) {modalCloseButton.click();}
    
    document.addEventListener('DOMContentLoaded', function () {
        
        const filterButtons = document.querySelectorAll('.filter-btns a');
        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        const table = $('#table-billing').DataTable({
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
        
        function fetchFilteredBillings(filterType) {
            $('.table-billing tbody').empty();
            $('.table-billing tbody').append('<tr><td colspan="9" align="center" class="p-6 text-xl"><font size="4">กำลังโหลดข้อมูล...</font></td></tr>');

            $.ajax({
                url: 'api/billing/api.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    proc: 'billing',
                    filter: filterType
                },
                success: function (data) {
                    if (data.length === 0) {
                        table.clear();
                        table.draw();
                    } else {
                        table.clear();
                        data.forEach(function (billing, index) {
                            var rowNumber = index + 1;
                            var rowColor = (rowNumber % 2 === 0) ? 'bg-slate-50' : 'bg-white';
                            var numTons = parseFloat(billing.BLB_NUMTONS).toLocaleString();
                            var numTrips = parseFloat(billing.BLB_NUMTRIPS).toLocaleString();
                            var numPrice = parseFloat(billing.BLB_NUMPRICE).toLocaleString();
                            var formattedDate = formatDateTimeBilling(billing.BLB_DATEALERT);
                            
                            var statusSelect = '';
                            if (billing.BLN_STATUS_NOTI === 'Sent') {
                                statusSelect = `
                                    <select class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800" onchange="updateBillingStatus('${billing.BLB_CODE}', this.value)">
                                        <option value="Paid" ${billing.BLB_STATUS === 'Paid' ? 'selected' : ''}>ชำระเงินแล้ว</option>
                                        <option value="Pending" ${billing.BLB_STATUS === 'Pending' ? 'selected' : ''}>รอการชำระเงิน</option>
                                        <option value="Overdue" ${billing.BLB_STATUS === 'Overdue' ? 'selected' : ''}>เกินกำหนดชำระ</option>
                                        <option value="Cancelled" ${billing.BLB_STATUS === 'Cancelled' ? 'selected' : ''}>ยกเลิก</option>
                                    </select>
                                `;
                            } else {
                                statusSelect = `
                                    <select class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 dark:focus:border-custom-800" onchange="updateBillingStatus('${billing.BLB_CODE}', this.value)">
                                        <option value="Paid" ${billing.BLB_STATUS === 'Paid' ? 'selected' : ''}>ชำระเงินแล้ว</option>
                                        <option value="Pending" ${billing.BLB_STATUS === 'Pending' ? 'selected' : ''}>รอการชำระเงิน</option>
                                        <option value="Overdue" ${billing.BLB_STATUS === 'Overdue' ? 'selected' : ''}>เกินกำหนดชำระ</option>
                                        <option value="Cancelled" ${billing.BLB_STATUS === 'Cancelled' ? 'selected' : ''}>ยกเลิก</option>
                                    </select>
                                `;
                            }
                            
                            table.row.add([
                                '<div class="text-center">' + rowNumber + '</div>',
                                '<div class="text-left">' + billing.BLB_CYCLE + '</div>',
                                '<div class="text-center">' + billing.BLB_NUMINVOICE + '</div>',
                                '<div class="text-left">' + billing.BLB_DEBTORNAME + '</div>',
                                '<div class="text-right">' + numPrice + '</div>',
                                '<div class="text-left">' + billing.BLB_REMARK + '</div>',
                                '<div class="text-left">' + statusSelect + '</div>',
                                '<div class="text-left">' + formattedDate + 
                                    (billing.BLN_STATUS_NOTI === 'Sent' 
                                        ? ' <span class="text-green-600">✅ ส่งแล้ว</span>' 
                                        : ' <span class="text-red-600">⏳ รอส่ง</span>'
                                    ) + 
                                '</div>',
                                '<div class="flex justify-center gap-2">' +
                                    '<button onclick="viewBillingDetails(\'' + billing.BLB_CODE + '\')" class="py-1 text-xs text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 edit-item-btn">' +
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">' +
                                            '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>' +
                                        '</svg>' +
                                    '</button>' +
                                    '<a href="javascript:void(0);" onclick="swaldelete_billing_main(\'' + billing.BLB_CODE + '\',' + rowNumber + ')">' +
                                        '<button aria-label="button" type="button" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">' +
                                                '<path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/>' +
                                            '</svg>' +
                                        '</button>' +
                                    '</a>' +
                                '</div>'
                            ]).draw();

                            var row = table.row(index).node();
                            $(row).addClass(rowColor);
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        }

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                const filterType = this.getAttribute('data-filter');
                fetchFilteredBillings(filterType);
            });
        });
        fetchFilteredBillings('All');
    });
    
    document.getElementById("param11").addEventListener("change", function () {
        calculateDueDateBilling(); 
    });

    document.getElementById("param3").addEventListener("change", function () {
        const debtorCode = this.value;
        if (!debtorCode) {
            document.getElementById("debtor_credit_days").innerText = "-";
            return;
        }

        fetch("api/billing/api.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "proc=get_debtor_credit&debtor_code=" + encodeURIComponent(debtorCode),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                document.getElementById("param12").value  = data.credit;
                calculateDueDateBilling(); 
            } else {
                document.getElementById("param12").value  = "ไม่พบข้อมูล";
            }
        })
        .catch((error) => {
            console.error("เกิดข้อผิดพลาดในการดึงเครดิตลูกหนี้:", error);
            document.getElementById("param12").value  = "-";
        });
    });
    function calculateDueDateBilling() {
        const billDateStr = document.getElementById('param11').value;
        const creditStr = document.getElementById('param12').value;

        if (!billDateStr || !creditStr || isNaN(creditStr)) {
            document.getElementById('param13').value = '';
            return;
        }

        const monthMap = {
            '01': 'ม.ค.', '02': 'ก.พ.', '03': 'มี.ค.', '04': 'เม.ย.',
            '05': 'พ.ค.', '06': 'มิ.ย.', '07': 'ก.ค.', '08': 'ส.ค.',
            '09': 'ก.ย.', '10': 'ต.ค.', '11': 'พ.ย.', '12': 'ธ.ค.'
        };

        const thMonthMap = {
            'ม.ค.': '01', 'ก.พ.': '02', 'มี.ค.': '03', 'เม.ย.': '04',
            'พ.ค.': '05', 'มิ.ย.': '06', 'ก.ค.': '07', 'ส.ค.': '08',
            'ก.ย.': '09', 'ต.ค.': '10', 'พ.ย.': '11', 'ธ.ค.': '12'
        };

        let billDate;

        if (billDateStr.includes(' ')) {
            const [day, thMonth, year] = billDateStr.split(' ');
            const month = thMonthMap[thMonth] || '01';
            billDate = new Date(`${year}-${month}-${day}`);
        } else if (billDateStr.includes('/')) {
            const [day, month, year] = billDateStr.split('/');
            billDate = new Date(`${year}-${month}-${day}`);
        } else {
            billDate = new Date(billDateStr);
        }

        if (isNaN(billDate)) {
            document.getElementById('param13').value = '';
            return;
        }

        billDate.setDate(billDate.getDate() + parseInt(creditStr, 10));

        const yyyy = billDate.getFullYear();
        const mm = String(billDate.getMonth() + 1).padStart(2, '0');
        const dd = String(billDate.getDate()).padStart(2, '0');
        const thaiMonth = monthMap[mm] || mm;

        const dueDateStr = `${dd} ${thaiMonth} ${yyyy}`;

        document.getElementById('param13').value = dueDateStr;
    }
    document.addEventListener('DOMContentLoaded', function () {
        const TableBodyBilling = document.querySelector('#AddRowBilling tbody');

        function CreateRowBilling(isLast = false) {
            const row = document.createElement('tr');

            const col0 = document.createElement('td');
            col0.className = 'text-center'; 
            const addBtn = document.createElement('button');
            addBtn.type = 'button';
            addBtn.textContent = 'เพิ่ม';
            
            addBtn.className = 'btn btn-add bg-green-500 text-white px-2 py-1 rounded';
            if (!isLast) {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
            col0.appendChild(addBtn);
            row.appendChild(col0);

            const fields = [
                { type: 'text', id: 'param4' },
                { type: 'number', id: 'param5' },
                { type: 'number', id: 'param6' },
                { type: 'number', id: 'param7' },
                { type: 'text', id: 'param8' },
                { type: 'datetime-local', id: 'param9' }
            ];

            fields.forEach(field => {
                const td = document.createElement('td');
                if (field.id === 'param9') {
                    td.classList.add('datetimeContainer');
                    td.style.cursor = 'pointer';
                }
                td.innerHTML = `<input type="${field.type}" id="${field.id}" placeholder="-" value="" autocomplete="off"
                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500
                    disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500
                    dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700
                    dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" />`;
                row.appendChild(td);
            });

            const delCell = document.createElement('td');
            delCell.className = 'text-center'; 
            const delBtn = document.createElement('button');
            delBtn.type = 'button';
            delBtn.textContent = 'ลบ';
            delBtn.className = 'btn btn-del bg-red-500 text-white px-2 py-1 rounded';
            delCell.appendChild(delBtn);
            row.appendChild(delCell);

            TableBodyBilling.appendChild(row);
            BindEventsBilling(); 
            BindDatetimeBilling();
        }
        function BindDatetimeBilling() {
            document.querySelectorAll('.datetimeContainer').forEach(td => {
                const input = td.querySelector('input[type="datetime-local"]');
                if (input) {
                    input.onchange = function() {
                        this.blur();
                    };
                }
                td.onclick = function() {
                    if (input) input.showPicker();
                };
            });
        }
        function BindEventsBilling() {
            const rows = TableBodyBilling.querySelectorAll('tr');
            const addButtons = TableBodyBilling.querySelectorAll('.btn-add');
            const delButtons = TableBodyBilling.querySelectorAll('.btn-del');

            addButtons.forEach((btn, index) => {
                btn.disabled = index !== addButtons.length - 1;
                if (btn.disabled) {
                    btn.classList.add('opacity-50', 'cursor-not-allowed');
                    btn.onclick = null;
                } else {
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    btn.onclick = () => CreateRowBilling(true);
                }
            });

            rows.forEach((row, index) => {
                const delBtn = row.querySelector('.btn-del');
                if (index === 0) {
                    if (delBtn) {
                        delBtn.remove();
                    }
                } else {
                    if (!delBtn) {
                        const cell = row.cells[5];
                        const newDelBtn = document.createElement('button');
                        newDelBtn.type = 'button';
                        newDelBtn.textContent = 'ลบ';
                        newDelBtn.className = 'btn btn-del bg-red-500 text-white px-2 py-1 rounded';
                        cell.appendChild(newDelBtn);
                    }
                }
            });

            document.querySelectorAll('.btn-del').forEach(btn => {
                btn.onclick = () => {
                    const row = btn.closest('tr');
                    row.remove();
                    BindEventsBilling(); 
                };
            });
        }

        BindEventsBilling();
    });
</script>
</body>
</html>