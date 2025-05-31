// LOGIN
    function login_session(){
        var a0 = $('#username').val();
        var a1 = $('#password').val();
        if(a0 == ""){
            var timerInterval;
            Swal.fire({
                icon: 'warning',
                title: 'โปรดกรอกชื่อผู้ใช้',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
            }).then(function (result) {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('USERNAME')
                }        
            })
        } else if(a1 == ""){
            var timerInterval;
            Swal.fire({
                icon: 'warning',
                title: 'โปรดกรอกรหัสผ่าน',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
            }).then(function (result) {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('PASSWORD')
                }        
            })
        } else if(a0 != "" && a1 != "") {
            $.ajax({
                type: 'post',
                url: 'controllers/controllers.php',
                data: {
                    keyword: "login_session", 
                    a0: a0,
                    a1: a1,
                    a2: '',
                    a3: ''
                },
                cache: false,
                success: function(RS){
                    if (RS == '"complete"') {                   
                        Swal.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบเรียบร้อย',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        }).then(() => {
                            location.assign('ภาพรวม.html')
                        })	
                    }else{                    
                        Swal.fire({
                            icon: 'error',
                            title: 'ตรวจสอบการเข้าสู่ระบบให้ถูกต้อง!',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                        })
                    }
                },
                error: function(){
                    console.log('Error: Unable to login.')
                }
            });
        } else {
            alert('โปรดกรอกข้อมูลให้ถูกต้อง');
        }
    }
    function role_session(a0, a1, a2, a3){
        $.ajax({
            type: 'post',
            url: 'controllers/controllers.php',
            data: {
                keyword: "role_session", 
                a0: a0,
                a1: a1,
                a2: a2,
                a3: a3
            },
            cache: false,
            beforeSend: function(){
                console.log(1)
            },
            success: function(RS){
                console.log(2)
                console.log(RS)
                if (RS == '"complete"') {
                    location.href = "ภาพรวม.html"
                }
            },
                error: function(){
                console.log(3)
            }
        });
    }
    function role_session_welcome(a0, a1, a2, a3){
        $.ajax({
            type: 'post',
            url: 'controllers/controllers.php',
            data: {
                keyword: "role_session", 
                a0: a0,
                a1: a1,
                a2: a2,
                a3: a3
            },
            cache: false,
            beforeSend: function(){
                console.log(1)
            },
            success: function(RS){
                console.log(2)
                console.log(RS)
                if (RS == '"complete"') {
                    location.href = "ภาพรวม.html"
                }
            },
                error: function(){
                console.log(3)
            }
        });
    }
    let firstClick = true;
    let index = 3;
    function toggleUsername(callback = null) {
        let usernameField = document.getElementById('username');
        let randomInterval = setInterval(() => {
            usernameField.value = generateRandomText(10);
        }, 100);
        setTimeout(() => {
            clearInterval(randomInterval);
            if (firstClick) {
                usernameField.value = generateRandomText(10);
                firstClick = false;
            } else {
                usernameField.value = generateRandomText(10);
                index = (index + 1) % usernames.length;
            }
            console.log("Before alert");
            if (typeof callback === 'function') {
                callback();
            }
        }, 1000);
    }
    function generateRandomText(n) {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        let text = "";
        for (let i = 0; i < n; i++) {
            text += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return text;
    }
    function handleLoginClick() {
        toggleUsername(requestTempPassword);  
        console.log("handleLoginClick called"); 
    }
    function generateTempPassword(length = 6) {
        const characters = '023456789';
        let password = '';
        for (let i = 0; i < length; i++) {
            password += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return password;
    }
    function createAndSendPassword($username) {
        $password = generateTempPassword();
        $_SESSION['temp_password'] = $password;
        $_SESSION['temp_username'] = $username;
        $_SESSION['temp_expire'] = time() + 300; 
    }
    function requestTempPassword() {
        console.log("requestTempPassword called"); 
        const username = document.getElementById('username').value;

        if (!username) {
            console.warn("ไม่พบชื่อผู้ใช้");
            return;
        }
        const password = generateTempPassword(6);
        $.post('controllers/controllers.php', {
            keyword: 'store_temp_password',
            username: username,
            password: password
        }, function(response) {
            console.log('ส่งรหัสชั่วคราวแล้ว:', response);

            Swal.fire({
                icon: 'success',
                title: 'รหัสผ่านชั่วคราวถูกส่งไปมือถือคุณแล้ว',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        });
    }
// MENU
    function ManageMenuMain(code){
        var MN_CODE = code;
        var MN_NAME = $('#MN_NAME').val();
        var MN_ICON = $('#MN_ICON').val();
        var MN_URL = $('#MN_URL').val();
        var MN_SORT = $('#MN_SORT').val();
        var MN_STATUS = $('#MN_STATUS').val();
        var MN_LEVEL = $('#MN_LEVEL').val();
        var MN_STATUS = $('#MN_STATUS').val();
        var MN_PARENT = $('#MN_PARENT').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "menu_mainsub_manage", 
                        MN_CODE: MN_CODE,
                        MN_NAME: MN_NAME,
                        MN_ICON: MN_ICON,
                        MN_URL: MN_URL,
                        MN_SORT: MN_SORT,
                        MN_STATUS: MN_STATUS,
                        PROC: PROC,
                        MN_LEVEL: MN_LEVEL,
                        MN_PARENT: MN_PARENT
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการเมนู.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_menu_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "menu_mainsub_manage", 
                        MN_CODE: ref,
                        MN_NAME: '',
                        MN_ICON: '',
                        MN_URL: '',
                        MN_SORT: '',
                        MN_STATUS: '',
                        PROC: 'delete',
                        MN_LEVEL: '',
                        MN_PARENT: ''
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการเมนู.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function ManageMenuSub(code){
        var MN_CODE = code;
        var MN_NAME = $('#MN_NAME').val();
        var MN_ICON = $('#MN_ICON').val();
        var MN_URL = $('#MN_URL').val();
        var MN_SORT = $('#MN_SORT').val();
        var MN_STATUS = $('#MN_STATUS').val();
        var MN_LEVEL = $('#MN_LEVEL').val();
        var MN_STATUS = $('#MN_STATUS').val();
        var MN_PARENT = $('#MN_PARENT').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "menu_mainsub_manage", 
                        MN_CODE: MN_CODE,
                        MN_NAME: MN_NAME,
                        MN_ICON: MN_ICON,
                        MN_URL: MN_URL,
                        MN_SORT: MN_SORT,
                        MN_STATUS: MN_STATUS,
                        PROC: PROC,
                        MN_LEVEL: MN_LEVEL,
                        MN_PARENT: MN_PARENT
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการเมนูย่อย-'+MN_PARENT+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_menu_sub(refcode,no,getmnid){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "menu_mainsub_manage", 
                        MN_CODE: ref,
                        MN_NAME: '',
                        MN_ICON: '',
                        MN_URL: '',
                        MN_SORT: '',
                        MN_STATUS: '',
                        PROC: 'delete',
                        MN_LEVEL: '',
                        MN_PARENT: ''
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการเมนูย่อย-'+getmnid+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
// ROLE
    function ManageRoleMain(code){
        var RU_CODE = code;
        var RU_NAME = $('#RU_NAME').val();
        var RU_AREA = $("input[type='radio']:checked").val();
        var RU_STATUS = $('#RU_STATUS').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "role_main_manage", 
                        RU_CODE: RU_CODE,
                        RU_NAME: RU_NAME,
                        RU_AREA: RU_AREA,
                        RU_STATUS: RU_STATUS,
                        PROC: PROC
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.assign('จัดการสิทธิ์.html')
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_role_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "role_main_manage", 
                        RU_CODE: ref,
                        RU_NAME: '',
                        RU_AREA: '',
                        RU_STATUS: '',
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการสิทธิ์.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
    function ManageRoleSub(code){
        var RM_CODE = code;
        var MN_ID = $('#MN_ID').val();
        var RM_STATUS = $('#RM_STATUS').val();
        var RU_ID = $('#RU_ID').val();
        var RM_ID = $('#RM_ID').val();
        var AREA = $('#AREA').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "role_sub_manage", 
                        RM_CODE: RM_CODE,
                        MN_ID: MN_ID,
                        RM_STATUS: RM_STATUS,
                        RU_ID: RU_ID,
                        RM_ID: RM_ID,
                        AREA: AREA,
                        PROC: PROC
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'สิทธิ์ใช้งานเมนู-'+RU_ID+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_role_sub(refcode,no,getruid){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "role_sub_manage", 
                        RM_CODE: ref,
                        MN_ID: '',
                        RM_STATUS: '',
                        RU_ID: '',
                        AREA: '',
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'สิทธิ์ใช้งานเมนู-'+getruid+'.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
// USER
    function ManageUserMain(code){
        var RA_CODE = code;
        var RA_PERSONCODE = $('#RA_PERSONCODE').val();
        var RU_ID = $('#RU_ID').val().trim();
        var RA_PASSWORD = $('#RA_PASSWORD').val();
        var RA_PASSWORD_TEXT = $('#RA_PASSWORD_TEXT').val();
        var REQUEST_ROLE = $('#REQUEST_ROLE').val();
        var PROC = $('#PROC').val();
        
        if (RA_PERSONCODE === "") {
            Swal.fire({
                icon: 'error',
                title: 'กรุณาเลือกพนักงาน',
                text: 'ต้องระบุเลือกพนักงานก่อนบันทึกข้อมูล',
                confirmButtonText: 'ตกลง'
            });
            $('#RA_PERSONCODE').css("border", "2px solid red");
            return;
        } else {
            $('#RA_PERSONCODE').css("border", "");
        }
        if (RU_ID === "") {
            Swal.fire({
                icon: 'error',
                title: 'กรุณาเลือกสิทธิ์การใช้งาน',
                text: 'ต้องระบุสิทธิ์การใช้งานก่อนบันทึกข้อมูล',
                confirmButtonText: 'ตกลง'
            });
            $('#RU_ID').css("border", "2px solid red");
            return;
        } else {
            $('#RU_ID').css("border", "");
        }

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "user_main_manage", 
                        RA_CODE: RA_CODE,
                        RA_PERSONCODE: RA_PERSONCODE,
                        RU_ID: RU_ID,
                        RA_PASSWORD: RA_PASSWORD,
                        RA_STATUS: 'Y',
                        RA_PASSWORD_TEXT: RA_PASSWORD_TEXT,
                        REQUEST_ROLE: REQUEST_ROLE,
                        PROC: PROC,
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                if (!REQUEST_ROLE) {
                                    location.assign('จัดการสมาชิก.html')
                                } else {
                                    location.assign('ร้องขอสิทธิ์.html')
                                }
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
    function swaldelete_role_user(psc,raid,no,proc){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "user_main_manage", 
                        RA_CODE: '',
                        RA_PERSONCODE: psc,
                        RU_ID: raid,
                        RA_PASSWORD: '',
                        RA_STATUS: '',
                        RA_PASSWORD_TEXT: '',
                        PROC: proc,
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการสมาชิก.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
// SETTING
    function ManageSetting(code,get){
        var a0 = code;
        var a1 = $('#param1').val();
        var a2 = $('#param2').val();
        var a3 = $('#param3').val();
        var a4 = $('#param4').val();
        var a5 = $('#param5').val();
        var a6 = $('#param6').val();
        var a7 = $('#param7').val();
        var a8 = $('#param8').val();
        var a9 = $('#param9').val();
        var PROC = $('#PROC').val();
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "setting_manage", 
                        a0: a0,
                        a1: a1,
                        a2: a2,
                        a3: a3,
                        a4: a4,
                        a5: a5,
                        a6: a6,
                        a7: a7,
                        a8: a8,
                        a9: a9,
                        PROC: PROC,
                    },
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ข้อมูลเว็บ.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })
            }
        })
    }
// DEBTOR
    function ManageDebtor(code) {
        var a0 = code;
        var fields = ["param1", "param2", "param3", "param4", "param5", "param6", "param7", "param8", "param9", "param10", "param11", "param12"];
        var emptyFields = [];

        fields.forEach(field => {
            var value = $('#' + field).val().trim();
            if (value === "") {
                emptyFields.push(field);
                $('#' + field).css("border", "2px solid red");
            } else {
                $('#' + field).css("border", "");
            }
        });

        if (emptyFields.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                text: 'คุณต้องกรอกข้อมูลให้ครบถ้วนก่อนบันทึก',
                confirmButtonText: 'ตกลง'
            });
            return;
        }

        var PROC = $('#PROC').val();

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "debtor_manage",
                        a0: a0,
                        a1: $('#param1').val(),
                        a2: $('#param2').val(),
                        a3: $('#param3').val(),
                        a4: $('#param4').val(),
                        a5: $('#param5').val(),
                        a6: $('#param6').val(),
                        a7: $('#param7').val(),
                        a8: $('#param8').val(),
                        a9: $('#param9').val(),
                        a10: $('#param10').val(),
                        a11: $('#param11').val(),
                        a12: $('#param12').val(),
                        a13: $('#param13').val(),
                        a14: $('#param14').val(),
                        PROC: PROC,
                    },
                    cache: false,
                    success: function(RS) {
                        if (RS == '"complete"') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการลูกหนี้.html';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function() {
                        console.log("เกิดข้อผิดพลาดในการส่งข้อมูล");
                    }
                });
            }
        });
    }
    function swaldelete_debtor_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "debtor_manage", 
                        a0: ref,
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการลูกหนี้.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
// BILLING
    function nextStepAddBilling() {
        var paramCom = document.getElementById('param_com').value;
        var paramMonth = document.getElementById('param_month').value;
        document.getElementById("param12").value  = "";
        
        fetch('api/billing/api.php', {
            method: 'POST',
            body: new URLSearchParams({ 'param_com': paramCom,'param_month': paramMonth,'proc': 'check_invoice_number' }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('next_invoice_number').innerHTML = data.next_invoice_number;
                document.getElementById('param2').value = data.next_invoice_number;
                document.getElementById('Step1AddBilling').classList.add('hidden');
                document.getElementById('Step2AddBilling').classList.remove('hidden');

                fetch("api/billing/api.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "company=" + encodeURIComponent(paramCom) + "&proc=list_debtor",
                })
                .then((response) => response.json())
                .then((debtorData) => {
                    const param3 = document.getElementById("param3");
                    param3.innerHTML = '<option value="">------โปรดเลือก------</option>';
                    debtorData.forEach((item) => {
                        const option = document.createElement("option");
                        option.value = item.DT_CODE;
                        option.textContent = item.DT_NAME;
                        param3.appendChild(option);
                    });
                })
                .catch((error) => {
                    console.error("เกิดข้อผิดพลาดในการโหลดรายชื่อลูกค้า:", error);
                });

            } else {
                alert("ไม่สามารถหาเลขที่ใบวางบิลได้");
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    function prevStepAddBilling() {
        document.getElementById('Step2AddBilling').classList.add('hidden');
        document.getElementById('Step1AddBilling').classList.remove('hidden');
    }
    function resetFormAndStartStep1() {
        document.getElementById('next_invoice_number').innerHTML = "---xxx---";
        document.getElementById('param_com').value = "";
        document.getElementById('Step2AddBilling').classList.add('hidden');
        document.getElementById('Step1AddBilling').classList.remove('hidden');
        document.getElementById('ShowHideDiv').classList.add('hidden');
        document.getElementById('param1').value = "";
        document.getElementById('param2').value = "";
        document.getElementById('param3').value = "";
        document.getElementById('param4').value = "";
        document.getElementById('param5').value = "";
        document.getElementById('param6').value = "";
        document.getElementById('param7').value = "";
        document.getElementById('param8').value = "";
        document.getElementById('param9').value = "";
    }
    function ManageBilling(code) {
        var a0 = code;
        var fields = ["param1", "param2", "param3", "param10", "param11"];
        var emptyFields = [];

        fields.forEach(field => {
            var value = $('#' + field).val().trim();
            if (value === "") {
                emptyFields.push(field);
                $('#' + field).css("border", "2px solid red");
            } else {
                $('#' + field).css("border", "");
            }
        });

        if (emptyFields.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                text: 'คุณต้องกรอกข้อมูลให้ครบถ้วนก่อนบันทึก',
                confirmButtonText: 'ตกลง'
            });
            return;
        }

        let hasEmpty = false;
        $('#AddRowBilling tbody tr').each(function () {
            if ($(this).hasClass('deleted')) return;

            $(this).find('input').each(function () {
                if ($(this).attr('id') === 'param8') return;
                const value = $(this).val().trim();
                if (value === "") {
                    hasEmpty = true;
                    $(this).css("border", "2px solid red");
                } else {
                    $(this).css("border", "");
                }
            });
        });

        if (hasEmpty) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                text: 'คุณต้องกรอกข้อมูลให้ครบถ้วนก่อนบันทึก',
                confirmButtonText: 'ตกลง'
            });
            return;
        }

        let billingRows = [];
        $('#AddRowBilling tbody tr').each(function () {
            if ($(this).hasClass('deleted')) return; 

            const rowData = {};
            $(this).find('input').each(function () {
                const id = $(this).attr('id');
                if (!id) return; 
                rowData[id] = $(this).val().trim();
            });

            billingRows.push(rowData);
        });

        var PROC = $('#PROC').val();

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "billing_manage",
                        a0: a0,
                        a1: $('#param1').val(),
                        a2: $('#param2').val(),
                        a3: $('#param3').val(),
                        a10: $('#param10').val(),
                        a20: $('#param_com').val(),
                        PROC: PROC,
                        rows: JSON.stringify(billingRows), 
                    },
                    cache: false,
                    success: function(RS) {
                        if (RS == '"complete"') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'สมุดคุมเลขที่วางบิล.html';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function() {
                        console.log("เกิดข้อผิดพลาดในการส่งข้อมูล");
                    }
                });
            }
        });
    }
    function updateBillingStatus(billingId, newStatus) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะเปลี่ยนสถานะ',
            html: 'หากคุณเปลี่ยนสถานะแล้ว ระบบจะทำการส่งแจ้งเตือนทันที',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "controllers/controllers.php",
                    type: 'POST',
                    data: {
                        keyword: "billing_manage", 
                        a0: billingId,
                        a1: newStatus,
                        PROC: 'update_status',
                    },
                    cache: false,
                    success: function(RS) {
                        if (RS == '"complete"') { 
                            Toastify({
                                text: "บันทึกข้อมูลเสร็จสิ้น",
                                duration: 3000,
                                newWindow: true,
                                close: false,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                                style: {
                                    background: "#006400",
                                },
                                onClick: function(){}
                            }).showToast(); 					
                        }else{
                            Toastify({
                                text: "ไม่สามารถบันทึกได้!",
                                duration: 3000,
                                newWindow: true,
                                close: false,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                                style: {
                                    background: "#FF0000",
                                },
                                onClick: function(){}
                            }).showToast(); 
                        }
                    },
                    error: function() {
                        console.log("เกิดข้อผิดพลาดในการส่งข้อมูล");
                    }
                });
            }
        });
    }
    function swaldelete_billing_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "billing_manage", 
                        a0: ref,
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'สมุดคุมเลขที่วางบิล.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
    function viewBillingDetails(billingCode) {
        
        document.getElementById("overlay").style.display = "block";
        document.getElementById("billingModal").style.display = "block";
        
        $('#billingModal').removeClass('hidden'); 
        $('#billingDetails').html("กำลังโหลดข้อมูล...");

        $.ajax({
            url: 'api/billing/api.php',
            type: 'POST',
            data: {
                proc: 'getBillingDetails',
                billingCode: billingCode
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('#billingDetails').html(`
                        <p><strong>รอบการวางบิล:</strong> ${data.billing_cycle}</p>
                        <p><strong>เลขที่ใบแจ้งหนี้:</strong> ${data.invoice_number}</p>
                        <p><strong>ลูกค้า:</strong> ${data.debtor_name}</p>
                        <p><strong>เลขที่ PO:</strong> ${data.num_po}</p>
                        <p><strong>จำนวนตัน:</strong> ${data.num_tons}</p>
                        <p><strong>จำนวนเที่ยว:</strong> ${data.num_trips}</p>
                        <p><strong>จำนวนเงิน:</strong> ${data.num_price}</p>
                        <p><strong>หมายเหตุ:</strong> ${data.remark}</p>
                        <p><strong>สถานะ:</strong> ${data.status}</p>
                        <p><strong>วันที่แจ้งเตือน:</strong> ${data.date_alert}</p>
                    `);
                } else {
                    $('#billingDetails').html("ไม่พบข้อมูล");
                }
            },
            error: function(xhr, status, error) {
                $('#billingDetails').html("เกิดข้อผิดพลาด: " + error);
            }
        });
    }
    function closeBillingDetails() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("billingModal").style.display = "none";
        $('#billingModal').addClass('hidden'); 
    }
    function formatDateTimeBilling(dateTimeString) {
        const dateObj = new Date(dateTimeString);
        const formattedDate = dateObj.toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
        const formattedTime = dateObj.toLocaleTimeString('th-TH', { hour: '2-digit', minute: '2-digit', hour12: false });
        return `${formattedDate} ${formattedTime}`;
    }
