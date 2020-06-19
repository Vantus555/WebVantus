<div class="Info">
  <div class="text-center InfoBlocks">
    <h3 class="text-resize">
      Информации о сайте
    </h3>
  </div>

  <div class="SiteInfo">
    <div class="InfoBlocks">
      <h4 class="text-resize">Сайт: <?= $arr['site'] ?></h4>
      <h5 class="text-resize-root">Владелец: <?= $arr['userRoot'] ?></h5>
      <h4 class="text-resize">База данных: <?= $arr['db'] ?></h4>
      <h5 class="text-resize-root">Логин: <?= $arr['user'] ?></h5>
      <h5 class="text-resize-root">Сервер: <?= $arr['host'] ?></h5>

      <a class="text-resize d-block w-100 btn btn-success" href="admin.php?file=SiteSetting.php&open=index.php">
        Редактировать сайт
      </a>
    </div>
    <div class="InfoBlocks">
      <h4 class="text-resize text-center">Основные файлы сайти</h4>
    </div>
  </div>
</div>
