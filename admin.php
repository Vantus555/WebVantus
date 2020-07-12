<?php
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');
mb_http_output('UTF-8');
mb_language('uni');
// Вывод заголовка с данными о кодировке страницы
header('Content-Type: text/html; charset=utf-8');
// Настройка локали
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');
?>
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
