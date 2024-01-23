<?php
function getAdminInfo($db,$email){
        $query="SELECT * FROM admin WHERE email='$email'";
        $run=mysqli_query($db,$query);
        $data= mysqli_fetch_assoc($run);
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