<?php
  class ContactModel {
    private $name;
    private $email;
    private $age;
    private $message;

    // на основе этого класса потом в контроллере будем создавать объект
    // и в каждую из этих переменных будем помещать то значение,
    // которое получаем из формы

    // следовательно, через эти переменные будет проверять на ошибки, если есть, то выводить
    // если все данные корректны, то будем отправлять письмо на почту

    // будем вызывать эту функцию когда захотим
    public function setData($name, $email, $age, $message) {
      $this->name = $name;
      $this->email = $email;
      $this->age = $age;
      $this->message = $message;
    }

    // в функции будем проверять на корректность значий в переменных
    public function validForm() {
      if(strlen($this->name) < 3)
        return "Имя слишком короткое";
      else if(strlen($this->email) < 3)
        return "Email слишком короткий";
      // является ли это значение числом (ставим ! - "если это не число")
      // больше нуля и не больше 90 (должно выплняться три условия)
      else if(!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
        return "Вы ввели не возраст";
      else if(strlen($this->message) < 10)
        return "Сообщение слишком короткое";
      else
        return "Верно";
    }

    // функция для отправки сообщения на электронную почту
    public function mail() {
      $to = "jean41@yandex.ru";
      $message = "Имя: " . $this->name . ". Возраст: " . $this->age . ". Сообщение: " . $this->message;

      // чтобы отправить письмо, нужна тема, которая оборачивается в следующий синтаксис
      $subject = "=?utf-8?B?".base64_encode("Сообщение с нашего сайта")."?=";
      // отправляем заголовки
      $headers = "From: $this->email\r\nReply-to: $this->email\r\nContent-type: text/html; charset=utf-8\r\n";
      // обращаемся к встроенной в PHP функции mail, которая позволяет отправить письмо на эл. адрес
      $success = mail($to, $subject, $message, $headers);

      if(!$success)
        return "Сообщение было не отправлено";
      else
        return true;
    }
  }
