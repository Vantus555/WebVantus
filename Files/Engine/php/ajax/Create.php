<?php
  require_once '../classes/FileStream.php';
  $file = "../../../../" . $_POST['name'];

  $command = "document.location.reload(true);";

  if($_POST['type'] == 'File' && $_POST['name'] && !file_exists($file)){
    $f_hdl = fopen($file, 'w');
    fclose($f_hdl);
  }
  else if($_POST['type'] == 'Folder' && $_POST['name'] && !file_exists($file)){
    mkdir($file);
  }
  else{
    $command = "$('#errorblock').text('Нельзя создать файл или дерикторию с таким именем!');$('#errorblock').show();";
  }

  echo $command;
 ?>
