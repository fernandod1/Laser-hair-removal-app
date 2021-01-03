<?php

// Set full path in $target_dir varible to disclaimer contract uploads of clients:

$target_dir = "/full/path/to/documents/".$_POST['cid']."/";

// --------------------- Do not modify under this line ---------------------- //

$target_file = $target_dir . basename($_FILES["upload"]["name"]);
$Ok = 1;

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Error. Ya existe otro fichero con mismo nombre.";
  $Ok = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
  echo "El tamaño del fichero no debe superar 10 MB.";
  $Ok = 0;
}

// Allow certain file formats
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
&& $FileType != "gif" && $FileType != "pdf"  && $FileType != "doc" && $FileType != "docx") {
  echo "Solo se permiten documentos de tipo JPG, JPEG, PNG, GIF, PDF o DOC.";
  $Ok = 0;
}
$target_file2 = $target_dir . uniqid() .".". $FileType;

if ($Ok == 0) {
  echo "Error. No fue posible subir el fichero.";

} else {
  if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file2)) {
    header('Location: orders.php?op=view&uploadedfile=done&cid='.$_POST['cid'].'');
    exit;
  } else {
    echo "Error. No fue posible subir el fichero.";
  }
}
?>