<?php
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');  
    header('Content-Type: application/json; charset=utf-8');

    $PROC = $_POST["proc"];
    
    if ($PROC == "billing") {
        $SESSION_AREA = $_SESSION["AD_AREA"];
        $filter = isset($_POST["filter"]) ? $_POST["filter"] : "All";
    
        $filterCondition = "";
        if ($filter == "Paid") {
            $filterCondition = "AND BLB_STATUS = 'Paid'";
        } elseif ($filter == "Pending") {
            $filterCondition = "AND BLB_STATUS = 'Pending'";
        } elseif ($filter == "Overdue") {
            $filterCondition = "AND BLB_STATUS = 'Overdue'";
        } elseif ($filter == "Cancelled") {
            $filterCondition = "AND BLB_STATUS = 'Cancelled'";
        }
    
        $query_billing = $conn->prepare("SELECT BLB_ID,BILLING_BOOK.BLB_CODE,BLB_CYCLE,BLB_NUMINVOICE,
                DEBTOR.DT_NAME AS BLB_DEBTORNAME,BLB_NUMPO,BLB_NUMTONS,BLB_NUMTRIPS,BLB_NUMPRICE,BLB_REMARK,
                BILLING_NOTIFICATION.BLN_DATEALERT AS BLB_DATEALERT,BILLING_NOTIFICATION.BLN_STATUS_NOTI,
                BLB_STATUS,BLB_CREATEBY,BLB_CREATEDATE,BLB_EDITBY,BLB_EDITDATE
            FROM BILLING_BOOK 
            LEFT JOIN DEBTOR ON DEBTOR.DT_CODE = BILLING_BOOK.BLB_DEBTORNAME 
            LEFT JOIN BILLING_NOTIFICATION ON BILLING_NOTIFICATION.BLB_CODE = BILLING_BOOK.BLB_CODE
            WHERE BLB_STATUS != 'Deleted' AND BLN_STATUS != 'D' AND BLB_AREA = :SESSION_AREA $filterCondition ORDER BY BLB_ID ASC;");
        $query_billing->execute([':SESSION_AREA' => $SESSION_AREA]);
    
        $rs_billing = [];
        while ($result = $query_billing->fetch(PDO::FETCH_OBJ)) {
            $rs_billing[] = $result;
        }
        echo json_encode($rs_billing);
    }

    if($PROC=="check_invoice_number"){
        $param_com = $_POST["param_com"];
        $customer_name = $_POST["param_com"];
        $month = $_POST["param_month"];
        $year = date('Y');
        $invoice_pattern = $customer_name.$year.$month.'-%';
        $sql_blbnumlast = $conn->prepare("SELECT 
                CASE 
                    WHEN MAX(CAST(SUBSTRING(BLB_NUMINVOICE, CHARINDEX('-', BLB_NUMINVOICE) + 1, LEN(BLB_NUMINVOICE)) AS INT)) IS NOT NULL 
                    THEN RIGHT('00' + CAST(MAX(CAST(SUBSTRING(BLB_NUMINVOICE, CHARINDEX('-', BLB_NUMINVOICE) + 1, LEN(BLB_NUMINVOICE)) AS INT)) + 1 AS VARCHAR), 2) 
                    ELSE '01' 
                END AS next_invoice_number
            FROM BILLING_BOOK
            WHERE BLB_NUMINVOICE LIKE :invoice_pattern AND BLB_STATUS != 'Deleted'");
        if ($sql_blbnumlast->execute([":invoice_pattern" => $invoice_pattern])) {
            $rs_blbnumlast = $sql_blbnumlast->fetch(PDO::FETCH_OBJ);
            $next_invoice_number = $customer_name . $year . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . $rs_blbnumlast->next_invoice_number;
            echo json_encode(["success" => true, "next_invoice_number" => $next_invoice_number]);
        } else {
            echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาดในการดึงข้อมูล"]);
        }
    }

    if ($PROC == "getBillingDetails") {
        $billingCode = $_POST["billingCode"];
    
        if (empty($billingCode)) {
            echo json_encode(["success" => false, "message" => "ไม่พบข้อมูล billingCode"]);
            exit;
        }
    
        $query_details = $conn->prepare("SELECT 
                BILLING_BOOK.BLB_CODE,
                BILLING_BOOK.BLB_CYCLE,
                BILLING_BOOK.BLB_NUMINVOICE,
                DEBTOR.DT_NAME AS BLB_DEBTORNAME,
                BILLING_BOOK.BLB_NUMPO,
                BILLING_BOOK.BLB_NUMTONS,
                BILLING_BOOK.BLB_NUMTRIPS,
                BILLING_BOOK.BLB_NUMPRICE,
                BILLING_BOOK.BLB_REMARK,
                BILLING_BOOK.BLB_STATUS,
                BILLING_NOTIFICATION.BLN_DATEALERT AS BLB_DATEALERT
            FROM BILLING_BOOK
            LEFT JOIN DEBTOR ON DEBTOR.DT_CODE = BILLING_BOOK.BLB_DEBTORNAME
            LEFT JOIN BILLING_NOTIFICATION ON BILLING_NOTIFICATION.BLB_CODE = BILLING_BOOK.BLB_CODE
            WHERE BILLING_BOOK.BLB_CODE = :billingCode AND BILLING_BOOK.BLB_STATUS != 'Deleted'
        ");
    
        $query_details->execute([':billingCode' => $billingCode]);
    
        $data = $query_details->fetch(PDO::FETCH_OBJ);

        if($data->BLB_STATUS == 'Paid'){
            $status = 'ชำระเงินแล้ว';
        }else if($data->BLB_STATUS == 'Pending'){
            $status = 'รอการชำระเงิน';
        }else if($data->BLB_STATUS == 'Overdue'){
            $status = 'เกินกำหนดชำระ';
        }else if($data->BLB_STATUS == 'Cancelled'){
            $status = 'ยกเลิก';
        }else{
            $status = 'ไม่ทราบสถานะ';
        }

        if ($data) {
            $response = [
                'success' => true,
                'billing_code' => $data->BLB_CODE,
                'billing_cycle' => $data->BLB_CYCLE,
                'invoice_number' =>  $data->BLB_NUMINVOICE,
                'debtor_name' => $data->BLB_DEBTORNAME,
                'num_po' => $data->BLB_NUMPO,
                'num_tons' => $data->BLB_NUMTONS,
                'num_trips' => $data->BLB_NUMTRIPS,
                'num_price' => $data->BLB_NUMPRICE,
                'remark' => $data->BLB_REMARK,
                'status' => $status,
                'date_alert' => $data->BLB_DATEALERT,
            ];
        }
        
        echo json_encode($response);
    }

    if ($PROC == "list_debtor") {
        $company = isset($_POST["company"]) ? $_POST["company"] : "";

        $sql = "SELECT DT_CODE, DT_NAME FROM DEBTOR WHERE DT_STATUS = 'Y' AND DT_COMPANY = :company ORDER BY DT_NAME ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company', $company);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }

    if ($PROC == "get_debtor_credit") {
        $debtor_code = isset($_POST["debtor_code"]) ? $_POST["debtor_code"] : "";

        $sql = "SELECT DT_CD FROM DEBTOR WHERE DT_CODE = :debtor_code AND DT_STATUS = 'Y'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":debtor_code", $debtor_code);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo json_encode([
                "success" => true,
                "credit" => $row["DT_CD"]
            ]);
        } else {
            echo json_encode(["success" => false]);
        }
    }

?>
