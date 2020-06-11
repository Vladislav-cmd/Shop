<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Кабинет пользователя</title>
  <meta name="description" content="Кабинет пользователя">

  <!--подключаем стили-->
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <link rel="stylesheet" href="/public/css/user.css" charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
  <!--подключаем шапку сайта-->
  <?php require 'public/blocks/header.php' ?>

  <!--ОСНОВНАЯ ЧАСТЬ САЙТА-->
  <div class="container main">
    <div class="user-info">
      <p>Привет, <b><?=$data['user']['name']?></b></p>

      <form action="/?url=user/dashboard" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <button type="submit" class="btn" name="upload_btn">Загрузить</button><br>
        <?php if($data['user']['image'] == ''): ?>
          <!--выводим ошибки, если есть-->
          <br><p><?=$data['error']?></p><br>
          <p><img src="public/img/for_user.png" alt="Изображение заглушки"></p>
        <?php else: ?>
          <br><p><img src="public/img/<?=$data['user']['image']?>" alt="Изображение пользователя"></p>
        <?php endif ?>
        <button type="submit" class="btn" name="exit_btn">Выйти</button>
      </form>

    </div>
  </div>

  <!--подключаем футер сайта-->
  <?php require 'public/blocks/footer.php' ?>
</body>
</html>
