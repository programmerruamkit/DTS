<div class="flex items-center justify-center px-5 text-center h-header group-data-[layout=horizontal]:hidden group-data-[sidebar-size=sm]:fixed group-data-[sidebar-size=sm]:top-0 group-data-[sidebar-size=sm]:bg-vertical-menu group-data-[sidebar-size=sm]:group-data-[sidebar=dark]:bg-vertical-menu-dark group-data-[sidebar-size=sm]:group-data-[sidebar=brand]:bg-vertical-menu-brand group-data-[sidebar-size=sm]:group-data-[sidebar=modern]:bg-gradient-to-br group-data-[sidebar-size=sm]:group-data-[sidebar=modern]:to-vertical-menu-to-modern group-data-[sidebar-size=sm]:group-data-[sidebar=modern]:from-vertical-menu-form-modern group-data-[sidebar-size=sm]:group-data-[sidebar=modern]:bg-vertical-menu-modern group-data-[sidebar-size=sm]:z-10 group-data-[sidebar-size=sm]:w-[calc(theme('spacing.vertical-menu-sm')_-_1px)] group-data-[sidebar-size=sm]:group-data-[sidebar=dark]:dark:bg-zink-700">
    <a href="<?php echo base_url(); ?>ภาพรวม.html" class="group-data-[sidebar=dark]:hidden group-data-[sidebar=brand]:hidden group-data-[sidebar=modern]:hidden" aria-label="DB">
        <span class="hidden group-data-[sidebar-size=sm]:block">
            <img src="<?php echo $result_setting->ST_ICON; ?>" alt="" class="h-6 mx-auto" loading="lazy">
        </span>
        <span class="group-data-[sidebar-size=sm]:hidden">
            <img src="<?php echo $result_setting->ST_LOGO_DARK; ?>" alt="" class="h-6 mx-auto" loading="lazy">
        </span>
    </a>
    <a href="<?php echo base_url(); ?>ภาพรวม.html" class="hidden group-data-[sidebar=dark]:block group-data-[sidebar=brand]:block group-data-[sidebar=modern]:block" aria-label="DB">
        <span class="hidden group-data-[sidebar-size=sm]:block">
            <img src="<?php echo $result_setting->ST_ICON; ?>" alt="" class="h-6 mx-auto" loading="lazy">
        </span>
        <span class="group-data-[sidebar-size=sm]:hidden">
            <img src="<?php echo $result_setting->ST_LOGO_LIGHT; ?>" alt="" class="h-6 mx-auto" loading="lazy">
        </span>
    </a>
    <button type="button" class="hidden p-0 float-end" id="vertical-hover">
        <i class="ri-record-circle-line"></i>
    </button>
