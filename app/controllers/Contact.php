<?php
  class Contact extends Controller {
    // обращаемся к функции view, она находится в классе Controller
    // эта функция подключает определённый файл
    // из app/views, который указываем в качестве параметра, который передаем в эту функцию

    // функция будет выводить страницу Контакты
    public function index() {
      // необходимо проверить, передаются ли данные при помощи метода данных POST
      // если не передаются, то просто выводим шаблон contact/index

      // массив, который мы будем передавать в шаблон
      $data = [];
      // в POST помещаем ключ любого из поля в форме
      // если это поле передается, значит была нажата кнопка Отправить
      // значит можем уже взять данные из массива POST и их обработать
      // если они корректны, то оптравить письмо
      if(isset($_POST['name'])) {
         // изначально создаем какой-либо объект, на основе модели ContactModel
         // для этого необходимо обратиться к функции в основном контроллере Controller
         // функция model подключает нужный файл модели и создает объект на основе этого файла
         // в качестве параметра просто передаем название того класса, на основе кот. хотим создать объект
         $mail = $this->model('ContactModel');
         // эта функция в ContactModel
         // параметры - все данные из массива POST
         $mail->setData($_POST['name'], $_POST['email'], $_POST['age'], $_POST['message']);

         // создаем переменную и в неё помещаем значение, которое будет выдано из функции validForm
         // эта функция в ContactModel
         $isValid = $mail->validForm();
         if($isValid == "Верно")
          // в ходе выполнения этой функции может быть выведено, что сообщение не отправлено
          // либо возвращено значение true
          // если данные верны, то будем помещать в ключ message
          $data['message'] = $mail->mail();
         else
          $data['message'] = $isValid;
      }
      $this->view("contact/index", $data);
    }

    // функция будет выводить страницу Про компанию
    // также, если передаем дополнительные параметры, то выводить на экран
    public function about($any_parametr = '') {
      if($any_parametr != '') {
        // выводим в views/contact/about/ информацию о допольнительном параметре,
        // помещая в новую переменную вместе с html оформлением
        $onpage = '<div class="container main">'.
        '<h1>Есть дополнительный параметр</h1>
        <b>Данные из URL: </b>'.$any_parametr.'</div>';
        // подгружаем нужный шаблон и передаём в него дополнительные параметры
        $this->view("contact/about", ['key' => $onpage]);
      } else
      // если не передаем параметр, то ключ устанавливаем как пустое значение
      // чтобы не было ошибки об неопределённом ключе
      $this->view("contact/about", ['key' => '']);
    }

    // функция для вывода ошибки неправильного метода в URL
    public function error_method() {
      $this->view('error/404');
    }
  }
