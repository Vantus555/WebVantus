<?php
  require_once '../classes/FileStream.php';
  $file = "../../../../" . $_POST['name'];

  function removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
       foreach($objs as $obj) {
         is_dir($obj) ? removeDirectory($obj) : unlink($obj);
       }
    }
    rmdir($dir);
  }

  if($_POST['name'] && $_POST['name'] != 'index.php'){
    if(is_file($file))
      unlink($file);
    else
      removeDirectory($file);
  }

  echo "document.location.href = 'admin.php?file=SiteSetting.php&open=index.php&type=page'";
 ?>
