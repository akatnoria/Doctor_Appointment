<?php

session_start();

$date = "";

$CONNECTION=mysqli_connect("localhost","root","","my_db");

if(!$CONNECTION)
{
 die(" Couldn't connect to server"); 
}
 
 if (!mysqli_select_db($CONNECTION,'my_db'))
 {
	 die("Database not selected");
 }


if(!isset($_SESSION['sid'])){

  header("location:website.php");
  exit();
}
else{

$date = date("Y-m-d");
$q = "select * from patient where date = '$date' and dep ='General Health'";
$r = mysqli_query($CONNECTION,$q);
$rows = mysqli_num_rows($r);

}

if(isset($_POST['sub'])){

$date = $_POST['date'];
$dept = $_POST['dept'];
$q = "select * from patient where date = '$date' and dep ='$dept'";
$r = mysqli_query($CONNECTION,$q);
$rows = mysqli_num_rows($r);

}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>table</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        body:before{
            content: '';
            position: fixed;
            width: 100vw;
            height: 100vh;
            background-image: url("images/list.jpeg");
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .contact-table
        {
            position: absolute;
            top: 50%;
            left: 72%;
            transform: translate(-50%,-50%);
            width: 700px;
            height: 500px;
            padding: 80px 40px;
            box-sizing: border-box;
            background: rgba(107, 104, 104, 0.719);
        }

        
    table.steelBlueCols {
  font-family: "Times New Roman", Times, serif;
  background-color: #54b817;
  width: 400px;
  text-align: center;
  border-collapse: collapse;
}
table.steelBlueCols td, table.steelBlueCols th {
  border: 2px solid #1BA428;
  padding: 2px 5px;
}
table.steelBlueCols tbody td {
  font-size: 12px;
  font-weight: bold;
  color: #1B1C18;
}
table.steelBlueCols thead {
  background: #A40000;
  border-bottom: 1px solid #398AA4;
}
table.steelBlueCols thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
  border-left: 1px solid #A40707;
}
table.steelBlueCols thead th:first-child {
  border-left: none;
}

table.steelBlueCols tfoot {
  font-size: 12px;
  font-weight: bold;
  color: #FFFFFF;
  background: #A4A39A;
  background: -moz-linear-gradient(top, #bbbab3 0%, #adaca4 66%, #A4A39A 100%);
  background: -webkit-linear-gradient(top, #bbbab3 0%, #adaca4 66%, #A4A39A 100%);
  background: linear-gradient(to bottom, #bbbab3 0%, #adaca4 66%, #A4A39A 100%);
}
table.steelBlueCols tfoot td {
  font-size: 12px;
} 
  
  </style>
</head>
<body>
  
    <div class="contact-table">
     <h2>Today's Appointment <span style = "float:right"><a href = "logout.php"><input type = "button" value ="Logout"></a> </span></h2> <h2><?="Welcome ".$_SESSION['name']?></h2> 
      <table class="steelBlueCols">
        <thead>
        <tr>
        <th>SR. NO.</th>
        <th>APPOINTMENT NO.</th>
        <th>NAME</th>
        <th>AGE</th>
        <th>EMAIL</th>
        <th>DEPARTMENT</th>
        <th>PHONE NO.</th>
        <th>TIME</th>
        </tr>
        </thead>
        <tbody>
          <?php
          if($rows>0){
            $i = 1;
            while($row = mysqli_fetch_assoc($r)){
              ?>
            <tr>
              <td><?=$i?></td>
              <td><?=$row['apptno']?></td>
              <td><?=$row['name']?></td>
              <td><?=$row['age']?></td>
              <td><?=$row['email']?></td>
              <td><?=$row['dep']?></td>
              <td><?=$row['phone']?></td>
              <td><?=$row['time']?></td>
              
            </tr>

              <?php
              $i++;
            }

          }else{
            echo "<tr><td colspan = '7'>No Appointments Available For This Date</td></tr>";

          }
          
          ?>
      
        </tbody>
        </table><br>
    <form action = "" method = "post">      
    Date<input type="date" value = "<?=$date?>" name = "date"><br><br>
    Department<select name = "dept">
    <option>General Health</option>
    <option>Cardiology</option>
		<option>Ophthalmology</option>
    <option>Dental</option>
    </select><br><br>
    Search Appointment&nbsp;<input type="submit" value="Go" name = "sub">
    </form>
  </div>
    

</body>
</html>