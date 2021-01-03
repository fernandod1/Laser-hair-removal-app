<?php 
extract($data); 
?>
<br><div class="alert alert-primary" role="alert">Añadir a cliente un nuevo servicio contratado:</div>
<form class="form-horizontal" action="orders.php?op=<?php echo $op;?>" method="post" name="myForm" onsubmit="return ValidateForm()">
<input type="hidden" name="cid" value="<?php echo $cid;?>"> 
<input type="hidden" name="name" value="<?php echo $name;?>"> 
<input type="hidden" name="lastname" value="<?php echo $lastname;?>"> 
<h2><?php echo $name;?> <?php echo $lastname;?></h2><br>
<div class="form-group">
    <label class="col-sm-6 control-label">* <b>Servicios disponibles:</b></label>
    <div class="col-sm-6">
        <select name="idproduct" class="form-control">
        <option value="">--- Seleccione servicio a contratar ---</option> 
<?php foreach($products as $product){ 
    extract($product); 
?>
<option value="<?php echo $id;?>"><?php echo $name;?> (<?php echo $description;?>)</option>
<? } ?>
        </select>
        <span id="idproduct"></span>   
    </div>
</div>
<div class="form-group">
    <label class="col-sm-6 control-label">* <b>Modalidad:</b></label>
    <div class="col-sm-6">
        <select name="type" class="form-control">
        <option value="">--- Seleccione una modalidad ---</option> 
        <option value="s">Sesi&oacute;n simple</option>
        <option value="b">Bono de sesiones</option>                
        </select>
        <span id="type"></span>   
    </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-6">
    * <input type="radio" name="paid" value="0">
    <label for="dewey">No pagado</label>&nbsp;&nbsp;
    <input type="radio" name="paid" value="1">
    <label for="dewey">S&iacute; pagado</label>
    <span id="paid"></span> 
  </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" class="btn btn-secondary">Contratar nuevo servicio</button>
    </div>
  </div>
</form>
<br>
* Campos requeridos.
<br>

<script>
function ValidateForm() {  
  var x, text = '';
  x = document.forms["myForm"]["idproduct"].value;
  if (x == "") {
    text = "<font color=red>Error. Debe indicar un servicio a contratar.</font>";
    document.getElementById("idproduct").innerHTML = text;
    return false;
  }
  x = document.forms["myForm"]["type"].value;
  if (x == "") {
    text = "<font color=red>Error. Debe indicar una modalidad.</font>";
    document.getElementById("type").innerHTML = text;
    return false;
  }
  x = document.forms["myForm"]["paid"].value;
  if (x == "") {
    text = "<font color=red>Error. Debe indicar si est&aacute; pagado.</font>";
    document.getElementById("paid").innerHTML = text;
    return false;
  }
}
</script>

