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

    $thaiMonths = [
        "01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม", "04" => "เมษายน",
        "05" => "พฤษภาคม", "06" => "มิถุนายน", "07" => "กรกฎาคม", "08" => "สิงหาคม",
        "09" => "กันยายน", "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"
    ];
    $thaiMonthName = isset($thaiMonths[$a2]) ? $thaiMonths[$a2] : "ไม่ทราบเดือน";

    $query_report = $conn->prepare("SELECT DT_ID,DT_CODE,DT_NAME,DT_EMAIL,DT_PHONE,DT_ADDRESS,DT_RAMARK,DT_STATUS,DT_AREA,
    DT_CREATEBY,DT_CREATEDATE,DT_EDITBY,DT_EDITDATE FROM DEBTOR A WHERE DT_STATUS='Y' AND DT_CODE = :a1 ORDER BY DT_ID ASC");
    $query_report->execute(array(':a1'=>$a1));
    $result_report_data = $query_report->fetch(PDO::FETCH_OBJ);

    $CUSNAME = htmlspecialchars($result_report_data->DT_NAME);

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
                    รายงานสรุปแยกลูกค้า '.$CUSNAME.'<br>
                    ประจำเดือน '.$thaiMonthName.' ปี '.($a3+543).'
                </h2>
            </center>';
        $tableopen =    "<table border='1' style='width: 100%;'>";
        $tablehead =    "<thead>
                            <tr>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;'><b>รอบการวางบิล<br>DATE PERIOD</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;'><b>เลขที่ใบแจ้งหนี้<br>INVOICE NO.</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;'><b>เลขที่ PO<br>PO NO.</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;'><b>จำนวนตัน<br>TONS</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;'><b>จำนวนเที่ยว<br>TRIPS</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;'><b>จำนวนเงิน<br>AMOUNT</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;'><b>หมายเหตุ<br>REMARK</b></td>
                                <td rowspan='1' style='text-align:center;background-color: #33FFFF;'><b>สถานะ<br>STATUS</b></td>
                            </tr>
                        </thead>";
        $tablebody =    "<tbody>";
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
                            $totalPrice += $row->BLB_NUMPRICE;
        $tablebody .=   "<tr>
                            <td style='text-align: center;'>".htmlspecialchars($row->BLB_CYCLE)."</td>
                            <td style='text-align: center;'>".htmlspecialchars($row->BLB_NUMINVOICE)."</td>
                            <td style='text-align: center;'>".htmlspecialchars($row->BLB_NUMPO)."</td>
                            <td style='text-align: center;'>".htmlspecialchars($row->BLB_NUMTONS)."</td>
                            <td style='text-align: center;'>".htmlspecialchars($row->BLB_NUMTRIPS)."</td>
                            <td style='text-align: center;'>".htmlspecialchars($row->BLB_NUMPRICE)."</td>
                            <td style='text-align: center;'>".htmlspecialchars($row->BLB_REMARK)."</td>";

                            $backgroundColor = '';
                            if (htmlspecialchars($row->BLB_STATUS) == 'Paid') {
                                $backgroundColor = 'background-color: #90EE90;'; 
                            } else if (htmlspecialchars($row->BLB_STATUS) == 'Pending') {
                                $backgroundColor = 'background-color: #FFFF99;';
                            } else if (htmlspecialchars($row->BLB_STATUS) == 'Overdue' || htmlspecialchars($row->BLB_STATUS) == 'Cancelled') {
                                $backgroundColor = 'background-color: #FF9999;'; 
                            }

        $tablebody .= "<td style='text-align: center; $backgroundColor'>";

                            if (htmlspecialchars($row->BLB_STATUS) == "Paid") {
                                $tablebody .= "ชำระเงินเสร็จสิ้น";
                            } else if (htmlspecialchars($row->BLB_STATUS) == "Pending") {
                                $tablebody .= "รอการชำระเงิน";
                            } else if (htmlspecialchars($row->BLB_STATUS) == "Overdue") {
                                $tablebody .= "เกินกำหนดชำระ";
                            } else if (htmlspecialchars($row->BLB_STATUS) == "Cancelled") {
                                $tablebody .= "ยกเลิก";
                            } else {
                                $tablebody .= htmlspecialchars($row->BLB_STATUS);
                            }
        $tablebody .= "</td></tr>";
                        }; 
        $tableclose =   "</tbody>        
                        <tfoot>
                            <tr style='height: 30px; vertical-align: middle; background-color: #FFFFFF;'>
                                <td colspan='3' style='text-align:center; font-weight: bold;'>ยอดรวมสุทธิ (NET TOTAL)</td>
                                <td style='text-align: center; font-weight: bold;'>".number_format($totalTons, 2)."</td>
                                <td style='text-align: center; font-weight: bold;'>".number_format($totalTrips, 0)."</td>
                                <td style='text-align: center; font-weight: bold;'>".number_format($totalPrice, 2)."</td>
                                <td colspan='2' style='text-align: center;'></td>
                            </tr>
                        </tfoot></table>";
        
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