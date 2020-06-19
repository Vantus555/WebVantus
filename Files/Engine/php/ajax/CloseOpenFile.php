<?php
  require_once '../classes/FileStream.php';
  $file="../../../../openfiles.php";
  $arr = FileStream::ReadPhpArray($file);
  $error = "Готово";
  foreach ($arr as $key => $value) {
    if($value == $_POST['href']){
      $error = $_POST['name'];
      unset($arr[$_POST['name']]);
      break;
    }
  }
  FileStream::WritePhpArray($arr, $file);

  echo "document.location.reload(true);";
 ?>
