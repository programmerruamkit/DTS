<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?php echo $result_setting->ST_TITLE; ?></title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Trailler Daily Check" name="description">
    <meta content="Matavanary" name="author">
    <link rel="shortcut icon" href="<?php echo $result_setting->ST_ICON; ?>" loading="lazy">
    <script src="<?php echo base_url(); ?>assets/js/layout.js" async></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/starcode2.css" async>
</head>
<style>
    .bt_approve {
        font-size: 22px;
    }
    .bt_exam {
        font-size: 27px;
    }
    .bt_exam_select {
        font-size: 30px;
    }    
    .bt_auth {
        font-size: 27px;
    }
</style>
<div style="display:none"><button id="addRow">Add New Row</button></div>
<div style="display:none"><button id="deleteButton">Delete Selected Row</button></div>
<div style="display:none"><input type="text" id="min" name="min"><input type="text" id="max" name="max"></div>
<?php
    // ตัดคำยาวๆ ให้เป็นคำสั้นๆ ...
    function truncateText($text, $length = 20) {
        if (mb_strlen($text, 'UTF-8') > $length) {
            return mb_substr($text, 0, $length, 'UTF-8') . '...';
        }
        return $text;
    }
    
?>