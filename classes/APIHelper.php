<?php

class APIHelper {

    public static function send($status, $message, $exit = true) {
        echo self::convertData($status, $message);
        if ($exit) exit;
    }

    public static function convertData($status, $message) {
        return json_encode([
            "status" => $status,
            "message" => $message,
        ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }
}
