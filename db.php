<?php
$con= mysqli_connect("localhost","root","","crud_app");
if(!$con){
    die ("Connection faild:" .mysqli_connect_error());   
}
?>