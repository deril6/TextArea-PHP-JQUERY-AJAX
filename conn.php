<?php
try {
    $conn = new PDO('mysql:host=127.0.0.1;dbname=db_post','root','admin');
} catch(PDOException $e) {
    die('Error : '.$e);
}
?>
