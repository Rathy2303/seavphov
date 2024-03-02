<?php
session_start();
    // $db=mysqli_connect('localhost','root','','ebook') or die("Database is not connect !");
    //$db = new mysqli('localhost','root','','ebook');
    try {
        $db = new PDO("mysql:host=localhost;dbname=ebook","root","");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>