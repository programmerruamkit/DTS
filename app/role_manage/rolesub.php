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
                        <h5 class="text-16">จัดการสิทธิ์ใช้งานเมนู</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <div class="shrink-0">     
                                <a href="เพิ่มสิทธิ์ใช้งานเมนู-<?=$_GET['id']?>.html">                            
                                    <button aria-label="button" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มสิทธิ์ใช้งานเมนู</span>
                                    </button>
                                </a>&emsp;
                                <a href="จัดการสิทธิ์.html">
                                    <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                                        <i data-lucide="undo-2" class="inline-block size-4"></i> <span class="align-middle">ย้อนกลับ</span>
                                    </button>
                                </a>
                            </div>
                             <br>
                            <table id="borderedTable" class="bordered group" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ชื่อเมนูตามสิทธิ์ใช้งาน</th>
                                        <th>กลุ่มเมนู</th>
                                        <th>พื้นที่</th>
                                        <th>สถานะสิทธิ์เมนู</th>
                                        <th>สถานะสิทธิ์</th>
                                        <th>สถานะใช้งาน</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=0;
                                        $query_rolesub = $conn->prepare("SELECT RM.RM_ID,RM.RM_CODE,RM.RU_ID,RU.RU_NAME,RM.MN_ID,MN.MN_NAME,RM.AREA,MN.MN_LEVEL,RM.RM_STATUS,RU.RU_STATUS,MN.MN_STATUS
                                            FROM dbo.ROLE_MENU AS RM
                                            LEFT JOIN dbo.ROLE_USER AS RU	ON RU.RU_ID = RM.RU_ID
                                            LEFT JOIN dbo.MENU AS MN ON MN.MN_ID = RM.MN_ID
                                            WHERE RM.RU_ID = :GET_RU_ID AND NOT RM.RM_STATUS ='D' ORDER BY RM.RM_ID ASC") or die($conn->error);
                                        $query_rolesub->execute(array(":GET_RU_ID" => $_GET['id']));
                                        while($rs_rolesub = $query_rolesub->fetch(PDO::FETCH_OBJ)) { 
                                            $no++;
                                            $RU_ID=$rs_rolesub->RU_ID;
                                            $RU_NAME=$rs_rolesub->RU_NAME;
                                            $MN_ID=$rs_rolesub->MN_ID;
                                    ?>                                        
                                        <tr align="center">
                                            <td align="center"><?php print "$no.";?></td>
                                            <td align="left"><?php echo $rs_rolesub->MN_NAME; ?></td>
                                            <td align="left"><?php if($rs_rolesub->MN_LEVEL=="1"){print "<font color='black'>MAIN</font>";}else{print "<font color='black'>SUB</font>";}?></td>
                                            <td align="center" ><?php print $rs_rolesub->AREA; ?></td>
                                            <td align="center"><?php if($rs_rolesub->RM_STATUS=="Y"){print "<img src='assets/images/check_true.gif' alt='pic' width='16' height='16'>";}else{print "<img src='assets/images/check_del.gif' alt='pic' width='16' height='16'>";}?></td>
                                            <td align="center"><?php if($rs_rolesub->RU_STATUS=="Y"){print "<img src='assets/images/check_true.gif' alt='pic' width='16' height='16'>";}else{print "<img src='assets/images/check_del.gif' alt='pic' width='16' height='16'>";}?></td>
                                            <td align="center"><?php if($rs_rolesub->MN_STATUS=="Y"){print "<img src='assets/images/check_true.gif' alt='pic' width='16' height='16'>";}else{print "<img src='assets/images/check_del.gif' alt='pic' width='16' height='16'>";}?></td>
                                            <td align="center">
                                                <div class="flex justify-center gap-2">
                                                    <div class="edit">
                                                        <a href="แก้ไขสิทธิ์ใช้งานเมนู-<?php echo $_GET['id'];?>-<?php echo $rs_rolesub->RM_ID;?>.html">
                                                            <button aria-label="button" class="py-1 text-xs text-black btn bg-yellow-500 border-yellow-500 hover:text-black hover:bg-yellow-600 hover:border-yellow-600 focus:text-black focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-black active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20 edit-item-btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="remove">
                                                        <button aria-label="button" type="button" onclick="swaldelete_role_sub('<?php print $rs_rolesub->RM_CODE; ?>','<?php print $no;?>','<?php echo $_GET['id'];?>')" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>   
                                    <?php } ?>
                                </tbody>
                            </table>
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
<script src="assets/js/datatables/jszip.min.js"></script>
<script src="assets/js/datatables/pdfmake.min.js"></script>
<script src="assets/js/datatables/buttons.html5.min.js"></script>
<script src="assets/js/datatables/buttons.print.min.js"></script>
<script src="assets/js/datatables/datatables.init.js"></script>

<script>
    $(document).ready(function () {
        $("#word").keyup(function () {
            $.post("NEW/autocomplete.php", { word: $("#word").val() },
                function (data, status) {
                    $("#hint").html(data);
                });
        });
    });
    function setterm(term) {
        $("#word").val(term);
        $("#hint").html('');
    }
</script>
</body>
</html>