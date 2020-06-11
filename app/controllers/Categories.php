<?php
  class Categories extends Controller {
    public function index($page = '') {
      // Необходимо брать все товары, которые хотим вывести на странице Все товары
      // Создаем объект на основе класса Products
      $products = $this->model('Products');

      // количество страниц, которое надо вывести, убираем дробную часть (сейчас число 6)
      // делим на 3 так как хотим, чтобы выводилось по 3 товара на странице, следовательно
      // необходимо определить сколько страниц будет, если выводить на каждой лишь по 3 товара
      $pages = floor(count($products->getProducts())/3);

      // получим номер страницы из URL
       $p = isset($_GET["p"]) ? (int) $_GET["p"] : $page;

       // через оператор будем определять, какие товары выводить согласно номеру
       // передаваемой странице
       // также делаем проверку на то, если номера страницы не существует, то ошибку выводим
       switch ($p) {
         case $p:
         if($p > ($pages+1))
           $this->view('error/404');
          else {
             $data = [
               'products' => $products->getProductsPagination(($p-1)*3, 3),
               'title' => 'Все товары на сайте',
               'name' => 'Все товары на нашем сайте',
               'count_of_pages' => $pages
             ];
             $this->view('categories/pagination', $data);
             break;
          }
        }
      }

    public function shoes() {
      // Необходимо брать все товары, которые хотим вывести на странице Обувь
      // Создаем объект на основе класса Products
      $products = $this->model('Products');
      // чтобы в шаблон передать дополнительные данные
      $data = ['products' => $products->getProductsCategory('shoes'), 'title' => 'Категория обувь'];
      $this->view('categories/index', $data);
    }

    public function hats() {
      // Необходимо брать все товары, которые хотим вывести на странице Обувь
      // Создаем объект на основе класса Products
      $products = $this->model('Products');
      $data = ['products' => $products->getProductsCategory('hats'), 'title' => 'Категория кепки'];
      $this->view('categories/index', $data);
    }

    public function shirts() {
      // Необходимо брать все товары, которые хотим вывести на странице Обувь
      // Создаем объект на основе класса Products
      $products = $this->model('Products');
      $data = ['products' => $products->getProductsCategory('shirts'), 'title' => 'Категория футболки'];
      $this->view('categories/index', $data);
    }

    public function watches() {
      // Необходимо брать все товары, которые хотим вывести на странице Обувь
      // Создаем объект на основе класса Products
      $products = $this->model('Products');
      $data = ['products' => $products->getProductsCategory('watches'), 'title' => 'Категория часы'];
      $this->view('categories/index', $data);
    }

    // функция для вывода ошибки неправильного метода в URL
    public function error_method() {
      $this->view('error/404');
    }
  }
