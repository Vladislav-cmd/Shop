<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Корзина товаров</title>
  <meta name="description" content="Корзина товаров интернет магазина">

  <!--подключаем стили-->
  <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
  <link rel="stylesheet" href="/public/css/products.css" charset="utf-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
  <!--подключаем шапку сайта-->
  <?php require 'public/blocks/header.php' ?>

  <!--ОСНОВНАЯ ЧАСТЬ САЙТА-->
  <div class="container main">
    <h1>Корзина товаров</h1>
    <!--можно проверить значения в $data['products'] через print_r($data['products'])-->
    <!--получим наглядный массив и станет понятней, что выводим-->

    <?php if(count($data['products']) == 0): ?>
      <p><b><?=$data['empty']?></b><p>
    <?php else: ?>
      <form action="/?url=basket" method="post">
        <button class="btn" name="remove_all_products" style="margin-left: 0;margin-top: 20px">Удалить все товары из <i class="fas fa-trash"></i></button>
      </form>
      <div class="products">
        <?php
          // общая цена товаров изначально
          $sum = 0;
          for($i = 0; $i < count($data['products']); $i++):
            // суммируем цену товаров
            $sum += $data['products'][$i]['price'];
        ?>
        <div class="row">
          <img src="/public/img/<?=$data['products'][$i]['img']?>" alt="<?=$data['products'][$i]['title']?>">
          <h4><?=$data['products'][$i]['title']?></h4>
          <span><?=$data['products'][$i]['price']?> рублей</span>
          <form action="/?url=basket" method="post">
            <input type="hidden" name="item_id_delete" value="<?=$data['products'][$i]['id']?>">
            <button class="btn">Удалить из корзины <i class="fas fa-trash-alt"></i></button>
          </form>
        </div>
    <?php endfor; ?>


        <!--СИСТЕМА ОПЛАТЫ НА САЙТЕ-->
        <?php

          //Секретный ключ интернет-магазина
          $key = "6455737c66365251644b69716345347850734a5761395b4e554c6b";

          $fields = array();

          // Добавление полей формы в ассоциативный массив
          // ID кошелька
          $fields["WMI_MERCHANT_ID"]    = "153718674250";
          $fields["WMI_PAYMENT_AMOUNT"] = $sum;
          // код рубля
          $fields["WMI_CURRENCY_ID"]    = "643";
          // уникальное значение кода платежа
          $fields["WMI_PAYMENT_NO"]     = time();
          $fields["WMI_DESCRIPTION"]    = "BASE64:".base64_encode("Покупка товаров на сайте");
          // время до которого платеж действителен типо
          $fields["WMI_EXPIRED_DATE"]   = date('Y-m-d')."T23:59:59";
          // страница, которая будет вызываться при успешной оплате
          //"https://itproge.com/success"; нужно указывать существующее, чтобы не было ошибок
          $fields["WMI_SUCCESS_URL"]    = "https://itproge.com/success"; // /?url=success
          // когда оплата не прошла
          //"https://itproge.com/fail";
          $fields["WMI_FAIL_URL"]       = "https://itproge.com/fail"; // /?url=fail
          $fields["id_of_product"]       = "ID-214542"; // Дополнительные параметры

          //Если требуется задать только определенные способы оплаты, раскоментируйте данную строку и перечислите требуемые способы оплаты.
          // $fields["WMI_PTENABLED"]      = array("UnistreamRUB", "SberbankRUB", "RussianPostRUB");

          //Сортировка значений внутри полей
          foreach($fields as $name => $val) {
            if(is_array($val)) {
              usort($val, "strcasecmp");
              $fields[$name] = $val;
            }
          }

          // Формирование сообщения, путем объединения значений формы,
          // отсортированных по именам ключей в порядке возрастания.
          uksort($fields, "strcasecmp");
          $fieldValues = "";

          foreach($fields as $value) {
            if(is_array($value))
              foreach($value as $v) {
                //Конвертация из текущей кодировки (UTF-8)
                //необходима только если кодировка магазина отлична от Windows-1251
                $v = iconv("utf-8", "windows-1251", $v);
                $fieldValues .= $v;
              }
              else {
                //Конвертация из текущей кодировки (UTF-8)
                //необходима только если кодировка магазина отлична от Windows-1251
                $value = iconv("utf-8", "windows-1251", $value);
                $fieldValues .= $value;
              }
          }

          // Формирование значения параметра WMI_SIGNATURE, путем
          // вычисления отпечатка, сформированного выше сообщения,
          // по алгоритму MD5 и представление его в Base64

          $signature = base64_encode(pack("H*", md5($fieldValues . $key)));

          //Добавление параметра WMI_SIGNATURE в словарь параметров формы

          $fields["WMI_SIGNATURE"] = $signature;

          // Формирование HTML-кода платежной формы

          print "<form action='https://wl.walletone.com/checkout/checkout/Index' method='POST'>";

          foreach($fields as $key => $val) {
            if(is_array($val))
              foreach($val as $value) {
                print "<input type='hidden' name='$key' value='$value'/>";
              }
              else
                print "<input type='hidden' name='$key' value='$val'/>";
          }

          print "<button type='submit' class='btn'>Приобрести все за (<b>$sum рублей</b>)</button></form>";

        ?>

      </div>
    <?php endif; ?>

  </div>

  <!--подключаем футер сайта-->
  <?php require 'public/blocks/footer.php' ?>
</body>
</html>
