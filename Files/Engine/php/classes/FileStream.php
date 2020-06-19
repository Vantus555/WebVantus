<?php

class FileStream{
  static function WritePhpArray($arr, $filepath){
    $open = fopen("$filepath", "w");

    fwrite($open, "<?php\n");
    foreach ($arr as $key => $value) {
        $key = trim($key);
        fwrite($open, "$$key = '$value';\n");
    }
    fwrite($open, "?>\n");

    fclose($open);
  }

  static function ReadPhpArray($filepath){
    $open = fopen($filepath, "r");
    $arr = new ArrayObject();

    while(!feof($open))
    {
      $str = fgets($open);
      if($str[0] == '$'){
        $str1 = substr($str, strpos($str, "'") + 1);
        $str2 = substr($str1, 0, strpos($str1, "'"));

        $arr[trim(substr($str, strpos($str, '$') + 1, strpos($str, '=') - 1))] = trim($str2);
      }
    }

    fclose($open);
    return $arr;
  }
  static function ReadFile($filepath){
    return file_get_contents($filepath);
  }
  static function WriteToFile($filepath, $data){
    file_put_contents($filepath, $data);
  }
}

?>
