<header id='Vheader'>
  <?php
    require_once 'Files/Engine/php/classes/FileStream.php';
    $openfiles = FileStream::ReadPhpArray('openfiles.php');
    foreach ($openfiles as $key => $value) {
      echo "<div class='fileopen'>";
      echo "<a class='fileopenhref' href='$value'>";
      echo "$key";
      echo "</a>";
      echo "<span class='closefile'>&#10008;</span>";
      echo "</div>";
    }
  ?>
</header>
