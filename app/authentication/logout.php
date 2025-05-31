<?php 
    session_name("DEBTOR");
    session_start();     
    $path = "../../"; 
    require_once($path.'config/authen.php'); 
    require_once($path.'config/connect.php'); 
    require_once($path.'include/head.php');              
    $SSPSC = $_SESSION['AD_PERSONCODE'];

    $check = $conn->prepare("EXECUTE ENB_USERLOGIN :proc,:username");
    $check->execute(array(':proc'=>'check_oldlogin',':username'=>$SSPSC,));
    $chk1null = $check->fetch(PDO::FETCH_OBJ); 
    if(isset($chk1null->PersonCode)) {
        $sqldelete = "DELETE FROM LOGING WHERE PersonCode = '$SSPSC' ";
        $result = $conn->query($sqldelete);		
    }
    session_destroy();
?>
    
<body class="flex items-center justify-center min-h-screen py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">
    
    <div class="mb-0 border-none lg:w-[500px] card bg-white/70 shadow-none dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <a href="หน้าหลัก.html">
                <img src="<?php echo $result_setting->ST_LOGO_LIGHT; ?>" alt="" class="hidden h-6 mx-auto dark:block">
                <img src="<?php echo $result_setting->ST_LOGO_DARK; ?>" alt="" class="block h-6 mx-auto dark:hidden">
            </a>
            <div class="mt-8 text-center">
                <div class="mb-4 text-center">
                    <i data-lucide="log-out" class="mx-auto text-purple-500 size-6 fill-purple-100"></i>
                </div>
                <h4 class="mb-2"><font color="blue">คุณออกจากระบบแล้ว</font></h4>
                <p class="mb-8 text-slate-500 dark:text-zink-200">ขอบคุณที่เข้ามาใช้งาน</p>
            </div>
            <a href="หน้าหลัก.html" class="w-full text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">หน้าหลัก</a>
        </div>
    </div>
<?php require_once($path.'include/script.php'); ?>

</body>
</html>