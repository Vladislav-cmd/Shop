<?php
  require 'DB.php';

  // класс будет служить для того, чтобы подключиться к БД и вывести все данные
  class Products {
    private $_db = null;
    // переменная, сколько товаров на странице должно быть
    //private $products_on_page = 3;
    //private $start_from = 0;

    // Далее создадим конструктор,
    // в котором будем получать подключение к БД и устанавливать в значение $_db
    public function __construct() {
      $this->_db = DB::getInstanse();
    }

    // функция будет выводить все записи из БД
    public function getProducts() {
      $result = $this->_db->query("SELECT * FROM `products` ORDER BY `id` DESC");
      // результат, который получаем, возвращаем из этой функции
      return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // функция для пагинации товаров на ссылке "Все товары"
    public function getProductsPagination($start_from, $products_on_page) {
      $result = $this->_db->query("SELECT * FROM `products` ORDER BY `id` DESC LIMIT $start_from, $products_on_page");
      // результат, который получаем, возвращаем из этой функции
      return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // функция будет выводить все записи из БД, но дополнительно сортировать
    // и лимитировать количество (На главной странице)
    public function getProductsLimited($order, $limit) {
      $result = $this->_db->query("SELECT * FROM `products` ORDER BY $order DESC LIMIT $limit");
      // результат, который получаем, возвращаем из этой функции
      return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // функция будет выводить все записи из БД по категории
    public function getProductsCategory($category) {
      $result = $this->_db->query("SELECT * FROM `products` WHERE `category` = '$category' ORDER BY `id` DESC");
      // результат, который получаем, возвращаем из этой функции
      return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // функция для вывода отдельного товара
    // возвращает лишь ту записи, у которого id равно передаваемому значению
    public function getOneProduct($id) {
      $result = $this->_db->query("SELECT * FROM `products` WHERE `id` = '$id'");
      // результат, который получаем, возвращаем из этой функции
      return $result->fetch(PDO::FETCH_ASSOC);
    }

    // функция для вывода товаров в корзине
    // будет получать набор элементов items
    public function getProductsCart($items) {
      // все записи, где id будет равен одному из значений IN (разные id пишем)
      $result = $this->_db->query("SELECT * FROM `products` WHERE `id`IN ($items)");
      // результат, который получаем, возвращаем из этой функции
      return $result->fetchAll(PDO::FETCH_ASSOC);
    }
  }
