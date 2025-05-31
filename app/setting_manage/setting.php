<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='ข้อมูลเว็บ.html';
    $_SESSION['DROPDOWN']='14';
    $_SESSION['DROPDOWN_ID']='15';
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
                        <?php if(isset($_GET['id'])){ ?>
                            <h5 class="text-16">แก้ไขข้อมูลเว็บ</h5>
                        <?php }else{ ?>
                            <h5 class="text-16">ข้อมูลเว็บ</h5>
                        <?php } ?>
                    </div>
                </div> 
                <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $style = "";
                    }else{
                        $id = '';
                        $style = "disabled";
                    }
                    $query_setting = $conn->prepare("SELECT * FROM SETTING") or die($conn->error);
                    $query_setting->execute();
                    while($rs_setting = $query_setting->fetch(PDO::FETCH_OBJ)) { 
                ?>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <div class="shrink-0">  
                                <div class="edit">
                                    <?php if(isset($_GET['id'])){ ?>
                                        <button aria-label="button" disabled class="text-white btn bg-yellow-200 border-yellow-200">แก้ไข</button>
                                    <?php }else{ ?>
                                        <a href="แก้ไขข้อมูลเว็บ-<?php echo $rs_setting->ST_ID; ?>.html">
                                            <button aria-label="button" class="text-black btn bg-yellow-500 border-yellow-500 hover:text-black hover:bg-yellow-600 hover:border-yellow-600 focus:text-black focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-black active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20 edit-item-btn">แก้ไข</button>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <br>
                            <form name="form2" method="post">
                                <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-3">
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">ชื่อเว็บ</label>
                                        <input <?=$style?> type="text" name="param1" id="param1" value="<?php echo $rs_setting->ST_TITLE; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="ชื่อเว็บ" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">ชื่อระบบ - ไทย</label>
                                        <input <?=$style?> type="text" name="param2" id="param2" value="<?php echo $rs_setting->ST_NAMETH; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="ชื่อระบบ - ไทย" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">ชื่อระบบ - อังกฤษ</label>
                                        <input <?=$style?> type="text" name="param3" id="param3" value="<?php echo $rs_setting->ST_NAMEEN; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="ชื่อระบบ - อังกฤษ" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">ตัวย่อระบบ - อังกฤษ</label>
                                        <input <?=$style?> type="text" name="param4" id="param4" value="<?php echo $rs_setting->ST_NAMEEN_SHOT; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="ตัวย่อระบบ - อังกฤษ" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">ICON</label>
                                        <input <?=$style?> type="text" name="param5" id="param5" value="<?php echo $rs_setting->ST_ICON; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="ICON" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">LOGO LIGHT</label>
                                        <input <?=$style?> type="text" name="param6" id="param6" value="<?php echo $rs_setting->ST_LOGO_LIGHT; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="LOGO LIGHT" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">LOGO DARK</label>
                                        <input <?=$style?> type="text" name="param7" id="param7" value="<?php echo $rs_setting->ST_LOGO_DARK; ?>" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="LOGO DARK" autocomplete="off">
                                    </div>
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">รายละเอียด 1</label>
                                        <textarea <?=$style?> name="param8" id="param8" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" rows="5" placeholder="รายละเอียด 1" autocomplete="off"><?php echo $rs_setting->ST_DES0; ?></textarea>

                                    </div>
                                    <div class="mb-4">
                                        <label class="inline-block mb-2 text-base font-medium">รายละเอียด 2</label>
                                        <textarea <?=$style?> name="param9" id="param9" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" rows="5" placeholder="รายละเอียด 2" autocomplete="off"><?php echo $rs_setting->ST_DES1; ?></textarea>
                                    </div>
                                </div>  
                                <?php if(isset($_GET['id'])){ ?>
                                    <div class="flex justify-center gap-2">
                                        <input type="hidden" name="PROC" id="PROC" value="edit">
                                        <a href="ข้อมูลเว็บ.html">
                                            <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">ยกเลิก</button>
                                        </a>
                                        <button aria-label="button" type="button" onclick="ManageSetting('<?php echo $rs_setting->ST_ID; ?>')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">บันทึกการแก้ไข</button>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                <!-- Close Section ############################################################## -->
                 <?php } ?>
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