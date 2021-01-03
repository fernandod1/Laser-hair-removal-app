 <br><div class="alert alert-warning">¿Est&aacute; seguro de querer eliminar al cliente <b><?php echo $data['name'];?> <?php echo $data['lastname'];?></b> y toda su informaci&oacute;n asociada?</div>
<form class="form-horizontal" action="clients.php?op=<?php echo $data['op'];?>" method="post" name="myForm" onsubmit="return ValidateForm()">
<input type="hidden" name="cid" value="<?php echo $data['cid'];?>">   

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger">Sí. Eliminar a <?php echo $data['name'];?> <?php echo $data['lastname'];?> de la base de datos</button> 
    </div>
  </div>
</form>

<br>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button  onclick="goBack()" type="submit" class="btn btn-secondary">No. Volver atr&aacute;s sin eliminar.</button>
    </div>
  </div>


<script>
function goBack() {
  window.history.back();
}
</script>



