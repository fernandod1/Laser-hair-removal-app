<?php
require 'functions.php';
require 'mysqldatabase.class.php';
require 'template.class.php';
require 'connectDB.php';

include('templates/header.php'); 

if(isset($_REQUEST['op']))
    $op = sanitize($_REQUEST['op']);
else 
    $op = "";
switch($op) {
    default:
        echo'<br><br><br>';
        echo'<div align=center><h1 class="display-1">Depilación láser</h1>';
        echo'<h1 class="display-2"><font color=#00baa4><b>Panel de Control</b></font></h1></div>';
        echo'<br><br><br><br><br>';
    break; break;
    case "logout":
        echo'Ha salido del panel de control.';  
    break;
}


include('templates/footer.php'); 

?>



