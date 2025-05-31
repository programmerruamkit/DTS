<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');  
    header('Content-Type: application/json; charset=utf-8');

    $PROC = $_POST["proc"];
    
    if($PROC=="debtor"){
        $SESSION_AREA = $_SESSION["AD_AREA"];
        $query_debtor = $conn->prepare("SELECT DT_ID,DT_CODE,DT_COMPANY,DT_CODECUS,DT_SHORTNAME,DT_NAME,DT_EMAIL,DT_PHONE,
            DT_ADDRESS,DT_PMT,DT_CD,DT_PMS,DT_WHDT,DT_VAT,DT_RAMARK,DT_STATUS,DT_AREA,DT_CREATEBY,DT_CREATEDATE,DT_EDITBY,DT_EDITDATE 
            FROM DEBTOR A WHERE DT_STATUS!='D' AND DT_AREA = '$SESSION_AREA' ORDER BY DT_ID ASC");
        $query_debtor->execute();
        $rs_debtor = [];
        while ($result = $query_debtor->fetch(PDO::FETCH_OBJ)) {
            $rs_debtor[] = $result;
        }
        echo json_encode($rs_debtor);
    }
