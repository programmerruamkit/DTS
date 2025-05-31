<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='จัดการลูกหนี้.html';
    $_SESSION['DROPDOWN']='null';  
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
                        <h5 class="text-16">แก้ไขลูกหนี้</h5>
                    </div>
                </div>
                <?php
                    $sql_debtor_edit = $conn->prepare("SELECT * FROM DEBTOR WHERE DT_ID = :DT_ID");
                    $sql_debtor_edit->execute(array(":DT_ID" => $_GET['id']));
                    $rs_debtor_edit = $sql_debtor_edit->fetch(PDO::FETCH_OBJ);
                ?>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <form name="form2" method="post">
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
                                                <option value="<?php echo $rs_company->COMPANYCODE ?>" <?php if($rs_debtor_edit->DT_COMPANY==$rs_company->COMPANYCODE){echo 'selected'; }?> ><?php echo $rs_company->COMPANYCODE ?> - <?php echo $rs_company->THAINAME ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>  
                                    <div class="xl:col-span-2">
                                        <label for="param2" class="inline-block mb-2 text-base font-medium">รหัสลูกหนี้</label>
                                        <input type="text" name="param2" id="param2" placeholder="กรอกรหัสลูกหนี้" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_CODECUS ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>          
                                    <div class="xl:col-span-2">
                                        <label for="param3" class="inline-block mb-2 text-base font-medium">ตัวย่อลูกหนี้</label>
                                        <input type="text" name="param3" id="param3" placeholder="กรอกตัวย่อลูกหนี้" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_SHORTNAME ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>          
                                    <div class="xl:col-span-4">
                                        <label for="param4" class="inline-block mb-2 text-base font-medium">ชื่อลูกหนี้</label>
                                        <input type="text" name="param4" id="param4" placeholder="กรอกชื่อลูกหนี้" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_NAME ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>                
                                    <div class="xl:col-span-3">
                                        <label for="param5" class="inline-block mb-2 text-base font-medium">อีเมล</label>
                                        <input type="email" name="param5" id="param5" class="form-input" placeholder="example@email.com" value="<?php echo $rs_debtor_edit->DT_EMAIL ?>">
                                    </div>                
                                    <div class="xl:col-span-2">
                                        <label for="param6" class="inline-block mb-2 text-base font-medium">เบอร์โทรศัพท์</label>
                                        <input type="number" name="param6" id="param6" class="form-input" placeholder="กรอกเบอร์โทรศัพท์" pattern="[0-9]{10}" value="<?php echo $rs_debtor_edit->DT_PHONE ?>">
                                    </div>                
                                    <div class="xl:col-span-5">
                                        <label for="param7" class="inline-block mb-2 text-base font-medium">ที่อยู่</label>
                                        <input type="text" name="param7" id="param7" placeholder="กรอกที่อยู่ลูกหนี้" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_ADDRESS ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div> 
                                    <div class="xl:col-span-2">
                                        <label for="param8" class="inline-block mb-2 text-base font-medium">ประเภทการจ่ายเงิน</label>
                                        <input type="text" name="param8" id="param8" placeholder="-" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_PMT ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>     
                                    <div class="xl:col-span-2">
                                        <label for="param9" class="inline-block mb-2 text-base font-medium">เครดิต</label>
                                        <input type="number" name="param9" id="param9" placeholder="-" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_CD ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>     
                                    <div class="xl:col-span-2">
                                        <label for="param10" class="inline-block mb-2 text-base font-medium">กำหนดจ่ายเงิน</label>
                                        <input type="text" name="param10" id="param10" placeholder="-" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_PMS ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>    
                                    <div class="xl:col-span-2">
                                        <label for="param11" class="inline-block mb-2 text-base font-medium">หัก ณ ที่จ่าย (%)</label>
                                        <input type="number" name="param11" id="param11" placeholder="-" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_WHDT ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>     
                                    <div class="xl:col-span-1">
                                        <label for="param12" class="inline-block mb-2 text-base font-medium">vat (%)</label>
                                        <input type="number" name="param12" id="param12" placeholder="-" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_VAT ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>    
                                    <div class="xl:col-span-3">
                                        <label for="param13" class="inline-block mb-2 text-base font-medium">หมายเหตุ</label>
                                        <input type="text" name="param13" id="param13" placeholder="-" autocomplete="off" required value="<?php echo $rs_debtor_edit->DT_RAMARK ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                    </div>  
                                    <div class="xl:col-span-2">
                                        <label for="stateInput" class="inline-block mb-2 text-base font-medium">สถานะลูกหนี้</label>
                                        <select name="param14" id="param14" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices="" data-choices-search-false="">
                                            <option value="">------โปรดเลือก------</option>
                                            <option value="Y" <?php if($rs_debtor_edit->DT_STATUS=="Y"){print "selected";}else{print "";}?>>เปิดใช้งาน</option>
                                            <option value="N" <?php if($rs_debtor_edit->DT_STATUS=="N"){print "selected";}else{print "";}?>>ปิดใช้งาน</option>
                                        </select>
                                    </div>
                                    <div class="xl:col-span-12 flex gap-2 items-center">
                                        <label for="stateInput" class="inline-block mb-2 text-base font-medium">&nbsp;</label><br>
                                        <input type="hidden" name="PROC" id="PROC" value="edit">
                                        <a href="จัดการลูกหนี้.html">
                                            <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">ย้อนกลับ</button>
                                        </a>
                                        <button aria-label="button" type="button" onclick="ManageDebtor('<?php echo $rs_debtor_edit->DT_CODE ?>')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">บันทึกการแก้ไข</button>
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