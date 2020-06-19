<?php

  require_once '../classes/FileStream.php';
  $file="../../../../openfiles.php";
  $arr = FileStream::ReadPhpArray($file);
  $boool = true;
  foreach ($arr as $key => $value) {
    if($value == $_POST['href']){
      $boool = false;
      break;
    }
  }
  if($boool){
    $arr[$_POST['name']] = $_POST['href'];
  }
  FileStream::WritePhpArray($arr, $file);

  echo "document.location.reload(true);";
 ?>
