<br><div class="alert alert-primary" role="alert">Rellene el siguiente formulario para añadir un cliente:</div>
<form class="form-horizontal" action="clients.php?op=<?php echo $data['op'];?>" method="post" name="myForm" onsubmit="return ValidateForm()">
<input type="hidden" name="cid" value="<?php echo $data['cid'];?>">   
  <div class="form-group">
    <label class="col-sm-6 control-label">* <b>Nombre:</b></label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="name" value="<?php echo $data['name'];?>" placeholder="Nombre" maxlength="100">
      <span id="name"></span>   
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-6 control-label">* <b>Apellidos:</b></label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="lastname" value="<?php echo $data['lastname'];?>" placeholder="Apellidos" maxlength="100">
      <span id="lastname"></span>   
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-6 control-label"><b>A&ntilde;o de nacimiento:</b></label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="yearborn" value="<?php echo $data['yearborn'];?>" placeholder="1985" maxlength="4">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-6 control-label">* <b>Sexo:</b></label>
    <div class="col-sm-6">
      <select name="sex" class="form-control">
        <option value="">--- Seleccione ---</option> 
        <option value="hombre">Hombre</option>
        <option value="mujer">Mujer</option>
      </select>
      <span id="sex"></span>   
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-6 control-label">* <b>Tel&eacute;fono:</b></label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="phone" value="<?php echo $data['phone'];?>" placeholder="6512347895" maxlength="20">
      <span id="phone"></span>   
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-6 control-label">Correo electr&oacute;nico:</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="email" value="<?php echo $data['email'];?>" placeholder="mi@email.com" maxlength="100">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-6 control-label">Direcci&oacute;n:</label>
    <div class="col-sm-6">
      <input class="form-control" type="text" name="address" value="<?php echo $data['address'];?>" placeholder="Calle San Juan" maxlength="250">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-6 control-label">Color ojos:</label>
    <div class="col-sm-6">
      <select name="coloreyes" class="form-control">
        <option value="">--- Seleccione ---</option> 
        <option value="Azul">Azul</option>
        <option value="Gris">Gris</option>
        <option value="Marron">Marr&oacute;n</option>
        <option value="Negro">Negro</option>
        <option value="Verde">Verde</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-6 control-label">Color pelo:</label>
    <div class="col-sm-6">
      <select name="colorhair" class="form-control">
        <option value="">--- Seleccione ---</option> 
        <option value="Castano">Castaño</option>
        <option value="Moreno">Moreno</option>
        <option value="Pelirrojo">Pelirrojo</option>
        <option value="Rubio">Rubio</option>
        <option value="Otro">Otro</option>
      </select>
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
      <input class="form-control" type="text" name="other" value="<?php echo $data['other'];?>" placeholder="Alguna nota del cliente..." maxlength="500">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" class="btn btn-secondary">Añadir nuevo cliente</button>
    </div>
  </div>
</form>
* Campos requeridos.

<?if(isset($data['id'])) {?>
    <br>
    <br><div class="alert alert-primary" role="alert">Ficheros de documentaci&oacute;n de consentimientos:</div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cid" value="<?php echo $data['id'];?>">
      <input type="file" name="upload">
      <input type="submit" value="Subir documento" name="submit" class="btn btn-secondary" >
    </form>
    <br>
<?php 
    if (file_exists("documents/".$data['id'])) {
      echo '<b>Documentos subidos</b>: '; 
      if ($handle = opendir("documents/".$data['id'])) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                echo "<a href=documents/".$data['id']."/".$entry.">$entry</a> · \n";
            }
        }
        closedir($handle);
      }
    }
} // end if(isset($data['id']))
?>

<script>
function ValidateForm() {  
  var x, text = '';

  x = document.forms["myForm"]["name"].value;
  if (x == "") {
    text = "<font color=red>Error. Debe indicar nombre.</font>";
    document.getElementById("name").innerHTML = text;
    return false;
  }
  x = document.forms["myForm"]["lastname"].value;
  if (x == "") {
    text = "<font color=red>Error. Debe indicar apellido.</font>";
    document.getElementById("lastname").innerHTML = text;
    return false;
  }
  x = document.forms["myForm"]["sex"].value;
  if (x == "") {
    text = "<font color=red>Error. Debe indicar el sexo.</font>";
    document.getElementById("sex").innerHTML = text;
    return false;
  }
  x = document.forms["myForm"]["phone"].value;
  if (isNaN(x) || x == "") {
    text = "<font color=red>Error. Debe ser valor num&eacute;rico.</font>";
    document.getElementById("phone").innerHTML = text;
    return false;
  }
}
</script>