// NOTIFICATION
    function ManageNotiMain(code) {
        var a0 = code;
        var fields = ["param1", "param2", "param3", "param4", "param6"];
        var emptyFields = [];

        fields.forEach(field => {
            var value = $('#' + field).val().trim();
            if (value === "") {
                emptyFields.push(field);
                $('#' + field).css("border", "2px solid red");
            } else {
                $('#' + field).css("border", "");
            }
        });

        if (emptyFields.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                text: 'คุณต้องกรอกข้อมูลให้ครบถ้วนก่อนบันทึก',
                confirmButtonText: 'ตกลง'
            });
            return;
        }

        if($('#cheparam5').val() == "cheparam5"){
            var param5 = window.editor.getData(); 
            $('#param5').val(param5); 
        }else{
            var param5 = $('#param5').val();
        }

        var PROC = $('#PROC').val();

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "notification_manage",
                        a0: a0,
                        a1: $('#param1').val(),
                        a2: $('#param2').val(),
                        a3: $('#param3').val(),
                        a4: $('#param4').val(),
                        a5: param5, 
                        a6: $('#param6').val(),
                        PROC: PROC,
                    },
                    cache: false,
                    success: function(RS) {
                        if (RS == '"complete"') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการการแจ้งเตือน.html';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function() {
                        console.log("เกิดข้อผิดพลาดในการส่งข้อมูล");
                    }
                });
            }
        });
    }
    function swaldelete_noti_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "notification_manage", 
                        a0: ref,
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'จัดการการแจ้งเตือน.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
    function copytextnoti(text) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(() => {
                showToast("คัดลอกข้อความเรียบร้อย", "#A52A2A");
            }).catch(err => {
                console.error("เกิดข้อผิดพลาดในการคัดลอกข้อความ: ", err);
                showToast("เกิดข้อผิดพลาดในการคัดลอกข้อความ", "#FF4500");
            });
        } else {
            const textarea = document.createElement("textarea");
            textarea.value = text;
            textarea.style.position = "fixed"; 
            textarea.style.opacity = "0"; 
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand("copy");
                showToast("คัดลอกข้อความเรียบร้อย", "#A52A2A");
            } catch (err) {
                console.error("เกิดข้อผิดพลาดในการคัดลอกข้อความ: ", err);
                showToast("เกิดข้อผิดพลาดในการคัดลอกข้อความ", "#FF4500");
            }
            document.body.removeChild(textarea);
        }
    }
    function showToast(message, backgroundColor) {
        Toastify({
            text: message,
            duration: 3000,
            newWindow: true,
            close: false,
            gravity: "top",  
            position: "center",
            stopOnFocus: true,
            style: {
                background: backgroundColor,
            },
            onClick: function () { }
        }).showToast();

        setTimeout(() => {
            document.querySelector(".toastify").style.cssText += "left: 50%;";
        }, 100);
    }
