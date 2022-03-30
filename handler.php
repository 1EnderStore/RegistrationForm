<?php
/* **************************************************************** *
  *  Назначение: Обработчик форм
* ***************************************************************** */

require('loader.php');
require(DIR_CLASSES . '/UserHelper.php');

/* ******************************** *
  *  Проверка на мамкиного хакера
  * ********************************* */

if (empty($_POST['action'])) {
    APIHelper::send("error", "Не пытайся меня обойти");
}

/* ******************************** *
  *  Форма регистрации
  * ********************************* */

if ($_POST['action'] == 'register') {

    // Проверка имени
    if (empty($_POST['firstname'])) {
        APIHelper::send("error", "Введите имя");
    }

    // Проверка фамилии
    if (empty($_POST['lastname'])) {
        APIHelper::send("error", "Введите фамилию");
    }

    // Проверка Email
    if (empty($_POST['email'])) {
        APIHelper::send("error", "Введите Email");
    }
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['email'])) {
        APIHelper::send("error", "Введите корректный Email");
    }

    // Проверка пароля
    if (empty($_POST['password'])) {
        APIHelper::send("error", "Введите пароль");
    }
    if (empty($_POST['password_repeat'])) {
        APIHelper::send("error", "Повторите пароль");
    }
    if ($_POST['password'] != $_POST['password_repeat']) {
        APIHelper::send("error", "Пароли не совпадают");
    }

    $UserHelper = new UserHelper();

    // Регистрация пользователя
    if ($UserHelper->registerUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
        APIHelper::send("success", "Вы успешно зарегистрировались");
    } else {
        APIHelper::send("error", "Пользователь с таким Email уже зарегистрирован");
    }

    APIHelper::send('error', 'Что-то пошло не так..');
} else {
    APIHelper::send("error", "А ловко ты это придумал, я даже не заметил.");
}
