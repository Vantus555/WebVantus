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

    <textarea id="EditText" class="
      <?php
        $url = $_SERVER["REQUEST_URI"];
          if (!strstr($url,"type=text"))
        {
          echo 'd-none';
        }
      ?>
      EditText"><?php
      if(strstr(mime_content_type($_GET["$open"]),'text/'))
        echo FileStream::ReadFile($_GET["$open"]);
      ?></textarea>

  </div>
</div>
