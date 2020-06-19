<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      $title = "Вход в панель управления";
      require_once 'Files/Engine/Blocks/head.php';
    ?>

    <link rel="stylesheet" href="Files/Engine/css/reg.css">
  </head>
  <body>
    <div class="reg">
      <h3 class="regtitle">Вход</h3>
      <div class="form-group">
        <label for="login">Логин</label>
        <input class="form-control" id="login" type="text" name="site" value="">
        <label for="pass">Пароль</label>
        <input class="form-control" id="pass" type="password" name="pass" value="">
      </div>

      <button id="go" class="btn btn-success" type="button" name="go">Вход</button>
    </div>
  </body>
  <?php
    require_once 'Files/Engine/Blocks/script.php';
  ?>

   <script type="text/javascript">
      $('#go').click(function(){
        var formdata = new FormData();
        formdata.append('login',$('#login').val());
        formdata.append('pass',$('#pass').val());

        let dir = "<?=str_replace("\\","/", __DIR__);?>";
        formdata.append('dir', dir);

        ajax.CreateAjax('Files/Engine/php/ajax/Auth.php', formdata);
      });
   </script>
</html>
