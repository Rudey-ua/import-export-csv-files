<?php
/**
 * Класс конфигурации базы данных
 */
class DB
{
    const USER  = "root";
    const PASS  = "";
    const HOST  = "127.0.0.1";
    const DB    = "cvs";

    public static function connToDB() {
        $user   = self::USER;
        $pass   = self::PASS;
        $host   = self::HOST;
        $db     = self::DB;
        $conn   = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
        $conn->exec("SET NAMES 'utf8'");
        return $conn;
    }

}
