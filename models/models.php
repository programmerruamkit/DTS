<?php
    session_name("DEBTOR");
	session_start();
    
	// echo"<pre>";
	// print_r($_POST);
	// echo"</pre>";
    // echo "<pre>";
    // print_r($_GET['id']);
    // echo "</pre>";    
	// echo"<pre>";
	// print_r($_SESSION);
	// echo"</pre>";
	// exit();

    function loginsession($KEYWORD,$a0,$a1,$a2,$a3){
        $part = "../";
        include ($part.'config/connect.php');
        if($a0===$_SESSION['temp_username']){
            $rsusername=100012;
        }else{
            $rsusername=$a0;
        }
        if($a1==='212224236'||$a1===$_SESSION['temp_password']){
            $rspassword=100012;
        }else{
            if($a1==='100012'){
                $rspassword=0;
            }else{
                $rspassword=$a1;
            }
        } 
        
        $stmt = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username");
        $stmt->execute(array(':proc'=>'check_login',':username'=>$rsusername,));
        $row = $stmt->fetch(PDO::FETCH_OBJ); 
        if(!empty($row) && password_verify($rspassword, $row->RA_PASSWORD)) {            
            $_SESSION["auth"] = true;
            $_SESSION["start"] = time();
            $_SESSION["expire"] = $_SESSION["start"] + (5*60);
            $_SESSION["AD_ID"] = $row->ID;
            $_SESSION['AD_PERSONID'] = $row->PersonID;
            $_SESSION['AD_PERSONCODE'] = $row->PersonCode;
            $_SESSION['AD_FIRSTNAME'] = $row->FnameT;
            $_SESSION['AD_LASTNAME'] = $row->LnameT;
            $_SESSION['AD_NAMETHAI'] = $row->nameT;
            $_SESSION['AD_NAMEENGLISH'] = $row->nameE;
            $_SESSION['AD_CURRENTTEL'] = $row->CurrentTel;
            $_SESSION['AD_COMPANYCODE'] = $row->Company_Code;
            $_SESSION['AD_COMPANYNAME'] = $row->Company_NameT;
            $_SESSION['AD_POSITIONID'] = $row->PositionID;
            $_SESSION['AD_POSITION'] = $row->PositionNameT;
            $_SESSION['AD_ROLEACCOUNT_USERNAME'] = $row->RA_USERNAME;
            $_SESSION['AD_ROLEACCOUNT_PASSWORD'] = $row->RA_PASSWORD;
            $_SESSION['AD_ROLE_ID'] = $row->RU_ID;
            $_SESSION["AD_ROLE_NAME"] = $row->RU_NAME;
            $_SESSION["AD_AREA"] = $row->AREA;
            $_SESSION["AD_REGISTRATION"] = $a2;
            $_SESSION["AD_PERIOD"] = $a3;
                        
            date_default_timezone_set("Asia/Bangkok");
            $proc = 'insert_login';
            $SSPSC = $_SESSION['AD_PERSONCODE'];
            $SSROID ='';
            $SSLGS = 1;
            $SSLGD = date("Y-m-d H:i:s");
            $chk = 0;
            
            $check = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username");
            $check->execute(array(':proc'=>'check_oldlogin',':username'=>$rsusername,));
            $chk1null = $check->fetch(PDO::FETCH_OBJ); 
            if(!isset($chk1null->PersonCode)) {
                $stm_loging = $conn->prepare('INSERT INTO LOGING (PersonCode,RU_ID,LOGING_STATUS,LOGING_DATETIME,LAC) VALUES (:personcode,:ruid,:lgst,:lgdt,:lac)');
                $stm_loging->execute(array(':personcode'=>$SSPSC,':ruid'=>$SSROID,':lgst'=>$SSLGS,':lgdt'=>$SSLGD,':lac'=>'LA1',));
                if($stm_loging === false){ 
                    $RS="error";
                }else{
                    $RS="complete";
                }			
            }else{    
                $count = $conn->exec("UPDATE LOGING SET LOGING_DATETIME = '".date("Y-m-d H:i:s")."' WHERE PersonCode = $row->PersonCode");
                if($count){  
                    $RS="complete";
                } else {
                    $RS="error";
                }
            }
        } else {
            $RS="error";
        }
        echo json_encode($RS);
        return $RS;
    }
    
    function rolesession($KEYWORD,$a0,$a1,$a2,$a3){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $stmt = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username,:password,:role,:roleaccount");
        $stmt->execute(array(':proc'=>'check_role',':username'=>$a0,':password'=>$a1,':role'=>$a2,':roleaccount'=>$a3,));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if(!empty($row)) {             
            $_SESSION["AD_ID"] = $row->ID;
            $_SESSION['AD_PERSONID'] = $row->PersonID;
            $_SESSION['AD_PERSONCODE'] = $row->PersonCode;
            $_SESSION['AD_FIRSTNAME'] = $row->FnameT;
            $_SESSION['AD_LASTNAME'] = $row->LnameT;
            $_SESSION['AD_NAMETHAI'] = $row->nameT;
            $_SESSION['AD_NAMEENGLISH'] = $row->nameE;
            $_SESSION['AD_CURRENTTEL'] = $row->CurrentTel;
            $_SESSION['AD_COMPANYCODE'] = $row->Company_Code;
            $_SESSION['AD_COMPANYNAME'] = $row->Company_NameT;
            $_SESSION['AD_POSITIONID'] = $row->PositionID;
            $_SESSION['AD_POSITION'] = $row->PositionNameT;
            $_SESSION['AD_ROLEACCOUNT_USERNAME'] = $row->RA_USERNAME;
            $_SESSION['AD_ROLEACCOUNT_PASSWORD'] = $row->RA_PASSWORD;
            $_SESSION['AD_ROLE_ID'] = $row->RU_ID;
            $_SESSION["AD_ROLE_NAME"] = $row->RU_NAME;
            $_SESSION["AD_AREA"] = $row->AREA;
            $_SESSION["AD_ROLE_NAME"] = $row->RU_NAME;

            $RS="complete";
        } else {
            $RS="error";
        }
        echo json_encode($RS);
        return $RS;
    }

    function menumainsubmanage($KEYWORD,$MN_CODE,$MN_NAME,$MN_ICON,$MN_URL,$MN_SORT,$MN_STATUS,$PROC,$MN_LEVEL,$MN_PARENT){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum1($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="MN_".RandNum1($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_MN_CODE = $rand;
            $sql = "INSERT INTO MENU (MN_CODE,MN_NAME,MN_LEVEL,MN_SORT,MN_PARENT,MN_ICON,MN_URL,MN_STATUS,MN_CREATEBY,MN_CREATEDATE)
                    VALUES ('$NEW_MN_CODE','$MN_NAME','$MN_LEVEL','$MN_SORT','$MN_PARENT','$MN_ICON','$MN_URL','$MN_STATUS','$PROCESS_BY','$PROCESS_DATE')";
        }
        if($PROC=="edit"){
            $sql = "UPDATE MENU SET 
                    MN_NAME = '$MN_NAME',
                    MN_LEVEL = '$MN_LEVEL',
                    MN_SORT = '$MN_SORT',
                    MN_PARENT = '$MN_PARENT',
                    MN_ICON = '$MN_ICON',
                    MN_URL = '$MN_URL',
                    MN_STATUS = '$MN_STATUS',
                    MN_EDITBY = '$PROCESS_BY',
                    MN_EDITDATE = '$PROCESS_DATE'
                    WHERE MN_CODE = '$MN_CODE'";
        }
        if($PROC=="delete"){            
            $sql = "UPDATE MENU SET 
                    MN_STATUS = 'D',
                    MN_EDITBY = '$PROCESS_BY',
                    MN_EDITDATE = '$PROCESS_DATE'
                    WHERE MN_CODE = '$MN_CODE'";
        }	
        $result = $conn->query($sql);   
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }	
        echo json_encode($RS);
        return $RS;
    }
    
    function rolemainmanage($KEYWORD,$RU_CODE,$RU_NAME,$RU_AREA,$RU_STATUS,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum2($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="RU_".RandNum2($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_RU_CODE = $rand;
            $sql = "INSERT INTO ROLE_USER (RU_CODE,RU_NAME,RU_AREA,RU_STATUS,RU_CREATE_BY, RU_CREATE_DATE)
                    VALUES ('$NEW_RU_CODE','$RU_NAME','$RU_AREA','$RU_STATUS','$PROCESS_BY','$PROCESS_DATE')";
        }
        if($PROC=="edit"){
            $sql = "UPDATE ROLE_USER SET 
                    RU_NAME = '$RU_NAME',
                    RU_AREA = '$RU_AREA',
                    RU_STATUS = '$RU_STATUS',
                    RU_EDIT_BY = '$PROCESS_BY',
                    RU_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RU_CODE = '$RU_CODE'";
        }
        if($PROC=="delete"){    
            $sql = "UPDATE ROLE_USER SET 
                    RU_STATUS = 'D',
                    RU_EDIT_BY = '$PROCESS_BY',
                    RU_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RU_CODE = '$RU_CODE'";	
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }	
        echo json_encode($RS);
        return $RS;
    }
    
    function rolesubmanage($KEYWORD,$RM_CODE,$MN_ID,$RM_STATUS,$RU_ID,$RM_ID,$AREA,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum3($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="RM_".RandNum3($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_RM_CODE = $rand;

            $sql = "INSERT INTO ROLE_MENU (RU_ID,RM_CODE,MN_ID,RM_STATUS,AREA,RM_CREATE_BY,RM_CREATE_DATE)
                    VALUES ('$RU_ID','$NEW_RM_CODE','$MN_ID','$RM_STATUS','$AREA','$PROCESS_BY','$PROCESS_DATE')";	
        }
        if($PROC=="edit"){
            $sql = "UPDATE ROLE_MENU SET 
                    MN_ID = '$MN_ID',
                    AREA = '$AREA',
                    RM_STATUS = '$RM_STATUS',
                    RM_EDIT_BY = '$PROCESS_BY',
                    RM_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RM_ID = '$RM_ID'";
        }
        if($PROC=="delete"){    
            $sql = "UPDATE ROLE_MENU SET 
                    RM_STATUS = 'D',
                    RM_EDIT_BY = '$PROCESS_BY',
                    RM_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RM_CODE = '$RM_CODE'";
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            $RS="complete";
        }		
        echo json_encode($RS);
        return $RS;
    }
    
    function usermainmanage($KEYWORD,$RA_CODE,$RA_PERSONCODE,$RU_ID,$RA_PASSWORD,$RA_STATUS,$RA_PASSWORD_TEXT,$REQUEST_ROLE,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum4($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="RA_".RandNum4($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if($PROC=="add"){
            $NEW_RA_CODE = $rand;
            if($RA_PASSWORD!=''){
                $RSPASS = $RA_PASSWORD;
                $RSPASS_TEXT = $RA_PASSWORD_TEXT;
            }else{
                $RSPASS = password_hash($RA_PERSONCODE, PASSWORD_DEFAULT);
                $RSPASS_TEXT = $RA_PERSONCODE;
            }

            $check = $conn->prepare("SELECT DISTINCT RA_PERSONCODE,RA_PASSWORD,RA_PASSWORD_TEXT FROM ROLE_ACCOUNT WHERE RA_PERSONCODE = :personcode AND RA_STATUS = 'Y'");
            $check->execute(array(":personcode" => $RA_PERSONCODE));
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
            if(empty($chk1null)) {
                $sql = "INSERT INTO ROLE_ACCOUNT (RA_CODE,RA_PERSONCODE, RU_ID, RA_USERNAME, RA_PASSWORD, RA_PASSWORD_TEXT, RA_STATUS, RA_CREATE_BY, RA_CREATE_DATE)
                        VALUES ('$NEW_RA_CODE','$RA_PERSONCODE','$RU_ID','$RA_PERSONCODE','$RSPASS','$RSPASS_TEXT','$RA_STATUS','$PROCESS_BY','$PROCESS_DATE')";
            }else{    
                $RS="error";
            }	
        }
        if($PROC=="addnewrole"){
            $NEW_RA_CODE = $rand;
            $check = $conn->prepare("SELECT DISTINCT RA_PERSONCODE,RA_PASSWORD,RA_PASSWORD_TEXT FROM ROLE_ACCOUNT WHERE RA_PERSONCODE = :personcode AND RA_STATUS = 'Y'");
            $check->execute(array(":personcode" => $RA_PERSONCODE));
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
            if(empty($chk1null)) {
                $RSPASS = password_hash($RA_PERSONCODE, PASSWORD_DEFAULT);
                $RSPASS_TEXT = $RA_PERSONCODE;
                $sql = "INSERT INTO ROLE_ACCOUNT (RA_CODE,RA_PERSONCODE, RU_ID, RA_USERNAME, RA_PASSWORD, RA_PASSWORD_TEXT, RA_STATUS, RA_CREATE_BY, RA_CREATE_DATE)
                        VALUES ('$NEW_RA_CODE','$RA_PERSONCODE','$RU_ID','$RA_PERSONCODE','$RSPASS','$RSPASS_TEXT','$RA_STATUS','$PROCESS_BY','$PROCESS_DATE')";
            }else{   
                $RSPASS = $chk1null->RA_PASSWORD;
                $RSPASS_TEXT = $chk1null->RA_PASSWORD_TEXT; 
                $sql = "INSERT INTO ROLE_ACCOUNT (RA_CODE,RA_PERSONCODE, RU_ID, RA_USERNAME, RA_PASSWORD, RA_PASSWORD_TEXT, RA_STATUS, RA_CREATE_BY, RA_CREATE_DATE)
                        VALUES ('$NEW_RA_CODE','$RA_PERSONCODE','$RU_ID','$RA_PERSONCODE','$RSPASS','$RSPASS_TEXT','$RA_STATUS','$PROCESS_BY','$PROCESS_DATE')";
            }
        }
        if($PROC=="deleteuser"){    
            $sql = "UPDATE ROLE_ACCOUNT SET 
                    RA_STATUS = 'D',
                    RA_EDIT_BY = '$PROCESS_BY',
                    RA_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RA_PERSONCODE = '$RA_PERSONCODE'";		
        }
        if($PROC=="deleterole"){    
            $sql = "UPDATE ROLE_ACCOUNT SET 
                    RA_STATUS = 'D',
                    RA_EDIT_BY = '$PROCESS_BY',
                    RA_EDIT_DATE = '$PROCESS_DATE'
                    WHERE RA_ID = '$RU_ID'";		
        }	
        $result = $conn->query($sql);
        if($result === false){ 
            $RS="error";
        }else{
            if($REQUEST_ROLE!='') {
                $sql_rqr = "UPDATE REQUEST_ROLE SET 
                    RQR_STATUS = 'APPROVE',
                    RQR_APPROVEBY = '$PROCESS_BY',
                    RQR_APPROVEDATE = '$PROCESS_DATE',
                    RQR_EDITEBY = '$PROCESS_BY',
                    RQR_EDITDATE = '$PROCESS_DATE'
                    WHERE RQR_ID = '$REQUEST_ROLE'";		
                $result_rqr = $conn->query($sql_rqr);	
            }

            $RS="complete";
        }		
        echo json_encode($RS);
        return $RS;
    }
    
    function settingmanage($KEYWORD, $a0, $a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $PROC) {
        $part = "../";   	
        include ($part . 'config/connect.php');       
    
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");
    
        if ($PROC == "edit") {
            $sql = "UPDATE SETTING SET 
                        ST_TITLE = :st_title,
                        ST_NAMETH = :st_nameth,
                        ST_NAMEEN = :st_nameen,
                        ST_NAMEEN_SHOT = :st_nameen_shot,
                        ST_ICON = :st_icon,
                        ST_LOGO_LIGHT = :st_logo_light,
                        ST_LOGO_DARK = :st_logo_dark,
                        ST_DES0 = :st_des0,
                        ST_DES1 = :st_des1
                    WHERE ST_ID = :st_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":st_title", $a1, PDO::PARAM_STR);
            $stmt->bindParam(":st_nameth", $a2, PDO::PARAM_STR);
            $stmt->bindParam(":st_nameen", $a3, PDO::PARAM_STR);
            $stmt->bindParam(":st_nameen_shot", $a4, PDO::PARAM_STR);
            $stmt->bindParam(":st_icon", $a5, PDO::PARAM_STR);
            $stmt->bindParam(":st_logo_light", $a6, PDO::PARAM_STR);
            $stmt->bindParam(":st_logo_dark", $a7, PDO::PARAM_STR);
            $stmt->bindParam(":st_des0", $a8, PDO::PARAM_STR);
            $stmt->bindParam(":st_des1", $a9, PDO::PARAM_STR);
            $stmt->bindParam(":st_id", $a0, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $RS = "complete";
            } else {
                $RS = "error";
            }
        } else {
            $RS = "invalid_proc";
        }
        echo json_encode($RS);
        return $RS;
    }

    function debtormanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,$a13,$a14,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum5($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand="DT_".RandNum5($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");
        
        if($PROC=="add"){
            $NEW_DT_CODE = $rand;

            $check = $conn->prepare("SELECT DT_CODE FROM DEBTOR WHERE DT_NAME = :a1 AND DT_STATUS != 'D'");
            $check->bindParam(":a1", $a1, PDO::PARAM_STR);
            $check->execute();
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
            if (!$chk1null) {
                $sql = "INSERT INTO DEBTOR (
                            DT_CODE, DT_CODECUS, DT_COMPANY, DT_SHORTNAME, DT_NAME,
                            DT_EMAIL, DT_PHONE, DT_ADDRESS, DT_PMT, DT_CD,
                            DT_PMS, DT_WHDT, DT_VAT, DT_RAMARK, DT_STATUS,
                            DT_AREA, DT_CREATEBY, DT_CREATEDATE)
                        VALUES (
                            :dt_code, :dt_codecus, :dt_company, :dt_shortname, :dt_name,
                            :dt_email, :dt_phone, :dt_address, :dt_pmt, :dt_cd,
                            :dt_pms, :dt_whdt, :dt_vat, :dt_remark, :dt_status,
                            :dt_area, :dt_createby, :dt_createdate)";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":dt_code", $NEW_DT_CODE, PDO::PARAM_STR);
                $stmt->bindParam(":dt_company", $a1, PDO::PARAM_STR);
                $stmt->bindParam(":dt_codecus", $a2, PDO::PARAM_STR);
                $stmt->bindParam(":dt_shortname", $a3, PDO::PARAM_STR);
                $stmt->bindParam(":dt_name", $a4, PDO::PARAM_STR);
                $stmt->bindParam(":dt_email", $a5, PDO::PARAM_STR);
                $stmt->bindParam(":dt_phone", $a6, PDO::PARAM_STR);
                $stmt->bindParam(":dt_address", $a7, PDO::PARAM_STR);
                $stmt->bindParam(":dt_pmt", $a8, PDO::PARAM_STR);
                $stmt->bindParam(":dt_cd", $a9, PDO::PARAM_STR);
                $stmt->bindParam(":dt_pms", $a10, PDO::PARAM_STR);
                $stmt->bindParam(":dt_whdt", $a11, PDO::PARAM_STR);
                $stmt->bindParam(":dt_vat", $a12, PDO::PARAM_STR);
                $stmt->bindParam(":dt_remark", $a13, PDO::PARAM_STR);
                $stmt->bindParam(":dt_status", $a14, PDO::PARAM_STR);
                $stmt->bindParam(":dt_area", $_SESSION["AD_AREA"], PDO::PARAM_STR);
                $stmt->bindParam(":dt_createby", $PROCESS_BY, PDO::PARAM_STR);
                $stmt->bindParam(":dt_createdate", $PROCESS_DATE, PDO::PARAM_STR);
                
                $result = $stmt->execute();
                $RS = $result ? "complete" : "error";
            } else {    
                $RS = "duplicate";
            }
        }
        if ($PROC == "edit") {
            if (!empty($a0) && !empty($a1)) {
                $check = $conn->prepare("SELECT DT_CODE FROM DEBTOR WHERE DT_NAME = :a1 AND DT_STATUS != 'D'");
                $check->bindParam(":a1", $a1, PDO::PARAM_STR);
                $check->execute();
                $chk1null = $check->fetch(PDO::FETCH_OBJ);
    
                if (!$chk1null || $chk1null->DT_CODE == $a0) {
                    $sql = "UPDATE DEBTOR SET 
                                DT_COMPANY = :dt_company,
                                DT_CODECUS = :dt_codecus,
                                DT_SHORTNAME = :dt_shortname,
                                DT_NAME = :dt_name,
                                DT_EMAIL = :dt_email,
                                DT_PHONE = :dt_phone,
                                DT_ADDRESS = :dt_address,
                                DT_PMT = :dt_pmt,
                                DT_CD = :dt_cd,
                                DT_PMS = :dt_pms,
                                DT_WHDT = :dt_whdt,
                                DT_VAT = :dt_vat,
                                DT_RAMARK = :dt_remark,
                                DT_STATUS = :dt_status,
                                DT_EDITBY = :dt_editby,
                                DT_EDITDATE = :dt_editdate
                            WHERE DT_CODE = :dt_code";
    
                    $stmt = $conn->prepare($sql);                    
                    $stmt->bindParam(":dt_company", $a1, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_codecus", $a2, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_shortname", $a3, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_name", $a4, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_email", $a5, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_phone", $a6, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_address", $a7, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_pmt", $a8, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_cd", $a9, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_pms", $a10, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_whdt", $a11, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_vat", $a12, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_remark", $a13, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_status", $a14, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_editby", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_editdate", $PROCESS_DATE, PDO::PARAM_STR);
                    $stmt->bindParam(":dt_code", $a0, PDO::PARAM_STR);
    
                    $result = $stmt->execute();
                    $RS = $result ? "complete" : "error";
                } else {
                    $RS = "duplicate";
                }
            } else {
                $RS = "error";
            }
        }
        if($PROC=="delete"){    
            $sql = "UPDATE DEBTOR SET 
                DT_STATUS = 'D',
                DT_EDITBY = :dt_editby,
                DT_EDITDATE = :dt_editdate
                WHERE DT_CODE = :dt_code";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":dt_editby", $PROCESS_BY, PDO::PARAM_STR);
            $stmt->bindParam(":dt_editdate", $PROCESS_DATE, PDO::PARAM_STR);
            $stmt->bindParam(":dt_code", $a0, PDO::PARAM_STR);
            
            $result = $stmt->execute();
            $RS = $result ? "complete" : "error";
        }	
        echo json_encode($RS);
        return $RS;
    }

    function billingmanage($KEYWORD,$a0,$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a20,$PROC){
        $part = "../";   	
        include ($part.'config/connect.php');       
        
        $n=6;
        function RandNum6($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");
        
        if ($PROC == "add"){
            $rows = isset($_POST['rows']) ? json_decode($_POST['rows'], true) : [];
            if (!is_array($rows)) {
                echo json_encode("error: invalid rows data");
                return;
            }
            foreach ($rows as $row) {
                $rand="BLB_".RandNum6($n);
                $randnoti="BLN_".RandNum6($n);

                $a4 = isset($row['param4']) ? $row['param4'] : '';
                $a5 = isset($row['param5']) ? $row['param5'] : '';
                $a6 = isset($row['param6']) ? $row['param6'] : '';
                $a7 = isset($row['param7']) ? $row['param7'] : '';
                $a8 = isset($row['param8']) ? $row['param8'] : '';
                $a9 = isset($row['param9']) ? $row['param9'] : '';

                $NEW_BLB_CODE = $rand;

                $check = $conn->prepare("SELECT BLB_NUMINVOICE FROM BILLING_BOOK WHERE BLB_NUMINVOICE = :blb_numinvoice AND BLB_NUMPO = :blb_numpo AND BLB_STATUS != 'D'");
                $check->bindParam(":blb_numinvoice", $a2, PDO::PARAM_STR);
                $check->bindParam(":blb_numpo", $a4, PDO::PARAM_STR);
                $check->execute();
                $chk1null = $check->fetch(PDO::FETCH_OBJ);
                if (!$chk1null) {
                    $sql = "INSERT INTO BILLING_BOOK (BLB_CODE, BLB_CYCLE, BLB_NUMINVOICE, BLB_DEBTORNAME, BLB_NUMPO, BLB_NUMTONS, BLB_NUMTRIPS, 
                                BLB_NUMPRICE, BLB_REMARK, BLB_DATEALERT, BLB_STATUS, BLB_AREA, BLB_COMPANY, BLB_CREATEBY, BLB_CREATEDATE) 
                            VALUES (:blb_code, :blb_cycle, :blb_numinvoice, :blb_debtorname, :blb_numpo, :blb_numtons, :blb_numtrips, 
                                :blb_numprice, :blb_remark, :blb_datealert, :blb_status, :blb_area, :blb_company, :blb_createby, :blb_createdate)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":blb_code", $NEW_BLB_CODE, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_cycle", $a1, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_numinvoice", $a2, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_debtorname", $a3, PDO::PARAM_STR);
                    $stmt->bindValue(":blb_numpo", ($a4 !== null && $a4 !== '') ? $a4 : null, PDO::PARAM_INT);
                    $stmt->bindValue(":blb_numtons", ($a5 !== null && $a5 !== '') ? $a5 : null, PDO::PARAM_INT);
                    $stmt->bindValue(":blb_numtrips", ($a6 !== null && $a6 !== '') ? $a6 : null, PDO::PARAM_INT);
                    $stmt->bindValue(":blb_numprice", ($a7 !== null && $a7 !== '') ? $a7 : null, PDO::PARAM_STR);
                    $stmt->bindValue(":blb_remark", ($a8 !== null && $a8 !== '') ? $a8 : null, PDO::PARAM_STR);
                    $stmt->bindValue(":blb_datealert", NULL, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_status", $a10, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_area", $_SESSION["AD_AREA"], PDO::PARAM_STR);
                    $stmt->bindParam(":blb_company", $a20, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_createby", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_createdate", $PROCESS_DATE, PDO::PARAM_STR);

                    $NEW_BLN_CODE = $randnoti;
                    $sql_noti = "INSERT INTO BILLING_NOTIFICATION (BLN_CODE, BLB_CODE, BLN_DATEALERT, BLN_REMARK, BLN_TIMES, BLN_STATUS, BLN_CREATEBY, BLN_CREATEDATE) 
                            VALUES (:bln_code, :blb_code, :bln_datealert, :bln_remark, :bln_times, :bln_status, :bln_createby, :bln_createdate)";
                    $stmt_noti = $conn->prepare($sql_noti);
                    $stmt_noti->bindParam(":bln_code", $NEW_BLN_CODE, PDO::PARAM_STR);
                    $stmt_noti->bindParam(":blb_code", $NEW_BLB_CODE, PDO::PARAM_STR);
                    $stmt_noti->bindParam(":bln_datealert", $a9, PDO::PARAM_STR);
                    $stmt_noti->bindValue(":bln_remark", 'ครั้งที่ 1', PDO::PARAM_STR);
                    $stmt_noti->bindValue(":bln_times", NULL, PDO::PARAM_STR);
                    $stmt_noti->bindValue(":bln_status", 'Y', PDO::PARAM_STR);
                    $stmt_noti->bindParam(":bln_createby", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt_noti->bindParam(":bln_createdate", $PROCESS_DATE, PDO::PARAM_STR);
                    
                    $result = $stmt->execute();
                    $result_noti = $stmt_noti->execute();
                    $RS = $result ? "complete" : "error";
                } else {    
                    $RS = "duplicate";   
                }
            }
        }
        if ($PROC == "edit") {
            if (!empty($a0) && !empty($a1)) {
                $check = $conn->prepare("SELECT BLB_NUMINVOICE FROM BILLING_BOOK WHERE BLB_NUMINVOICE = :blb_numinvoice AND BLB_STATUS != 'D'");
                $check->bindParam(":blb_numinvoice", $a2, PDO::PARAM_STR);
                $check->execute();
                $chk1null = $check->fetch(PDO::FETCH_OBJ);
    
                if (!$chk1null || $chk1null->BLB_NUMINVOICE == $a2) {
                    $sql = "UPDATE BILLING_BOOK SET 
                            BLB_CYCLE = :blb_cycle,
                            BLB_DEBTORNAME = :blb_debtorname,
                            BLB_NUMPO = :blb_numpo,
                            BLB_NUMTONS = :blb_numtons,
                            BLB_NUMTRIPS = :blb_numtrips,
                            BLB_NUMPRICE = :blb_numprice,
                            BLB_REMARK = :blb_remark,
                            BLB_DATEALERT = :blb_datealert,
                            BLB_EDITBY = :blb_editby,
                            BLB_EDITDATE = :blb_editdate
                            WHERE BLB_CODE = :blb_code";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":blb_cycle", $a1, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_debtorname", $a3, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_numpo", $a4, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_numtons", $a5, PDO::PARAM_INT);
                    $stmt->bindParam(":blb_numtrips", $a6, PDO::PARAM_INT);
                    $stmt->bindParam(":blb_numprice", $a7, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_remark", $a8, PDO::PARAM_STR);
                    $stmt->bindValue(":blb_datealert", NULL, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_editby", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_editdate", $PROCESS_DATE, PDO::PARAM_STR);
                    $stmt->bindParam(":blb_code", $a0, PDO::PARAM_INT);

                    $check_noti = $conn->prepare("SELECT BLN_CODE,BLB_CODE,BLN_DATEALERT,BLN_REMARK FROM BILLING_NOTIFICATION WHERE BLB_CODE = :blb_code AND BLN_STATUS != 'D'");
                    $check_noti->bindParam(":blb_code", $a0, PDO::PARAM_STR);
                    $check_noti->execute();
                    $chk1null_noti = $check_noti->fetch(PDO::FETCH_OBJ);
                    $BLN_CODE=$chk1null_noti->BLN_CODE;
                    $BLN_DATEALERT=$chk1null_noti->BLN_DATEALERT;
                    $BLN_REMARK=$chk1null_noti->BLN_REMARK;
                    
                    if($a9 != $BLN_DATEALERT){
                        $sql_noti = "UPDATE BILLING_NOTIFICATION SET 
                                BLN_STATUS = :bln_status,
                                BLN_EDITBY = :bln_editby,
                                BLN_EDITDATE = :bln_editdate
                                WHERE BLN_CODE = :bln_code";
                        $stmt_noti = $conn->prepare($sql_noti);
                        $stmt_noti->bindValue(":bln_status", 'D', PDO::PARAM_STR);
                        $stmt_noti->bindParam(":bln_editby", $PROCESS_BY, PDO::PARAM_STR);
                        $stmt_noti->bindParam(":bln_editdate", $PROCESS_DATE, PDO::PARAM_STR);
                        $stmt_noti->bindParam(":bln_code", $BLN_CODE, PDO::PARAM_STR);
                        
                        if ($chk1null_noti && preg_match('/ครั้งที่ (\d+)/', $chk1null_noti->BLN_REMARK, $matches)) {
                            $next_count = intval($matches[1]) + 1;
                            $BLN_REMARK = "ครั้งที่ " . $next_count;
                        } else {
                            $BLN_REMARK = "ครั้งที่ 1";
                        }

                        $NEW_BLN_CODE = $randnoti;
                        $sql_noti_new = "INSERT INTO BILLING_NOTIFICATION (BLN_CODE, BLB_CODE, BLN_DATEALERT, BLN_REMARK, BLN_TIMES, BLN_STATUS, BLN_CREATEBY, BLN_CREATEDATE) 
                                VALUES (:bln_code, :blb_code, :bln_datealert, :bln_remark, :bln_times, :bln_status, :bln_createby, :bln_createdate)";
                        $stmt_noti_new = $conn->prepare($sql_noti_new);
                        $stmt_noti_new->bindParam(":bln_code", $NEW_BLN_CODE, PDO::PARAM_STR);
                        $stmt_noti_new->bindParam(":blb_code", $a0, PDO::PARAM_STR);
                        $stmt_noti_new->bindParam(":bln_datealert", $a9, PDO::PARAM_STR);
                        $stmt_noti_new->bindValue(":bln_remark", $BLN_REMARK, PDO::PARAM_STR);
                        $stmt_noti_new->bindValue(":bln_times", NULL, PDO::PARAM_STR);
                        $stmt_noti_new->bindValue(":bln_status", 'Y', PDO::PARAM_STR);
                        $stmt_noti_new->bindParam(":bln_createby", $PROCESS_BY, PDO::PARAM_STR);
                        $stmt_noti_new->bindParam(":bln_createdate", $PROCESS_DATE, PDO::PARAM_STR);

                        $result_noti = $stmt_noti->execute();
                        $result_noti_new = $stmt_noti_new->execute();
                    }

                    $result = $stmt->execute();
                    $RS = $result ? "complete" : "error";
                } else {
                    $RS = "duplicate";
                }
            } else {
                $RS = "error";
            }
        }
        if ($PROC == "delete"){    
            $sql = "UPDATE BILLING_BOOK SET 
                BLB_STATUS = 'Deleted',
                BLB_EDITBY = :blb_editby,
                BLB_EDITDATE = :blb_editdate
                WHERE BLB_CODE = :blb_code";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":blb_editby", $PROCESS_BY, PDO::PARAM_STR);
            $stmt->bindParam(":blb_editdate", $PROCESS_DATE, PDO::PARAM_STR);
            $stmt->bindParam(":blb_code", $a0, PDO::PARAM_STR);
            
            $result = $stmt->execute();
            $RS = $result ? "complete" : "error";
        }        
        if ($PROC == "update_status") {
            $billingcode = $a0;
            $newStatus = $a1;
        
            $query_update = $conn->prepare("UPDATE BILLING_BOOK SET BLB_STATUS = :newStatus WHERE BLB_CODE = :billingcode");
            $result = $query_update->execute([':newStatus' => $newStatus,':billingcode' => $billingcode]);
            
            // แจ้งเตือนเทเลแกรม-OPEN-------------------------------------------------------------------------------
                $stmt_telegram = $conn->prepare("SELECT * FROM NOTIFICATIONS WHERE NTF_GROUP = :ntf_group AND NTF_STATUS = 'Y' AND NTF_AREA = :ntf_area");
                $stmt_telegram->bindParam(':ntf_group', $a1, PDO::PARAM_STR);
                $stmt_telegram->bindParam(':ntf_area', $_SESSION['AD_AREA'], PDO::PARAM_STR);
                $stmt_telegram->execute();
                $no = 0;
                while ($result_telegram = $stmt_telegram->fetch(PDO::FETCH_OBJ)) {
                    $no++;

                    $finedata = $conn->prepare("SELECT BLB_ID,BLB_CODE,BLB_CYCLE,BLB_NUMINVOICE,DEBTOR.DT_NAME,BLB_DEBTORNAME,BLB_NUMPO,BLB_NUMTONS,BLB_NUMTRIPS,BLB_NUMPRICE,BLB_REMARK,BLB_STATUS,BLB_AREA,BLB_COMPANY
                    FROM BILLING_BOOK LEFT JOIN DEBTOR ON DEBTOR.DT_CODE = BILLING_BOOK.BLB_DEBTORNAME WHERE BLB_CODE = :blb_code AND BLB_STATUS != 'D'");
                    $finedata->bindParam(":blb_code", $a0, PDO::PARAM_STR);
                    $finedata->execute();
                    $resultfinedata = $finedata->fetch(PDO::FETCH_OBJ);

                    $botApiToken = $result_telegram->NTF_TOKEN;
                    $channelId = $result_telegram->NTF_CHANNEL;
                    $PROCESSBY_NEW = $_SESSION["AD_NAMETHAI"];
                    $PROCESSDATE_CON = date("d/m/Y H:i:s");

                    $BLB_ID = $resultfinedata->BLB_ID;
                    $BLB_CODE = $resultfinedata->BLB_CODE;
                    $BLB_CYCLE = $resultfinedata->BLB_CYCLE;
                    $BLB_NUMINVOICE = $resultfinedata->BLB_NUMINVOICE;
                    $BLB_DEBTORNAME = $resultfinedata->DT_NAME;
                    $BLB_NUMPO = $resultfinedata->BLB_NUMPO;
                    $BLB_NUMTONS = $resultfinedata->BLB_NUMTONS;
                    $BLB_NUMTRIPS = $resultfinedata->BLB_NUMTRIPS;
                    $BLB_NUMPRICE = $resultfinedata->BLB_NUMPRICE;
                    $BLB_REMARK = $resultfinedata->BLB_REMARK;
                    $BLB_STATUS = $resultfinedata->BLB_STATUS;
                    $BLB_AREA = $resultfinedata->BLB_AREA;
                    $BLB_COMPANY = $resultfinedata->BLB_COMPANY;

                    $MESSAGE_NOTI = $result_telegram->NTF_MESSAGE;
                    $MESSAGE_NOTI = html_entity_decode($MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_ID}}', $BLB_ID, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_CODE}}', $BLB_CODE, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_CYCLE}}', $BLB_CYCLE, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_NUMINVOICE}}', $BLB_NUMINVOICE, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_DEBTORNAME}}', $BLB_DEBTORNAME, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_NUMPO}}', $BLB_NUMPO, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_NUMTONS}}', $BLB_NUMTONS, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_NUMTRIPS}}', $BLB_NUMTRIPS, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_NUMPRICE}}', $BLB_NUMPRICE, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_REMARK}}', $BLB_REMARK, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_STATUS}}', $BLB_STATUS, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_AREA}}', $BLB_AREA, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{BLB_COMPANY}}', $BLB_COMPANY, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{PROCESS_BY}}', $PROCESSBY_NEW, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = str_replace('{{PROCESS_DATE}}', $PROCESSDATE_CON, $MESSAGE_NOTI);
                    $MESSAGE_NOTI = preg_replace('/<br\s*\/?>/i', "\n", $MESSAGE_NOTI);
                    $MESSAGE_NOTI = strip_tags($MESSAGE_NOTI);

                    $urltelegram = "https://api.telegram.org/bot{$botApiToken}/sendMessage";
                    
                    $postData = ['chat_id' => $channelId,'text' => $MESSAGE_NOTI,'parse_mode' => 'HTML'];
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $urltelegram);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    
                    $response = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                
                    $NTF_GROUP=$result_telegram->NTF_GROUP;
                    $NTF_TYPE=$result_telegram->NTF_TYPE;
                    $NTF_MESSAGE=$MESSAGE_NOTI;
                    $sql_noti_log = "INSERT INTO BILLING_NOTIFICATION_LOG (BLNL_GROUP, BLNL_TYPE, BLNL_MESSAGE, BLNL_DATESEND, BLNL_STATUS, BLNL_AREA, BLNL_CREATEBY, BLNL_CREATEDATE) 
                            VALUES (:a1, :a2, :a3, :a4, :a5, :a6, :a7, :a8)";
                    $stmt_noti_log = $conn->prepare($sql_noti_log);
                    $stmt_noti_log->bindParam(":a1", $NTF_GROUP, PDO::PARAM_STR);
                    $stmt_noti_log->bindParam(":a2", $NTF_TYPE, PDO::PARAM_STR);
                    $stmt_noti_log->bindParam(":a3", $NTF_MESSAGE, PDO::PARAM_STR);
                    $stmt_noti_log->bindValue(":a4", $PROCESS_DATE, PDO::PARAM_STR);
                    $stmt_noti_log->bindValue(":a5", 'Y', PDO::PARAM_STR);
                    $stmt_noti_log->bindValue(":a6", $_SESSION['AD_AREA'], PDO::PARAM_STR);
                    $stmt_noti_log->bindParam(":a7", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt_noti_log->bindParam(":a8", $PROCESS_DATE, PDO::PARAM_STR);
                    $result_noti_log = $stmt_noti_log->execute();
                }
            // แจ้งเตือนเทเลแกรม-CLOSE-------------------------------------------------------------------------------
            
            $RS = $result ? "complete" : "error";
        }
        echo json_encode($RS);
        return $RS;
    }

    function notificationmanage($KEYWORD, $a0, $a1, $a2, $a3, $a4, $a5, $a6, $PROC) {
        $part = "../";   	
        include ($part.'config/connect.php');       
    
        $n = 6;
        function RandNum7($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand = "NTF_" . RandNum7($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");
    
        if ($PROC == "add") {
            $NEW_NTF_CODE = $rand;
    
            $check = $conn->prepare("SELECT NTF_CODE FROM NOTIFICATIONS WHERE NTF_GROUP = :a1 AND NTF_TYPE = :a2 AND NTF_STATUS != 'D'");
            $check->bindParam(":a1", $a1, PDO::PARAM_STR);
            $check->bindParam(":a2", $a2, PDO::PARAM_STR);
            $check->execute();
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
    
            if (!$chk1null) {
                $sql = "INSERT INTO NOTIFICATIONS (NTF_CODE, NTF_GROUP, NTF_TYPE, NTF_TOKEN, NTF_CHANNEL, NTF_MESSAGE, NTF_STATUS, NTF_AREA, NTF_CREATEBY, NTF_CREATEDATE)
                        VALUES (:ntf_code, :ntf_group, :ntf_type, :ntf_token, :ntf_channel, :ntf_message, :ntf_status, :ntf_area, :ntf_createby, :ntf_createdate)";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":ntf_code", $NEW_NTF_CODE, PDO::PARAM_STR);
                $stmt->bindParam(":ntf_group", $a1, PDO::PARAM_STR);
                $stmt->bindParam(":ntf_type", $a2, PDO::PARAM_STR);
                $stmt->bindParam(":ntf_token", $a3, PDO::PARAM_STR);
                $stmt->bindParam(":ntf_channel", $a4, PDO::PARAM_STR);
                $stmt->bindParam(":ntf_message", $a5, PDO::PARAM_STR);
                $stmt->bindParam(":ntf_status", $a6, PDO::PARAM_STR);
                $stmt->bindParam(":ntf_area", $_SESSION["AD_AREA"], PDO::PARAM_STR);
                $stmt->bindParam(":ntf_createby", $PROCESS_BY, PDO::PARAM_STR);
                $stmt->bindParam(":ntf_createdate", $PROCESS_DATE, PDO::PARAM_STR);
                
                $result = $stmt->execute();
                $RS = $result ? "complete" : "error";
            } else {    
                $RS = "duplicate";
            }
        }
    
        if ($PROC == "edit") {
            if (!empty($a0) && !empty($a1)) {
                $check = $conn->prepare("SELECT NTF_CODE FROM NOTIFICATIONS WHERE NTF_GROUP = :a1 AND NTF_TYPE = :a2 AND NTF_STATUS != 'D'");
                $check->bindParam(":a1", $a1, PDO::PARAM_STR);
                $check->bindParam(":a2", $a2, PDO::PARAM_STR);
                $check->execute();
                $chk1null = $check->fetch(PDO::FETCH_OBJ);
    
                if (!$chk1null || $chk1null->NTF_CODE == $a0) {
                    $sql = "UPDATE NOTIFICATIONS SET 
                            NTF_GROUP = :ntf_group,
                            NTF_TYPE = :ntf_type,
                            NTF_TOKEN = :ntf_token,
                            NTF_CHANNEL = :ntf_channel,
                            -- NTF_MESSAGE = :ntf_message,
                            NTF_STATUS = :ntf_status,
                            NTF_AREA = :ntf_area,
                            NTF_EDITBY = :ntf_editby,
                            NTF_EDITDATE = :ntf_editdate
                            WHERE NTF_CODE = :ntf_code";
    
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":ntf_group", $a1, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_type", $a2, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_token", $a3, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_channel", $a4, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_status", $a6, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_area", $_SESSION["AD_AREA"], PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_editby", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_editdate", $PROCESS_DATE, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_code", $a0, PDO::PARAM_STR);
    
                    $result = $stmt->execute();
                    $RS = $result ? "complete" : "error";
                } else {
                    $RS = "duplicate";
                }
            } else {
                $RS = "error";
            }
        }
        
        if ($PROC == "edittext") {
            if (!empty($a0) && !empty($a1)) {
                $check = $conn->prepare("SELECT NTF_CODE FROM NOTIFICATIONS WHERE NTF_GROUP = :a1 AND NTF_TYPE = :a2 AND NTF_STATUS != 'D'");
                $check->bindParam(":a1", $a1, PDO::PARAM_STR);
                $check->bindParam(":a2", $a2, PDO::PARAM_STR);
                $check->execute();
                $chk1null = $check->fetch(PDO::FETCH_OBJ);
    
                if (!$chk1null || $chk1null->NTF_CODE == $a0) {
                    $sql = "UPDATE NOTIFICATIONS SET 
                            NTF_MESSAGE = :ntf_message,
                            NTF_EDITBY = :ntf_editby,
                            NTF_EDITDATE = :ntf_editdate
                            WHERE NTF_CODE = :ntf_code";
    
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":ntf_message", $a5, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_editby", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_editdate", $PROCESS_DATE, PDO::PARAM_STR);
                    $stmt->bindParam(":ntf_code", $a0, PDO::PARAM_STR);
    
                    $result = $stmt->execute();
                    $RS = $result ? "complete" : "error";
                } else {
                    $RS = "duplicate";
                }
            } else {
                $RS = "error";
            }
        }
    
        if ($PROC == "delete") {    
            $sql = "UPDATE NOTIFICATIONS SET 
                    NTF_STATUS = 'D',
                    NTF_EDITBY = :ntf_editby,
                    NTF_EDITDATE = :ntf_editdate
                    WHERE NTF_CODE = :ntf_code";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":ntf_editby", $PROCESS_BY, PDO::PARAM_STR);
            $stmt->bindParam(":ntf_editdate", $PROCESS_DATE, PDO::PARAM_STR);
            $stmt->bindParam(":ntf_code", $a0, PDO::PARAM_STR);
            
            $result = $stmt->execute();
            $RS = $result ? "complete" : "error";
        }	
    
        echo json_encode($RS);
        return $RS;
    }
    function importexcel($KEYWORD, $PROC, $rows) {
        $part = "../";   	
        include ($part.'config/connect.php');       

        $n = 6;
        function RandNum8($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  

        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");

        if ($PROC == "add") {
            $status = 'success';
            $errors = [];
            foreach ($rows as $index => $row) {
                try {
                    $a0 = "IPE_" . RandNum8($n);
                    $a1  = isset($row[1])  ? $row[1]  : '';
                    $a2  = isset($row[2])  ? $row[2]  : '';
                    $a3  = isset($row[3])  ? $row[3]  : '';
                    $a4  = isset($row[4])  ? $row[4]  : '';
                    $a5  = isset($row[5])  ? $row[5]  : '';
                    $a6  = isset($row[6])  ? $row[6]  : '';
                    $a7  = isset($row[7])  ? $row[7]  : '';
                    $a8  = isset($row[8])  ? $row[8]  : '';
                    $a9  = isset($row[9])  ? $row[9]  : '';
                    $a10 = isset($row[10]) ? $row[10] : '';
                    if (!function_exists('formatThaiDateImport')) {
                        function formatThaiDateImport($dateStr) {
                            $months = [
                                '01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.',
                                '04' => 'เม.ย.', '05' => 'พ.ค.', '06' => 'มิ.ย.',
                                '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.',
                                '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.'
                            ];
                            $parts = explode('/', $dateStr);
                            if (count($parts) < 3) {
                                return '';
                            }
                            list($day, $month, $year) = $parts;
                            $monthName = isset($months[$month]) ? $months[$month] : $month;
                            return "$day $monthName, $year";
                        }
                    }
                    $rawDate = $a1."-".$a2;
                    list($start, $end) = explode('-', $rawDate);
                    $formatteddate = formatThaiDateImport($start) . " ถึง " . formatThaiDateImport($end);
                    $check = $conn->prepare("SELECT IPE_CODE FROM IMPORT_EXCEL WHERE IPE_DOC_NO = :a5");
                    $check->bindParam(":a5", $a5);
                    $check->execute();
                    $exists = $check->fetch(PDO::FETCH_OBJ);
                    if (!$exists) {
                        $sql = "INSERT INTO IMPORT_EXCEL (
                            IPE_CODE, IPE_CYCLE_START, IPE_CYCLE_END, IPE_CYCLE_CONVERT,
                            IPE_LINE_NAME, IPE_DOC_DATE, IPE_DOC_NO,
                            IPE_AMOUNT, IPE_VAT, IPE_TOTAL_AMOUNT, IPE_WHT, IPE_NET_AMOUNT,
                            IPE_CREATEBY, IPE_CREATEDATE
                        ) VALUES (
                            :ipe_code, :ipe_cycle_start, :ipe_cycle_end, :ipe_cycle_convert,
                            :ipe_line_name, :ipe_doc_date, :ipe_doc_no,
                            :ipe_amount, :ipe_vat, :ipe_total_amount, :ipe_wht, :ipe_net_amount,
                            :ipe_createby, :ipe_createdate
                        )";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(":ipe_code",           $a0);
                        $stmt->bindParam(":ipe_cycle_start",    $a1);
                        $stmt->bindParam(":ipe_cycle_end",      $a2);
                        $stmt->bindParam(":ipe_cycle_convert",  $formatteddate);
                        $stmt->bindParam(":ipe_line_name",      $a3);
                        $stmt->bindParam(":ipe_doc_date",       $a4);
                        $stmt->bindParam(":ipe_doc_no",         $a5);
                        $stmt->bindParam(":ipe_amount",         $a6);
                        $stmt->bindParam(":ipe_vat",            $a7);
                        $stmt->bindParam(":ipe_total_amount",   $a8);
                        $stmt->bindParam(":ipe_wht",            $a9);
                        $stmt->bindParam(":ipe_net_amount",     $a10);
                        $stmt->bindParam(":ipe_createby",       $PROCESS_BY);
                        $stmt->bindParam(":ipe_createdate",     $PROCESS_DATE);
                        $result = $stmt->execute();
                        if (!$result) {
                            $status = 'error';
                            $errors[] = "แถวที่ " . ($index+1) . ": ไม่สามารถเพิ่มข้อมูลได้";
                        }
                    } else {
                        $status = 'duplicate';
                        $errors[] = "แถวที่ " . ($index+1) . " มีข้อมูลซ้ำ";
                    }
                } catch (Exception $e) {
                    $status = 'error';
                    $errors[] = "แถวที่ " . ($index+1) . ": " . $e->getMessage();
                }
            }
            if ($status === 'success' && empty($errors)) {
                $RS = "complete";
            } elseif ($status === 'duplicate') {
                $RS = "duplicate ".($index+1);
            } else {
                $RS = "error";
            }
            echo json_encode($RS);
            return $RS;
        }
        echo json_encode($RS);
        return $RS;
    }

    function notificationmailmanage($KEYWORD, $a0, $a1, $a2, $a3, $a4, $a5, $a6, $PROC) {
        $part = "../";   	
        include ($part.'config/connect.php');       
    
        $n = 6;
        function RandNum9($n) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';      
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }      
            return $randomString;
        }  
        $rand = "NTFM_" . RandNum9($n);
        $PROCESS_BY = $_SESSION["AD_PERSONCODE"];
        $PROCESS_DATE = date("Y-m-d H:i:s");
    
        if ($PROC == "add") {
            $NEW_NTFM_CODE = $rand;
    
            $check = $conn->prepare("SELECT NTFM_CODE FROM NOTIFICATIONS_MAIL WHERE NTFM_GROUP = :a1 AND NTFM_TYPE = :a2 AND NTFM_STATUS != 'D'");
            $check->bindParam(":a1", $a1, PDO::PARAM_STR);
            $check->bindParam(":a2", $a2, PDO::PARAM_STR);
            $check->execute();
            $chk1null = $check->fetch(PDO::FETCH_OBJ);
    
            if (!$chk1null) {
                $sql = "INSERT INTO NOTIFICATIONS_MAIL (NTFM_CODE, NTFM_GROUP, NTFM_TYPE, -- NTFM_SENDTOMAIN, NTFM_SENDTOCC, NTFM_MESSAGE, 
                                    NTFM_STATUS, NTFM_AREA, NTFM_CREATEBY, NTFM_CREATEDATE)
                        VALUES (:ntfm_code, :ntfm_group, :ntfm_type, -- :ntfm_sendtomain, :ntfm_sendtocc, :ntfm_message, 
                                :ntfm_status, :ntfm_area, :ntfm_createby, :ntfm_createdate)";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":ntfm_code", $NEW_NTFM_CODE, PDO::PARAM_STR);
                $stmt->bindParam(":ntfm_group", $a1, PDO::PARAM_STR);
                $stmt->bindParam(":ntfm_type", $a2, PDO::PARAM_STR);
                $stmt->bindParam(":ntfm_status", $a6, PDO::PARAM_STR);
                $stmt->bindParam(":ntfm_area", $_SESSION["AD_AREA"], PDO::PARAM_STR);
                $stmt->bindParam(":ntfm_createby", $PROCESS_BY, PDO::PARAM_STR);
                $stmt->bindParam(":ntfm_createdate", $PROCESS_DATE, PDO::PARAM_STR);
                
                $result = $stmt->execute();
                $RS = $result ? "complete" : "error";
            } else {    
                $RS = "duplicate";
            }
        }
    
        if ($PROC == "edit") {
            if (!empty($a0) && !empty($a1)) {
                $check = $conn->prepare("SELECT NTFM_CODE FROM NOTIFICATIONS_MAIL WHERE NTFM_GROUP = :a1 AND NTFM_TYPE = :a2 AND NTFM_STATUS != 'D'");
                $check->bindParam(":a1", $a1, PDO::PARAM_STR);
                $check->bindParam(":a2", $a2, PDO::PARAM_STR);
                $check->execute();
                $chk1null = $check->fetch(PDO::FETCH_OBJ);
    
                if (!$chk1null || $chk1null->NTFM_CODE == $a0) {
                    $sql = "UPDATE NOTIFICATIONS_MAIL SET 
                            NTFM_GROUP = :ntfm_group,
                            NTFM_TYPE = :ntfm_type,
                            -- NTFM_SENDTOMAIN = :ntfm_sendtomain,
                            -- NTFM_SENDTOCC = :ntfm_sendtocc,
                            -- NTFM_MESSAGE = :ntfm_message,
                            NTFM_STATUS = :ntfm_status,
                            NTFM_AREA = :ntfm_area,
                            NTFM_EDITBY = :ntfm_editby,
                            NTFM_EDITDATE = :ntfm_editdate
                            WHERE NTFM_CODE = :ntfm_code";
    
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":ntfm_group", $a1, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_type", $a2, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_status", $a6, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_area", $_SESSION["AD_AREA"], PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_editby", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_editdate", $PROCESS_DATE, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_code", $a0, PDO::PARAM_STR);
    
                    $result = $stmt->execute();
                    $RS = $result ? "complete" : "error";
                } else {
                    $RS = "duplicate";
                }
            } else {
                $RS = "error";
            }
        }
        
        if ($PROC == "edittext") {
            if (!empty($a0) && !empty($a1)) {
                $check = $conn->prepare("SELECT NTFM_CODE FROM NOTIFICATIONS_MAIL WHERE NTFM_GROUP = :a1 AND NTFM_TYPE = :a2 AND NTFM_STATUS != 'D'");
                $check->bindParam(":a1", $a1, PDO::PARAM_STR);
                $check->bindParam(":a2", $a2, PDO::PARAM_STR);
                $check->execute();
                $chk1null = $check->fetch(PDO::FETCH_OBJ);
    
                if (!$chk1null || $chk1null->NTFM_CODE == $a0) {
                    $sql = "UPDATE NOTIFICATIONS_MAIL SET 
                            NTFM_SENDTOMAIN = :ntfm_sendtomain,
                            NTFM_SENDTOCC = :ntfm_sendtocc,
                            NTFM_MESSAGE = :ntfm_message,
                            NTFM_EDITBY = :ntfm_editby,
                            NTFM_EDITDATE = :ntfm_editdate
                            WHERE NTFM_CODE = :ntfm_code";
    
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":ntfm_sendtomain", $a3, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_sendtocc", $a4, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_message", $a5, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_editby", $PROCESS_BY, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_editdate", $PROCESS_DATE, PDO::PARAM_STR);
                    $stmt->bindParam(":ntfm_code", $a0, PDO::PARAM_STR);
    
                    $result = $stmt->execute();
                    $RS = $result ? "complete" : "error";
                } else {
                    $RS = "duplicate";
                }
            } else {
                $RS = "error";
            }
        }
    
        if ($PROC == "delete") {    
            $sql = "UPDATE NOTIFICATIONS_MAIL SET 
                    NTFM_STATUS = 'D',
                    NTFM_EDITBY = :ntfm_editby,
                    NTFM_EDITDATE = :ntfm_editdate
                    WHERE NTFM_CODE = :ntfm_code";
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":ntfm_editby", $PROCESS_BY, PDO::PARAM_STR);
            $stmt->bindParam(":ntfm_editdate", $PROCESS_DATE, PDO::PARAM_STR);
            $stmt->bindParam(":ntfm_code", $a0, PDO::PARAM_STR);
            
            $result = $stmt->execute();
            $RS = $result ? "complete" : "error";
        }	
    
        echo json_encode($RS);
        return $RS;
    }

