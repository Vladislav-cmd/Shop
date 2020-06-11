<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!--массив data определен в контроллере Categories-->
  <!--в нем передаются параметры, где первый - это массив данных из БД-->
  <title><?=$data['title']?></title>
  <meta name="description" content="<?=$data['name']?>">

  <!--подключаем стили-->
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <link rel="stylesheet" href="/public/css/pagination.css" charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
  <!--подключаем шапку сайта-->
  <?php require 'public/blocks/header.php' ?>

  <!--ОСНОВНАЯ ЧАСТЬ САЙТА-->
  <div class="container main">
    <h1><?=$data['title']?></h1>
    <div class="products">
      <?php for($i = 0; $i < count($data['products']); $i++): ?>
        <div class="product">
          <div class="image">
            <img src="/public/img/<?=$data['products'][$i]['img']?>" alt="<?=$data['products'][$i]['title']?>">
          </div>
          <h3><?=$data['products'][$i]['title']?></h3>
          <p><?=$data['products'][$i]['anons']?></p>
          <!--почему-то метод index не вызывается по умолчанию для этого контроллера-->
          <a href="/?url=product/index/<?=$data['products'][$i]['id']?>"><button class="btn">Детальнее</button></a>
        </div>
      <?php endfor; ?>
    </div>
  </div>

  <!--кнопки для перехода не следующую страницу товаров-->
  <div class="pagination">
    <?php for($i = 0; $i <= $data['count_of_pages']; $i++): ?>
    <a href="/?url=categories/index/<?=$a=($i+1)?>"><button class="btnpgn"><?=$i + 1?></button></a>
  <?php endfor; ?>
  </div>

  <!--подключаем футер сайта-->
  <?php require 'public/blocks/footer.php' ?>
</body>
</html>
