<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      $title = "Панель управления";
      require_once 'Files/Engine/Blocks/head.php';

      require_once 'Files/Engine/php/classes/FileStream.php';
      $arr = FileStream::ReadPhpArray("mysql_data.php");
    ?>
  </head>
  <body>
    <?php require_once 'Files/Engine/Blocks/header.php'; ?>
    <main class="main">
      <?php
        require_once 'Files/Engine/Blocks/navbar.php';

        if($_GET['file'] == '')
          require_once 'Files/Engine/Blocks/mainInfo.php';
        else require_once "Files/Engine/Blocks/" . $_GET['file'];
       ?> 
    </main>
  </body>
  <?php
    require_once 'Files/Engine/Blocks/script.php';
   ?>
   <div
</html>
