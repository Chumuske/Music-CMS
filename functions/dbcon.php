<?php


$con = mysqli_connect('localhost', 'root', '', 'songs_db');

if(mysqli_errno($con)){
    echo "Connection Failed" . mysqli_errno($con);
}


?>