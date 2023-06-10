<?php
$CONNECTION=mysqli_connect("localhost","root","");
if(!$CONNECTION)
{
 if(" Couldn't connect to server"); 
}
echo"Connected Successfullly <br><br>";
 
 //create database
  $sql_query = "CREATE DATABASE my_db";
  mysqli_query($CONNECTION,$sql_query);
  mysqli_close($CONNECTION);
 ?>