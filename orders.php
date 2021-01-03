<?php
require 'functions.php';
require 'mysqldatabase.class.php';
require 'template.class.php';
require 'orders.class.php';
require 'connectDB.php';


include('templates/header.php'); 

$db = new MySQLDatabase($HOST,$USERNAME,$PASSWORD,$DATABASE);
$db->connect();

$op = sanitize($_REQUEST['op']);
$order = new Orders;
switch($op) {
    default:

    break; break;
    case "consume":
        $pid=sanitize($_GET['pid']);
        if(isPositiveValue($pid))
            $order->formConsumeOrder($db,$pid,sanitize($_GET['cid']),sanitize($_GET['oid']),sanitize($_GET['actualcredits']),sanitize($_GET['product']),sanitize($_GET['name']),sanitize($_GET['lastname']));
    break;
    case "consuming":        
        $oid=sanitize($_POST['oid']);
        if(isPositiveValue($oid))
            $order->consumeOrder($db,sanitize($_POST['actualcredits']),sanitize($_POST['oid']),sanitize($_POST['idbodypart']),sanitize($_POST['skintype']),sanitize($_POST['other']),sanitize($_POST['name']),sanitize($_POST['lastname']),sanitize($_POST['cid']));
    break;
    case "view": 
        $cid=sanitize($_GET['cid']);
        if(isPositiveValue($cid))
            $order->viewOrder($db,$cid);
    break;
    case "add": 
        $cid=sanitize($_GET['cid']);
        if(isPositiveValue($cid))
            $order->formAddOrder($db,$cid,sanitize($_GET['name']),sanitize($_GET['lastname']));
    break;
    case "adding":
        $idproduct=sanitize($_POST['idproduct']);
        $cid=sanitize($_POST['cid']);
        if(isPositiveValue($idproduct)&&isPositiveValue($cid))
            $order->addOrder($db,$idproduct,sanitize($_POST['type']),$cid,sanitize($_POST['paid']),sanitize($_POST["name"]),sanitize($_POST["lastname"]));
    break;
    case "paying":
        $oid=sanitize($_GET['oid']);
        if(isPositiveValue($oid))
            $order->payingOrder($db,$oid);
    break;
    case "removeconsumption":
        $id=sanitize($_GET['id']);
        $oid=sanitize($_GET['oid']);
        $cid=sanitize($_GET['cid']);
        if(isPositiveValue($id)&&isPositiveValue($oid)&&isPositiveValue($cid))
            $order->removeConsumptionOrder($db,$id,sanitize($_GET['credits']),$oid,$cid);
    break;
    case "removeorder":
        $oid=sanitize($_GET['oid']);
        $cid=sanitize($_GET['cid']);
        if(isPositiveValue($oid)&&isPositiveValue($cid))
            $order->removeOrder($db,$oid,$cid);
    break;

}

$db->close();

include('templates/footer.php'); 

?>



