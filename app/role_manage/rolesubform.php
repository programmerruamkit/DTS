<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='จัดการสิทธิ์.html';
    $_SESSION['DROPDOWN']='14';
    $_SESSION['DROPDOWN_ID']='21'; 
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
                        <?php if(isset($_GET['rmid'])){ ?>
                            <h5 class="text-16">แก้ไขสิทธิ์ใช้งานเมนู</h5>
                        <?php }else{ ?>
                            <h5 class="text-16">เพิ่มสิทธิ์ใช้งานเมนู</h5>
                        <?php } ?>
                    </div>
                </div>
                <?php
                    if(isset($_GET['rmid'])){
                        $rmid = $_GET['rmid'];
                    }else{
                        $rmid = '';
                    }
                    $sql_rolesub_edit = $conn->prepare("SELECT RM.RM_ID, RM.RU_ID, RM.MN_ID, RM.AREA, RM.RM_STATUS, RM.RM_CODE, MN.MN_CODE, MN.MN_NAME, MN.MN_STATUS FROM dbo.ROLE_MENU AS RM LEFT JOIN dbo.MENU AS MN ON MN.MN_ID = RM.MN_ID WHERE RM_ID = :RM_ID");
                    $sql_rolesub_edit->execute(array(":RM_ID" => $rmid));
                    $rs_rolesub_edit = $sql_rolesub_edit->fetch(PDO::FETCH_OBJ);
                ?>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <form name="form1" method="post">
                                <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-3">
                                    <div class="mb-3">
                                        <label for="userId" class="inline-block mb-2 text-base font-medium">ค้นหาเมนู</label>
                                        <select name="MN_ID" id="MN_ID" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" id="choices-multiple-groups" name="choices-multiple-groups" data-choices="" data-choices-multiple-groups="true">
                                            <option value="">------พิมพ์ชื่อเมนู------</option>
                                            <?php
                                                $query_selmainrole = $conn->query("SELECT * FROM MENU WHERE MN_STATUS='Y'") or die($conn->error);
                                                while($result_selmainrole = $query_selmainrole->fetch(PDO::FETCH_OBJ)) { 
                                            ?>
                                            <option value="<?=$result_selmainrole->MN_ID;?>" <?php if(isset($rs_rolesub_edit->MN_ID)){if($result_selmainrole->MN_ID == $rs_rolesub_edit->MN_ID){ echo "selected"; }}?>><?=$result_selmainrole->MN_NAME;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3" style="display:block">
                                        <label for="statusSelect" class="inline-block mb-2 text-base font-medium">สถานะเมนู</label>
                                        <select name="RM_STATUS" id="RM_STATUS" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices="" data-choices-search-false="">
                                            <option value="">------โปรดเลือก------</option>
                                            <option value="Y" <?php if(isset($rs_rolesub_edit->MN_ID)){if($rs_rolesub_edit->RM_STATUS=='Y'){echo 'selected';}}?>>เปิดใช้งาน</option>
                                            <option value="N" <?php if(isset($rs_rolesub_edit->MN_ID)){if($rs_rolesub_edit->RM_STATUS=='N'){echo 'selected';}}?>>ปิดใช้งาน</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">    
                                        <label for="statusSelect" class="inline-block mb-2 text-base font-medium">&nbsp;</label><br>
                                        <input type="hidden" name="RU_ID" id="RU_ID" value="<?=$_GET['id']; ?>">
                                        <input type="hidden" name="RM_ID" id="RM_ID" value="<?=$rmid; ?>">
                                        <input type="hidden" name="AREA" id="AREA" value="<?=$_SESSION["AD_AREA"];?>">
                                        <?php if(isset($_GET['rmid'])){ ?>
                                            <input type="hidden" name="PROC" id="PROC" value="edit">
                                            <button aria-label="button" type="button" onclick="ManageRoleSub('<?php echo $rs_rolesub_edit->RM_ID; ?>','')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">แก้ไขสิทธิ์ใช้งานเมนู</button>
                                        <?php }else{ ?>
                                            <input type="hidden" name="PROC" id="PROC" value="add">
                                            <button aria-label="button" type="button" onclick="ManageRoleSub('ADD','')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">เพิ่มสิทธิ์ใช้งานเมนู</button>
                                        <?php } ?>
                                        &emsp;
                                        <a href="สิทธิ์ใช้งานเมนู-<?=$_GET['id'];?>.html">
                                            <button aria-label="button" type="button" data-modal-close="AddMenuModal" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10" data-modal-close="AddMenuModal">ย้อนกลับ</button>
                                        </a>
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