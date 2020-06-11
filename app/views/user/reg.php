<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Регистрация</title>
  <meta name="description" content="Регистрация">

  <!--подключаем стили-->
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <!--отдельный файл со стилями для формы-->
  <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
  <!--подключаем специальные шрифты через сайт fontawesome.com-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
  <!--подключаем шапку сайта-->
  <?php require 'public/blocks/header.php' ?>

  <!--ОСНОВНАЯ ЧАСТЬ САЙТА-->
  <div class="container main">
    <!--Форма обратной связи-->
    <h1>Регистрация</h1>
    <p>Здесь вы можете зарегистрироваться</p>
    <!--указываем на какой странице будет происходить обработка формы-->
    <form action="/?url=user/reg" method="post" class="form-control">
      <input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>"><br>
      <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
      <input type="password" name="pass" placeholder="Введите пароль" value="<?=$_POST['pass']?>"><br>
      <input type="password" name="re_pass" placeholder="Повторите пароль" value="<?=$_POST['re_pass']?>"><br>
      <!--Блок сообщений с ошибками-->
      <div class="error"><?=$data['message']?></div>
      <button class="btn" id="send">Готово</button>
    </form>
  </div>

  <!--подключаем футер сайта-->
  <?php require 'public/blocks/footer.php' ?>
</body>
</html>
