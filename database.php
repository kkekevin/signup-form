<?php 
    $conn_string = "host=localhost dbname=phptestdb user=myuser password=123";
    $conn = pg_connect($conn_string) or die('cold not connect to database');

/*      if($conn) {
        echo "connected successfuly";
    }
 */
?>