<?php
  require_once '../classes/FileStream.php';
  $arr = FileStream::ReadPhpArray($_POST["dir"] . "/mysql_data.php");

  if($arr['userRoot'] == $_POST['login']){
    if($arr['pass'] == $_POST['pass'])
      echo "document.location.href = 'admin.php';";
    else echo "alert('Ошибка!');";
  }
  else echo "alert('Ошибка!');";
 ?>
