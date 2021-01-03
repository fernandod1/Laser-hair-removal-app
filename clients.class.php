<?
class Clients
{
 
    function __construct()
    {

    }


    public function getClients($db,$page){
        $offset=paginate($db,$page,"all");
        $results = $db->getData("SELECT * FROM clients ORDER BY lastname ASC LIMIT $offset,10");
        if($results){
            $template = new Template;
            $template->load("templates/client_list_all.php");
            $template->replace("data", $results);
            $template->publish();
        }         
    }


    public function searchClients($db,$word){
        $results = $db->getData("SELECT * FROM clients WHERE ( lastname LIKE '%".$word."%' OR name LIKE '%".$word."%' OR phone LIKE '%".$word."%' ) ORDER BY lastname ASC");
        if($results){
            $template = new Template;
            $template->load("templates/client_list_all.php");
            $template->replace("data", $results);
            $template->publish();
        }   
    }

    public function formAddClients(){
        $template = new Template;
        $template->load("templates/client_form_add.php");
        $data=array(
            'op'=>'adding',
            'cid'=>'',
            'name'=>'',
            'lastname'=>'',
            'yearborn'=>'',
            'sex'=>'',
            'address'=>'',
            'phone'=>'',
            'email'=>'',
            'coloreyes'=>'',
            'colorhair'=>'',
            'skintype'=>'',
            'other'=>''
        );
        $template->replace("data", $data);
        $template->publish();
    }

    public function addClients($db,$name,$lastname,$yearborn,$sex,$address,$phone,$email,$coloreyes,$colorhair,$skintype,$other){
        $result = $db->executeInstruction("
        INSERT INTO `clients` (`name`, `lastname`, `yearborn`, `sex`, `address`, `phone`, `email`, `coloreyes`, `colorhair`, `skintype`, `other`, `dateadded`) 
        VALUES ('".$name."', '".$lastname."', '".$yearborn."', '".$sex."', '".$address."', '".$phone."', '".$email."', '".$coloreyes."', '".$colorhair."', '".$skintype."', '".$other."', '".date("Y-m-d")."');
        ");
        $template = new Template;
        $template->load("templates/alert_message.php");
        if($result){   
            $data=array(
               'type'=>'alert-success',
               'message'=>'Datos de cliente insertados con &eacute;xito en la base de datos.'
            );
        }else{
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No fue posible insertar los datos de cliente en la base de datos.'
             );        
        }
        $template->replace("data", $data);
        $template->publish();           
    }

    public function formEditClients($db,$id){
        $result = $db->getDataSingle("SELECT * FROM `clients` WHERE `id` = '".$id."'");
        if($result){
            $template = new Template;
            $template->load("templates/client_form_edit.php");
            $result['op']='editing';
            $template->replace("data", $result);
            $template->publish(); 
        }        
    }

    public function editClients($db,$name,$lastname,$yearborn,$sex,$address,$phone,$email,$coloreyes,$colorhair,$skintype,$other,$cid){
        $result = $db->executeInstruction("UPDATE `clients` SET `name`='".$name."', `lastname`='".$lastname."', `yearborn`='".$yearborn."', `sex`='".$sex."', `address`='".$address."', `phone`='".$phone."', `email`='".$email."', `coloreyes`='".$coloreyes."', `colorhair`='".$colorhair."', `skintype`='".$skintype."', `other`='".$other."' WHERE `id` = '".$cid."'");
        if($result){
            $template = new Template;
            $template->load("templates/alert_message.php");        
            $data=array(
               'type'=>'alert-success',
               'message'=>'Datos de cliente modificados con &eacute;xito.<br><br> <a href=orders.php?op=view&cid='.sanitize($_POST['cid']).'&name='.sanitize($_POST['name']).'&lastname='.sanitize($_POST['lastname']).'><b>Volver a ficha de cliente</b></a>'
            );           
            $template->replace("data", $data);
            $template->publish();
        }
    }

    public function uploadClients(){
        $template = new Template;
        $template->load("templates/client_form_edit.php");
        $result['op']='uploading';
        $template->replace("data", $result);
        $template->publish(); 
    }

     public function formRemoveClients($cid,$name,$lastname) {
        $template = new Template;
        $template->load("templates/client_form_remove.php");
        $data=array(
            'op'=>'removing',
            'cid'=>$cid,
            'name'=>$name,
            'lastname'=>$lastname
        );
        $template->replace("data", $data);
        $template->publish();    
    }

    public function removeClients($db,$cid) {
        $result = $db->executeInstruction("DELETE FROM `clients` WHERE `id` = '".$cid."'");
        $template = new Template;
        $template->load("templates/alert_message.php");        
        if($result){
            $data=array(
                'type'=>'alert-success',
                'message'=>'Datos de cliente eliminados con &eacute;xito.'
            );
        }
        else{
            $data=array(
                'type'=>'alert-danger',
                'message'=>'Error. No fue posible eliminar los datos de cliente.'
            );        
        }
        $template->replace("data", $data);
        $template->publish();
    }
}

?>