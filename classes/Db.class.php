<!-- hier komt de connectie naar de databank -->
<?php
abstract class Db
{
    private static $conn;



    public static function getInstance()
    {
        include_once(__DIR__ . "/../settings/settings.php");

        if (self::$conn == null) {
            self::$conn = new PDO('mysql:host=' . SETTINGS2['db']['host'] . ';dbname=' . SETTINGS2['db']['db'], SETTINGS2['db']['user'], SETTINGS2['db']['password']);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }
}
