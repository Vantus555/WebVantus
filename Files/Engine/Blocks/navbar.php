<?php
  $Ignore = array(
    "index.php",
    "admin.php",
    "auth.php",
    "mysql_connect.php",
    "mysql_data.php",
    "reg.php",
    "Files",
    "Frameworks",
    "openfiles.php",
    ".git",
    ".gitignore",
    ".gitattributes",
    "LICENSE");
 ?>

<nav class="m_nav">
    <?php $url = $_SERVER["REQUEST_URI"];?>
    <div class="blank">
      <div>
       <div class="">
        <a class="width-100 nav_a text-resize <?php if ($url == "/admin.php?file=MainInfo.php" || $url == "/" || $url == "/admin.php") {echo 'activeitem';}?>"
          href="admin.php?file=MainInfo.php">
          Главная
        </a>
       </div>
      </div>
    </div>
    <!--////////activedir//////////////_index.php_////////////////////////////////////////////////////////////-->
    <div>
      <?php $open = "open";
      $type = "&type=page";?>
      <div class="maindir">
        <div class="dir">
          <div data-ul='ul1' class='opendir'>
            <a class="text-resize">
              <img class='Folder text-resize' src='Files/Engine/img/FolderClose.svg' alt=''>
              Сайт/Файлы
            </a>
          </div>
          <div data-Folder="" class="AddNewFile AddAndSave text-resize">
            <div class="AddAndSaveText">
                +
            </div>
          </div>
        </div>
        <ul data-ul='ul-ul1' class="m_ul">
          <div class="
            <?php
              if (
                strstr($url, "admin.php?file=SiteSetting.php&$open=index.php")
                || strstr($url, "admin.php?file=SiteSetting.php&$open=./index.php"))
              {echo 'active';}
            ?>
           fileindir">
            <div class='open'>
              <a class="text-resize" href="admin.php?file=SiteSetting.php&<?= $open ?>=index.php<?= $type ?>">
                <li>index.php</li>
              </a>
            </div>
            <div class="Files AddAndSave text-resize">
              <div class="AddAndSaveText">
                  ✓
              </div>
            </div>
          </div>

          <!--//////////////////////_Файлы_////////////////////////////////////////////////////////////-->

          <?php
            $dataul = 2;
            function printfile($name){
              $url = $_SERVER["REQUEST_URI"];
              $open="open";
              $type = "&type=page";

              echo "<div class='";
                if (strstr($url, "admin.php?file=SiteSetting.php&$open=$name"))
                  echo "active";
              echo " fileindir'>";
              echo "<div data-delete-rename-href='$name' class='open'><a
                class='text-resize' href='admin.php?file=SiteSetting.php&$open=$name$type'>
                  <li class='hrefmyfile'>";
                  $lastindex = strrpos($name, '/');
                  if($lastindex)
                    $href = substr($name, $lastindex+1);
                  else $href = $name;
                  echo "$href";
                  echo "</li>
                </a></div>
                <div class='Files AddAndSave text-resize'>
                  <div class='AddAndSaveText'>
                      ✓
                  </div>
                </div>
              </div>";
            }

            function printdir($name){
              global $dataul;
              $open = "open";
              $type = "&type=page";
                echo "<div><div class='dir'>";
                  echo "<div data-ul='ul$dataul' data-delete-rename-href='$name' class='open opendir'>";
                    echo "<a href='$name' class='text-resize'>";
                    echo "
                      <img class='Folder text-resize' src='Files/Engine/img/FolderClose.svg' alt=''>";
                      $lastindex = strrpos($name, '/');
                      if($lastindex)
                        $href = substr($name, $lastindex+1);
                      else $href = $name;
                      echo "$href";
                    echo "</a>";
                  echo "</div>";
                  echo "
                  <div data-Folder='' class='AddNewFile AddAndSave text-resize'>
                    <div class='AddAndSaveText'>
                        +
                    </div>
                  </div>
                </div>";

                  //$path = "$name";
                  echo "<ul data-ul='ul-ul$dataul' class='m_ul'>";
                  $dataul++;
                  $files = scandir($name);
                  for($i=2; $i<count($files); $i++) {
                    if(is_dir("$name/$files[$i]")){
                        printdir("$name/$files[$i]");
                    }
                  }
                  for($i=2; $i<count($files); $i++) {
                    if(is_file("$name/$files[$i]")){
                        printfile("$name/$files[$i]");
                    }
                  }
                  echo "</ul></div>";
            }
           ?>
          <?php
            $path = "./";
            $files = scandir($path);
            for($i=2; $i<count($files); $i++) {
              $bool = True;
              foreach ($Ignore as $key) {
                if($files[$i] == $key){
                  $bool = False;
                  break;
                }
              }
              if($bool == True && is_dir($files[$i])) {
                printdir($files[$i]);
              }
            }
            for($i=2; $i<count($files); $i++) {
              $bool = True;
              foreach ($Ignore as $key) {
                if($files[$i] == $key){
                  $bool = False;
                  break;
                }
              }
              if($bool == True && is_file($files[$i])){
                printfile($files[$i]);/*  Тут Ошибка!  */
              }
            }
          ?>
        </ul>
      </div>
    </div>
    <!----------------------------------------------------------------------------------------->
    <div>
      <div class="">
        <a class="width-100 nav_a text-resize <?php if ($url == "/a") {echo 'activeitem';}?>" href="">База данных</a>
      </div>
    </div>
    <!----------------------------------------------------------------------------------------->
    <div class="text-light">
      <?php $open = "open";
      $type = "&type=page";?>
      <div class="html_elements">
        <div class="">
          <div data-ul='el1' class='opendir'>
            <a class="text-resize">
              <img class='Folder text-resize' src='Files/Engine/img/FolderClose.svg' alt=''>
              Элементы
            </a>
          </div>
        </div>
        <ul data-ul='el-el1' class="m_ul">
          <div class="drag"
            data-head="
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <title>Document</title>"

            data-elem="
            <!DOCTYPE html>
            <html lang='en'>
            <head>
              <meta charset='UTF-8'>
              <meta name='viewport' content='width=device-width, initial-scale=1.0'>
              <meta http-equiv='X-UA-Compatible' content='ie=edge'>
              <title>Document</title>
            </head>
            <body>

            </body>
            </html>
          ">
            <a>
              <li>HTML</li>
            </a>
          </div>

          <div class="drag" data-elem="<div></div>">
            <a>
              <li>DIV</li>
            </a>
          </div>
        </ul>
      </div>
    </div>
    <!----------------------------------------------------------------------------------------->
    <div class="popupwindow">
      <div class="AddFile">
        <div class="form-group">
          <h5  class="text-resize white text-center">Информация о полдьзователе</h5>
          <label class="text-resize-root white" for="Nmae">Имя</label>
          <input class="input-resize form-control" id="Name" type="text" name="site" value="">
          <input class="input-resize form-control" id="input-href" type="text" name="site" value="">
          <div class="checkfiletype">
            <input class="radiobtn input-resize" id="createfile" type="radio" name="filetype" value="" checked>
            <label class="radiobtn text-resize-root white" for="createfile">Файл</label>
            <input class="radiobtn input-resize" id="createfolder" type="radio" name="filetype" value="">
            <label class="radiobtn text-resize-root white" for="createfolder">Папка</label>
          </div>
          <div id="errorblock" class="text-resize alert alert-danger" role="alert">
            Ошибка!
          </div>
          <a class="radiobtn text-resize white gocreatefile" href="#">Создать</a>
          <a class="renamebtn text-resize white gocreatefile" href="#">Переименовать</a>
        </div>
      </div>
    </div>
    <!----------------------------------------------------------------------------------------->
    <div data-filedelete="" tabindex="2" class="FileSettigs">
      <a class="delete" href="">
        Удалить
      </a>
      <a class="renamefile" href="">
        Переименовать
      </a>
    </div>
</nav>


<?php

/*
echo "<div class='dir'>";
echo "<div class='open'><a class='text-resize ";
if (strstr($url, "admin.php?file=SiteSetting.php&$open=$path$files[$i]"))
  echo "active";
echo "
  ' href='admin.php?file=SiteSetting.php&$open=$path$files[$i]$type'>
    <li class='hrefmyfile'>$name</li>
  </a></div>
  <div class='Files AddAndSave text-resize'>
    <div class='AddAndSaveText'>
        ✓
    </div>
  </div>
</div>";
*/

 ?>
