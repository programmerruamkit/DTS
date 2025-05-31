<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');

    $PROC = $_POST["proc"];
    $SESSION_AREA = $_SESSION["AD_AREA"];

    if($PROC=="dashboard"){
        $dateString = date('Y-m-d');
        $datecheck = date('Y-m-d', strtotime($dateString));  
        
        $filter = isset($_POST["filter"]) ? $_POST["filter"] : "All";

        $filterCondition = "";
        $params = [];

        if ($filter !== "All") {
            $filterCondition = "AND BLB_COMPANY = ?";
        }

        $query = "SELECT
                (SELECT COUNT(*) FROM BILLING_BOOK WHERE BLB_AREA=? $filterCondition AND BLB_STATUS!='Deleted') AS TOTAL,
                (SELECT COUNT(*) FROM BILLING_BOOK WHERE BLB_AREA=? $filterCondition AND BLB_STATUS='Pending') AS PENDING,
                (SELECT SUM(CAST(BLB_NUMPRICE AS FLOAT)) FROM BILLING_BOOK WHERE BLB_AREA=? $filterCondition AND BLB_STATUS!='Deleted') AS TOTALAMOUNT,
                (SELECT SUM(CAST(BLB_NUMPRICE AS FLOAT)) FROM BILLING_BOOK WHERE BLB_AREA=? $filterCondition AND BLB_STATUS IN('Paid')) AS PAID,
                (SELECT SUM(CAST(BLB_NUMPRICE AS FLOAT)) FROM BILLING_BOOK WHERE BLB_AREA=? $filterCondition AND BLB_STATUS IN('Pending','Overdue')) AS OVERDUE,
                (SELECT COUNT(*) FROM BILLING_BOOK LEFT JOIN BILLING_NOTIFICATION ON BILLING_NOTIFICATION.BLB_CODE = BILLING_BOOK.BLB_CODE WHERE BLB_STATUS != 'Deleted' AND BLN_STATUS_NOTI = 'Sent' AND BLB_AREA=? $filterCondition) AS NOTIFICATION;";
        for ($i = 0; $i < 6; $i++) {
            $params[] = $SESSION_AREA;
            if ($filter !== "All") {
                $params[] = $filter;
            }
        }

        $query_sel_data_daily = $conn->prepare($query);
        $query_sel_data_daily->execute($params);
        $resul_sel_data_daily = $query_sel_data_daily->fetch(PDO::FETCH_OBJ);

        $TOTAL        = isset($resul_sel_data_daily->TOTAL) && is_numeric($resul_sel_data_daily->TOTAL) ? $resul_sel_data_daily->TOTAL : 0;
        $PENDING      = isset($resul_sel_data_daily->PENDING) && is_numeric($resul_sel_data_daily->PENDING) ? $resul_sel_data_daily->PENDING : 0;
        $TOTALAMOUNT  = isset($resul_sel_data_daily->TOTALAMOUNT) && is_numeric($resul_sel_data_daily->TOTALAMOUNT) ? $resul_sel_data_daily->TOTALAMOUNT : 0;
        $PAID         = isset($resul_sel_data_daily->PAID) && is_numeric($resul_sel_data_daily->PAID) ? $resul_sel_data_daily->PAID : 0;
        $OVERDUE      = isset($resul_sel_data_daily->OVERDUE) && is_numeric($resul_sel_data_daily->OVERDUE) ? $resul_sel_data_daily->OVERDUE : 0;
        $NOTIFICATION = isset($resul_sel_data_daily->NOTIFICATION) && is_numeric($resul_sel_data_daily->NOTIFICATION) ? $resul_sel_data_daily->NOTIFICATION : 0;

        $dailyData = [
            'TOTAL' => $TOTAL,
            'PENDING' => $PENDING,
            'TOTALAMOUNT' => $TOTALAMOUNT,
            'PAID' => $PAID,
            'OVERDUE' => $OVERDUE,
            'NOTIFICATION' => $NOTIFICATION
        ];
        $response = [
            'dailyData' => $dailyData,
        ];
        echo json_encode($response);
    }

    
    if ($PROC=='getModalData') {
        $filter = isset($_POST["filter"]) ? $_POST["filter"] : "All"; 
        $inputfiltercom = isset($_POST["inputfiltercom"]) ? $_POST["inputfiltercom"] : "All";

        $response = [];

        $filterCondition = "";
        $params = [];

        if ($filter == "All" || $filter == "TOTAL") {
            $filterCondition = "AND BLB_STATUS != 'Deleted'";
        } elseif ($filter == "PD") {
            $filterCondition = "AND BLB_STATUS = 'Paid'";
        } elseif ($filter == "PDOD") {
            $filterCondition = "AND BLB_STATUS IN('Pending','Overdue')";
        } elseif ($filter == "PENDING") {
            $filterCondition = "AND BLB_STATUS = 'Pending'";
        } elseif ($filter == "NOTI") {
            $filterCondition = "AND BLB_STATUS != 'Deleted' AND BLN_STATUS_NOTI = 'Sent'";
        }

        if ($inputfiltercom == "All") {
            $filterCondition .= "";
        }else {
            $filterCondition .= " AND BLB_COMPANY = '$inputfiltercom'";
        }

        $sel_chk_daily = $conn->prepare("SELECT BLB_ID,BILLING_BOOK.BLB_CODE,BLB_CYCLE,BLB_NUMINVOICE,
			DEBTOR.DT_NAME AS BLB_DEBTORNAME,BLB_NUMPO,BLB_NUMTONS,BLB_NUMTRIPS,BLB_NUMPRICE,BLB_REMARK,
			BILLING_NOTIFICATION.BLN_DATEALERT AS BLB_DATEALERT,BILLING_NOTIFICATION.BLN_STATUS_NOTI,
			BLB_STATUS,BLB_CREATEBY,BLB_CREATEDATE,BLB_EDITBY,BLB_EDITDATE
		FROM BILLING_BOOK 
		LEFT JOIN DEBTOR ON DEBTOR.DT_CODE = BILLING_BOOK.BLB_DEBTORNAME 
		LEFT JOIN BILLING_NOTIFICATION ON BILLING_NOTIFICATION.BLB_CODE = BILLING_BOOK.BLB_CODE
		WHERE BLN_STATUS != 'D' $filterCondition AND BLB_AREA = '$SESSION_AREA' ORDER BY BLB_CREATEDATE DESC");
        $sel_chk_daily->execute();
        $rs_chk_daily = [];
        while ($result = $sel_chk_daily->fetch(PDO::FETCH_OBJ)) {
            $rs_chk_daily[] = $result;
        }
        $response = [
            'reportData' => $rs_chk_daily
        ];
        echo json_encode($response);
        exit;
    }