<?php
    $path = "../../";   	
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'include/head.php');   

    $a1 = $_GET["a1"];
    $a2 = $_GET["a2"];
    $a3 = $_GET["a3"];
    if (!is_numeric($a2)) {
        die("Error: a2 ต้องเป็นตัวเลข");
    }
    if ($a2 >= 1 && $a2 <= 9) {
        $a2 = str_pad((int)$a2, 2, "0", STR_PAD_LEFT); 
    }
    if (!isset($a2) || !is_numeric($a2)) {
        die("Error: a2 ต้องเป็นตัวเลขและต้องถูกส่งมา");
    }

    $thaiMonths = [
        "01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน",
        "05" => "พฤษภาคม", "06" => "มิถุนายน", "07" => "กรกฎาคม", "08" => "สิงหาคม",
        "09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"
    ];
    if (!array_key_exists($a2, $thaiMonths)) {
        die("Error: เดือนที่ส่งมาไม่ถูกต้อง");
    }
    $thaiMonthName = $thaiMonths[$a2];

    $SS_AREA = $_SESSION["AD_AREA"];

    if (empty($a1) || empty($a2) || empty($a3)) {
        die("Error: ข้อมูลไม่ครบถ้วนสำหรับการสร้างรายงาน");
    }
    if($a1 == "Paid"){
        $a10 = "ชำระเงินเสร็จสิ้น";
    } else if($a1 == "Pending"){
        $a10 = "รอการชำระเงิน";
    } else if($a1 == "Overdue"){
        $a10 = "เกินกำหนดชำระ";
    } else if($a1 == "Cancelled"){
        $a10 = "ยกเลิก";
    } else if($a1 == "Payment"){
        $a10 = "แจ้งเตือนชำระเงิน";
    } else {
        $a10 = $a1;
    }
    $strExcelFileName = "รายงานการแจ้งเตือน ".$a10." ประจำเดือน ".$thaiMonthName." ปี ".($a3+543).".xls";

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
    header("Pragma:no-cache");
?>
<body>
    <table border="1" style="width: 100%;">
        <thead>
            <tr style="height: 30px;">
                <td colspan="6" style="text-align:center;vertical-align: middle; background-color: #FFFFFF;border:none;font-size:20px;"><b>รายงานการแจ้งเตือน <?php echo $a10; ?></b></td>
            </tr>
            <tr style="height: 30px;">
                <td colspan="6" style="text-align:center;vertical-align: middle; background-color: #FFFFFF;border:none;font-size:20px;"><b>ประจำเดือน <?php echo $thaiMonthName; ?> ปี <?php echo ($a3+543); ?></b></td>
            </tr>
            <tr></tr>
            <tr>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>ลำดับ</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>ประเภทการแจ้งเตือน</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>ช่องทาง</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>ข้อความ</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>วันที่ส่ง</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>สถานะการส่ง</b></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=0;
                $query_report_loop = $conn->prepare("SELECT BLNL_ID,BLNL_GROUP,BLNL_TYPE,BLNL_MESSAGE,BLNL_DATESEND,BLNL_STATUS 
                FROM dbo.BILLING_NOTIFICATION_LOG
                WHERE BLNL_STATUS = 'Y' AND BLNL_GROUP = :a1 AND SUBSTRING(BLNL_DATESEND, 6, 2) = :a2 AND SUBSTRING(BLNL_DATESEND, 1, 4) = :a3 AND BLNL_AREA = :a4");
                $query_report_loop->execute(array(':a1'=>$a1,':a2'=>$a2,':a3'=>$a3,':a4'=>$SS_AREA));
                if ($query_report_loop->rowCount() === 0) {
                    echo "<tr><td colspan='6' style='text-align: center;'>ไม่มีข้อมูล</td></tr>";
                }
                while($row = $query_report_loop->fetch(PDO::FETCH_OBJ)) { $no++;
                    $message = htmlspecialchars($row->BLNL_MESSAGE);
                    $message = str_replace("??", "", $message);
                    $message = str_replace("?? ", "", $message);
                    
                    $backgroundColor = '';
                    if (htmlspecialchars($row->BLNL_STATUS) == 'Y') {
                        $backgroundColor = 'background-color: #90EE90;';
                        $BLNL_STATUS = "ส่งสำเร็จ";
                    } else if (htmlspecialchars($row->BLNL_STATUS) == 'D') {
                        $backgroundColor = 'background-color: #FF9999;';
                        $BLNL_STATUS = "ส่งไม่สำเร็จ";
                    }
                ?>
                <tr>
                    <td style="text-align: center;vertical-align: middle;"><?php echo $no; ?></td>
                    <td style="text-align: center;vertical-align: middle;"><?php echo $a10; ?></td>
                    <td style="text-align: center;vertical-align: middle;"><?php echo $row->BLNL_TYPE; ?></td>
                    <td style="text-align: center;vertical-align: middle;"><?php echo $message; ?></td>
                    <td style="text-align: center;vertical-align: middle;"><?php echo $row->BLNL_DATESEND; ?></td>
                    <td style="text-align: center;vertical-align: middle; <?php echo $backgroundColor; ?>"><?php echo $BLNL_STATUS; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
