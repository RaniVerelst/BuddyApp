<!-- hier komt de connectie naar de databank -->
<?php
abstract class Db
{
    private static $conn;



    public static function getInstance()
    {
        include_once(__DIR__ . "/../includes/settings.php");

        if (self::$conn == null) {
            self::$conn = new PDO('mysql:host=' . SETTINGS['db']['host'] . ';dbname=' . SETTINGS['db']['db'], SETTINGS['db']['user'], SETTINGS['db']['password']);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }
}
