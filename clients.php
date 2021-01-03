<?php
require 'functions.php';
require 'mysqldatabase.class.php';
require 'template.class.php';
require 'clients.class.php';
require 'connectDB.php';

include('templates/header.php'); 

$db = new MySQLDatabase($HOST,$USERNAME,$PASSWORD,$DATABASE);
$db->connect(); 
if(isset($_REQUEST['op']))
    $op = sanitize($_REQUEST['op']);
else 
    $op = "";
$client = new Clients;
switch($op) {
    default:
        echo '<br>';
        if(isset($_GET['page']))
            $page=sanitize($_GET['page']);
        else
            $page=1;
        if(isPositiveValue($page))
            $client->getClients($db,$page);
    break; break;	
    case "searching":
        echo '<br>';
        if(isset($_POST['word'])&&$_POST['word']!=""){
            $word=sanitize($_POST['word']);
            $client->searchClients($db,$word);
        }
    break;
    case "add":
        $client->formAddClients();
    break;
    case "adding":
        $client->formAddClients($db,sanitize($_POST['name']),sanitize($_POST['lastname']),sanitize($_POST['yearborn']),sanitize($_POST['sex']),sanitize($_POST['address']),sanitize($_POST['phone']),sanitize($_POST['email']),sanitize($_POST['coloreyes']),sanitize($_POST['colorhair']),sanitize($_POST['skintype']),sanitize($_POST['other']));
    break;
    case "edit": 
        $id=sanitize($_GET['cid']);
        if(isPositiveValue($id))
            $client->formEditClients($db,$id);
    break;
	case "editing": 
        $id=sanitize($_POST['cid']);
        if(isPositiveValue($id))
            $client->editClients($db,sanitize($_POST['name']),sanitize($_POST['lastname']),sanitize($_POST['yearborn']),sanitize($_POST['sex']),sanitize($_POST['address']),sanitize($_POST['phone']),sanitize($_POST['email']),sanitize($_POST['coloreyes']),sanitize($_POST['colorhair']),sanitize($_POST['skintype']),sanitize($_POST['other']),$id);
    break;
    case "uploading": 
        $client->uploadClients();
	break;
    case "remove": 
        $id=sanitize($_GET['cid']);
        if(isPositiveValue($id))
            $client->formRemoveClients($id,sanitize($_GET['name']),sanitize($_GET['lastname']));
    break;
    case "removing": 
        $cid=sanitize($_POST['cid']);
        if(isPositiveValue($cid))
            $client->removeClients($db,$cid);
    break;


}
$db->close();




include('templates/footer.php'); 

?>



