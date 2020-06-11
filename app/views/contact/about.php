<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Страница про компанию</title>
  <meta name="description" content="Страница про нашу компанию">

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
    <h1>Про компанию</h1>
    <p>Здесь просто текст про компанию</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
       sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
  </div>

    <!--вывод дополнительного параметра, если прописан-->
    <?=$data['key']?>

  <!--подключаем футер сайта-->
  <?php require 'public/blocks/footer.php' ?>
</body>
</html>
