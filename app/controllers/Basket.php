<?php
  class Basket extends Controller {
    public function index() {
      // Была нажата кнопка удалить товар из корзины
      // Соответсвенно удаляем запись из сессии
      if(isset($_POST['item_id_delete'])) {
        $cart = $this->model('BasketModel');
        // Вызываем функцию что удаляет один элемент из сессии
        $cart->deleteOneFromSession($_POST['item_id_delete']);
        // После удаления элемента у нас произойдет вызов сессии еще раз
        // и будут выведены все товары кроме того, что уже удален
      }

      // для удаления всех товаров
      if(isset($_POST['remove_all_products'])) {
        $cart = $this->model('BasketModel');
        // удаляем сессию, и в счетчике корзины 0 товаров
        $cart->deleteSession();
      }

      $data = [];
      $cart = $this->model('BasketModel');
      // передаются ли данные при помощи метода POST
      // когда нажали на кнопку Купить
      if(isset($_POST['item_id']))
        // то добавляем в сессию новый товар
        $cart->addToCart($_POST['item_id']);

      // сессия не установлена, пока в неё ничего не добавляли
      if(!$cart->isSetSession())
        $data['empty'] = 'Пустая корзина';
      else { // если установлена и какие то элементы в сессии есть
        // выводим сами товары
        $products = $this->model('Products');
        // функция getProductsCart в модели Products
        // $cart->getSession() = $itmes которое мы передаем в функцию getProductsCart
        // где $cart->getSession() - id тех товаров, что добавили, к примеру (6, 7, 1)
        $data['products'] = $products->getProductsCart($cart->getSession());
      }

      $this->view('basket/index', $data);
    }

    // функция для вывода ошибки неправильного метода в URL
    public function error_method() {
      $this->view('error/404');
    }
  }
