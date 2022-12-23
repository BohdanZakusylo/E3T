
    <?php
        $host = "mysql";
        $dbname = "project";
        $username = "root";
        $password = "qwerty";

        try {
            
        $dbhandler = new PDO("mysql:host=$host; dbname=$dbname;charset=utf8", $username, $password);
        
    } catch (PDOException $e) {
            echo "Connection Failed". $e->getMessage();
        }


        

?>