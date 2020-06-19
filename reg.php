<?php
    require_once 'Files/Engine/php/classes/FileStream.php';
    $arr = FileStream::ReadPhpArray("mysql_data.php");

    if($arr['userRoot'] != '')
      header('Location: auth.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      $title = "Регистрация сайта";
      require_once 'Files/Engine/Blocks/head.php';
    ?>

    <link rel="stylesheet" href="Files/Engine/css/reg.css">
  </head>
  <body>
    <div class="reg">
      <h3 class="regtitle">Зарегистрировать сайт</h3>
      <div class="form-group">
        <h5  class="regtitle">Информация о полдьзователе</h5>
        <label for="site">Название сайта</label>
        <input class="form-control" id="site" type="text" name="site" value="">
        <label for="userRoot">Пользователь</label>
        <input class="form-control" id="userRoot" type="text" name="userRoot" value="">
        <label for="pass">Пароль</label>
        <input class="form-control" id="pass" type="text" name="pass" value="">
        <label for="mail">E-mail</label>
        <input class="form-control" id="mail" type="text" name="mail" value="">
      </div>

      <div class="form-group mt-5">
        <h5  class="regtitle">Информация о базе данных</h5>
        <label for="db">Имя базы данных</label>
        <input class="form-control" id="db" type="text" name="db" value="">
        <label for="user">Имя пользователя базы данных</label>
        <input class="form-control" id="user" type="text" name="user" value="">
        <label for="password">Пароль</label>
        <input class="form-control" id="password" type="text" name="password" value="">
        <label for="host">Сервер</label>
        <input class="form-control" id="host" type="text" name="host" value="">
      </div>

      <button id="go" class="btn btn-success" type="button" name="go">Зарегистрировать сайт</button>
    </div>
  </body>
  <?php
    require_once 'Files/Engine/Blocks/script.php';
   ?>

   <script type="text/javascript">
      $('#go').click(function(){
        var formdata = new FormData();
        let dir = "<?=str_replace("\\","/", __DIR__);?>";
        dir+='/mysql_data.php'
        formdata.append('filename', dir);

        formdata.append('site',$('#site').val());
        formdata.append('userRoot',$('#userRoot').val());
        formdata.append('pass',$('#pass').val());
        formdata.append('mail',$('#mail').val());
        formdata.append('db',$('#db').val());
        formdata.append('user',$('#user').val());
        formdata.append('password',$('#password').val());
        formdata.append('host',$('#host').val());

        ajax.CreateAjax('Files/Engine/php/ajax/RegSite.php', formdata);
      });
   </script>
</html>
