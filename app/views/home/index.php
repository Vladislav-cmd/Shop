<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Главная страница</title>
  <!--ещё один мета тег для описания страницы-->
  <meta name="description" content="Главная страница интернет магазина">

  <!--подключаем стили-->
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <!--подключаем специальные шрифты через сайт fontawesome.com-->
  <!--регистрируемся на сайте и после получаем ссылку на код, но у меня не было, было другое-->
  <!--"https://kit.fontawesome.com/c51b7eb152.js" crossorigin="anonymous"-->
  <!--взял из материала лекции-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
  <!--подключаем шапку сайта-->
  <?php require 'public/blocks/header.php' ?>

  <!--ОСНОВНАЯ ЧАСТЬ САЙТА-->
  <div class="container main">
    <h1>Популярные товары</h1>
    <div class="products">
      <?php for($i = 0; $i < count($data); $i++): ?>
        <div class="product">
          <div class="image">
            <img src="/public/img/<?=$data[$i]['img']?>" alt="<?=$data[$i]['title']?>">
          </div>
          <h3><?=$data[$i]['title']?></h3>
          <p><?=$data[$i]['anons']?></p>
          <!--почему-то метод index не вызывается по умолчанию для этого контроллера-->
          <a href="/?url=product/index/<?=$data[$i]['id']?>"><button class="btn">Детальнее</button></a>
        </div>
      <?php endfor; ?>
    </div>
  </div>

  <!--подключаем футер сайта-->
  <?php require 'public/blocks/footer.php' ?>
</body>
</html>