// REPORT
    function openModal_report_mbc(comcode, fileType) {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("monthYearModal").style.display = "block";
        document.getElementById("comcode").value = comcode;
        document.getElementById("comcode1").textContent = comcode;
        document.getElementById("fileType").value = fileType; 

        const confirmButton = document.querySelector("#monthYearForm button[type='button'][onclick='sendModal_report_mbc()']");
        if (fileType === "PDF") {
            confirmButton.textContent = "ดาวน์โหลด PDF";
        } else if (fileType === "EXCEL") {
            confirmButton.textContent = "ดาวน์โหลด EXCEL";
        }
    }
    function closeModal_report_mbc() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("monthYearModal").style.display = "none";
    }
    function sendModal_report_mbc() {
        const comcode = document.getElementById("comcode").value;
        const month = document.getElementById("month").value;
        const year = document.getElementById("year").value;
        const fileType = document.getElementById("fileType").value; 

        if (fileType === "PDF") {
            window.open('รายงานสมุดคุมเลขที่วางบิลของ_' + comcode + '_เดือน_' + month + '_ปี_' + year + '.pdf', '_blank').focus();
        } else if (fileType === "EXCEL") {
            window.open('รายงานสมุดคุมเลขที่วางบิลของ_' + comcode + '_เดือน_' + month + '_ปี_' + year + '.xlsx', '_blank').focus();
        }
    }
    function openModal_report_ntf(comcode, comcode1, fileType) {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("monthYearModal").style.display = "block";

        document.getElementById("comcode").value = comcode;
        document.getElementById("comcode1").textContent = comcode1;
        document.getElementById("fileType").value = fileType; 
        const confirmButton = document.querySelector("#monthYearForm button[type='button'][onclick='sendModal_report_ntf()']");
        if (fileType === "PDF") {
            confirmButton.textContent = "ดาวน์โหลด PDF";
        } else if (fileType === "EXCEL") {
            confirmButton.textContent = "ดาวน์โหลด EXCEL";
        }
    }
    function closeModal_report_ntf() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("monthYearModal").style.display = "none";
    }
    function sendModal_report_ntf() {
        const comcode = document.getElementById("comcode").value;
        const month = document.getElementById("month").value;
        const year = document.getElementById("year").value;
        const fileType = document.getElementById("fileType").value; 
        if (fileType === "PDF") {
            window.open('รายงานการแจ้งเตือน_' + comcode + '_เดือน_' + month + '_ปี_' + year + '.pdf', '_blank').focus();
        } else if (fileType === "EXCEL") {
            window.open('รายงานการแจ้งเตือน_' + comcode + '_เดือน_' + month + '_ปี_' + year + '.xlsx', '_blank').focus();
        }
    }
    function openModal_report_ctm(cusname, cusname1, fileType) {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("monthYearModal").style.display = "block";
        document.getElementById("cusname").value = cusname;
        document.getElementById("cusname1").textContent = cusname1;
        document.getElementById("fileType").value = fileType; 
        const confirmButton = document.querySelector("#monthYearForm button[type='button'][onclick='sendModal_report_ctm()']");
        if (fileType === "PDF") {
            confirmButton.textContent = "ดาวน์โหลด PDF";
        } else if (fileType === "EXCEL") {
            confirmButton.textContent = "ดาวน์โหลด EXCEL";
        }
    }
    function closeModal_report_ctm() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("monthYearModal").style.display = "none";
    }
    function sendModal_report_ctm() {
        const cusname = document.getElementById("cusname").value;
        const month = document.getElementById("month").value;
        const year = document.getElementById("year").value;
        const fileType = document.getElementById("fileType").value; 
        if (fileType === "PDF") {
            window.open('รายงานสรุปแยกลูกค้า_' + cusname + '_เดือน_' + month + '_ปี_' + year + '.pdf', '_blank').focus();
        } else if (fileType === "EXCEL") {
            window.open('รายงานสรุปแยกลูกค้า_' + cusname + '_เดือน_' + month + '_ปี_' + year + '.xlsx', '_blank').focus();
        }
    }
