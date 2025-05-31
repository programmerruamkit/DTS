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
    
    $query_report = $conn->prepare("SELECT DT_ID,DT_CODE,DT_NAME,DT_EMAIL,DT_PHONE,DT_ADDRESS,DT_RAMARK,DT_STATUS,DT_AREA,
    DT_CREATEBY,DT_CREATEDATE,DT_EDITBY,DT_EDITDATE FROM DEBTOR A WHERE DT_STATUS='Y' AND DT_CODE = :a1 ORDER BY DT_ID ASC");
    $query_report->execute(array(':a1'=>$a1));
    $result_report_data = $query_report->fetch(PDO::FETCH_OBJ);

    $CUSNAME = htmlspecialchars($result_report_data->DT_NAME);

    $strExcelFileName = "รายงานสรุปแยกลูกค้า ".$CUSNAME." ประจำเดือน ".$thaiMonthName." ปี ".($a3+543).".xls";

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
    header("Pragma:no-cache");
?>
<body>
    <table border="1" style="width: 100%;">
        <thead>
            <tr style="height: 30px;">
                <td colspan="8" style="text-align:center;vertical-align: middle; background-color: #FFFFFF;border:none;font-size:20px;"><b>รายงานสรุปแยกลูกค้า <?php echo $CUSNAME; ?></b></td>
            </tr>
            <tr style="height: 30px;">
                <td colspan="8" style="text-align:center;vertical-align: middle; background-color: #FFFFFF;border:none;font-size:20px;"><b>ประจำเดือน <?php echo $thaiMonthName; ?> ปี <?php echo ($a3+543); ?></b></td>
            </tr>
            <tr></tr>
            <tr>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>รอบการวางบิล<br>DATE PERIOD</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>เลขที่ใบแจ้งหนี้<br>INVOICE NO.</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>เลขที่ PO<br>PO NO.</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>จำนวนตัน<br>TONS</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>จำนวนเที่ยว<br>TRIPS</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>จำนวนเงิน<br>AMOUNT</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>หมายเหตุ<br>REMARK</b></td>
                <td rowspan="1" style="text-align:center;background-color: #33FFFF;"><b>สถานะ<br>STATUS</b></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $totalTons = 0;
                $totalTrips = 0;
                $totalPrice = 0;
                $query_report_loop = $conn->prepare("SELECT A.COMPANYCODE,B.BLB_COMPANY,A.THAINAME, A.AREA,B.BLB_AREA,B.BLB_CYCLE, 
                    B.BLB_NUMINVOICE, C.DT_NAME,B.BLB_NUMPO, B.BLB_NUMTONS, B.BLB_NUMTRIPS,B.BLB_NUMPRICE,B.BLB_REMARK, B.BLB_DATEALERT, B.BLB_STATUS
                    FROM dbo.COMPANY AS A
                    LEFT JOIN	dbo.BILLING_BOOK AS B ON B.BLB_COMPANY = A.COMPANYCODE AND B.BLB_STATUS <> 'Deleted' 
                    AND SUBSTRING(B.BLB_NUMINVOICE, 4, 4) = :a3	AND SUBSTRING(B.BLB_NUMINVOICE, 8, 2) = :a2
                    LEFT JOIN	dbo.DEBTOR AS C ON C.DT_CODE = B.BLB_DEBTORNAME
                    WHERE	A.COMPANY_STATUS = '1' AND C.DT_CODE = :a1
                    ORDER BY B.BLB_NUMINVOICE ASC");
                $query_report_loop->execute(array(':a1'=>$a1,':a2'=>$a2,':a3'=>$a3));
                while($row = $query_report_loop->fetch(PDO::FETCH_OBJ)) {
                $totalTons += $row->BLB_NUMTONS;
                $totalTrips += $row->BLB_NUMTRIPS;
                $totalPrice += $row->BLB_NUMPRICE; ?>
                <tr>
                    <td style="text-align: center;"><?php echo htmlspecialchars($row->BLB_CYCLE); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($row->BLB_NUMINVOICE); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($row->BLB_NUMPO); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($row->BLB_NUMTONS); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($row->BLB_NUMTRIPS); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($row->BLB_NUMPRICE); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($row->BLB_REMARK); ?></td>
                    <td style="text-align: center; 
                        <?php 
                            if (htmlspecialchars($row->BLB_STATUS) == "Paid") {
                                echo 'background-color: #90EE90;'; 
                            } else if (htmlspecialchars($row->BLB_STATUS) == "Pending") {
                                echo 'background-color: #FFFF99;'; 
                            } else if (htmlspecialchars($row->BLB_STATUS) == "Overdue" || htmlspecialchars($row->BLB_STATUS) == "Cancelled") {
                                echo 'background-color: #FF9999;'; 
                            }
                        ?>">
                        <?php 
                            if (htmlspecialchars($row->BLB_STATUS) == "Paid") {
                                echo "ชำระเงินเสร็จสิ้น";
                            } else if (htmlspecialchars($row->BLB_STATUS) == "Pending") {
                                echo "รอการชำระเงิน";
                            } else if (htmlspecialchars($row->BLB_STATUS) == "Overdue") {
                                echo "เกินกำหนดชำระ";
                            } else if (htmlspecialchars($row->BLB_STATUS) == "Cancelled") {
                                echo "ยกเลิก";
                            } else {
                                echo htmlspecialchars($row->BLB_STATUS);
                            }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr style="height: 30px; vertical-align: middle; background-color: #FFFFFF;">
                <td colspan="3" style="text-align:center; font-weight: bold;">ยอดรวมสุทธิ (NET TOTAL)</td>
                <td style="text-align: center; font-weight: bold;"><?php echo number_format($totalTons, 2); ?></td>
                <td style="text-align: center; font-weight: bold;"><?php echo number_format($totalTrips, 0); ?></td>
                <td style="text-align: center; font-weight: bold;"><?php echo number_format($totalPrice, 2); ?></td>
                <td colspan="2" style="text-align: center;"></td>
            </tr>
        </tfoot>
    </table>
</body>
