<?php
    class App {
        // Пропишем, какой контроллер будет вызываться по умолчанию
        // Какая функция по умолчанию в конкретном контроллере
        // А также указать, какие параметры были переданы через URL-адрес
        protected $controller = 'Home'; // т.е. контроллер по умолчанию Home, если не переданы параметры в URL
        protected $method = 'index'; // т.е. функция индекс по умолчанию в этом контроллере
        protected $params = []; // массив из нескольких элементов, которые были переданы в URL-запросе

        public function __construct() {
            // Получение данных из URL-запроса и вывод на экран
          //  print_r($this->parseUrl()); // print_r так как лучше, когда массив
            $url = $this->parseUrl();

            // проверим, существет ли контроллер, который передаем в URL
            // ищем внутри папки контроллер в первый элемент (home) из массива $url (нулевой элемент) (URL-запроса /public/home) с расширением .php
            // ucfirst($url[0]) функция оборачивает слово, ставит первую букву в верхнем регистре
            if(file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
                $this->controller = ucfirst($url[0]); // то есть установили новый контроллер
                // теперь из массива надо удалить первый элемент (название контроллера теперь будет удалено)
                unset($url[0]);
            }

            // Проверка на соответствие контроллеров для ошибки 404, страница не найдена
            // Если контроллер в URL не соответствуют тем, что есть, то выводим 404
            else if($this->controller != 'app/controllers/') {
                $this->controller = 'Error404';
            }

            // Подключаем сам файл контроллера
            require_once 'app/controllers/' . $this->controller . '.php';

            // вызываем нужную функцию из контроллера
            // в качестве названия класса используем переменную $this->controller, где записывается Home
            $this->controller = new $this->controller;

            // теперь проверяем второй параметр (название функции)
            if(isset($url[1])) {
                // и проверим, существует ли какой-либо метод внутри какого-либо определённого класса
                // 1 параметр - название класса; 2 - функция
                if(method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
                // Проверка на наличие методов для ошибки 404, страница не найдена
                // Если метод в URL не соответствуют тем, что есть, то выводим 404
                else if($this->method != 'app/views/') {
                    $this->method = 'error_method';
                }
            }

                // следовательно, те параметры, что мы удаляем unset, то их не будет
                // будут выводиться только доп параметры, которые указываем, с соответствующим индексом
                // если указать только home/text/john ... и тд, то не выведет только home, а text будет как доп параметр
                // так как такого метода нет
                // можем проверить   print_r($url);


            // установим дополнительные параметры
            // изначально проверяем, является ли массив с какими либо данными ($url ?)
            // если не пустой, то функцию array_values($url) обнуляет индексы для конкретного массива (то есть не учитывает уже удалённые)

            // если пустой, то просто устанавливаем :[]
            $this->params = $url ? array_values($url) : [];
            // можем проверить
            // print_r($url);

            // call_user_func_array(); мы можем вызвать функцию внутри какого-либо класса
            // при этом в эту функцию мы можем передать какие-то параметры
            // [указываем класс, потом функцию в классе], и потом параметры, которые передаем
            call_user_func_array([$this->controller, $this->method], $this->params);
          }

        public function parseUrl() {
            // Проверим, установлен ли у нас такой параметр, который мы берем
            // из URL-адреса и который называется 'url', и если установлен
            // то изначально выводим на экран
            if(isset($_GET['url'])) {
                // Убираем лишние пробелы фильтром и удаляем КОНКРЕТНЫЕ символы до и после строки rtrim (какая строка, какой символ убираем)
                // Также разбиваем по слешу с помощью explode (параметр, по которому разбиваем, и строка)
                return explode('/', filter_var(
                    rtrim($_GET['url'], '/'),
                    FILTER_SANITIZE_STRING));
                // создаётся в URL: public/?url=home/index/
            }
        }
    }
