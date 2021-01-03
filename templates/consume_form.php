<br><div class="alert alert-primary" role="alert"><? echo $data['product'];?>. Elija la zona del cuerpo a consumir en la sesi&oacute;n contratada:</div>
<form class="form-horizontal" action="orders.php?op=<? echo $data['op'];?>" method="post" name="myForm" onsubmit="return ValidateForm()">
<input type="hidden" name="cid" value="<? echo $data['cid'];?>">
<input type="hidden" name="oid" value="<? echo $data['oid'];?>"> 
<input type="hidden" name="actualcredits" value="<? echo $data['actualcredits'];?>"> 
<input type="hidden" name="name" value="<? echo $data['name'];?>"> 
<input type="hidden" name="lastname" value="<? echo $data['lastname'];?>"> 
<h2><? echo $data['name'];?> <? echo $data['lastname'];?></h2><br>
<div class="form-group">
    <label class="col-sm-6 control-label">* <b>Elija <? echo $data['product'];?> a consumir:</b></label>
    <div class="col-sm-6">
        <select name="idbodypart" class="form-control">
        <option value="">--- Seleccione zona a consumir ---</option> 
        <? foreach($data['bodyparts'] as $bodypart){ ?>
        <option value="<? echo $bodypart['id'];?>"><? echo $bodypart['bodypart'];?></option>            
        <? } ?>
        </select>
        <span id="idbodypart"></span>   
    </div>
</div>
<div class="form-group">
    <label class="col-sm-6 control-label">Tipo de piel:</label>
    <div class="col-sm-6">
      <select name="skintype" class="form-control">
        <option value="">--- Seleccione ---</option> 
        <option value="Fototipo I">Fototipo I</option>
        <option value="Fototipo II">Fototipo II</option>
        <option value="Fototipo III">Fototipo III</option>
        <option value="Fototipo IV">Fototipo IV</option>
        <option value="Fototipo V">Fototipo V</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-6 control-label">Anotaci&oacute;n:</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="other" placeholder="Anotaci&oacute;n sobre servicio..." maxlength="300">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" class="btn btn-secondary">Consumir 1 sesi&oacute;n YA</button>
    </div>
  </div>
</form>
<br>
* Campos requeridos.
<br>

<script>
function ValidateForm() {  
  var x, text = '';
  x = document.forms["myForm"]["idbodypart"].value;
  if (x == "") {
    text = "<font color=red>Error. Debe indicar una parte del cuerpo a consumir.</font>";
    document.getElementById("idbodypart").innerHTML = text;
    return false;
  }
}
</script>
