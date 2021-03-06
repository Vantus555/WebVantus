<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    *{
      z-index: 3;
      margin: 0;
      padding: 0;
    }
    body{
      height: 10000px;
    }
    html,body{
      border: none;
    }
    video{
      z-index: 1;
      display: block;
      position: fixed;
      width: 100%;
      opacity: 0.75;
    }
    .menu{
      width: 900px;
      margin: auto;
      display: grid;
      grid-template-columns: repeat(5, 1fr);
    }
    .menua, .ahover{
      display: block;
      width: 100%;
      background: #f0f;
      border: 2px solid #000;
      height: 25px;
      text-align: center;
      line-height: 25px;
      text-decoration: none;
      color: #fff;
    }

    .menua:hover, .ahover:hover{
      background: #555;
    }

    ul{
      width: 100%;
      position: absolute;
      display: none;
      list-style: none;
    }
    .divhover{
      position:relative;
    }
    </style>
    <link rel="stylesheet" href="">
  </head>
  <body>
    <video src="videoplayback.mp4" autoplay muted loop>
    </video>

    <div class="menu">
      <div class="divhover">
        <a class="menua" href="#">Главная</a>
          <ul>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
          </ul>
      </div><div class="divhover">
        <a class="menua" href="#">Новости</a>
          <ul>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
          </ul>
      </div><div class="divhover">
        <a class="menua" href="#">О нас</a>
          <ul>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
          </ul>
      </div><div class="divhover">
        <a class="menua" href="#">Форум</a>
          <ul>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
          </ul>
      </div><div class="divhover">
        <a class="menua" href="#">Контакты</a>
          <ul>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
            <a href="" class="ahover">
              <li>seofjnjmise</li>
            </a>
          </ul>
      </div>
    </div>
  </body>

  <script type="text/javascript" src="Frameworks/jQuery/jquery-3.5.1.min.js">

  </script>
  <script type="text/javascript">
    $('.divhover').mouseover(function(){
      $($(this).children()[1]).show();
    });

    $('.divhover').mouseout(function(){
      $($(this).children()[1]).hide();
    });
  </script>
</html>
