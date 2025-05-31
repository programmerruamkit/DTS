
<div id="sidebar-overlay" class="absolute inset-0 z-[1002] bg-slate-500/30 hidden"></div>
    <header id="page-topbar" class="ltr:md:left-vertical-menu rtl:md:right-vertical-menu group-data-[sidebar-size=md]:ltr:md:left-vertical-menu-md group-data-[sidebar-size=md]:rtl:md:right-vertical-menu-md group-data-[sidebar-size=sm]:ltr:md:left-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:md:right-vertical-menu-sm group-data-[layout=horizontal]:ltr:left-0 group-data-[layout=horizontal]:rtl:right-0 fixed right-0 z-[1000] left-0 print:hidden group-data-[navbar=bordered]:m-4 group-data-[navbar=bordered]:[&.is-sticky]:mt-0 transition-all ease-linear duration-300 group-data-[navbar=hidden]:hidden group-data-[navbar=scroll]:absolute group/topbar group-data-[layout=horizontal]:z-[1004]">
        <div class="layout-width">
            <div class="flex items-center px-4 mx-auto bg-topbar border-b-2 border-topbar group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:border-topbar-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:border-topbar-brand shadow-md h-header shadow-slate-200/50 group-data-[navbar=bordered]:rounded-md group-data-[navbar=bordered]:group-[.is-sticky]/topbar:rounded-t-none group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:border-zink-700 dark:shadow-none group-data-[topbar=dark]:group-[.is-sticky]/topbar:dark:shadow-zink-500 group-data-[topbar=dark]:group-[.is-sticky]/topbar:dark:shadow-md group-data-[navbar=bordered]:shadow-none group-data-[layout=horizontal]:group-data-[navbar=bordered]:rounded-b-none group-data-[layout=horizontal]:shadow-none group-data-[layout=horizontal]:dark:group-[.is-sticky]/topbar:shadow-none">
                <div class="flex items-center w-full group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl navbar-header group-data-[layout=horizontal]:ltr:xl:pr-3 group-data-[layout=horizontal]:rtl:xl:pl-3">
                    <div class="items-center justify-center hidden px-5 text-center h-header group-data-[layout=horizontal]:md:flex group-data-[layout=horizontal]:ltr::pl-0 group-data-[layout=horizontal]:rtl:pr-0">
                        <a href="<?php echo base_url(); ?>index.html">
                            <span class="hidden">
                                <img src="<?php echo $result_setting->ST_ICON; ?>" alt="" class="h-10 mx-auto">
                            </span>
                            <span class="group-data-[topbar=dark]:hidden group-data-[topbar=brand]:hidden">
                                <img src="<?php echo $result_setting->ST_LOGO_DARK; ?>" alt="" class="h-10 mx-auto">
                            </span>
                        </a>
                        <a href="<?php echo base_url(); ?>index.html" class="hidden group-data-[topbar=dark]:block group-data-[topbar=brand]:block">
                            <span class="group-data-[topbar=dark]:hidden group-data-[topbar=brand]:hidden">
                                <img src="<?php echo $result_setting->ST_ICON; ?>" alt="" class="h-10 mx-auto">
                            </span>
                            <span class="group-data-[topbar=dark]:block group-data-[topbar=brand]:block">
                                <img src="<?php echo $result_setting->ST_LOGO_LIGHT; ?>" alt="" class="h-10 mx-auto">
                            </span>
                        </a>
                    </div>

                    <button type="button" aria-label="button" class="inline-flex relative justify-center items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-75 ease-linear bg-topbar rounded-md btn hover:bg-slate-100 group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:border-topbar-dark group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:border-topbar-brand group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:text-zink-200 group-data-[topbar=dark]:dark:border-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[layout=horizontal]:flex group-data-[layout=horizontal]:md:hidden hamburger-icon" id="topnav-hamburger-icon">
                        <i data-lucide="chevrons-left" class="w-5 h-5 group-data-[sidebar-size=sm]:hidden"></i>
                        <i data-lucide="chevrons-right" class="hidden w-5 h-5 group-data-[sidebar-size=sm]:block"></i>
                    </button>
                    &emsp;<span id="show_text"></span>
                    <script>
                        var wait_time=<?php echo $_SESSION["expire"]-time(); ?>;
                        var vela;
                        window.onload=function(){  
                            vela=setInterval("decrease_num()",1000);  
                        }  
                        function decrease_num(){  
                            // console.log(wait_time);
                            if(wait_time>0){  
                            var show_place=document.getElementById('show_text');  
                            show_place.innerHTML = 'Time Out '+wait_time+' Sec.';  
                            wait_time--;  
                            }else{  
                                if(wait_time===0){  
                                    clearInterval(vela);  
                                    Swal.fire({
                                        title: 'หมดเวลาเข้าใช้งาน...',
                                        text: 'ชื่อผู้ใช้และรหัสผ่านหมดอายุ กรุณาเข้าสู่ระบบใหม่อีกครั้ง',
                                        icon: 'warning',
                                        showCancelButton: false,
                                        confirmButtonColor: 'blue',
                                        confirmButtonText: 'ตกลง',
                                        cancelButtonText: 'ยกเลิก'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload(); 
                                        }
                                    })      
                                }     
                            }  
                        } 
                    </script>
                    <div class="flex gap-3 ms-auto"> 
                        <!-- <div class="relative flex items-center h-header">
                            <button type="button" aria-label="button" class="inline-flex relative justify-center items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-200 ease-linear bg-topbar rounded-md btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200 group-data-[topbar=dark]:text-topbar-item-dark" id="light-dark-mode">
                                <i data-lucide="sun" class="inline-block w-5 h-5 stroke-1 fill-slate-100 group-data-[topbar=dark]:fill-topbar-item-bg-hover-dark group-data-[topbar=brand]:fill-topbar-item-bg-hover-brand"></i>
                            </button>
                        </div> -->

                        <!-- <div class="relative items-center hidden h-header md:flex">
                            <button data-drawer-target="customizerButton" aria-label="button" type="button" class="inline-flex justify-center items-center p-0 text-topbar-item transition-all w-[37.5px] h-[37.5px] duration-200 ease-linear bg-topbar group-data-[topbar=dark]:text-topbar-item-dark rounded-md btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200">
                                <i data-lucide="settings" class="inline-block w-5 h-5 stroke-1 fill-slate-100 group-data-[topbar=dark]:fill-topbar-item-bg-hover-dark group-data-[topbar=brand]:fill-topbar-item-bg-hover-brand"></i>
                            </button>
                        </div> -->
                        
                        <div class="relative flex items-center dropdown h-header"><?php echo $_SESSION['AD_NAMETHAI']; ?>&emsp;
                            <button type="button" aria-label="button" class="inline-flex justify-center items-center p-0 text-topbar-item transition-all w-[60px] h-[37.5px] duration-200 ease-linear bg-topbar rounded-md dropdown-toggle btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=dark]:dark:text-zink-500 group-data-[topbar=dark]:dark:hover:text-zink-50" id="flagsDropdown" data-bs-toggle="dropdown">
                                <h6 class="transition-all duration-200 ease-linear font-15medium text- text-slate-600 dark:text-zink-200 group-hover/items:text-custom-500"><?=$_SESSION['AD_ROLE_NAME'];?> - <?=$_SESSION['AD_AREA'];?></h6>
                            </button>
                            <div class="absolute z-50 hidden p-4 ltr:text-left rtl:text-right bg-white rounded-md shadow-md !top-4 dropdown-menu min-w-[10rem] flex flex-col gap-4 dark:bg-zink-600" aria-labelledby="flagsDropdown">
                                <?php
                                    $query_login = $conn->prepare("EXECUTE ENB_NAVBAR :proc,:username,:password");
                                    $query_login->execute(array(':proc'=>'check_role',':username'=>$_SESSION['AD_ROLEACCOUNT_USERNAME'],':password'=>$_SESSION['AD_ROLEACCOUNT_PASSWORD'],));
                                    $no=1;
                                    while($result_login = $query_login->fetch(PDO::FETCH_OBJ)) { 
                                        $AD_RA_ID = $result_login->RA_ID;
                                        $AD_ROLE_ID = $result_login->RU_ID;
                                        $AD_ROLE_NAME = $result_login->RU_NAME;
                                        $AD_AREA = $result_login->AREA;	                    
                                ?>                              
                                <a href="#;" class="flex items-center gap-3 group/items language" onclick="role_session('<?=$_SESSION['AD_ROLEACCOUNT_USERNAME'];?>','<?=$_SESSION['AD_ROLEACCOUNT_PASSWORD'];?>',<?=$AD_ROLE_ID;?>,<?=$AD_RA_ID;?>)">
                                    <h6 class="transition-all duration-200 ease-linear font-15medium text- text-slate-600 dark:text-zink-200 group-hover/items:text-custom-500"><?=$AD_ROLE_NAME?> - <?=$AD_AREA?></h6>
                                </a>
                                <?php $no++; } ?>
                            </div>
                        </div>

                        <div class="relative flex items-center dropdown h-header">
                        <!-- <div class="relative flex items-center h-header"> -->
                            <button type="button" aria-label="button" class="inline-block p-0 transition-all duration-200 ease-linear bg-topbar rounded-full text-topbar-item dropdown-toggle btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <div class="bg-pink-100 rounded-full">
                                    <?php
                                        if($_SESSION["AD_ROLE_NAME"]==="ADMIN"){
                                            $img="https://img2.pic.in.th/pic/admin_person_user_man_2839.png";
                                        }else if($_SESSION["AD_ROLE_NAME"]==="OFFICER"){
                                            $img="https://img2.pic.in.th/pic/supervisor_people_man_you_2840.png";
                                        }else if($_SESSION["AD_ROLE_NAME"]==="MASTER"){
                                            $img="https://img2.pic.in.th/pic/teacher_man_avatar_person_2836.png";
                                        }
                                    ?>
                                    <img src="<?=$img;?>" alt="" class="w-[37.5px] h-[37.5px] rounded-full">
                                </div>
                            </button>
                            <!-- ปิดใช้การแสดงโปรไฟล์แบบเดิม เมื่อกดที่รูป -->
                            <!-- <div class="absolute z-50 hidden p-4 ltr:text-left rtl:text-right bg-white rounded-md shadow-md !top-4 dropdown-menu min-w-[14rem] dark:bg-zink-600" aria-labelledby="dropdownMenuButton"> -->
                                <!-- อันนี้ิดอยู่แล้ว <h6 class="mb-2 text-sm font-normal text-slate-500 dark:text-zink-300">Welcome to starcode</h6> -->
                                <!-- <a href="#" class="flex gap-3 mb-3">
                                    <div class="relative inline-block shrink-0">
                                        <div class="rounded bg-slate-100 dark:bg-zink-500">
                                            <img src="<?=$img;?>" alt="" class="w-12 h-12 rounded">
                                        </div>
                                        <span class="-top-1 ltr:-right-1 rtl:-left-1 absolute w-2.5 h-2.5 bg-green-400 border-2 border-white rounded-full dark:border-zink-600"></span>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 text-15"><?php echo $_SESSION['AD_NAMETHAI']; ?></h6>

                                        <p class="text-slate-500 dark:text-zink-300"><?php echo $_SESSION['AD_POSITION']; ?></p>
                                    </div>
                                </a>
                                <ul>
                                    <li>
                                        <a class="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500" href="pages-account.html"><i data-lucide="user-2" class="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a class="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500" href="apps-mailbox.html"><i data-lucide="mail" class="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> Inbox <span class="inline-flex items-center justify-center w-5 h-5 ltr:ml-2 rtl:mr-2 text-[11px] font-medium border rounded-full text-white bg-red-500 border-red-500">15</span></a>
                                    </li>
                                    <li>
                                        <a class="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500" href="apps-chat.html"><i data-lucide="messages-square" class="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> Chat</a>
                                    </li>
                                    <li>
                                        <a class="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500" href="pages-pricing.html"><i data-lucide="gem" class="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> Upgrade <span class="inline-flex items-center justify-center w-auto h-5 ltr:ml-2 rtl:mr-2 px-1 text-[12px] font-medium border rounded text-white bg-sky-500 border-sky-500">Pro</span></a>
                                    </li>
                                    <li class="pt-2 mt-2 border-t border-slate-200 dark:border-zink-500">
                                        <a href="ออกจากระบบ.html" class="block ltr:pr-4 rtl:pl-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500"><i data-lucide="log-out" class="inline-block size-4 ltr:mr-2 rtl:ml-2"></i> ออกจากระบบ</a>
                                    </li>
                                </ul> -->
                            <!-- เปิดใช้การเลือกสิทธิ์ เมื่อกดที่รูป -->
                            <div class="absolute z-50 hidden p-4 ltr:text-left rtl:text-right bg-white rounded-md shadow-md !top-4 dropdown-menu min-w-[10rem] flex flex-col gap-4 dark:bg-zink-600" aria-labelledby="flagsDropdown">
                                <?php
                                    $query_login = $conn->prepare("EXECUTE ENB_NAVBAR :proc,:username,:password");
                                    $query_login->execute(array(':proc'=>'check_role',':username'=>$_SESSION['AD_ROLEACCOUNT_USERNAME'],':password'=>$_SESSION['AD_ROLEACCOUNT_PASSWORD'],));
                                    $no=1;
                                    while($result_login = $query_login->fetch(PDO::FETCH_OBJ)) { 
                                        $AD_RA_ID = $result_login->RA_ID;
                                        $AD_ROLE_ID = $result_login->RU_ID;
                                        $AD_ROLE_NAME = $result_login->RU_NAME;
                                        $AD_AREA = $result_login->AREA;	                    
                                ?>                              
                                <a href="#;" class="flex items-center gap-3 group/items language" onclick="role_session('<?=$_SESSION['AD_ROLEACCOUNT_USERNAME'];?>','<?=$_SESSION['AD_ROLEACCOUNT_PASSWORD'];?>',<?=$AD_ROLE_ID;?>,<?=$AD_RA_ID;?>)">
                                    <h6 class="transition-all duration-200 ease-linear font-15medium text- text-slate-600 dark:text-zink-200 group-hover/items:text-custom-500"><?=$AD_ROLE_NAME?> - <?=$AD_AREA?></h6>
                                </a>
                                <?php $no++; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
