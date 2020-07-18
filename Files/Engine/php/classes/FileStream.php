<?php

mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');
mb_http_output('UTF-8');
mb_language('uni');
setlocale(LC_ALL, 'ru_RU.65001', 'rus_RUS.65001', 'Russian_Russia. 65001', 'russian');

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
  static function ReadLinesFile($filepath){
    $res = '';

    $f = fopen($filepath, 'r');
    while(!feof($f))
      array_push($res, fgets($f));

    fclose($f);
    return $res;
  }

  static function WriteToFile($filepath, $data){
    file_put_contents($filepath, $data);
  }

  static function GetHtml($filepath){
    $text = file_get_contents($filepath);

    $indexHeadOpen = strripos($text, "<head>",0);
    $indexHeadClose = strripos($text, "</head>",0);
    $arr['head'] = trim(substr($text, $indexHeadOpen + 6, $indexHeadClose - $indexHeadOpen - 6));

    $indexBodyOpen = strripos($text, "<body>",0);
    $indexBodyClose = strripos($text, "</body>",0);
    $arr['body'] = trim(substr($text, $indexBodyOpen + 6, $indexBodyClose - $indexBodyOpen - 6));

    $textnew = str_replace($arr['body'], '', $text);
    $textnew = str_replace($arr['head'], '', $textnew);

    $replace = array("<!DOCTYPE html>", "<html>", "</html>", "<head>", "</head>", "<body>", "</body>");
    $textnew = str_replace($replace, '', $textnew);

    $arr['html'] = trim($textnew);

    //////////////////////////////////////
    preg_match_all('/<link.*href="(.*)".*>/i',$arr['head'], $arr['links']);

    $arr['links'] = $arr['links'][1];

    for ($i=0; $i < count($arr['links']); $i++) {
      if($arr['links'][$i] == '')
        unset($arr['links'][$i]);
    }
    
    return $arr;
  }
}

?>
