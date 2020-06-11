<?php
    // Дочерний класс от класса Controller
    // Класс контроллер, который отвечает за главную страницу
    // наследует всё от главного контроллера
    class Home extends Controller {
        public function index() {
          // создадим объект на основе модели Products
          $products = $this->model('Products');
          // передаем второй параметр, в котором обращаемся к функции в модели
          // а также в этой функции указываем два параметра
          $this->view('home/index', $products->getProductsLimited("id", 5));
        }

        // функция для вывода ошибки неправильного метода в URL
        public function error_method() {
          $this->view('error/404');
        }
    }
