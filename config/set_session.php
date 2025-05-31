<?php
    unset($_SESSION['SIDEBAR']); 
    unset($_SESSION['DROPDOWN']);
    unset($_SESSION['DROPDOWN_ID']); 
    unset($_SESSION['start']); 
    unset($_SESSION['expire']); 
    $_SESSION["start"] = time();
    $_SESSION["expire"] = $_SESSION["start"] + (30*60);