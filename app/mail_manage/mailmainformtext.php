<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='ตั้งค่าการส่งเมล.html';
    $_SESSION['DROPDOWN']='null';
    $_SESSION['DROPDOWN_ID']='null';

    $sql_mail_edit = $conn->prepare("SELECT * FROM NOTIFICATIONS_MAIL WHERE NTFM_ID = :NTFM_ID");
    $sql_mail_edit->execute(array(":NTFM_ID" => $_GET['id']));
    $rs_mail_edit = $sql_mail_edit->fetch(PDO::FETCH_OBJ);
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
                            <h5 class="text-16">แก้ไขข้อความแจ้งเตือน:                            
                            <?php 
                                if($rs_mail_edit->NTFM_GROUP == "Paid"){
                                    echo "ชำระเงินเสร็จสิ้น";
                                } else if($rs_mail_edit->NTFM_GROUP == "Pending"){
                                    echo "รอการชำระเงิน";
                                } else if($rs_mail_edit->NTFM_GROUP == "Overdue"){
                                    echo "เกินกำหนดชำระ";
                                } else if($rs_mail_edit->NTFM_GROUP == "Cancelled"){
                                    echo "ยกเลิก";
                                } else if($rs_mail_edit->NTFM_GROUP == "Payment"){
                                    echo "แจ้งเตือนชำระเงิน";
                                } else {
                                    echo $rs_mail_edit->NTFM_GROUP;
                                }
                            ?>
                        </h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">                        
                            <form name="form2" method="post">
                                <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-3">
                                    <div class="mb-3">
                                        <label class="inline-block mb-2 text-base font-medium"><b>ข้อความที่ต้องการส่งไปในเมล:</b><br>&nbsp;</label>
                                        <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-1">
                                            <textarea id="param5" rows="10" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"><?php echo $rs_mail_edit->NTFM_MESSAGE; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="inline-block mb-2 text-base font-medium"><b>To (อีเมลผู้รับ, คั่นด้วย comma):</b><br>
                                            ตัวอย่าง: admin@example.com, anotheruser@gmail.com
                                        </label>
                                        <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-1">
                                            <textarea id="param3" rows="10" required class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"><?php echo htmlspecialchars($rs_mail_edit->NTFM_SENDTOMAIN); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="inline-block mb-2 text-base font-medium"><b>CC (สำเนาถึง, คั่นด้วย comma):</b><br>
                                            ตัวอย่าง: admin@example.com, anotheruser@gmail.com
                                        </label>
                                        <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-1">
                                            <textarea id="param4" rows="10" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"><?php echo htmlspecialchars($rs_mail_edit->NTFM_SENDTOCC); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-1">
                                    <div class="mb-3">
                                        <label class="inline-block mb-2 text-base font-medium">&nbsp;</label><br>    
                                        <input type="text" id="param1" name="param1" value="<?php echo $rs_mail_edit->NTFM_GROUP; ?>" hidden>
                                        <input type="text" id="param2" name="param2" value="<?php echo $rs_mail_edit->NTFM_TYPE; ?>" hidden>
                                        <input type="text" id="param6" name="param6" value="<?php echo $rs_mail_edit->NTFM_STATUS; ?>" hidden>
                                        <input type="text" id="cheparam3" name="cheparam3" value="cheparam3" hidden>
                                        <div class="flex justify-center items-center gap-2">
                                            <input type="hidden" name="PROC" id="PROC" value="edittext">
                                            <a href="ตั้งค่าการส่งเมล.html">
                                                <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600">ย้อนกลับ</button>
                                            </a>
                                            <button aria-label="button" type="button" onclick="ManageNotiMailMain('<?php echo $rs_mail_edit->NTFM_CODE; ?>')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">บันทึกการแก้ไข</button>
                                        </div>
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