<?php
  require_once '../classes/FileStream.php';
  /*$a = mime_content_type($_POST['file']);
  if(strstr($a,'text/') || strstr($a,'empty')){
    FileStream::WriteToFile($_POST['file'], $_POST['data']);
  }*/
  $finfo = finfo_open(FILEINFO_MIME_TYPE); // возвращает mime-тип
  foreach (glob("*") as $filename) {
    if(strstr(finfo_file($finfo, $filename),'text/') || strstr(finfo_file($finfo, $filename),'empty')){
      FileStream::WriteToFile($_POST['file'], $_POST['data']);
    }
  }
  finfo_close($finfo);
  
  echo "";

 ?>
