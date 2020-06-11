<?php
  class Product extends Controller {
    // в качестве параметра передаем id товара
    // этот id мы получаем из URL адреса
    public function index($id) {
      // передаем лишь одну запись, которую нужно вывести
      $product = $this->model('Products');

      $this->view('product/index', $product->getOneProduct($id));
    }

    // функция для вывода ошибки неправильного метода в URL
    public function error_method() {
      $this->view('error/404');
    }
  }
