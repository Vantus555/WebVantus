<?php
  //require_once '../classes/FileStream.php';
  $OldfileName = "../../../../" . $_POST['oldname'];
  $NewfileName = "../../../../" . $_POST['newname'];

  if($_POST['oldname'] != 'index.php' && $_POST['oldname'] && $OldfileName != $NewfileName){
    rename($OldfileName, $NewfileName);
  }

  //echo "alert('$file');";
  echo "document.location.href = 'admin.php?file=SiteSetting.php&open=index.php&type=page'";
 ?>
