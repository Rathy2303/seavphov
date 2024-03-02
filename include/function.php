<?php

function getAdminInfo($db,$email){

        $query= $db->prepare("SELECT * FROM admin WHERE email='$email'");
        $query->execute();
        $data= $query->fetchAll(PDO::FETCH_CLASS);

        return $data;

    }



    function getAllCategory($db){

        $query="SELECT * FROM category";

        $run=mysqli_query($db,$query);

        $data = array();

        while($d=mysqli_fetch_assoc($run)){

            $data[]=$d;

        }

        return $data;

    };

?>