<?php
    $path = "../../";   	
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'config/set_session.php');  
    require_once($path.'assets/pdf/PDF/vendor/autoload.php');

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

    if (isset($_GET['a1']) && isset($_GET['a2']) && isset($_GET['a3'])) {  

        $mpdf = new mPDF('th', 'A4', '0', ''); 
        $style = '
            <style>
                body {
                    font-family: "Garuda"; /* เรียกใช้ฟอนต์ Garuda สำหรับภาษาไทย */
                    font-size: 10px; /* ขนาดตัวอักษร */
                }
                h2 {
                    text-align: center; /* จัดข้อความให้อยู่กึ่งกลางแนวนอน */
                    margin: 0; /* ลบระยะห่างรอบข้อความ */
                }
                table {
                    width: 100%;
                    border-collapse: collapse; /* รวมเส้นขอบ */
                }
                td, th {
                    text-align: center; /* จัดข้อความให้อยู่กึ่งกลางแนวนอน */
                    vertical-align: middle; /* จัดข้อความให้อยู่กึ่งกลางแนวตั้ง */
                    padding: 5px; /* เพิ่มระยะห่างภายในเซลล์ */
                }
            </style>
            <center>
                <h2>
                    รายงานการแจ้งเตือน '.$a10.'<br>
                    ประจำเดือน '.$thaiMonthName.' ปี '.($a3+543).'
                </h2>
            </center>';
        $tableopen =    "<table border='1' style='width: 100%;'>";
        $tablehead =    "<thead>
                            <tr>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;' width='5%'><b>ลำดับ</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;' width='20%'><b>ประเภทการแจ้งเตือน</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;' width='10%'><b>ช่องทาง</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;' width='30%'><b>ข้อความ</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;' width='10%'><b>วันที่ส่ง</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;' width='15%'><b>สถานะการส่ง</b></td>
                            </tr>
                        </thead>";
        $tablebody =    "<tbody>";
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
        $tablebody .=   "<tr>
                            <td style='text-align: center;'>".$no."</td>
                            <td style='text-align: center;'>".$a10."</td>
                            <td style='text-align: center;'>".$row->BLNL_TYPE."</td>
                            <td style='text-align: left;'>".$message."</td>
                            <td style='text-align: center;'>".$row->BLNL_DATESEND."</td>";

                            $backgroundColor = '';
                            if (htmlspecialchars($row->BLNL_STATUS) == 'Y') {
                                $backgroundColor = 'background-color: #90EE90;'; 
                            } else if (htmlspecialchars($row->BLNL_STATUS) == 'D') {
                                $backgroundColor = 'background-color: #FF9999;'; 
                            }

        $tablebody .= "<td style='text-align: center; $backgroundColor'>";
                            if (htmlspecialchars($row->BLNL_STATUS) == "Y") {
                                $tablebody .= "ส่งสำเร็จ";
                            } else if (htmlspecialchars($row->BLNL_STATUS) == "D") {
                                $tablebody .= "ส่งไม่สำเร็จ";
                            }
        $tablebody .= "</td></tr>";
                        }; 
        $tableclose =   "</tbody></table>";
        
        $mpdf->WriteHTML($style);
        $mpdf->WriteHTML($tableopen);
        $mpdf->WriteHTML($tablehead);
        $mpdf->WriteHTML($tablebody);
        $mpdf->WriteHTML($tableclose);
        $mpdf->Output();
    } else {
        echo json_encode(['error' => 'No report data provided']);
    }
?>