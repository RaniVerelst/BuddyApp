<!-- hier komt de connectie naar de databank -->
<?php
    abstract class Db {
        private static $conn;

        private static function getConfig(){
            // get the config file
            return parse_ini_file("config.ini");
        }
        

        public static function getInstance() {
            if(self::$conn != null) {
                // REUSE our connection
                // echo "🚀";
                return self::$conn;
            }
            else {
                // CREATE a new connection

                // get the configuration for our connection from one central settings file
                $config = self::getConfig();
                $database = $config['database'];
                $user = $config['user'];
                $password = $config['password'];

                // echo "💥";
                self::$conn = new PDO("mysql:host=localhost;dbname=php2020;", "root", "", null);
                return self::$conn;
            }
        }
    }