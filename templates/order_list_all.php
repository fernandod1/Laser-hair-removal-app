<?php if ($data['uploadedfile']=="done"){echo '<br><div class="alert alert-success" role="alert">El documento del cliente ha sido subido con &eacute;xito.</div>';} ?>
<br><p class="d-inline h3"><?php echo $data['name'];?> <?php echo $data['lastname'];?>
<?php if  ($data['other']!=""){echo "<div>".$data['other']."</div>";} ?>
<div class="text-right">
        <a class="btn btn-outline-success btn-sm" href="orders.php?op=add&cid=<?php echo $data['cid'];?>&name=<?php echo $data['name'];?>&lastname=<?php echo $data['lastname'];?>" role="button">Contratar</a>
        <a class="btn btn-outline-primary btn-sm" href="clients.php?op=edit&cid=<?php echo $data['cid'];?>" role="button">Modificar</a>
        <a class="btn btn-outline-danger btn-sm" href="clients.php?op=remove&cid=<?php echo $data['cid'];?>&name=<?php echo $data['name'];?>&lastname=<?php echo $data['lastname'];?>" role="button">Eliminar</a>
</div>
</p>
<table class="table table-hover">
<thead>
    <tr>
    <th scope="col">Alta</th>
    <th scope="col">Servicio</th>
    <th scope="col">Cr&eacute;ditos</th>
    <th scope="col" colspan="2" class="text-center">Sesiones</th>
    </tr>
</thead>
<tbody>
<?php $i=0; foreach($data['results'] as $result){ ?>
    <tr>
        <td width=90px><small><?php echo $result['dateadded'];?></small></td>
        <td><a href="orders.php?op=removeorder&cid=<? echo $data['cid'];?>&oid=<? echo $result['id'];?>" onclick="return confirm('¿Realmente quiere eliminar este servicio?')"><img src=images/trash.png style="float:left"></a>
            <?php echo $result['name'];?>
            <?php
            if($result['type']=="b"){
                echo"<kbd style=\"background-color: #f5b942;color: black;font-weight:bold;\">B</kbd>";
            }
            ?>
            <?php 
            if($result['paid']=="0"){
                echo"
                    <script>
                        $(document).ready(function() {
                            $(\"#paybutton".$i."\").click(function(){
                                $.ajax({
                                data: {\"op\" : \"paying\", \"oid\" :\"".$result['id']."\"},
                                type: \"GET\",
                                url: \"orders.php\",
                                })
                                .done(function( data, textStatus, jqXHR ) {
                                    if ( console && console.log ) {
                                        $('#dopay".$i."').hide();
                                        $('#paydone".$i."').show();                                        
                                    }
                                })
                            });
                        });
                    </script>
                    <a href=# id=paybutton".$i."><span id=dopay".$i." class=\"badge badge-pill badge-danger\" style=\"font-weight:bold;\">¿PAGAR?</span></a> <span id=paydone".$i." class=\"badge badge-pill badge-success\" style=\"font-weight:bold;display:none;\">PAGADO</span></a>";
            }            
            ?>        
        </td> 
        <td align=center width=30px><kbd><b><?php echo $result['credits'];?></b></kbd></td>
        <td width=30px><a href="#" class="badge badge-primary"  data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="true" aria-controls="collapse<?php echo $i;?>">DETALLES</a></td> 
        <td width=30px><?php         
            if($result['credits']==0){
                echo '<span class="badge badge-danger">AGOTADA</span>';
            } else{
                echo "<a href=\"orders.php?op=consume&pid=".$result['pid']."&cid=".$_GET['cid']."&oid=".$result['id']."&actualcredits=".$result['credits']."&product=".$result['name']."&name=".$data['name']."&lastname=".$data['lastname']."\" class=\"badge badge-success\">CONSUMIR</a>";
            }        
            ?>
        </td>
    </tr>
    <tr>
        <td colspan=5>
            <div id="collapse<?php echo $i;?>" class="collapse toggle" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordion">
                <div class="card-body">
                    <?php 
                    if($data['results2'][$i]){
                        echo"Fecha y zona consumida:";
                        foreach($data['results2'][$i] as $result2){      
                            echo'<h6><a href="orders.php?op=removeconsumption&id='.$result2['id'].'&credits='.$result['credits'].'&cid='.$data['cid'].'&oid='.$result['id'].'" onclick="return confirm(\'¿Realmente quiere eliminar esta sesi&oacute;n?\')"><img src=images/trash.png style="float:left"></a> <span class="badge badge-secondary">'.date_format(date_create($result2['datetimeadded']), 'Y-m-d H:i').'h</span> <span class="badge badge-info">'.$result2['bodypart'].'</span> <span class="badge badge-light">'.$result2['skintype'].'</span> <span class="badge badge-light">'.$result2['other'].'</span></h6> ';
                        }
                    }
                    else{
                        echo"No se ha consumido sesi&oacute;n a&uacute;n.";
                    }            
                    ?>
                </div>
            </div>                                
        </td>
    </tr> 

<?php $i++; } ?>

</tbody>
</table>