// DASHBOARD
    function openModalDashboard(title,filter) {
        const modal = document.getElementById('modal');
        const overlay = document.getElementById('modal-overlay');
        const modalTitle = document.getElementById('modal-title');
        const modalTable = $('#modal-table').DataTable();
        const inputfiltercom = document.getElementById('inputfiltercom').value;

        modalTitle.textContent = title;

        modalTable.clear();

        $.ajax({
            url: 'api/dashboard/api.php',  
            type: 'POST',
            dataType: 'json',
            data: { proc: 'getModalData', filter: filter,inputfiltercom: inputfiltercom }, 
            success: function (data) {
                const reportData = data.reportData; 
                if (reportData.length > 0) {
                    reportData.forEach(item => {
                        modalTable.row.add([
                            formatDateTimeDashboard(item.BLB_CREATEDATE),  
                            item.BLB_DEBTORNAME,           
                            item.BLB_CYCLE,                 
                            parseFloat(item.BLB_NUMPRICE).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }), 
                            getStatusIconDashboard(item.BLB_STATUS)    
                        ]);
                    });

                    modalTable.draw();
                } else {
                    modalTable.clear().draw();
                    $('#modal-table tbody').html(`
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">ไม่มีข้อมูล</td>
                        </tr>
                    `);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                console.log(xhr.responseText);  
            }
        });

        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }
    function closeModalDashboard() {
        const modal = document.getElementById('modal');
        const overlay = document.getElementById('modal-overlay');

        modal.classList.add('hidden');
        overlay.classList.add('hidden');
    }
    const overlay = document.getElementById('modal-overlay');
    if (overlay) {
        overlay.addEventListener('click', closeModalDashboard);
    }
    const modal = document.getElementById('modal');
    if (modal) {
        modal.addEventListener('click', function (event) {
            if (event.target === this) {
                closeModalDashboard();
            }
        });
    }
    function formatDateTimeDashboard(dateTimeString) {
        const dateObj = new Date(dateTimeString);
        const formattedDate = dateObj.toLocaleDateString('th-TH', { day: '2-digit', month: '2-digit', year: 'numeric' });
        const formattedTime = dateObj.toLocaleTimeString('th-TH', { hour: '2-digit', minute: '2-digit', hour12: false });
        return `${formattedDate} ${formattedTime}`;
    }
    function getStatusIconDashboard(status) {
        switch (status) {
            case 'Paid':
                return "<img src='assets/images/check_true.gif' alt='Paid' width='16' height='16'>";
            case 'Pending':
                return "<img src='assets/images/imgloading.gif' alt='Pending' width='25' height='25'>";
            case 'Overdue':
                return "<img src='assets/images/warning.png' alt='Overdue' width='25' height='25'>";
            case 'Cancelled':
                return "<font color='red'><b>ยกเลิก</b></font>";
            default:
                return "ไม่ทราบสถานะ";
        }
    }
