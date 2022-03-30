<?php

class LogHelper {

    /* ******************************** *
      *  Файл с логами
    * ********************************* */

    public static $pathFileLogs = SERVER_DIR_ROOT . '/data/logs.log';


    /* ******************************** *
      *  Формат записи логов
    * ********************************* */

    public static $logFormat = "[{date}] [{status}]: {message}" . PHP_EOL;


    /* ******************************** *
      *  JSON файл с пользователями
    * ********************************* */

    public static function writeLog($status, $message) {
        $row = self::$logFormat;
        $row = str_replace("{date}", date("Y-m-d H:i:s"), $row);
        $row = str_replace("{status}", $status, $row);
        $row = str_replace("{message}", $message, $row);

        try {
            $f_hdl = fopen(self::$pathFileLogs, 'a+');
            fwrite($f_hdl, $row);
            fclose($f_hdl);
            // file_put_contents(self::$pathFileLogs, $row, FILE_APPEND);
        } catch (Exception $e) {
            print_r('Ошибка записи лог файла: ' + $e);
        }
    }


}