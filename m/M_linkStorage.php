<?php
// Подключаем необходимые модули
include_once('../m/M_SQL.php');

// Модель для работы с ссылками
class M_linkStorage
{
    private static $instance;   // Экземпляр класса
    private $msql;              // Драйвер б/д

    // Конструктор
    public function __construct()
    {
        // Подключение к б/д
        $this -> msql = M_SQL::Instance();
    }

    // Cоздание экземпляра класса M_linkStorage
    public static function Instance()
    {
        // Если есть возвращаем его, если нет создам новый (всегда один)
        if (self::$instance == null) self::$instance = new M_linkStorage();
        return self::$instance;
    }

    // Список всех ссылок
    public function All()
    {
        // Запрос б/д
        $query = "SELECT * FROM links ORDER BY link_id";
        return $this -> msql -> Select($query);
    }

    public function AllMy($login)
    {
        // Запрос б/д
        $login = trim(htmlspecialchars($login));
        $query = "SELECT * FROM links WHERE author='$login'";
        $result = $this -> msql -> Select($query);
        $arr = $result;
        for($i = 0; $i < count($arr) - 1;$i++) {
            if ($arr[$i]['user'] == $login) $qwe[] = $arr[$i];
        }
        return $arr;
    }

    // Выбрать одну ссылку
    public function Get($id_art)
    {
        // Запрос б/д
        $id = (int)$id_art;
        if ($id < 0) return false;
        $t = "SELECT * FROM Articles WHERE id = '%d'";
        $query = sprintf($t, $id);
        $result = $this -> msql -> Select($query);
        return $result[0];
    }

    // Редактировать ссылку
    public function Edit($id_art, $title, $content)
    {
        // Подготовка.
        $title = trim(htmlspecialchars($title));
        $content = trim(htmlspecialchars($content));
        $id = (int)$id_art;
        if ($id < 0) return false;


        // Проверка
        if ($title == '' || $content == '') return false;

        // Складываем в массив
        $art = array();
        $art['title'] = $title;
        $art['content'] = $content;

        // Запрос б/д
        $t = "id = '%d'";
        $where = sprintf($t, $id);
        $this -> msql -> Update('Articles', $art, $where);
        return true;
    }

    // Удалить ссылку
    public function Delete($id_art)
    {
        $id = (int)$id_art;
        if ($id < 0) return false;


        // Запрос б/д
        $t = "id = '%d'";
        $where = sprintf($t, $id);
        $this -> msql -> Delete('Articles', $where);
        return true;
    }

    // Создать ссылку
    public function Add($title, $content, $user)
    {
        // Подготовка.
        $title = trim(htmlspecialchars($title));
        $content = trim(htmlspecialchars($content));

        // Проверка
        if ($title == '' || $content =='') return false;

        // Складываем в массив
        $art = array();
        $art['title'] = $title;
        $art['content'] = $content;
        $art['user'] = $_COOKIE['greeting'];
        date_default_timezone_set('Asia/Novosibirsk');
        $art['data'] = date("Y-m-d H:i:s");
        $art['user'] = $user;

        // Запрос б/д
        $this -> msql -> Insert('Articles', $art);
        return true;
    }

}