<div class="editAndViewPahe">
  <div class="settings">
    <?php $open = "open"; ?>
    <?php $path="admin.php?file=SiteSetting.php&$open=".$_GET["$open"]; ?>
    <a href="<?= $path ?>&type=page" class="text-light m-0 text-resize btn btn-secondary">Страница</a>
    <a href="<?= $path ?>&type=constructor" class="text-light m-0 text-resize btn btn-secondary">Конструктор</a>
    <a href="<?= $path ?>&type=text" class="text-light m-0 text-resize btn btn-secondary">Текст</a>
  </div>
  <div id="textpage">
    <iframe class="
      <?php
        $url = $_SERVER["REQUEST_URI"];
        if (!strstr($url,"type=page"))
        { echo 'd-none'; }
      ?>
        viewpage" src="<?= $_GET["$open"]
      ?>">
    </iframe>

    <div id="EditText" class="
      <?php
        $url = $_SERVER["REQUEST_URI"];
          if (!strstr($url,"type=text"))
        {
          echo 'd-none';
        }
      ?>
      EditText" tabindex='1'><div class="line"><div id="cursor"></div></div></div>

  </div>
</div>

<?php
  /*
  if(strstr(mime_content_type($_GET["$open"]),'text/')){
    $code = FileStream::ReadFile($_GET["$open"]);
    $syntax = "";
    for ($i=0; $i < strlen($code); $i++) {
      if($code[$i] == '<'){
        $syntax .= "<span><<span>";
      }
      else if($code[$i] == '>'){
        $syntax .= "<span>><span>";
      }
      else $syntax .= $code[$i];
    }
    echo $syntax;
  }
  */
 ?>
