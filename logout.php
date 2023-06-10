<?php

session_start();


if(isset($_SESSION['sid'])){
    session_destroy();
    header("location:website.php");



}
else{
    header("location:index.php");
}
?>