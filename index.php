<?php
    // чтобы не выводились ошибки на сайте
    // при окончательном результате снимать комментарий
    error_reporting(0);

    // Наш основной файл, который запускается при заходе на сайт
    require_once 'app/init.php';
    // Создаём объёкт на основе класса App.php
    $app = new App();

// ключ с кошелька
// 6455737c66365251644b69716345347850734a5761395b4e554c6b
