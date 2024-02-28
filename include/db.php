<?php
    // $db=new mysqli('localhost','root','','ebook');
    try {
        $db = new PDO("mysql:host=localhost;dbname=ebook","root","");
        
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>