<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='จัดการการแจ้งเตือน.html';
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
                        <h5 class="text-16">จัดการการแจ้งเตือน</h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <?php if($_SESSION["AD_ROLE_NAME"]=='MASTER'){ ?>
                                <div class="shrink-0">                                        
                                    <button aria-label="button" data-modal-target="AddNotiModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">เพิ่มการแจ้งเตือน</span>
                                    </button>
                                </div>
                                <br>
                            <?php } ?>
                            <?php if($_SESSION["AD_ROLE_NAME"]=='MASTER'){ ?>
                                <font color="red">1 ประเภทการแจ้งเตือน สามารถเปิดใช้งานได้เพียง 1 ตัวเท่านั้น เช่น เมื่อมีประเภท->ชำระเงินแล้ว กับสถานะ->กำลังใช้งาน</font>
                                <font color="red"><br>จะไม่สามารถเปิดใช้งานประเภท->ชำระเงินแล้วได้อีก</font>
                                <font color="red"><br>ถ้าจะสร้างการแจ้งเตือนใหม่ ต้องทำการปิดการใช้งานประเภทที่มีอยู่ก่อน</font>
                            <?php } ?>
                            <table id="borderedTable" class="bordered group" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="10%">ลำดับ</th>
                                        <th width="20%">ประเภทการแจ้งเตือน</th>
                                        <th width="20%">รูปแบบการแจ้งเตือน</th>
                                        <?php if($_SESSION["AD_ROLE_NAME"]=='MASTER'){ ?>
                                            <th width="20%">TOKEN</th>
                                            <th width="20%">CHANNEL</th>
                                        <?php } ?>
                                        <th width="20%">ข้อความ</th>
                                        <?php if($_SESSION["AD_ROLE_NAME"]=='MASTER'){ ?>
                                            <th width="10%">สถานะ</th>
                                            <th width="10%">จัดการ</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no=0;
                                        $query_notify = $conn->prepare("SELECT * FROM NOTIFICATIONS WHERE NTF_STATUS != 'D' AND NTF_AREA = '".$_SESSION["AD_AREA"]."'") or die($conn->error);
                                        $query_notify->execute();
                                        while($rs_notify = $query_notify->fetch(PDO::FETCH_OBJ)) { 
                                            $no++;
                                    ?>                       
                                    <tr align="center">
                                        <td align="center"><?php print "$no.";?></td>
                                        <td align="left">
                                            <?php 
                                                if($rs_notify->NTF_GROUP == "Paid"){
                                                    echo "ชำระเงินเสร็จสิ้น";
                                                } else if($rs_notify->NTF_GROUP == "Pending"){
                                                    echo "รอการชำระเงิน";
                                                } else if($rs_notify->NTF_GROUP == "Overdue"){
                                                    echo "เกินกำหนดชำระ";
                                                } else if($rs_notify->NTF_GROUP == "Cancelled"){
                                                    echo "ยกเลิก";
                                                } else if($rs_notify->NTF_GROUP == "Payment"){
                                                    echo "แจ้งเตือนชำระเงิน";
                                                } else {
                                                    echo $rs_notify->NTF_GROUP;
                                                }
                                            ?>
                                        </td>
                                        <td align="left"><?php echo $rs_notify->NTF_TYPE; ?></td>
                                        <?php if($_SESSION["AD_ROLE_NAME"]=='MASTER'){ ?>
                                            <td align="center">
                                                <?php 
                                                    $token = $rs_notify->NTF_TOKEN;
                                                    if (strlen($token) > 10) {
                                                        echo substr($token, 0, 5) . '...' . substr($token, -5);
                                                    } else {
                                                        echo $token;
                                                    }
                                                ?>
                                            </td>
                                            <td align="center"><?php echo $rs_notify->NTF_CHANNEL; ?></td>
                                        <?php } ?>
                                        <td align="center">
                                            <?php $message = $rs_notify->NTF_MESSAGE; if (strlen($message) > 10) { ?>
                                                <a href="แก้ไขการข้อความแจ้งเตือน-<?php echo $rs_notify->NTF_ID; ?>.html">
                                                    <button aria-label="button" type="button" class="text-white btn bg-green-400 border-green-400 hover:text-white hover:bg-green-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-letter-text-icon lucide-letter-text"><path d="M15 12h6"/><path d="M15 6h6"/><path d="m3 13 3.553-7.724a.5.5 0 0 1 .894 0L11 13"/><path d="M3 18h18"/><path d="M4 11h6"/></svg>
                                                    </button>
                                                </a>
                                            <?php } else { ?>
                                                <a href="แก้ไขการข้อความแจ้งเตือน-<?php echo $rs_notify->NTF_ID; ?>.html">
                                                    <button aria-label="button" type="button" class="text-white btn bg-slate-300 border-slate-300 hover:text-white hover:bg-slate-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-letter-text-icon lucide-letter-text"><path d="M15 12h6"/><path d="M15 6h6"/><path d="m3 13 3.553-7.724a.5.5 0 0 1 .894 0L11 13"/><path d="M3 18h18"/><path d="M4 11h6"/></svg>
                                                    </button>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <?php if($_SESSION["AD_ROLE_NAME"]=='MASTER'){ ?>
                                            <td align="center">
                                                <?php 
                                                    if($rs_notify->NTF_STATUS == "Y"){
                                                        print "<img src='assets/images/check_true.gif' alt='pic' width='16' height='16'>";
                                                    } else {
                                                        print "<img src='assets/images/check_del.gif' alt='pic' width='16' height='16'>";
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <div class="flex justify-center gap-2">
                                                    <div class="edit">
                                                        <a href="แก้ไขการแจ้งเตือน-<?php echo $rs_notify->NTF_ID; ?>.html">
                                                            <button aria-label="button" class="py-1 text-xs text-black btn bg-yellow-500 border-yellow-500 hover:text-black hover:bg-yellow-600 hover:border-yellow-600 focus:text-black focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-black active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20 edit-item-btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="remove">
                                                        <button aria-label="button" type="button" onclick="swaldelete_noti_main('<?php print $rs_notify->NTF_CODE; ?>','<?php print $no;?>')" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php } ?>
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
<!-- INSERT MODAL -->
<div id="AddNotiModal" modal-center="" class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show ">
    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">
        <div class="flex items-center justify-between p-4 border-b dark:border-zink-300/20">
            <h5 class="text-16">เพิ่มการแจ้งเตือนใหม่</h5>
            <button aria-label="button" data-modal-close="AddNotiModal" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500"><i data-lucide="x" class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
            <form name="form1" method="post">
                <div class="mb-3">
                    <label for="param1" class="inline-block mb-2 text-base font-medium">ประเภทการแจ้งเตือน</label>
                    <select name="param1" id="param1" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 text-slate-400 dark:text-zink-200">
                        <option value="">------โปรดเลือก------</option>
                        <option value="Payment">แจ้งเตือนชำระเงิน</option>
                        <option value="Paid">ชำระเงินเสร็จสิ้น</option>
                        <option value="Pending">รอการชำระเงิน</option>
                        <option value="Overdue">เกินกำหนดชำระ</option>
                        <option value="Cancelled">ยกเลิก</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="param2" class="inline-block mb-2 text-base font-medium">รูปแบบการแจ้งเตือน</label>
                    <select name="param2" id="param2" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 text-slate-400 dark:text-zink-200">
                        <!-- <option value="">------โปรดเลือก------</option> -->
                        <option value="Telegram" selected>Telegram</option>
                        <!-- <option value="E-mail">E-mail</option> -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="param3" class="inline-block mb-2 text-base font-medium">TOKEN</label>
                    <input type="text" name="param3" id="param3" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="กรอก TOKEN" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="param4" class="inline-block mb-2 text-base font-medium">CHANNEL</label>
                    <input type="text" name="param4" id="param4" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="กรอก CHANNEL" autocomplete="off">
                </div>
                <div class="mb-3 hidden">
                    <label for="param5" class="inline-block mb-2 text-base font-medium">ข้อความ</label>
                    <input type="text" name="param5" id="param5" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="กรอกข้อความ" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="param6" class="inline-block mb-2 text-base font-medium">สถานะใช้งาน</label>
                    <select name="param6" id="param6" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 text-slate-400 dark:text-zink-200">
                        <option value="">------โปรดเลือก------</option>
                        <option value="Y">เปิดใช้งาน</option>
                        <option value="N">ปิดใช้งาน</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <input type="hidden" name="PROC" id="PROC" value="add">
                    <button aria-label="button" type="button" data-modal-close="AddNotiModal" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600">ปิด</button>
                    <button aria-label="button" type="button" onclick="ManageNotiMain('ADD','')" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600">เพิ่มข้อมูล</button>
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
</body>
</html>