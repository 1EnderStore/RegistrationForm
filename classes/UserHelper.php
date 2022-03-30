<?php

require(DIR_CLASSES . '/LogHelper.php');

class UserHelper {

    /* ******************************** *
      *  JSON файл с пользователями
    * ********************************* */

    public static $pathFileUsers = SERVER_DIR_ROOT . '/data/users.json';


    /* ******************************** *
      *  Массив пользователей
    * ********************************* */

    public static $users = [];


    /* ******************************** *
      *  Инициализация класса
    * ********************************* */

    function __construct() {
        self::getUsers();
    }


    /* ******************************** *
      *  Получение массива пользователей
      *  из json файла.
    * ********************************* */

    public function getUsers() {
        try {
            self::$users = json_decode(file_get_contents(self::$pathFileUsers), true);
        } catch (Exception $e) {
            print_r('Ошибка получения массива пользователей: ' + $e);
        }
    }


    /* ******************************** *
      *  Проверяем существует ли пользователь.
      *  Если да, то возврашаем true.
      *  В иных случаях false.
    * ********************************* */

    public function checkUser($email) {
        foreach (self::$users as $id => $data) {
            if ($data['email'] == $email) {
                return true;
            }
        }
        return false;
    }


    /* ******************************** *
      *  Регистрация пользователя
    * ********************************* */

    public function registerUser($firstname, $lastname, $email, $password /* Передаем пароль для возможной дальнейшей обработки */) {
        if (self::checkUser($email)) {
            LogHelper::writeLog("WARNING", "Пользователь с Email \"{$email}\" уже существует");
            return false;
        }

        self::$users[] = [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email
        ];
        self::saveChanges();

        LogHelper::writeLog("INFO", "Пользователь с Email \"{$email}\" успешно зарегистрирован");
        return true;
    }


    /* ******************************** *
      *  Сохраняем изменения в файл
    * ********************************* */

    public function saveChanges() {
        try {
            file_put_contents(self::$pathFileUsers, json_encode(self::$users, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        } catch (Exception $e) {
            print_r('Ошибка записи массива пользователей: ' + $e);
        }
    }
}