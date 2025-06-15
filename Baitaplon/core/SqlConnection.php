<?php
class SqlConnection
{

    private static $conn = null;

    public function __construct()
    {
        try {
            $dsn = 'mysql:dbname=' . _DB . ';host=' . _HOST;
            $option = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            self::$conn = new PDO($dsn, _USER, _PASS, $option);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
    public static function getConnection()
    {
        if (self::$conn == null) {
            new SqlConnection();
        }
        //var_dump(self::$conn);
        return self::$conn;
    }
}
