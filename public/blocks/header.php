<!--Шапка из трёх секций-->
<header>

  <!--Вписан номер телефона интернет магазина и ссылки-->
  <div class="container top-menu">
    <!--класс nav - класс навигации, где будет несколько ссылок-->
    <div class="nav">
      <a href="/?url=home">Главная</a>
      <a href="/?url=contact">Контакты</a>
      <a href="/?url=contact/about">Про компанию</a>
    </div>
    <!--ещё один класс tel - записываем номер телефона в этом div-->
    <div class="tel">
      <!--добавляем иконку через fontawesome, выбираем на сайте и копируем код-->
      <i class="fas fa-phone"></i> +7 (000) 000 - 00 - 00
    </div>
  </div>

  <!--Логотип-->
  <div class="container middle">
    <div class="logo">
      <img src="/public/img/logo.svg" alt="Logo">
      <!--Лозунг-->
      <span>Мы знаем, что вы хотите!</span>
    </div>
    <!--Блок отвечает за ссылки на кнопки авторизации, регистрации, корзины-->
    <div class="auth-checkout">
      <a href="/?url=basket">

        <!--для подсчета элементов в корзине-->
        <?php
          require_once 'app/models/BasketModel.php';
          $basketModel = new BasketModel();
        ?>

        <button class="btn basket">Корзина <b>(<?=$basketModel->countItems()?>)</b></button></a><br>
      <?php if($_COOKIE['log'] == ''): ?>
        <a href="/?url=user/auth"><button class="btn auth">Войти</b></button></a>
        <a href="/?url=user/reg"><button class="btn">Регистрация</b></button></a>
      <?php else: ?>
        <a href="/?url=user/dashboard"><button class="btn dashboard">Кабинет пользователя</b></button></a>
      <?php endif ?>

    </div>
  </div>

  <!--Меню-->
  <div class="container menu">
    <ul>
      <li><a href="/?url=categories/index/1">Все товары</a></li>
      <li><a href="/?url=categories/shoes">Обувь</a></li>
      <li><a href="/?url=categories/hats">Кепки</a></li>
      <li><a href="/?url=categories/shirts">Футболки</a></li>
      <li><a href="/?url=categories/watches">Часы</a></li>
    </ul>
  </div>
</header>
