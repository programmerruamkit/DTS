<?php 
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');  
    $_SESSION['SIDEBAR']='จัดการการแจ้งเตือน.html';
    $_SESSION['DROPDOWN']='null';
    $_SESSION['DROPDOWN_ID']='null';

    $sql_noti_edit = $conn->prepare("SELECT * FROM NOTIFICATIONS WHERE NTF_ID = :NTF_ID");
    $sql_noti_edit->execute(array(":NTF_ID" => $_GET['id']));
    $rs_noti_edit = $sql_noti_edit->fetch(PDO::FETCH_OBJ);
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
                                if($rs_noti_edit->NTF_GROUP == "Paid"){
                                    echo "ชำระเงินเสร็จสิ้น";
                                } else if($rs_noti_edit->NTF_GROUP == "Pending"){
                                    echo "รอการชำระเงิน";
                                } else if($rs_noti_edit->NTF_GROUP == "Overdue"){
                                    echo "เกินกำหนดชำระ";
                                } else if($rs_noti_edit->NTF_GROUP == "Cancelled"){
                                    echo "ยกเลิก";
                                } else if($rs_noti_edit->NTF_GROUP == "Payment"){
                                    echo "แจ้งเตือนชำระเงิน";
                                } else {
                                    echo $rs_noti_edit->NTF_GROUP;
                                }
                            ?>
                        </h5>
                    </div>
                </div>
                <!-- Open Section  ############################################################## -->
                 
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h5 class="text-16">คุณสามารถแก้ไขข้อความแจ้งเตือนได้ตามต้องการ</h5>
                            <h5 class="text-16">หรือสามารถคัดลอกหัวข้อและตัวอย่างข้อมูลที่ต้องการไปใช้ได้</h5>
                        </center>
                        <div style="display: flex; gap: 20px;">
                            <div style="flex: 1; border: none; padding: 20px;">
                                <div class="col-md-6">
                                    <div class="card" style="flex: 1; border: 1px solid #E5E7EB; padding: 20px;">
                                        <div class="card-body">
                                            <h5 class="card-title">หัวข้อพื้นฐานที่สามารถคัดลอกไปใช้ได้</h5>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('📆 แจ้งเตือนใบวางบิลใกล้ถึงกำหนดชำระ<br><br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;📆 แจ้งเตือนใบวางบิลใกล้ถึงกำหนดชำระ</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('💵 แจ้งเตือนการชำระเงินเรียบร้อย<br><br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;💵 แจ้งเตือนการชำระเงินเรียบร้อย</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🟡 แจ้งเตือนใบวางบิลรอการชำระเงิน<br><br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🟡 แจ้งเตือนใบวางบิลรอการชำระเงิน</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔴 แจ้งเตือนใบวางบิลเกินกำหนดชำระ<br><br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔴 แจ้งเตือนใบวางบิลเกินกำหนดชำระ</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🏁 แจ้งเตือนยกเลิกใบวางบิล<br><br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🏁 แจ้งเตือนยกเลิกใบวางบิล</p>
                                            <!-- <p class="card-text mb-2"><button onclick="copytextnoti('✅ แจ้งเตือนใบวางบิลได้รับการอนุมัติ<br><br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;✅ แจ้งเตือนใบวางบิลได้รับการอนุมัติ</p> -->
                                            <!-- <p class="card-text mb-2"><button onclick="copytextnoti('✅ แจ้งเตือนสร้างใบวางบิลใหม่<br><br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;✅ แจ้งเตือนสร้างใบวางบิลใหม่</p> -->
                                            <!-- <p class="card-text mb-2"><button onclick="copytextnoti('🔴 แจ้งเตือนใบวางบิลถูกปฏิเสธ<br><br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔴 แจ้งเตือนใบวางบิลถูกปฏิเสธ</p> -->
                                            <br>
                                            <h5 class="card-title">ข้อมูลที่สามารถคัดลอกไปใช้ได้</h5>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸รอบการวางบิล: {{BLB_CYCLE}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸รอบการวางบิล</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸เลขที่ใบวางบิล: {{BLB_NUMINVOICE}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸เลขที่ใบวางบิล</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸ลูกค้า: {{BLB_DEBTORNAME}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸ลูกค้า</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸เลขที่ PO: {{BLB_NUMPO}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸เลขที่ PO</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸จำนวนตัน: {{BLB_NUMTONS}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸จำนวนตัน</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸จำนวนเที่ยว: {{BLB_NUMTRIPS}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸จำนวนเที่ยว</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸จำนวนเงินที่ต้องชำระ: {{BLB_NUMPRICE}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸จำนวนเงินที่ต้องชำระ</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸หมายเหตุ: {{BLB_REMARK}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸หมายเหตุ</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸ข้อมูลของพื้นที่: {{BLB_AREA}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸ข้อมูลของพื้นที่</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸ใบวางบิลของบริษัท: {{BLB_COMPANY}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸ใบวางบิลของบริษัท</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸เวลาแจ้งเตือนที่กำหนด: {{BLN_DATEALERT}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸เวลาแจ้งเตือนที่กำหนด</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸ผู้ยืนยัน: {{PROCESS_BY}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸ผู้ยืนยัน</p>
                                            <p class="card-text mb-2"><button onclick="copytextnoti('🔸วันที่ยืนยัน: {{PROCESS_DATE}}<br>')" class="text-white bg-purple-500 hover:bg-purple-600 focus:ring focus:ring-purple-300 px-1 py-1 text-md rounded-md">คัดลอก</button>&emsp;🔸วันที่ยืนยัน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="flex: 1; border: none; padding: 20px;">
                                <div class="col-md-6">
                                    <div class="card" style="flex: 1; border: 1px solid #E5E7EB; padding: 20px;">
                                        <div class="card-body">
                                            <p class="text-gray-600">หากต้องการขึ้นบรรทัดใหม่ กรุณาใส่ <code>&lt;br&gt;</code> ในตำแหน่งที่ต้องการต่อจากข้อความ</p>
                                            <p class="text-gray-600">หากคัดลอกข้อความมา สามารถแก้ไขชื่อข้อมูลได้ แต่ห้ามแก้ไขตัวแปร '{{.....}}'</p><br>
                                            <form name="form2" method="post">
                                                <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-1">
                                                    <textarea name="param5" id="param5" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                                                        <?php echo htmlspecialchars($rs_noti_edit->NTF_MESSAGE); ?>
                                                    </textarea>
                                                </div><br>
                                                <input type="text" id="param1" name="param1" value="<?php echo $rs_noti_edit->NTF_GROUP; ?>" hidden>
                                                <input type="text" id="param2" name="param2" value="<?php echo $rs_noti_edit->NTF_TYPE; ?>" hidden>
                                                <input type="text" id="param3" name="param3" value="<?php echo $rs_noti_edit->NTF_TOKEN; ?>" hidden>
                                                <input type="text" id="param4" name="param4" value="<?php echo $rs_noti_edit->NTF_CHANNEL; ?>" hidden>
                                                <input type="text" id="param6" name="param6" value="<?php echo $rs_noti_edit->NTF_STATUS; ?>" hidden>
                                                <input type="text" id="cheparam5" name="cheparam5" value="cheparam5" hidden>
                                                <div class="flex justify-center gap-2">
                                                    <input type="hidden" name="PROC" id="PROC" value="edittext">
                                                    <a href="จัดการการแจ้งเตือน.html">
                                                        <button aria-label="button" type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600">ย้อนกลับ</button>
                                                    </a>
                                                    <button aria-label="button" type="button" onclick="ManageNotiMain('<?php echo $rs_noti_edit->NTF_CODE; ?>')" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">บันทึกการแก้ไข</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<script src="assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="assets/js/pages/form-editor-classic.init.js"></script>
<script>
    let editorInstance; 
    ClassicEditor
        .create(document.querySelector('#param5'))
        .then(editor => {
            window.editor = editor; 
        })
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>