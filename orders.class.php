<?
class Orders
{
 
    function __construct()
    {

    }

    public function formConsumeOrder($db,$pid,$cid,$oid,$actualcredits,$product,$name,$lastname)
    {
        $template = new Template;
        $template->load("templates/consume_form.php");
        $results = $db->getData("SELECT * FROM bodyparts WHERE idproduct = '".$pid."' ORDER BY bodypart ASC");
        if($results){ 
            $data=array(
                'op'=>'consuming',
                'cid'=>$cid,
                'oid'=>$oid,
                'actualcredits'=>$actualcredits,
                'product'=>$product,      
                'name'=>$name,
                'lastname'=>$lastname,
                'bodyparts'=>$results
            );
        } else {
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No existen servicios registrados en la base de datos.'
            );
        }
        $template->replace("data", $data);
        $template->publish();
    }

    public function consumeOrder($db,$actualcredits,$oid,$idbodypart,$skintype,$other,$name,$lastname,$cid)
    {
        $template = new Template;
        $template->load("templates/alert_message.php");
        $newcredits=$actualcredits-1;
        $result = $db->executeInstruction("UPDATE orders SET credits = '".$newcredits."' WHERE id = '".$oid."'");
        $result2 = $db->executeInstruction("INSERT INTO consumptions (`idorder`,`idbodypart`, `skintype`, `other`, `datetimeadded`) VALUES ('".$oid."', '".$idbodypart."', '".$skintype."', '".$other."', '".date("Y-m-d H:i:s")."')");
        if(($result)&&($result2)){
            $data=array(
                'type'=>'alert-success',
                'message'=>'<div align=center><h5>Nuevo consumo registrado para <b>'.$name.' '.$lastname.'</b><br><br>Quedan <span class="badge badge-primary">'.$newcredits.'</span> cr&eacute;ditos.</h5>
                <br><a class="btn btn-secondary" href="orders.php?op=view&cid='.$cid.'&name='.$name.'&lastname='.$lastname.'" role="button">Volver a ficha de cliente</a></div>'
            );
        } else{
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No fue posible aplicar consumo a cliente.'
            );
        }
        $template->replace("data", $data);
        $template->publish();
    }

    public function viewOrder($db,$cid) {
        $results_client = $db->getDataSingle("SELECT * FROM  clients WHERE id = '".$cid."'");        
        $results = $db->getData("SELECT orders.id, orders.type, orders.credits, orders.paid, orders.dateadded, products.id AS pid, products.name, products.description FROM orders INNER JOIN products ON orders.idproduct = products.id INNER JOIN clients ON orders.idclient = clients.id WHERE orders.idclient = '".$cid."' ORDER BY orders.id DESC");
        $results2 = array();
        if($results){
            foreach($results as $result){
                $results2[] = $db->getData("SELECT consumptions.id, consumptions.skintype, consumptions.datetimeadded, consumptions.other, bodyparts.bodypart FROM consumptions INNER JOIN bodyparts ON consumptions.idbodypart = bodyparts.id WHERE consumptions.idorder = ".$result['id']." ORDER BY consumptions.id ASC");
            }
        }
        $template = new Template;
        $template->load("templates/order_list_all.php");
        $data=array(
            'cid'=>$cid,
            'name'=>$results_client['name'],
            'lastname'=>$results_client['lastname'],
            'other'=>$results_client['other'],
            'results'=>$results,
            'results2'=>$results2,
            'uploadedfile'=>""
        );
        $template->replace("data", $data);
        $template->publish();
    }

    public function formAddOrder($db,$cid,$name,$lastname) {
        $template = new Template;        
        $results = $db->getData("SELECT * FROM `products` ORDER BY `id` ASC");
        if($results){
            $template->load("templates/order_form_add.php");
            $data=array(
                'op'=>'adding',
                'cid'=>$cid,
                'name'=>$name,
                'lastname'=>$lastname,
                'products'=>$results
            );
            $template->replace("data", $data);
            $template->publish();
        }
        else{
            $template->load("templates/alert_message.php");
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No existen servicios registrados en la base de datos.'
            );
            $template->replace("data", $data);
            $template->publish();
        }
    }

    public function addOrder($db,$idproduct,$type,$cid,$paid,$name,$lastname) {
	    $template = new Template;
        $template->load("templates/alert_message.php");
        if( ($idproduct>4) && ($type=="b") ){$credits="6";} // Special credits 6 sessions
        else if($type=="b"){$credits="5";} // credits 5 sessions
        else if($type=="s"){$credits="1";} // credits 1 session
        $result = $db->executeInstruction("
        INSERT INTO `orders` (`idclient`, `idproduct`, `type`, `credits`, `paid`, `dateadded`) 
        VALUES ('".$cid."', '".$idproduct."', '".$type."', '".$credits."', '".$paid."', '".date("Y-m-d")."');
        ");
        if($result){
			$data=array(
                'type'=>'alert-success',
                'message'=>'<div align=center><h5>Nuevo servicio añadido a cliente <b>'.$name.' '.$lastname.'</b></h5>
                <br><a class="btn btn-secondary" href="orders.php?op=view&cid='.$cid.'&name='.$name.'&lastname='.$lastname.'" role="button">Volver a ficha de cliente</a></div>'
            );            
        }else{
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No fue posible añadir el servicio al cliente.'
            );        
        }
        $template->replace("data", $data);
        $template->publish(); 
    }

    public function payingOrder($db,$oid) {
        $template = new Template;
        $template->load("templates/alert_message.php");
        $result = $db->executeInstruction("UPDATE orders SET paid = '1' WHERE id = '".$oid."'");
        if($result){
            $data=array(
                'type'=>'alert-success',
                'message'=>'Pago registrado con &eacute;xito para este servicio.'
            );
        }
        else{
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No fue posible registrar el pago realizado.'
            );        
        }
        $template->replace("data", $data);
        $template->publish();
    }

    public function removeConsumptionOrder($db,$id,$credits,$oid,$cid) {
	    $template = new Template;
        $template->load("templates/alert_message.php");
        $result = $db->executeInstruction("DELETE FROM `consumptions` WHERE `id` = '".$id."'");
        $newcredits = $credits+1;
        $result2 = $db->executeInstruction("UPDATE orders SET credits = '".$newcredits."' WHERE id = '".$oid."'");        
        if($result){
			$data=array(
                'type'=>'alert-success',
                'message'=>'<div align=center><h5>Sesi&oacute;n eliminada del cliente.</b></h5>
                <br><a class="btn btn-secondary" href="orders.php?op=view&cid='.$cid.'" role="button">Volver a ficha de cliente</a></div>'
            );            
        }else{
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No fue posible añadir el servicio al cliente.'
            );        
        }
        $template->replace("data", $data);
        $template->publish(); 
    }

    public function removeOrder($db,$oid,$cid) {
	    $template = new Template;
        $template->load("templates/alert_message.php");
        $result = $db->executeInstruction("DELETE FROM `consumptions` WHERE `idorder` = '".$oid."'");
        $result = $db->executeInstruction("DELETE FROM `orders` WHERE `id` = '".$oid."'");
        if($result){
			$data=array(
                'type'=>'alert-success',
                'message'=>'<div align=center><h5>Servicio eliminado de cliente.</b></h5>
                <br><a class="btn btn-secondary" href="orders.php?op=view&cid='.$cid.'" role="button">Volver a ficha de cliente</a></div>'
            );            
        }else{
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No fue posible añadir el servicio al cliente.'
            );        
        }
        $template->replace("data", $data);
        $template->publish(); 
    }


}

?>