</div>
<div id="scrollbar" class="group-data-[sidebar-size=md]:max-h-[calc(100vh_-_theme('spacing.header')_*_1.2)] group-data-[sidebar-size=lg]:max-h-[calc(100vh_-_theme('spacing.header')_*_1.2)] group-data-[layout=horizontal]:h-56 group-data-[layout=horizontal]:md:h-auto group-data-[layout=horizontal]:overflow-auto group-data-[layout=horizontal]:md:overflow-visible group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:mx-auto">
    <div>
        <ul class="group-data-[layout=horizontal]:flex group-data-[layout=horizontal]:flex-col group-data-[layout=horizontal]:md:flex-row" id="navbar-nav">
            <?php 
                $SESSION_AREA=$_SESSION["AD_AREA"];
                $SESSION_ROLEID=$_SESSION["AD_ROLE_ID"];
                
                $query_sidemenu = $conn->prepare("EXECUTE ENB_SIDEBAR :proc,:role");
                $query_sidemenu->execute(array(':proc'=>'side_main',':role'=>$SESSION_ROLEID,));
                while($result_sidemenu = $query_sidemenu->fetch(PDO::FETCH_OBJ)) { 
                    $MN_ID=$result_sidemenu->MN_ID;
                    
                    $query_check_menusub = $conn->prepare("EXECUTE ENB_SIDEBAR :proc,:role,:parent");
                    $query_check_menusub->execute(array(':proc'=>'check_sub',':role'=>$SESSION_ROLEID,':parent'=>$MN_ID,));
                    $check_menusub = $query_check_menusub->fetch(PDO::FETCH_OBJ); 
                    
                    if(isset($check_menusub->MN_ID)){
                        if($check_menusub->MN_ID != ''){
                            $divmenusub = "dropdown-button";
                        }
                    }else{
                        $divmenusub = "";
                    }

                    if($result_sidemenu->MN_URL==$_SESSION['SIDEBAR']){
                        $active_main="active";
                    }elseif($_SESSION['DROPDOWN']==$MN_ID){
                        $active_main="active";
                        $dropdown="show";
                    }else{
                        $active_main="";
                        $dropdown="hidden";
                    }
            ?>    
            <li class="relative group-data-[layout=horizontal]:shrink-0 group/sm">
                <a href="<?php echo $result_sidemenu->MN_URL; ?>" class="relative <?php echo $divmenusub; ?> <?php echo $active_main; ?> [&.active]:text-vertical-menu-item-active [&.active]:bg-vertical-menu-item-bg-active flex items-center ltr:pl-3 rtl:pr-3 ltr:pr-5 rtl:pl-5 mx-3 my-1 group/menu-link text-vertical-menu-item-font-size font-normal transition-all duration-75 ease-linear rounded-md py-2.5 text-vertical-menu-item hover:text-vertical-menu-item-hover hover:bg-vertical-menu-item-bg-hover group-data-[sidebar=dark]:text-vertical-menu-item-dark group-data-[sidebar=dark]:hover:text-vertical-menu-item-hover-dark group-data-[sidebar=dark]:dark:hover:text-custom-800 group-data-[layout=horizontal]:dark:hover:text-custom-800 group-data-[sidebar=dark]:hover:bg-vertical-menu-item-bg-hover-dark group-data-[sidebar=dark]:dark:hover:bg-zink-600 group-data-[sidebar=dark]:[&.active]:text-vertical-menu-item-active-dark group-data-[sidebar=dark]:[&.active]:bg-vertical-menu-item-bg-active-dark group-data-[sidebar=brand]:text-vertical-menu-item-brand group-data-[sidebar=brand]:hover:text-vertical-menu-item-hover-brand group-data-[sidebar=brand]:hover:bg-vertical-menu-item-bg-hover-brand group-data-[sidebar=brand]:[&.active]:bg-vertical-menu-item-bg-active-brand group-data-[sidebar=brand]:[&.active]:text-vertical-menu-item-active-brand group-data-[sidebar=modern]:text-vertical-menu-item-modern group-data-[sidebar=modern]:hover:bg-vertical-menu-item-bg-hover-modern group-data-[sidebar=modern]:hover:text-vertical-menu-item-hover-modern group-data-[sidebar=modern]:[&.active]:bg-vertical-menu-item-bg-active-modern group-data-[sidebar=modern]:[&.active]:text-vertical-menu-item-active-modern group-data-[sidebar-size=md]:block group-data-[sidebar-size=md]:text-center group-data-[sidebar-size=sm]:group-hover/sm:w-[calc(theme('spacing.vertical-menu-sm')_*_3.63)] group-data-[sidebar-size=sm]:group-hover/sm:bg-vertical-menu group-data-[sidebar-size=sm]:group-data-[sidebar=dark]:group-hover/sm:bg-vertical-menu-dark group-data-[sidebar-size=sm]:group-data-[sidebar=modern]:group-hover/sm:bg-vertical-menu-border-modern group-data-[sidebar-size=sm]:group-data-[sidebar=brand]:group-hover/sm:bg-vertical-menu-brand group-data-[sidebar-size=sm]:my-0 group-data-[sidebar-size=sm]:rounded-b-none group-data-[layout=horizontal]:m-0 group-data-[layout=horizontal]:ltr:pr-8 group-data-[layout=horizontal]:rtl:pl-8 group-data-[layout=horizontal]:hover:bg-transparent group-data-[layout=horizontal]:[&.active]:bg-transparent [&.dropdown-button]:before:absolute [&.dropdown-button]:[&.show]:before:content-['\ea4e'] [&.dropdown-button]:before:content-['\ea6e'] [&.dropdown-button]:before:font-remix ltr:[&.dropdown-button]:before:right-2 rtl:[&.dropdown-button]:before:left-2 [&.dropdown-button]:before:text-16 group-data-[sidebar-size=sm]:[&.dropdown-b[button]:before:hidden group-data-[sidebar-size=md]:[&.dropdown-button]:before:hidden group-data-[sidebar=dark]:dark:text-zink-200 group-data-[layout=horizontal]:dark:text-zink-200 group-data-[sidebar=dark]:[&.active]:dark:bg-zink-600 group-data-[layout=horizontal]:dark:[&.active]:text-custom-800 rtl:[&.dropdown-button]:before:rotate-180 group-data-[layout=horizontal]:[&.dropdown-button]:before:rotate-90 group-data-[layout=horizontal]:[&.dropdown-button]:[&.show]:before:rotate-0 rtl:[&.dropdown-button]:[&.show]:before:rotate-]0">
                    <span class="min-w-[1.75rem] group-data-[sidebar-size=sm]:h-[1.75rem] inline-block text-start text-[16px] group-data-[sidebar-size=md]:block group-data-[sidebar-size=sm]:flex group-data-[sidebar-size=sm]:items-center">
                        <?php echo $result_sidemenu->MN_ICON; ?>
                    </span>
                    <span class="group-data-[sidebar-size=sm]:ltr:pl-10 group-data-[sidebar-size=sm]:rtl:pr-10 align-middle group-data-[sidebar-size=sm]:group-hover/sm:block group-data-[sidebar-size=sm]:hidden text-black dark:text-black">
                        &nbsp;<?php echo $result_sidemenu->MN_NAME; ?>
                    </span>
                </a>
                <?php if($divmenusub!=""){ ?>
                    <div class="dropdown-content group-data-[sidebar-size=sm]:ltr:left-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:right-vertical-menu-sm group-data-[sidebar-size=sm]:w-[calc(theme('spacing.vertical-menu-sm')_*_2.8)] group-data-[sidebar-size=sm]:absolute group-data-[sidebar-size=sm]:rounded-b-sm bg-vertical-menu group-data-[sidebar=dark]:bg-vertical-menu-dark group-data-[sidebar=dark]:dark:bg-zinc-700 group-data-[sidebar=brand]:bg-vertical-menu-brand group-data-[sidebar=modern]:bg-transparent group-data-[layout=horizontal]:md:absolute group-data-[layout=horizontal]:top-full group-data-[layout=horizontal]:md:w-44 group-data-[layout=horizontal]:py-2 group-data-[layout=horizontal]:rounded-b-md roup-data-[layout=horizontal]:md:shadow-lg group-data-[layout=horizontal]:md:shadow-slate-500/10 group-data-[layout=horizontal]:dark:bg-zinc-700 group-data-[layout=horizontal]:dark:md:shadow-zinc-600/20 <?php echo $dropdown; ?> group-data-[sidebar-size=sm]:hidden group-data-[sidebar-size=sm]:group-hover/sm:block group-data-[sidebar-size=sm]:ltr:rounded-br-md group-data-[sidebar-size=sm]:rtl:rounded-br-md group-data-[sidebar-size=sm]:shadow-lg group-data-[sidebar-size=sm]:shadow-slate-700/10 group-data-[sidebar-size=sm]:group-data-[sidebar=modern]:group-hover/sm:to-vertical-menu-to-modern group-data-[sidebar-size=sm]:group-data-[sidebar=modern]:group-hover/sm:from-vertical-menu-from-modern group-data-[sidebar-size=sm]:group-data-[sidebar=modern]:group-hover/sm:bg-gradient-to-tr">
                        <ul class="ltr:pl-[1.75rem] rtl:pr-[1.75rem] group-data-[sidebar-size=md]:ltr:pl-0 group-data-[sidebar-size=md]:rtl:pr-0 group-data-[sidebar-size=sm]:ltr:pl-0 group-data-[sidebar-size=sm]:rtl:pr-0 group-data-[sidebar-size=sm]:py-2 group-data-[layout=horizontal]:ltr:pl-0 group-data-[layout=horizontal]:rtl:pr-0">
                        <?php
                            $query_menusub = $conn->prepare("EXECUTE ENB_SIDEBAR :proc,:role,:parent");
                            $query_menusub->execute(array(':proc'=>'side_sub',':role'=>$SESSION_ROLEID,':parent'=>$MN_ID,));
                            while($result_menusub = $query_menusub->fetch(PDO::FETCH_OBJ)) { 
                                $MNS_ID=$result_menusub->MN_ID;
                                if(isset($_SESSION['DROPDOWN_ID'])){
                                    if($_SESSION['DROPDOWN_ID']==$MNS_ID){
                                        $active_sub="active";
                                    }else{
                                        $active_sub="";
                                    }
                                }else{
                                    $active_sub="";
                                }
                        ?>
                            <li>
                                <a href="<?php echo $result_menusub->MN_URL; ?>" class="relative <?php echo $active_sub; ?> flex items-center px-6 py-2 text-vertical-menu-item-font-size transition-all duration-75 ease-linear text-vertical-menu-sub-item hover:text-vertical-menu-sub-item-hover [&.active]:text-vertical-menu-sub-item-active before:absolute ltr:before:left-1.5 rtl:before:right-1.5 before:top-4 before:w-1 before:h-1 before:rounded before:transition-all before:duration-75 before:ease-linear before:bg-vertical-menu-sub-item hover:before:bg-vertical-menu-sub-item-hover [&.active]:before:bg-vertical-menu-sub-item-active group-data-[sidebar=dark]:text-vertical-menu-sub-item-dark group-data-[sidebar=dark]:dark:text-zink-200 group-data-[layout=horizontal]:dark:text-zink-200 group-data-[layout=horizontal]:dark:hover:text-custom-800 group-data-[sidebar=dark]:hover:text-vertical-menu-sub-item-hover-dark group-data-[sidebar=dark]:dark:hover:text-custom-800 group-data-[sidebar=dark]:[&.active]:text-vertical-menu-sub-item-active-dark group-data-[sidebar=dark]:dark:[&.active]:text-custom-800 group-data-[layout=horizontal]:dark:[&.active]:text-custom-800 group-data-[sidebar=dark]:before:bg-vertical-menu-sub-item-dark/50 group-data-[sidebar=dark]:hover:before:bg-vertical-menu-sub-item-hover-dark group-data-[sidebar=dark]:dark:hover:before:bg-custom-800 group-data-[sidebar=dark]:[&.active]:before:bg-vertical-menu-sub-item-active-dark group-data-[sidebar=dark]:dark:[&.active]:before:bg-custom-800 group-data-[sidebar=brand]:text-vertical-menu-sub-item-brand group-data-[sidebar=brand]:hover:text-vertical-menu-sub-item-hover-brand group-data-[sidebar=brand]:before:bg-vertical-menu-sub-item-brand/80 group-data-[sidebar=brand]:hover:before:bg-vertical-menu-sub-item-hover-brand/80 group-data-[sidebar=brand]:[&.active]:before:bg-vertical-menu-sub-item-active-brand/80 group-data-[sidebar=brand]:[&.active]:text-vertical-menu-sub-item-active-brand group-data-[sidebar=modern]:text-vertical-menu-sub-item-modern group-data-[sidebar=modern]:before:bg-vertical-menu-sub-item-modern/70 group-data-[sidebar=modern]:hover:text-vertical-menu-sub-item-hover-modern group-data-[sidebar=modern]:before:hover:bg-vertical-menu-sub-item-hover-modern group-data-[sidebar=modern]:[&.active]:text-vertical-menu-sub-item-active-modern group-data-[sidebar=modern]:before:[&.active]:text-vertical-menu-sub-item-active-modern group-data-[sidebar-size=md]:before:hidden group-data-[sidebar-size=md]:text-center group-data-[sidebar-size=md]:block group-data-[sidebar-size=sm]:before:hidden group-data-[layout=horizontal]:before:left-[1.4rem] group-data-[layout=horizontal]:md:before:hidden group-data-[layout=horizontal]:ltr:pl-10 group-data-[layout=horizontal]:rtl:pr-10 group-data-[layout=horizontal]:ltr:pr-5 group-data-[layout=horizontal]:rtl:pl-5 group-data-[layout=horizontal]:md:!px-5">
                                    &nbsp;<?php echo $result_menusub->MN_NAME; ?>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<?php  
	// echo"<pre>";
	// print_r($_SESSION['SIDEBAR']);
	// echo"</pre>";
	// echo"<pre>";
	// print_r($_SESSION['DROPDOWN']);
	// echo"</pre>";
	// echo"<pre>";
	// print_r($_SESSION['DROPDOWN_ID']);
	// echo"</pre>";
	// exit();
?>
