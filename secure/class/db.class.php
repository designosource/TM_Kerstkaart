<?php 

abstract class Db
{
    private static $conn = null;

    public static function getInstance()
    {
        try {
            if (isset(self::$conn)) {
                // Connection found! return it
                return self::$conn;
            } else {
                // No connection found. Create the connection! return it

                /*private $m_sHost = "localhost";
                private $m_sUser = "tmecards";
                private $m_sPassword = "bFQ7fnQzCz8VdK2K";
                private $m_sDatabase = "tmecards";*/

                $m_sHost = "localhost";
                $m_sUser = "root";
                $m_sPassword = "root";
                $m_sDatabase = "tmecards";

                /* local
                private $m_sHost = "localhost";
                private $m_sUser = "root";
                private $m_sPassword = "";
                private $m_sDatabase = "tmecards";
                */

                /* online
                private $m_sHost = "localhost";
                private $m_sUser = " tmecards";
                private $m_sPassword = "bFQ7fnQzCz8VdK2K";
                private $m_sDatabase = " tmecards";
                */


                //self::$conn = new PDO("mysql:host=" . $m_sHost . "; dbname=" . $m_sDatabase, $m_sUser, $m_sPassword);
                self::$conn = new PDO("mysql:host=localhost; dbname=tmecards", "root", "root");
                return self::$conn;
            }
        } catch (PDOException $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}
 ?>