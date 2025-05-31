<?php 
    $path = "../../"; 
    require_once($path.'config/connect.php'); 
?>
<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?php echo $result_setting->ST_TITLE; ?></title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Trailler Daily Check" name="description">
    <meta content="Matavanary" name="author">
    <link rel="shortcut icon" href="<?php echo $result_setting->ST_ICON; ?>">
    <script src="assets/js/layout.js"></script>
    <link rel="stylesheet" href="assets/css/starcode2.css">
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>

<div style="display:none"><button id="addRow">Add New Row</button></div>
<div style="display:none"><button id="deleteButton">Delete Selected Row</button></div>
<div style="display:none"><input type="text" id="min" name="min"><input type="text" id="max" name="max"></div>
<style>
    .sbi_photo {
        background-size: contain !important;
    }
</style>
<body class="text-base bg-white text-body font-public dark:text-zink-50 dark:bg-zink-800">

    <nav class="fixed inset-x-0 top-0 z-50 flex items-center justify-center h-20 py-3 [&.is-sticky]:bg-white dark:[&.is-sticky]:bg-zink-700 border-b border-slate-200 dark:border-zink-500 [&.is-sticky]:shadow-lg [&.is-sticky]:shadow-slate-200/25 dark:[&.is-sticky]:shadow-zink-500/30 navbar" id="navbar">
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto flex items-center self-center w-full">
            <div class="shrink-0">
                <a href="#home" aria-label="DB">
                    <img rel="preload" src="<?php echo $result_setting->ST_LOGO_DARK; ?>" alt="" class="block h-10 w-100 dark:hidden sbi_photo" loading="lazy">
                    <!-- <img rel="preload" src="<?php echo $result_setting->ST_LOGO_LIGHT; ?>" alt="" class="hidden h-10 w-100 dark:block sbi_photo" loading="lazy"> -->
                </a>
            </div>
            <div class="mx-auto"></div>
            <div class="flex gap-2">
                <div class="ltr:ml-auto rtl:mr-auto md:hidden navbar-toggale-button">
                    <button type="button" aria-label="button" class="flex items-center  justify-center size-[37.5px] p-0 text-white btn bg-custom-600 border-custom-600 hover:text-white hover:bg-custom-800 hover:border-custom-800 focus:text-white focus:bg-custom-800 focus:border-custom-800 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-800 active:border-custom-800 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="menu"></i></button>
                </div>
                <?php if(isset($_SESSION['AD_PERSONCODE'])){ ?>
                    <a href="เข้าสู่ระบบ.html" class="text-white btn bg-custom-600 border-custom-600 hover:text-white hover:bg-custom-800 hover:border-custom-800 focus:text-white focus:bg-custom-800 focus:border-custom-800 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-800 active:border-custom-800 active:ring active:ring-custom-100 dark:ring-custom-400/20"><span class="align-middle">จัดการข้อมูล</span> <i data-lucide="log-in" class="inline-block size-4 ltr:ml-1 rtl:mr-1"></i></a>
                <?php } else{ ?>
                    <a href="เข้าสู่ระบบ.html" class="text-white btn bg-custom-600 border-custom-600 hover:text-white hover:bg-custom-800 hover:border-custom-800 focus:text-white focus:bg-custom-800 focus:border-custom-800 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-800 active:border-custom-800 active:ring active:ring-custom-100 dark:ring-custom-400/20"><span class="align-middle">เข้าสู่ระบบ</span> <i data-lucide="log-in" class="inline-block size-4 ltr:ml-1 rtl:mr-1"></i></a>
                <?php } ?>
            </div>
        </div>
    </nav>

    <section class="relative pb-36 pt-20" id="home">
        <!-- <div class="absolute rotate-45 border border-dashed size-[500px] border-t-slate-300 dark:border-t-zink-500 border-l-slate-300 dark:border-l-zink-500 border-r-slate-700 dark:border-r-zink-400 border-b-slate-700 dark:border-b-zink-400 -bottom-[250px] rounded-full ltr:right-40 rtl:left-40 z-10 hidden lg:block"></div> -->
        <!-- <div class="absolute rotate-45 border border-dashed size-[700px] border-t-slate-300 dark:border-t-zink-500 border-l-slate-300 dark:border-l-zink-500 border-r-slate-700 dark:border-r-zink-400 border-b-slate-700 dark:border-b-zink-400 -bottom-[350px] rounded-full ltr:right-16 rtl:left-16 z-10 hidden 2xl:block"></div> -->
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <div class="grid grid-cols-12 2xl:grid-cols-2">
                <!-- <div class="col-span-12 lg:col-span-7 2xl:col-span-1"> -->
                <div class="col-span-12">
                    <!-- md:text-5xl -->
                    <h1 class="mb-8 !leading-relaxed "><?php echo $result_setting->ST_NAMETH; ?><br><?php echo $result_setting->ST_NAMEEN; ?> 
                        <span class="relative inline-block px-2 mx-2 before:block before:absolute before:-inset-1 before:-skew-y-6 before:bg-sky-50 dark:before:bg-sky-500/20 before:rounded-md before:backdrop-blur-xl"><span class="relative text-sky-500">(<?php echo $result_setting->ST_NAMEEN_SHOT; ?>)</span></span>
                    </h1>
                    <p class="mb-6 text-black text-lg" loading="lazy">
                        &emsp;&emsp;<?php echo $result_setting->ST_DES0; ?>
                        <br><br>
                        &emsp;&emsp;<?php echo $result_setting->ST_DES1; ?>
                    </p>
                    <div class="flex items-center gap-2">
                        <a href="เข้าสู่ระบบ.html">
                            <button type="button" aria-label="button" class="py-2.5 px-6 text-white btn bg-custom-600 border-custom-600 hover:text-white hover:bg-custom-800 hover:border-custom-800 focus:text-white focus:bg-custom-800 focus:border-custom-800 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-800 active:border-custom-800 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="rocket" class="inline-block align-middle size-4 rtl:ml-1 ltr:mr-1"></i> <b>เริ่มใช้งานระบบ</b></button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <button id="back-to-top" aria-label="button" class="fixed flex items-center justify-center w-10 h-10 text-white bg-purple-500 rounded-md bottom-10 right-10">
        <i data-lucide="chevron-up" class="animate animate-icons"></i>
    </button>

    <script src="assets/libs/lucide/umd/lucide.js" ></script>
    <script src="assets/js/starcode.bundle.js" async></script>
    <script src="assets/js/pages/landing-onepage.init.js" async></script>
</body>
</html>