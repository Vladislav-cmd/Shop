<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?=$data['title']?></title>
  <meta name="description" content="<?=$data['anons']?>">

  <!--подключаем стили-->
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <!--создаем отдельные стили для отдельного товара-->
  <link rel="stylesheet" href="/public/css/product.css" charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
  <!--подключаем шапку сайта-->
  <?php require 'public/blocks/header.php' ?>

  <!--ОСНОВНАЯ ЧАСТЬ САЙТА-->
  <div class="container main">
    <a href="/?url=categories/<?=$data['category']?>">Назад</a>
    <h1><?=$data['title']?></h1>
    <div class="info">
      <div>
        <img src="/public/img/<?=$data['img']?>" alt="<?=$data['title']?>">
      </div>
      <div>
        <p><?=$data['anons']?></p><br>
        <p><?=$data['text']?></p>
      </div>
      <div>
        <form action="/?url=basket" method='post'>
          <!--в значении id товара-->
          <input type="hidden" name="item_id" value="<?=$data['id']?>">
          <button class="btn">Купить за <?=$data['price']?> рублей</button>
        </form>

      </div>
    </div>
  </div>

  <!--подключаем футер сайта-->
  <?php require 'public/blocks/footer.php' ?>
</body>
</html>
