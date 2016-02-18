<?php
    abstract class C_Controller                           // Базовый класс контроллера.
    {
        protected $params;
        protected abstract function render();             // Генерация внешнего шаблона
        protected abstract function before();             // Функция отрабатывающая до основного метода

        public function Request($action, $params)
        {
            $this -> params = $params;
            $this -> before();
            $this -> $action();
            $this -> render();
        }

        protected function IsGet()
        {
            return $_SERVER['REQUEST_METHOD'] == 'GET';
        }

        protected function IsPost()
        {
            return $_SERVER['REQUEST_METHOD'] == 'POST';
        }

        protected function Template($fileName, $vars = array())  // Генерация HTML шаблона в строку.
        {
            foreach ($vars as $k => $v) {                        // Установка переменных для шаблона.
                $$k = $v;
            }

            ob_start();                                          // Генерация HTML в строку.
            include "$fileName";
            return ob_get_clean();	
        }

        public function __call($name, $params)                   // Если вызвали метод, которого нет - завершаем работу
        {
            die('404');
        }

        protected function redirect($url)                        // Переадресация
        {
            if($url[0] == '/') $url = BASE_URL.substr($url, 1);
            header("location: $url");
            exit();
        }
    }
