<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='ตั้งค่าการส่งเมล.html';
    $_SESSION['DROPDOWN']='null';
    $_SESSION['DROPDOWN_ID']='null';
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
                        <h5 class="text-16">แก้ไขข้อมูลการส่งเมล</h5>
                    </div>
                </div>
                <?php
                    $sql_mail_edit = $conn->prepare("SELECT * FROM NOTIFICATIONS_MAIL WHERE NTFM_ID = :NTFM_ID");
                    $sql_mail_edit->execute(array(":NTFM_ID" => $_GET['id']));
                    $rs_mail_edit = $sql_mail_edit->fetch(PDO::FETCH_OBJ);
                ?>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <form name="form2" method="post">
                                <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-3">
                                    <div class="mb-4">
                                        <label for="param1" class="inline-block mb-2 text-base font-medium">ประเภทการส่งเมล</label>
                                        <select name="param1" id="param1" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                            <option value="Payment" <?php if($rs_mail_edit->NTFM_GROUP == "Payment"){echo "selected";} ?>>แจ้งเตือนชำระเงิน</option>
                                            <option value="Paid" <?php if($rs_mail_edit->NTFM_GROUP == "Paid"){echo "selected";} ?>>ชำระเงินแล้ว</option>
                                            <option value="Pending" <?php if($rs_mail_edit->NTFM_GROUP == "Pending"){echo "selected";} ?>>รอการชำระเงิน</option>
                                            <option value="Overdue" <?php if($rs_mail_edit->NTFM_GROUP == "Overdue"){echo "selected";} ?>>เกินกำหนดชำระ</option>
                                            <option value="Cancelled" <?php if($rs_mail_edit->NTFM_GROUP == "Cancelled"){echo "selected";} ?>>ยกเลิก</option>
                                        </select>
                                    </div>
                                    <div class="mb-4 hidden">
                                        <label for="param2" class="inline-block mb-2 text-base font-medium">รูปแบบการส่งเมล</label>
                                        <select name="param2" id="param2" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                            <option value="Telegram" <?php if($rs_mail_edit->NTFM_TYPE == "Telegram"){echo "selected";} ?>>Telegram</option>
                                            <option value="E-mail" <?php if($rs_mail_edit->NTFM_TYPE == "E-mail"){echo "selected";} ?>>E-mail</option>
                                        </select>
                                    </div>
                                    <div class="mb-4 hidden">
                                        <label for="param3" class="inline-block mb-2 text-base font-medium">TOKEN</label>
                                        <input type="text" name="param3" id="param3" value="<?php echo $rs_mail_edit->NTFM_SENDTOCCMAIN; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" placeholder="กรอก TOKEN" autocomplete="off">
                                    </div>
                                    <div class="mb-4 hidden">
                                        <label for="param4" class="inline-block mb-2 text-base font-medium">CHANNEL</label>
                                        <input type="text" name="param4" id="param4" value="<?php echo $rs_mail_edit->NTFM_SENDTOCC; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" placeholder="กรอก CHANNEL" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label for="param6" class="inline-block mb-2 text-base font-medium">สถานะการส่งเมล</label>
                                        <select name="param6" id="param6" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                            <option value="Y" <?php if($rs_mail_edit->NTFM_STATUS == "Y"){echo "selected";} ?>>เปิดใช้งาน</option>
                                            <option value="N" <?php if($rs_mail_edit->NTFM_STATUS == "N"){echo "selected";} ?>>ปิดใช้งาน</option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="flex justify-center gap-2">
                                    <input type="hidden" name="PROC" id="PROC" value="edit">
                                    <a href="ตั้งค่าการส่งเมล.html">
                                        <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600">ย้อนกลับ</button>
                                    </a>
                                    <button aria-label="button" type="button" onclick="ManageNotiMailMain('<?php echo $rs_mail_edit->NTFM_CODE; ?>')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">บันทึกการแก้ไข</button>
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