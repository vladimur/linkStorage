<?php
// Модель для работы с пользователями
include_once('m/M_MySQL.php');

class M_Users
{
    private static $instance;	// экземпляр класса
    private $msql;				// драйвер БД
    private $sid;				// идентификатор текущей сессии
    private $uid;				// идентификатор текущего пользователя
    private $onlineMap;			// карта пользователей online

    // Cоздание экземпляра класса
    public static function Instance()
    {
        if (self::$instance == null) self::$instance = new M_Users();
        return self::$instance;
    }

    // Конструктор
    public function __construct()
    {
        $this -> msql = M_SQL::Instance();
        $this -> sid = null;
        $this -> uid = null;
        $this -> onlineMap = null;
    }

    // Очистка сессий
    public function ClearSessions()
    {
        $min = date('Y-m-d H:i:s', time() - 60 * 20);
        $t = "time_last < '%s'";
        $where = sprintf($t, $min);
        $this -> msql -> Delete('sessions', $where);
    }

    // Список всех пользователей
    public function All()
    {
        $query = "SELECT * FROM users ORDER BY id_user DESC";
        return $this -> msql -> Select($query);
    }

    // Авторизация
    public function Login($login, $password, $remember = true)
    {
        $solt = "adsfghfgh";
        // вытаскиваем пользователя из БД
        $user = $this -> GetByLogin($login);
        if ($user == null) return false;

        // Запоминаем id и сверяем пароль
        $id_user = $user['id_user'];
        if ($user['password'] != md5($password.$solt)) return false;

        // Запоминаем имя и пароль
        if ($remember)
        {
            $expire = time() + 3600 * 24 * 100;
            setcookie('login', $login, $expire);
            setcookie('password', md5($password), $expire);
        }

        // Открываем сессию и запоминаем SID
        $this -> sid = $this -> OpenSession($id_user);
        return true;
    }

    // Выход
    public function Logout()
    {
        setcookie('login', '', time() - 1);
        setcookie('password', '', time() - 1);
        unset($_COOKIE['login']);
        unset($_COOKIE['password']);
        unset($_SESSION['sid']);
        $this -> sid = null;
        $this -> uid = null;
    }

    // Получение пользователя
    public function GetUser($id_user = null)
    {
        // Если id не указан берем его из текущей сессии
        if ($id_user == null) $id_user = $this -> GetUID();
        if ($id_user == null) return null;

        // Достаем из б/д по id
        $t = "SELECT * FROM users WHERE id_user = '%d'";
        $query = sprintf($t, $id_user);
        $result = $this -> msql -> Select($query);
        return $result[0];
    }

    // Получает пользователя по логину
    public function GetByLogin($login)
    {
        $t = "SELECT * FROM users WHERE login = '%s'";
        $query = sprintf($t, mysql_real_escape_string($login));
        $result = $this -> msql -> Select($query);
        return $result[0];
    }

    // Проверка наличия привилегии
    public function Can($priv, $id_user = null)
    {

        $query = "SELECT privs.name FROM privs RIGHT JOIN privs2roles ON privs2roles.id_priv = privs.id_priv
                        JOIN users ON ((users.id_role = privs2roles.id_role) AND (users.id_user = '$id_user'))";
        $result = $this -> msql -> Select($query);

        foreach ($result as $dick) {
            $privs[] = $dick['name'];
        }

        return in_array($priv, $privs);
    }

    // Проверка активности пользователя
    public function IsOnline($id_user)
    {
        if ($this -> onlineMap == null) {
            $t = "SELECT DISTINCT id_user FROM sessions";
            $query = sprintf($t, $id_user);
            $result = $this -> msql -> Select($query);

            foreach ($result as $item) {
                $this -> onlineMap['id_user'] = true;
            }
        }

        return ($this -> onlineMap['id_user'] != null);
    }

    public function Registration($login, $pass, $name)
    {
        $solt = "adsfghfgh";
        // Проверили
        $login = trim(htmlspecialchars($login));
        $pass = trim(htmlspecialchars($pass));
        $name = trim(htmlspecialchars($name));

        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = $this -> msql -> Select($query);
        $error = $result[0];

        if ($error != null) {
            return false;
        } else {
            // Сложили в массив
            $user['login'] = $login;
            $user['password'] = md5($pass.$solt);
            $user['id_role'] = 3;
            $user['name'] = $name;

            // Пложиди в б/д
            $this -> msql -> Insert('users', $user);
            return true;
        }
    }

    // Получение id текущего пользователя
    public function GetUID()
    {
        // Проверка кеша
        if ($this -> uid != null) return $this -> uid;

        // Берем по текущей сессии
        $sid = $this -> GetSID();
        if ($sid == null) return null;

        // Запрос
        $t = "SELECT id_user FROM sessions WHERE sid = '%s'";
        $query = sprintf($t, mysql_real_escape_string($sid));
        $result = $this -> msql -> Select($query);

        // Если сессию не нашли - значит пользователь не авторизован
        if (count($result) == 0) return null;

        // Если нашли - запоминм ее
        $this -> uid = $result[0]['id_user'];
        return $this -> uid;
    }

    // Получение идентификатора текущей сессии
    private function GetSID()
    {
        // Кеш
        if ($this -> sid != null) return $this -> sid;

        // Сессия
        $sid = $_SESSION['sid'];

        // Если нашли - обновляем time_last в базе
        if ($sid != null) {
            $session = array();
            $session['time_last'] = date('Y-m-d H:i:s');
            $t = "sid = '%s'";
            $where = sprintf($t, mysql_real_escape_string($sid));
            $affected_rows = $this -> msql -> Update('sessions', $session, $where);

            if ($affected_rows == 0) {
                $t = "SELECT count(*) FROM sessions WHERE sid = '%s'";
                $query = sprintf($t, mysql_real_escape_string($sid));
                $result = $this -> msql -> Select($query);

                if ($result[0]['count(*)'] == 0) $sid = null;
            }
        }

        // Если $_SESSION['sid'] = null достаем из cookies
        if ($sid == null && isset($_COOKIE['login'])) {
            $user = $this -> GetByLogin($_COOKIE['login']);
            if ($user != null && $user['password'] == $_COOKIE['password'])
                $sid = $this -> OpenSession($user['id_user']);
        }

        // Помещаем в кеш
        if ($sid != null) $this -> sid = $sid;
        return $sid;
    }

    // Открытие сессии
    private function OpenSession($id_user)
    {
        // Генерируем SID
        $sid = $this -> GenerateSTR(10);
        // Вставляем в б/д
        $now = date('Y-m-d H:i:s');
        $session = array();
        $session['id_user'] = $id_user;
        $session['sid'] = $sid;
        $session['time_start'] = $now;
        $session['time_last'] = $now;
        $this -> msql -> Insert('sessions', $session);

        // Регистрируем сессию в php сессии
        $_SESSION['sid'] = $sid;
        return $sid;
    }

    private function GenerateSTR($lenght = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $lenght) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
}