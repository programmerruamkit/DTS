<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    if($_SESSION['SIDEBAR']=='ร้องขอสิทธิ์.html'){
        require_once($path.'include/head.php'); 
    }else{
        require_once($path.'config/set_session.php');  
        require_once($path.'include/head.php'); 
        $_SESSION['SIDEBAR']='จัดการสมาชิก.html';
        $_SESSION['DROPDOWN']='null';
    }
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
                        <h5 class="text-16">เพิ่มสิทธิ์สมาชิก</h5>
                    </div>
                </div>
                <?php
                    if(isset($_GET['id'])){
                        $pscc = $_GET['id'];
                        $style = 'disabled';
                    }else{
                        $pscc = '';
                        $style = '';
                    }
                    $query_sel_roleuser = $conn->prepare("EXECUTE ENB_EMPLOYEE :proc,:personCode");
                    $query_sel_roleuser->execute(array(':proc'=>'select_data',':personCode'=>$pscc,));
                    $resul_sel_roleuser = $query_sel_roleuser->fetch( PDO::FETCH_OBJ );
                ?>
                <!-- Open Section  ############################################################## -->
                    <div class="card">
                        <div class="card-body">
                            <form name="form1" method="post">
                                <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-3">
                                    <div class="mb-3">
                                        <label class="inline-block mb-2 text-base font-medium">เลือกพนักงาน</label>
                                        <select <?=$style?> name="RA_PERSONCODE" id="RA_PERSONCODE" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-choices="">
                                            <option value="">------โปรดเลือก------</option>
                                            <?php 
                                                $query_emp = $conn->prepare("EXECUTE ENB_EMPLOYEE :proc");
                                                $query_emp->execute(array(':proc'=>'select_employee',));
                                                while($rs_emp = $query_emp->fetch( PDO::FETCH_OBJ )) { 
                                            ?>
                                                <option value="<?php echo $rs_emp->PersonCode ?>" <?php if(isset($resul_sel_roleuser->PersonCode)){if($resul_sel_roleuser->PersonCode==$rs_emp->PersonCode){echo "selected";}}else{echo "";}; ?>><?php echo $rs_emp->PersonCode.' - '.$rs_emp->nameT ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="inline-block mb-2 text-base font-medium">เลือกสิทธิ์ใช้งาน</label>
                                        <select name="RU_ID" id="RU_ID" class="form-input border-slate-300 focus:outline-none focus:border-custom-500" data-choices="" data-choices-search-false="">
                                            <option value="">------โปรดเลือก------</option>
                                            <?php 
                                                $SESSION_AREA=$_SESSION["AD_AREA"];
                                                $SESSION_ROLE_NAME=$_SESSION["AD_ROLE_NAME"];
                                                if($SESSION_ROLE_NAME=='MASTER'){
                                                    $findquery='select_roleuser';
                                                }else{
                                                    $findquery='select_roleuser_not';
                                                }
                                                $query_role = $conn->prepare("EXECUTE ENB_ROLEUSER :proc,:area");
                                                $query_role->execute(array(':proc'=>$findquery,':area'=>$SESSION_AREA,));
                                                while($rs_role = $query_role->fetch( PDO::FETCH_OBJ )) { 
                                                    echo '<option value="'.$rs_role->RU_ID.'">'.$rs_role->RU_AREA.' - '.$rs_role->RU_NAME.'</option>';
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                    <?php
                                        if(isset($_GET['rqrid'])){
                                            $rqrid = $_GET['rqrid'];
                                        }else{
                                            $rqrid = '';
                                        }
                                    ?>
                                    <div class="mb-3">
                                        <label class="inline-block mb-2 text-base font-medium">&nbsp;</label><br>                        
                                        <?php if(isset($_GET['id'])){ ?>
                                            <input type="hidden" name="PROC" id="PROC" value="addnewrole">
                                            <input type="hidden" name="RA_PASSWORD" id="RA_PASSWORD" value="<?php echo $resul_sel_roleuser->PersonCode; ?>">
                                            <input type="hidden" name="RA_PASSWORD_TEXT" id="RA_PASSWORD_TEXT" value="<?php echo $resul_sel_roleuser->PersonCode; ?>">
                                            <input type="hidden" name="REQUEST_ROLE" id="REQUEST_ROLE" value="<?php echo $rqrid; ?>">
                                            <button aria-label="button" type="button" onclick="ManageUserMain('ADD','')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">เพิ่มสิทธิ์ใช้งานเมนู</button>
                                        <?php }else{ ?>
                                            <input type="hidden" name="PROC" id="PROC" value="add">
                                            <input type="hidden" name="RA_PASSWORD" id="RA_PASSWORD" value="">
                                            <input type="hidden" name="RA_PASSWORD_TEXT" id="RA_PASSWORD_TEXT" value="">
                                            <input type="hidden" name="REQUEST_ROLE" id="REQUEST_ROLE" value="">
                                            <button aria-label="button" type="button" onclick="ManageUserMain('ADD','')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">เพิ่มข้อมูล</button>
                                        <?php } ?>
                                        &emsp;
                                        <?php if($_SESSION['SIDEBAR']=='ร้องขอสิทธิ์.html'){ ?>
                                            <a href="ร้องขอสิทธิ์.html">
                                                <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">ย้อนกลับ</button>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="จัดการสมาชิก.html">
                                                <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/10">ย้อนกลับ</button>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- #################################################################### -->
                    <?php if(isset($_GET['id'])){ ?>
                        <div class="card">
                            <div class="card-body">
                                <table id="borderedTable" class="bordered group" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">ลำดับ</th>
                                            <th width="10%">ชื่อผู้ใช้</th>
                                            <th width="10%">รหัสผ่าน</th>
                                            <th width="10%">รหัสพนักงาน</th>
                                            <th width="15%">ชื่อ - สกุล</th>
                                            <th width="10%">สิทธิ์ใช้งาน</th>
                                            <th width="10%">พื้นที่</th>
                                            <th width="5%">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody><?php 
                                        $query_emp = $conn->prepare("EXECUTE ENB_USERACCOUNT :proc,:username");
                                        $query_emp->execute(array(':proc'=>'check_user',':username'=>$pscc,));
                                        $no=0;
                                        while($result_emp = $query_emp->fetch( PDO::FETCH_OBJ )){ 
                                            $no++;
                                            $RA_ID=$result_emp->RA_ID;
                                            $RU_NAME=$result_emp->RU_NAME;
                                            $RU_AREA=$result_emp->RU_AREA;
                                            $RA_USERNAME=$result_emp->RA_USERNAME;
                                            $RA_PASSWORD=$result_emp->RA_PASSWORD;
                                            if(strlen($RA_PASSWORD) > 15){
                                                $RA_PASSWORD = mb_substr($RA_PASSWORD, 0, 15).'...';
                                            }
                                            $PersonCode=$result_emp->PersonCode;
                                            $nameT=$result_emp->nameT;
                                            $PositionNameT=$result_emp->PositionNameT;
                                            $THAINAME=$result_emp->THAINAME;
                                            $Company_NameT=$result_emp->Company_NameT;
                                            if($THAINAME==""){
                                                $rscompany="บริษัท ".$Company_NameT." จำกัด";
                                            }else{
                                                $rscompany=$THAINAME;
                                            } ?>
                                        <tr>
                                            <td align="center"><?php print "$no.";?></td>
                                            <td align="left"><?php print $RA_USERNAME; ?></td>
                                            <td align="left"><?php print $RA_PASSWORD; ?></td>
                                            <td align="center"><?php print $PersonCode; ?></td>
                                            <td align="left"><?php print $nameT; ?></td>
                                            <td align="left"><?php print $RU_NAME; ?></td>
                                            <td align="center"><?php print $RU_AREA; ?></td>
                                            <td align="center"><?php 
                                                if(($RU_NAME=='MASTER')&&($SESSION_ROLE_NAME!='MASTER')){
                                                    
                                                }else if(($RU_NAME=='MASTER')&&($SESSION_ROLE_NAME=='MASTER')){ ?>
                                                    <div class="flex items-center gap-3">
                                                        <div class="remove">
                                                            <button aria-label="button" type="button" onclick="swaldelete_role_user('','<?php print $RA_ID; ?>','<?php print $no;?>','deleterole')" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">ลบ</button>
                                                        </div>
                                                    </div><?php 
                                                }else{ ?>
                                                    <div class="flex items-center gap-3">
                                                        <div class="remove">
                                                            <button aria-label="button" type="button" onclick="swaldelete_role_user('','<?php print $RA_ID; ?>','<?php print $no;?>','deleterole')" class="py-1 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20 remove-item-btn">ลบ</button>
                                                        </div>
                                                    </div><?php 
                                                } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
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
</body>
</html>