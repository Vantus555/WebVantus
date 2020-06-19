<?php
 require_once '../classes/FileStream.php';
 $file = $_POST['filename'];

  unset($_POST['filename']);
  FileStream::WritePhpArray($_POST, $file);

  echo "document.location.href = 'admin.php';";
?>
