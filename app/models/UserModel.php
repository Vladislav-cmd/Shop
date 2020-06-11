<?php
  // выполним подключение к БД
  require 'DB.php';

  class UserModel {
    private $name;
    private $email;
    private $pass;
    private $re_pass;

    private $_db = null;

    public function __construct() {
      $this->_db = DB::getInstanse();
    }


    public function setData($name, $email, $pass, $re_pass) {
      $this->name = $name;
      $this->email = $email;
      $this->pass = $pass;
      $this->re_pass = $re_pass;
    }

    // в функции будем проверять на корректность значий в переменных
    public function validForm() {
      if(strlen($this->name) < 3)
        return "Имя слишком короткое";
      else if(strlen($this->email) < 3)
        return "Email слишком короткий";
      else if(strlen($this->pass) < 3)
        return "Пароль не менее 3 символов";
      // проверка на совпадение паролей
      else if($this->pass != $this->re_pass)
        return "Пароли не совпадают";
      else
        return "Верно";
    }

    // функция будет добавлять пользователя в БД
    public function addUser () {
      $sql = 'INSERT INTO users(name, email, pass) VALUES(:name, :email, :pass)';
      $query = $this->_db->prepare($sql);
      // для обеспечения безопасности пароля его необходимо хэшировать
      // существуют функции md5() или sha1(), но они уже не столь эффективны
      // новая функция: (первый параметр который хотим захэшировать, 2 - формат хэширования)
      // эта функция возвращает строку из 60 символов
      $pass = password_hash($this->pass, PASSWORD_DEFAULT);
      // и её передаем в запрос
      $query->execute(['name' => $this->name, 'email' => $this->email, 'pass' => $pass]);

      // устанавливаем куки
      $this->setAuth($this->email);
    }

    // получаем данные пользователя
    public function getUser() {
      $email = $_COOKIE['log'];
      // выбираем все данные того пользователя, email которого установлен в cookie
      $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
      return $result->fetch(PDO::FETCH_ASSOC);
    }

    // функция для выхода из УЗ пользователя
    public function logOut() {
      setcookie('log', $this->email, time() - 3600, '/');
      // удаляем куки
      unset($_COOKIE['log']);
      // переадресовываем на страницу авторизации
      header('Location: /?url=user/auth');
    }

    // функия для авторизации, получаем данные из формы авторизации
    public function auth($email, $pass) {
      $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
      $user = $result->fetch(PDO::FETCH_ASSOC);

      // делаем проверки
      if($user['email'] == '')
        return 'Пользователя с таким email не существует';
      // специальная функция которая сравнивает пароли
      else if(password_verify($pass, $user['pass']))
        $this->setAuth($email);
      else
        return 'Пароли не совпадают';
    }

    // функция для добавления названия изображения в БД соответствующему пользователю по email
    public function addImage() {
      $path = 'public/img/';
      $email = $_COOKIE['log'];
      // делаем название изображения уникальным
      $image = time()."_".($_FILES['image']['name']);

      if(!@copy($_FILES['image']['tmp_name'], $path . $image)) {

      }
      else {
        $sql = "UPDATE users SET image = :image WHERE email = '$email'";
        $query = $this->_db->prepare($sql);
        $query->execute(['image' => $image]);
      }
    }


    public function setAuth($email) {
      // также установку cookie сделаем и переброс на кабинет пользователя
      setcookie('log', $email, time() + 3600, '/'); // в конце указываем где будут работать куки (везде)
      // переадресовываем если устанавливабтся куки на кабинет пользователя
      header('Location: /?url=user/dashboard');
    }
  }
