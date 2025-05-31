<?php 
    require_once('connect.php');
    $CurrentTime = time();
    if($CurrentTime > $_SESSION["expire"]){
        header('Location: '.base_url().'เข้าสู่ระบบ.html');
    }
    if(!isset($_SESSION['AD_ID'])){
        header('Location: '.base_url().'เข้าสู่ระบบ.html');  
    }
?>