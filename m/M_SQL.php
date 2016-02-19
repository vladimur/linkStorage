<?php
// Модель для работы с базой данных
class M_MySQL
{
    // Экземпляр класса
    private static $instance;

    // Cоздание экземпляра
    public static function Instance()
    {
        if (self::$instance == null) self::$instance = new M_MySQL();
        return self::$instance;
    }

    // Подключение к базе данных
    private function __construct()
    {
        // Языковая настройка.
        // Устанавливаем нужную локаль (для дат, денег, запятых и пр.)
        setlocale(LC_ALL, 'ru_RU.UTF-8');
        // Устанавливаем кодировку строк
        mb_internal_encoding('UTF-8');

        // Подключение к БД.
        mysql_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD) or die('No connect with data base');
        mysql_query('SET NAMES utf8');
        mysql_select_db(MYSQL_DB) or die('No data base');
    }

    // Выбрать кортеж
    public function Select($query)
    {
        // $query - SQL запрос
        $result = mysql_query($query);
        if (!$result) die(mysql_error());

        // Сложить данные запроса в массив
        $tmp = mysql_num_rows($result);
        $arr = array();
        for ($i = 0; $i < $tmp; $i++) {
            $row = mysql_fetch_assoc($result);
            $arr[] = $row;
        }

        // Вернуть массив выбранных объектов
        return $arr;
    }

    // Вставить кортеж
    public function Insert($table, $object)
    {
        // $table - имя таблицы
        // $object - ассоциативный массив "имя столбца - значение"

        // Куда вставлять
        $columns = array();

        // Что вставлять
        $values = array();

        // Складываем в отдельные массивы ключи и значения
        foreach ($object as $key => $value) {
            $key = mysql_real_escape_string($key."");
            $columns[] = $key;

            if ($value == null) {
                $values[] = 'NULL';
            } else {
                $value = mysql_real_escape_string($value."");
                $values[] = "'$value'";
            }
        }

        // Собираем в строку
        $columns_str = implode(",", $columns);
        $values_str = implode(",", $values);

        // Запрос б/д
        $query = "INSERT INTO $table ($columns_str) VALUES ($values_str)";
        $result = mysql_query($query);
        if (!$result) die(mysql_error());

        // Возвращаем id новой строки
        return mysql_insert_id();
    }

    public function Update($table, $object, $where)
    {
        // $table - имя таблицы
        // $object - ассоциативный массив "имя столбца - значение"
        // $where - куда вставлять

        $set = array();

        // Складываем в массив ключи и их значения
        foreach ($object as $key => $value) {
            $key = mysql_real_escape_string($key."");

            if ($value == null) {
                $set[] = "$value=NULL";
            } else {
                $value = mysql_real_escape_string($value."");
                $set[] = "$key='$value'";
            }
        }

        // Собираем в строку
        $set_str = implode(",", $set);

        // Формируем запрос
        $query = "UPDATE $table SET $set_str WHERE $where";
        $result = mysql_query($query);
        if (!$result) die(mysql_error());

        // Возвращаем число изменённых строк
        return mysql_affected_rows();
    }

    public function Delete($table, $where)
    {
        // $table - имя таблицы
        // $where - откуда удалять

        // Формируем запрос
        $query = "DELETE FROM $table WHERE $where";
        $result = mysql_query($query);
        if (!$result) die(mysql_error());

        // Возвращаем число удалённых строк
        return mysql_affected_rows();
    }
}