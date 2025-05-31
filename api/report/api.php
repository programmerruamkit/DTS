<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');  
    header('Content-Type: application/json; charset=utf-8');

    $PROC = $_POST["proc"];
        
    if($PROC=="report_mbc"){
        $SS_AREA = $_SESSION["AD_AREA"];
        $area = $_POST["a1"];
        if($area=="AMT"){
            $a1 = 'AMATA';
        }else{
            $a1 = 'GATEWAY';
        }        
        $query_company = $conn->prepare("SELECT * FROM COMPANY WHERE COMPANY_STATUS='1' AND AREA=:a1");
        $query_company->execute(array(":a1" => $a1));
        $result_company = [];
        while($result_company_data  = $query_company->fetch(PDO::FETCH_OBJ)) { 
            $result_company[] = $result_company_data ;
        }
        echo json_encode($result_company);
    }
    if($PROC=="report_ntf"){
        $SS_AREA = $_SESSION["AD_AREA"];
        $a1 = $_POST["a1"];
        
        $query_report = $conn->prepare("SELECT NTF_GROUP,NTF_TYPE,NTF_TOKEN,NTF_CHANNEL,NTF_MESSAGE,NTF_STATUS,NTF_AREA
        FROM NOTIFICATIONS WHERE NTF_STATUS='Y' AND NTF_AREA=:a1");
        $query_report->execute(array(":a1" => $SS_AREA));
        $result_ntf = [];
        while($result_report_data  = $query_report->fetch(PDO::FETCH_OBJ)) { 
            $result_ntf[] = $result_report_data ;
        }
        echo json_encode($result_ntf);
    }
    if($PROC=="report_ctm"){
        $SS_AREA = $_SESSION["AD_AREA"];
        $a1 = $_POST["a1"];

        $query_debtor = $conn->prepare("SELECT DT_ID,DT_CODE,DT_NAME,DT_EMAIL,DT_PHONE,DT_ADDRESS,DT_RAMARK,DT_STATUS,DT_AREA,
        DT_CREATEBY,DT_CREATEDATE,DT_EDITBY,DT_EDITDATE FROM DEBTOR A WHERE DT_STATUS='Y' AND DT_AREA = :a1 ORDER BY DT_ID ASC");
        $query_debtor->execute(array(":a1" => $SS_AREA));
        $rs_debtor = [];
        while ($result = $query_debtor->fetch(PDO::FETCH_OBJ)) {
            $rs_debtor[] = $result;
        }
        echo json_encode($rs_debtor);
    }
    