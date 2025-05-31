<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='สมุดคุมเลขที่วางบิล.html';
    $_SESSION['DROPDOWN']='null';  

    $sql_billing_edit = $conn->prepare("SELECT BLB_ID,BILLING_BOOK.BLB_CODE,BLB_CYCLE,BLB_NUMINVOICE,BLB_DEBTORNAME,BLB_NUMPO,BLB_NUMTONS,BLB_NUMTRIPS,BLB_NUMPRICE,BLB_REMARK,BILLING_NOTIFICATION.BLN_DATEALERT AS BLB_DATEALERT,BLB_STATUS,BLB_CREATEBY,BLB_CREATEDATE,BLB_EDITBY,BLB_EDITDATE
    FROM BILLING_BOOK LEFT JOIN BILLING_NOTIFICATION ON BILLING_NOTIFICATION.BLB_CODE = BILLING_BOOK.BLB_CODE WHERE BLB_ID = :BLB_ID AND BLN_STATUS != 'D'");
    $sql_billing_edit->execute(array(":BLB_ID" => $_GET['id']));
    $rs_billing_edit = $sql_billing_edit->fetch(PDO::FETCH_OBJ);
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
                        <h5 class="text-16">แก้ไขใบวางบิล เลขที่: <?php echo $rs_billing_edit->BLB_NUMINVOICE ?></h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <form name="form2" method="post">
                                <!-- <div class="grid grid-cols-2 gap-x-5 md:grid-cols-2 xl:grid-cols-3"> -->
                                <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                                    
                                    <div class="xl:col-span-4 relative group cursor-pointer">
                                        <label for="param1" class="inline-block mb-2 text-base font-medium">รอบการวางบิล</label>
                                        <input type="text" id="param1" placeholder="เลือกรอบการวางบิล" value="<?php echo $rs_billing_edit->BLB_CYCLE?>" autocomplete="off"  class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-provider="flatpickr" data-date-format="d M Y" data-range-date="true" readonly="readonly">
                                    </div>
                                    <!-- <div class="xl:col-span-4">
                                        <label for="param1" class="inline-block mb-2 text-base font-medium">รอบการวางบิล</label>
                                        <input type="text" id="param1" placeholder="กรอกรอบการวางบิล" value="<?php echo $rs_billing_edit->BLB_CYCLE?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div> -->
                                    <div class="xl:col-span-4 hidden">
                                        <label for="param2" class="inline-block mb-2 text-base font-medium">เลขที่ใบแจ้งหนี้</label>
                                        <input type="text" id="param2" placeholder="กรอกเลขที่ใบแจ้งหนี้" value="<?php echo $rs_billing_edit->BLB_NUMINVOICE?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>
                                    <div class="xl:col-span-4">
                                        <label for="param3" class="inline-block mb-2 text-base font-medium">รายชื่อลูกค้า</label>
                                        <select name="param3" id="param3" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices="">
                                            <option value="">------โปรดเลือก------</option>
                                            <?php 
                                                $SESSION_AREA = $_SESSION["AD_AREA"];
                                                $BLB_DEBTORNAME=$rs_billing_edit->BLB_DEBTORNAME;
                                                $query_owner = $conn->prepare("SELECT DT_ID,DT_CODE,DT_NAME FROM DEBTOR A WHERE DT_STATUS='Y' AND DT_AREA = '$SESSION_AREA' ORDER BY DT_ID ASC");
                                                $query_owner->execute();
                                                while($rs_owner = $query_owner->fetch( PDO::FETCH_OBJ )) { 
                                            ?>
                                                <option value="<?php echo $rs_owner->DT_CODE ?>" <?php if($rs_owner->DT_CODE==$BLB_DEBTORNAME){echo "selected";}else{echo "";}?>><?php echo $rs_owner->DT_NAME ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="xl:col-span-4">
                                        <label for="param4" class="inline-block mb-2 text-base font-medium">เลขที่ PO</label>
                                        <input type="text" id="param4" placeholder="กรอกเลขที่ PO" value="<?php echo $rs_billing_edit->BLB_NUMPO?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>
                                    <div class="xl:col-span-4">
                                        <label for="param5" class="inline-block mb-2 text-base font-medium">จำนวนตัน</label>
                                        <input type="number" id="param5" placeholder="กรอกจำนวนตัน" value="<?php echo $rs_billing_edit->BLB_NUMTONS ?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>
                                    <div class="xl:col-span-4">
                                        <label for="param6" class="inline-block mb-2 text-base font-medium">จำนวนเที่ยว</label>
                                        <input type="number" id="param6" placeholder="กรอกจำนวนเที่ยว" value="<?php echo $rs_billing_edit->BLB_NUMTRIPS ?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>
                                    <div class="xl:col-span-4">
                                        <label for="param7" class="inline-block mb-2 text-base font-medium">จำนวนเงิน</label>
                                        <input type="number" id="param7" placeholder="กรอกจำนวนเงิน" value="<?php echo $rs_billing_edit->BLB_NUMPRICE ?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>
                                    <div class="xl:col-span-4">
                                        <label for="param8" class="inline-block mb-2 text-base font-medium">หมายเหตุ</label>
                                        <input type="text" id="param8" placeholder="กรอกหมายเหตุ" value="<?php echo $rs_billing_edit->BLB_REMARK ?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>
                                    <div class="xl:col-span-4 relative group cursor-pointer" id="datetimeContainer">
                                        <label for="param9" class="inline-block mb-2 text-base font-medium">วันที่แจ้งเตือน</label>
                                        <input type="datetime-local" id="param9" placeholder="กรอกวันที่แจ้งเตือน" value="<?php echo $rs_billing_edit->BLB_DATEALERT ?>" autocomplete="off" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-black dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>
                                    <div class="xl:col-span-6">
                                        <label for="stateInput" class="inline-block mb-2 text-base font-medium">&nbsp;</label><br>
                                        <input type="hidden" name="PROC" id="PROC" value="edit">
                                        <a href="สมุดคุมเลขที่วางบิล.html">
                                            <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">ย้อนกลับ</button>
                                        </a>
                                        <button aria-label="button" type="button" onclick="ManageBilling('<?php echo $rs_billing_edit->BLB_CODE ?>')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">บันทึกการแก้ไข</button>
                                    </div>
                                </div>
                            </form>
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
</body>
</html>