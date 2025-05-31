<?php 
session_name("DEBTOR");
session_start(); 
session_destroy();
$path = "../../"; 
require_once($path.'config/connect.php'); 
if(isset($_SESSION['AD_ID'])){
    header('Location: '.base_url().'ภาพรวม.html');  
}else{
require_once($path.'include/head.php'); 
?>

<body class="flex items-center justify-center min-h-screen py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">
    <div class="mb-0 border-none lg:w-[500px] card bg-white/70 shadow-none dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <a href="หน้าหลัก.html" aria-label="link">
                <img src="<?php echo $result_setting->ST_LOGO_LIGHT; ?>" alt="" class="hidden h-10 mx-auto dark:block">
                <img src="<?php echo $result_setting->ST_LOGO_DARK; ?>" alt="" class="block h-10 mx-auto dark:hidden">
            </a>
            <div class="mt-5 text-center">
                <h4 class="mb-2 text-black-500 dark:text-black-500">ยินดีต้อนรับ</h4>
                <p class="text-slate-500 dark:text-zink-200">กรุณาเข้าสู่ระบบเพื่อเข้าใช้งาน</p>
            </div>
            <form name="form1" method="post">
                <div class="hidden px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50" id="successAlert">
                    You have <b>successfully</b> signed in.
                </div>
                <div class="mb-3">
                    <label for="username" class="inline-block mb-2 text-base font-medium">UserName / ชื่อผู้ใช้</label>
                    <input type="text" inputmode="numeric" name="username" id="username" autocomplete="off" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-600 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="กรอกชื่อผู้ใช้">
                    <div id="username-error" class="hidden mt-1 text-sm text-red-500">Please enter a valid email address.</div>
                </div>
                <div class="mb-3"> 
                    <label for="password" class="inline-block mb-2 text-base font-medium">Password / รหัสผ่าน</label>
                    <input type="password" inputmode="numeric" name="password" id="password" autocomplete="off" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-600 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="กรอกรหัสผ่าน">
                    <div id="password-error" class="hidden mt-1 text-sm text-red-500">Password must be at least 8 characters long and contain both letters and numbers.</div>
                </div>
                <div class="mt-8 text-center">
                    <button aria-label="button" type="button" onclick="login_session()" class="bt_auth text-white btn bg-custom-600 border-custom-600 hover:text-white hover:bg-custom-800 hover:border-custom-800 focus:text-white focus:bg-custom-800 focus:border-custom-800 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-800 active:border-custom-800 active:ring active:ring-custom-100 dark:ring-custom-400/20"><b>เข้าสู่ระบบ</b></button>&emsp;
                    <a href="หน้าหลัก.html">
                        <button aria-label="button" type="button" class="bt_auth text-white bg-red-500 btn hover:text-black hover:bg-red-600 focus:text-black focus:bg-red-600 focus:ring focus:ring-red-100 active:text-black active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-black dark:focus:bg-red-500 dark:focus:text-black dark:active:bg-red-500 dark:active:text-black dark:ring-red-400/20"><b>ยกเลิก</b></button>
                    </a>
                </div>
            </form>
        </div>
        <a href="#" onclick="handleLoginClick();return false;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#B3B3B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-user-icon lucide-shield-user"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="M6.376 18.91a6 6 0 0 1 11.249.003"/><circle cx="12" cy="11" r="4"/></svg>
        </a>
    </div>
<?php require_once($path.'include/script.php'); ?>

</body>
</html>
<?php } ?>