// IMPORT
    function handleExcelImport(inputElementId, tableId) {
        document.getElementById(inputElementId).addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                let data = e.target.result;
                let workbook = XLSX.read(data, { type: 'binary' });
                let firstSheet = workbook.SheetNames[0];
                let worksheet = workbook.Sheets[firstSheet];
                let json = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

                const table = document.getElementById(tableId);

                if ($.fn.DataTable.isDataTable('#' + tableId)) {
                    $('#' + tableId).DataTable().destroy();
                }

                const oldTbody = table.querySelector('tbody');
                if (oldTbody) oldTbody.remove();

                const tbody = document.createElement('tbody');
                let previewRows = json.slice(2);
                let sumAmount = 0, sumVat = 0, sumTotal = 0, sumWht = 0, sumNet = 0;

                function excelDateToString(serial) {
                    if (typeof serial === 'number') {
                        const utc_days = Math.floor(serial - 25569);
                        const utc_value = utc_days * 86400;
                        const date_info = new Date(utc_value * 1000);
                        const day = date_info.getUTCDate().toString().padStart(2, '0');
                        const month = (date_info.getUTCMonth() + 1).toString().padStart(2, '0');
                        const year = date_info.getUTCFullYear();
                        return `${day}/${month}/${year}`;
                    }
                    return serial;
                }

                function formatNumberExcel(val) {
                    if (val === undefined || val === null || val === '') return '';
                    let num = parseFloat(val);
                    return isNaN(num) ? val : num.toFixed(2);
                }

                previewRows.forEach((row, i) => {
                    const tr = document.createElement('tr');

                    const cells = [
                        i + 1,
                        excelDateToString(row[0]),
                        excelDateToString(row[1]),
                        row[2] || '',
                        excelDateToString(row[3]),
                        row[4] || '',
                        formatNumberExcel(row[5]),
                        formatNumberExcel(row[6]),
                        formatNumberExcel(row[7]),
                        formatNumberExcel(row[8]),
                        formatNumberExcel(row[9])
                    ];

                    cells.forEach((val, idx) => {
                        const td = document.createElement('td');
                        td.textContent = val;
                        td.className = [0, 1, 2, 4, 5].includes(idx) ? 'text-center' :
                                    [6, 7, 8, 9, 10].includes(idx) ? 'text-right' : '';
                        tr.appendChild(td);
                    });

                    sumAmount += parseFloat(row[5]) || 0;
                    sumVat += parseFloat(row[6]) || 0;
                    sumTotal += parseFloat(row[7]) || 0;
                    sumWht += parseFloat(row[8]) || 0;
                    sumNet += parseFloat(row[9]) || 0;

                    tbody.appendChild(tr);
                });

                table.appendChild(tbody);

                const tfoot = table.querySelector('tfoot');
                if (tfoot) {
                    const sumRow = tfoot.querySelector('tr');
                    if (sumRow && sumRow.cells.length >= 11) {
                        sumRow.cells[6].textContent = sumAmount.toFixed(2);
                        sumRow.cells[7].textContent = sumVat.toFixed(2);
                        sumRow.cells[8].textContent = sumTotal.toFixed(2);
                        sumRow.cells[9].textContent = sumWht.toFixed(2);
                        sumRow.cells[10].textContent = sumNet.toFixed(2);
                    }
                }

                $('#' + tableId).DataTable({
                    destroy: true,
                    searching: true,
                    paging: true,
                    info: true,
                    ordering: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/th.json"
                    },
                    footerCallback: function(row, data, start, end, display) {
                        const api = this.api();
                        const parseNumber = val => {
                            if (typeof val === 'string') {
                                val = val.replace(/,/g, '').replace(/[^0-9.\-]/g, '');
                            }
                            const num = parseFloat(val);
                            return isNaN(num) ? 0 : num;
                        };
                        const sumColumn = index => {
                            return api.column(index).data().reduce((a, b) => parseNumber(a) + parseNumber(b), 0).toFixed(2);
                        };
                        [6, 7, 8, 9, 10].forEach(idx => {
                            $(api.column(idx).footer()).html('<b>' + sumColumn(idx) + '</b>');
                        });
                    }
                });
            };
            reader.readAsBinaryString(file);
        });
    }
    function ImportExcelFromDataTable() {
        var table = $('#borderedTable').DataTable();
        var allData = table.rows().data().toArray();  

        if (allData.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'ไม่มีข้อมูลในตาราง',
                text: 'กรุณาตรวจสอบข้อมูลก่อนนำเข้า',
                timer: 2500,
                timerProgressBar: true,
                showConfirmButton: false
            });
            return;
        }

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะนำเข้าข้อมูลทั้งหมด?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'นำเข้า',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: JSON.stringify({
                        keyword: "import_excel",
                        PROC: "add",
                        rows: allData
                    }),
                    contentType: "application/json",
                    cache: false,
                    success: function(RS){
                        if (RS === '"complete"' || (typeof RS === 'object' && RS.status === 'success')) {
                            Swal.fire({
                                icon: 'success',
                                title: 'นำเข้าข้อมูลสำเร็จ',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(() => {
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถนำเข้าได้!',
                                text: 'โปรดตรวจสอบข้อมูลหรือสอบถามผู้ดูแลระบบ',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถติดต่อเซิร์ฟเวอร์ได้',
                            footer: error,
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    }
    function DownloadImport(){
        axios({
            url:'app/import_manage/ตัวอย่างรูปแบบไฟล์นำข้อมูลเข้าระบบ.xlsx',
            method:'GET',
            responseType: 'blob'
        })
        .then((response) => {
            const url = window.URL
            .createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'ตัวอย่างรูปแบบไฟล์นำข้อมูลเข้าระบบ.xlsx');
                document.body.appendChild(link);
                link.click();
            }
        )
    }
// NOTIFICATION_MAIL
    function ManageNotiMailMain(code) {
        var a0 = code;
        var fields = ["param1", "param6"];
        var emptyFields = [];

        fields.forEach(field => {
            var value = $('#' + field).val().trim();
            if (value === "") {
                emptyFields.push(field);
                $('#' + field).css("border", "2px solid red");
            } else {
                $('#' + field).css("border", "");
            }
        });

        if (emptyFields.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                text: 'คุณต้องกรอกข้อมูลให้ครบถ้วนก่อนบันทึก',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
            return;
        }
            
        if($('#cheparam3').val() == "cheparam3"){
            var param3 = $('#param3').val().trim();
            if(param3 === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'จำเป็นต้องกรอกอีเมลผู้รับ',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                });
                $('#param3').focus();
                return;
            }
        }else{
            var param3 = $('#param3').val();
        }

        var PROC = $('#PROC').val();

        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะบันทึกข้อมูล',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'บันทึก',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "notificationmail_manage",
                        a0: a0,
                        a1: $('#param1').val(),
                        a2: $('#param2').val(),
                        a3: param3,
                        a4: $('#param4').val(),
                        a5: $('#param5').val(),
                        a6: $('#param6').val(),
                        PROC: PROC,
                    },
                    cache: false,
                    success: function(RS) {
                        if (RS == '"complete"') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเสร็จสิ้น',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ตั้งค่าการส่งเมล.html';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function() {
                        console.log("เกิดข้อผิดพลาดในการส่งข้อมูล");
                    }
                });
            }
        });
    }
    function swaldelete_noti_mail_main(refcode,no){
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่...ที่จะลบรายการที่ '+no+' นี้',
            text: "หากลบแล้ว คุณจะไม่สามารถกู้คืนข้อมูลได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#C82333',
            confirmButtonText: 'ใช่! ลบเลย',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                var ref = refcode; 
                $.ajax({
                    type: "POST",
                    url: "controllers/controllers.php",
                    data: {
                        keyword: "notificationmail_manage", 
                        a0: ref,
                        PROC: 'delete',
                    },	
                    cache: false,
                    success: function(RS){
                        if (RS == '"complete"') {                   
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลเรียบร้อยแล้ว',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            }).then(() => {
                                location.href = 'ตั้งค่าการส่งเมล.html'
                            })	
                        }else{                    
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถลบได้!',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            })
                        }
                    },
                        error: function(){
                        console.log(3)
                    }
                })	
            }
        })
    }
    function emailListModal(sendToMain, sendToCC) {
        const modal = document.getElementById('modal');
        const overlay = document.getElementById('modal-overlay');
        const modalTitle = document.getElementById('modal-sendToMain');
        const modalTable = $('#modal-table').DataTable();

        modalTitle.textContent = 'รายชื่อ อีเมลผู้รับ และ สำเนาถึง';

        modalTable.clear();

        sendToMain = sendToMain || '';
        sendToCC = sendToCC || '';

        const toList = sendToMain.split(/\s*,\s*|\s*\n\s*/).filter(e => e.trim() !== '');
        const ccList = sendToCC.split(/\s*,\s*|\s*\n\s*/).filter(e => e.trim() !== '');

        if (toList.length === 0 && ccList.length === 0) {
            modalTable.row.add([
                '<span class="text-slate-400">ไม่มีข้อมูล</span>',
                '<span class="text-slate-400">ไม่มีข้อมูล</span>'
            ]);
        } else {
            toList.forEach(email => {
                modalTable.row.add([
                    'อีเมลผู้รับ (To)',
                    email,
                ]);
            });

            ccList.forEach(email => {
                modalTable.row.add([
                    'สำเนาถึง (CC)',
                    email,
                ]);
            });
        }

        modalTable.draw();

        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }
    function closeEmailListModal() {
        const modal = document.getElementById('modal');
        const overlay = document.getElementById('modal-overlay');

        modal.classList.add('hidden');
        overlay.classList.add('hidden');
    }