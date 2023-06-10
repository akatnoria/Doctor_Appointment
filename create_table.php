<?php
$CONNECTION=mysqli_connect("localhost","root","","my_db");
if(!$CONNECTION)
{
 if(" Couldn't connect to server"); 
}
echo"Connected Successfullly <br><br>";
 
 //create table under my_db database
  $sql_query = "create table patient(id int Auto_Increment Primary Key,name varchar(20)not null ,age int(3) not null ,email varchar(20) not null ,date varchar(255),dep varchar(20),phone int(10),message varchar(30),apptno varchar(20),time varchar(255))";
  mysqli_query($CONNECTION,$sql_query);
  echo"table created successfully";

  
  mysqli_close($CONNECTION);
 ?>