<?php
 function FormatinFile($text){
   if($text){
     $res='';
     $lines = explode("\r\n", $text);
     if(count($lines) <= 1)
     $lines = explode("\n", $text);
     //return $lines[0];

     for ($i=0; $i < count($lines); $i++) {
        $resline = "";
        $opentag = false;
        $insedetag = false;
        foreach (preg_split('//u', $lines[$i]) as $key) {
            if($key == '<'){
              $opentag = true;
              $insedetag = false;
              $resline .= "<span class='symbol opentag'>".$key."</span>";
            }
            else if($key == '>' || ($key == ' ' && $opentag)){
              if($key == '>'){
                $opentag = false;
                $insedetag = false;
                $resline .= "<span class='symbol closetag'>".$key."</span>";
              }
              else{
                $opentag = false;
                $insedetag = true;
                $resline .= "<span class='symbol inside-tag'>".$key."</span>";
              }
            }
            else{
              if($opentag && !$insedetag)
                $resline .= "<span class='symbol tag'>".$key."</span>";
              else if(!$opentag && $insedetag)
                $resline .= "<span class='symbol inside-tag'>".$key."</span>";
              else if(!$insedetag && !$insedetag) $resline .= "<span class='symbol'>".$key."</span>";
            }
          }
          if($i==0)
            $resline = "<div class='line'><div id='cursor'></div>".$resline."</div>";
          else
            $resline = "<div class='line'>".$resline."</div>";
          $res .= $resline;

        }

        /*for ($j=0; $j < mb_strlen($lines[$i]); $j++) {
          if($lines[$i][$j] == '<'){
            $opentag = true;
            $insedetag = false;
            $resline .= "<span class='symbol opentag'>".$lines[$i][$j]."</span>";
          }
          else if($lines[$i][$j] == '>' || ($lines[$i][$j] == ' ' && $opentag)){
            if($lines[$i][$j] == '>'){
              $opentag = false;
              $insedetag = false;
              $resline .= "<span class='symbol closetag'>".$lines[$i][$j]."</span>";
            }
            else{
              $opentag = false;
              $insedetag = true;
              $resline .= "<span class='symbol inside-tag'>".$lines[$i][$j]."</span>";
            }
          }
          else{
            if($opentag && !$insedetag)
              $resline .= "<span class='symbol tag'>".$lines[$i][$j]."</span>";
            else if(!$opentag && $insedetag)
              $resline .= "<span class='symbol inside-tag'>".$lines[$i][$j]."</span>";
            else if(!$insedetag && !$insedetag) $resline .= "<span class='symbol'>".$lines[$i][$j]."</span>";
          }
        }
        if($i==0)
          $resline = "<div class='line'><div id='cursor'></div>".$resline."</div>";
        else
          $resline = "<div class='line'>".$resline."</div>";
        $res .= $resline;
     }*/

    return $res;
   }
   else{
     return "<div class='line'><div id='cursor'></div></div>";
   }
 }

 function NumLine($text){
   if($text){
     $res='';
     $lines = explode("\n", $text);

     for ($i=0; $i < count($lines); $i++) {
        $res .= "<div class='numline'>".($i+1)."</div>";
     }
     return $res;
   }
   else{
     return "<div class='numline'>1</div>";
   }
 }
 ?>

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

    <div id="Editor" class="
      <?php
        $url = $_SERVER["REQUEST_URI"];
          if (!strstr($url,"type=text"))
        {
          echo 'd-none';
        }
      ?>">
      <div class="numerationLine">
        <?php
          require_once 'Files/Engine/php/classes/FileStream.php';
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          if(strstr(finfo_file($finfo, $_GET["$open"]),'text/') || strstr(finfo_file($finfo, $_GET["$open"]),'empty')){
            echo NumLine(FileStream::ReadFile($_GET["$open"]));
          }
        ?>
      </div>
      <div class="overflowText">
        <div id="EditText" class="EditText" tabindex='1'><?php
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          if(strstr(finfo_file($finfo, $_GET["$open"]),'text/') || strstr(finfo_file($finfo, $_GET["$open"]),'empty')){
            echo FormatinFile(FileStream::ReadFile($_GET["$open"]));
          }
        ?></div>
      </div>
    </div>

  </div>
</div>
