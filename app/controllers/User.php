<?php
  class User extends Controller {
    public function reg() {
      $data = [];
      // функционал для обработки формы
      if(isset($_POST['name'])) {
         $user = $this->model('UserModel');
         $user->setData($_POST['name'], $_POST['email'], $_POST['pass'], $_POST['re_pass']);

         $isValid = $user->validForm();
         if($isValid == "Верно")
          $user->addUser();
         else
          $data['message'] = $isValid;
      }

      $this->view('user/reg', $data);
    }

    public function dashboard() {
      $user = $this->model('UserModel');
      // изначально передаем такой массив, если не нажата ни одна кнопка
      $data = ['user' => $user->getUser(), 'error' => ''];
      // Массив допустимых значений типа файла
      $types = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');

      // необходимо проверять, передаются ли данные методом POST
      // есть если это поле(из dashboard) передается, то значит, что мы нажали на Выйти
      if(isset($_POST['exit_btn'])) {
        $user->logOut();
        exit();
      }
      if(isset($_POST['upload_btn'])) {
        if($_FILES['image']['name'] == '')
          $data['error'] = 'Вы не указали файла для загрузки';
        // сравниваем тип файла из массива с совпадающим типом из types
        else if(!in_array($_FILES['image']['type'], $types))
          $data['error'] = 'Вы выбрали неподходящий тип файла. Возможны: <b>.gif; .png; .jpeg; .jpg</b>';
        else if(($_FILES['image']['size'] >= 512000) || ($_FILES['image']['size'] == 0))
          $data['error'] = 'Файл слишком большой. Максимум <b>500 КБ</b>';
        else {
          $user->addImage();
          // если все успешно, то перезаписываем массив, чтобы выбирать также image
          $data['user'] = $user->getUser();
        }
      }

      $this->view('user/dashboard', $data);
    }

    // функция для авторизации
    public function auth() {
      $data = [];
      if(isset($_POST['email'])) {
        $user = $this->model('UserModel');
        $data['message'] = $user->auth($_POST['email'], $_POST['pass']);
        // сообщение, которое вернется из функции auth запишется в массив data
      }

      $this->view('user/auth', $data);
    }

    // функция для вывода ошибки неправильного метода в URL
    public function error_method() {
      $this->view('error/404');
    }
  }
