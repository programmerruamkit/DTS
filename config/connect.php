<?php
  session_name("DEBTOR");
  session_start();
  error_reporting(0); 
  // error_reporting(E_ALL); 
  date_default_timezone_set('Asia/Bangkok');
  header("Cache-Control: public, max-age=3600"); 
  header("Cache-Control: private, max-age=3600");
  header('Content-Type: text/html; charset=UTF-8');

  function base_url(){
    return "http" . "://$_SERVER[HTTP_HOST]/"."";
  }
  function get_client_ip(){
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }
  class Database {
    /**
     * @var string|null
     * @return PDO
    */

    /** HOST */ 
    private $host = "RK02";
    private $dbname = "DTS";
    private $username = "sa";
    private $password = "Fpce#9084";
    private $conn = null;

    public function connect() {
      try{          
        $this->conn = new PDO('sqlsrv:server='.$this->host.';Database='.$this->dbname.';',$this->username,$this->password);
        $this->conn->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }catch(PDOException $exception){
        echo '<div style="
                text-align: center; 
                font-family: Arial, sans-serif; 
                margin-top: 50px; 
                padding: 30px;
                background-color: #f8d7da; 
                color: #721c24; 
                border: 2px solid #f5c6cb; 
                border-radius: 10px; 
                max-width: 800px; 
                margin: auto;
            ">';
        echo '    <h1 style="color: #d8000c;">⚠️ ขออภัยในความไม่สะดวก</h1>';
        echo '    <h2>ระบบ <span style="color: #0056b3;">ติดตามลูกหนี้</span> ไม่สามารถเชื่อมต่อฐานข้อมูลระบบ<span style="color: #0056b3;"></span>ได้</h2>';
        echo '    <p style="font-size: 18px; color: #721c24;">ทีมงานกำลังดำเนินการแก้ไขปัญหาโดยเร็วที่สุด ขออภัยในความไม่สะดวก</p>';
        echo '    <p style="font-size: 16px; color: #721c24;">';
        echo '    </p>';
        echo '</div>';
        exit();
      }
      return $this->conn;
    }
  }
  class Database1 {
    /**
     * @var string|null
     * @return PDO
    */
    /** LOCAL REQUEST 2 SERVER */ 
    private $host1 = "RK01";
    private $dbname1 = "RTMS";
    private $username1 = "sa";
    private $password1 = "Fpce#9084";
    private $conn1 = null;

    public function connect1() {
      try{         
        $this->conn1 = new PDO('sqlsrv:server='.$this->host1.';Database='.$this->dbname1.';',$this->username1,$this->password1);
        $this->conn1->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
        $this->conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }catch(PDOException $exception){
        echo '<div style="
                text-align: center; 
                font-family: Arial, sans-serif; 
                margin-top: 50px; 
                padding: 30px;
                background-color: #f8d7da; 
                color: #721c24; 
                border: 2px solid #f5c6cb; 
                border-radius: 10px; 
                max-width: 800px; 
                margin: auto;
            ">';
        echo '    <h1 style="color: #d8000c;">⚠️ ขออภัยในความไม่สะดวก</h1>';
        echo '    <h2>ระบบ <span style="color: #0056b3;">ติดตามลูกหนี้</span> ไม่สามารถเชื่อมต่อฐานข้อมูลระบบ <span style="color: #0056b3;">TMS</span> ได้</h2>';
        echo '    <p style="font-size: 18px; color: #721c24;">';
        echo '        ระบบ ติดตามลูกหนี้ จำเป็นต้องใช้ข้อมูลจากฐานข้อมูลของระบบ TMS<br>';
        echo '        หากฐานข้อมูลของระบบ TMS มีปัญหา อาจส่งผลให้ระบบ ติดตามลูกหนี้ ไม่สามารถใช้งานได้ชั่วคราว';
        echo '    </p>';
        echo '    <p style="font-size: 18px; color: #721c24;">ทีมงานกำลังดำเนินการแก้ไขปัญหาโดยเร็วที่สุด ขออภัยในความไม่สะดวก</p>';
        echo '    <p style="font-size: 16px; color: #721c24;">';
        echo '    </p>';
        echo '</div>';
        exit();
      }
      return $this->conn1;
    }
  }
  function write_log($page, $username, $ip){
      global $conn;
      $time = date("Y-m-d H:i:s");
      $sql = "INSERT INTO `log_tb` (`page`, `username`, `time`, `ip`) 
      VALUES ('$page', '$username', '$time' , '$ip')";
      $result = $conn->query($sql);
      return $result;
  }
  function get_session(){
    if(isset($_SESSION['ADMIN_EMAIL']))  {
      $admin = $_SESSION['ADMIN_EMAIL'];
    }else{
      $admin = "";
    }
    return $admin;
  }

  function selectNum($str){
    $b="0123456789";
    $n=strlen($str);
    $x=strlen($b);
    $newstr="";
    for($i=0;$i<=$n;$i++){
      for($j=0;$j<=$x;$j++)	{
        if($str[$i]==$b[$j])		{
          $newstr.=$b[$j];
        }
      }
    }
    return $newstr;
  }

  $dayTH = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
  $monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
  $monthTH_brev = [null,'ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
  function thai_date_and_time($time){  
      global $dayTH,$monthTH;   
      $thai_date_return = date("j",$time);   
      $thai_date_return.=" ".$monthTH[date("n",$time)];   
      $thai_date_return.= " ".(date("Y",$time)+543);   
      $thai_date_return.= " เวลา ".date("H:i:s",$time);
      return $thai_date_return;   
  } 
  function thai_date_and_time_short($time){ 
      global $dayTH,$monthTH_brev;   
      $thai_date_return = date("j",$time);   
      $thai_date_return.=" ".$monthTH_brev[date("n",$time)];   
      $thai_date_return.= " ".(date("Y",$time)+543);   
      $thai_date_return.= " ".date("H:i:s",$time);
      return $thai_date_return;   
  } 
  function thai_date_short($time){ 
      global $dayTH,$monthTH_brev;   
      $thai_date_return = date("j",$time);   
      $thai_date_return.=" ".$monthTH_brev[date("n",$time)];   
      $thai_date_return.= " ".(date("Y",$time)+543);   
      return $thai_date_return;   
  } 
  function thai_date_fullmonth($time){ 
      global $dayTH,$monthTH;   
      $thai_date_return = date("j",$time);   
      $thai_date_return.=" ".$monthTH[date("n",$time)];   
      $thai_date_return.= " ".(date("Y",$time)+543);   
      return $thai_date_return;   
  } 
  function thai_date_short_number($time){
      global $dayTH,$monthTH;   
      $thai_date_return = date("d",$time);   
      $thai_date_return.="-".date("m",$time);   
      $thai_date_return.= "-".substr((date("Y",$time)+543),-2);   
      return $thai_date_return;   
  } 
  function thai_date_month($time){ 
      global $dayTH,$monthTH;    
      $thai_date_return =" ".$monthTH[date("n",$time)]; 
      $thai_date_return.= " ปี ".(date("Y",$time)+543);   
      return $thai_date_return;   
  } 
  function thai_date_dmy($time){ 
      global $dayTH,$monthTH;    
      $thai_date_return = date("d",$time);   
      $thai_date_return.=" ".$monthTH[date("n",$time)]; 
      $thai_date_return.= " ".(date("Y",$time)+543);   
      return $thai_date_return;   
  } 

  $Database   =   new Database();
  $conn       =   $Database->connect();
  $Database1  =   new Database1();
  $conn1      =   $Database1->connect1();

  $query_setting = $conn->prepare("SELECT * FROM SETTING") or die("Error: " . $conn->errorInfo());
  $query_setting->execute();
  $result_setting = $query_setting->fetch(PDO::FETCH_OBJ);  

  $localhost     = "http://localhost/DEBTORTRACKINGSYSTEM_DTS/";
  $webhost        = "http://61.91.5.111:9000";