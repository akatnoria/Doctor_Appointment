
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Health - Medical Website </title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="doctor appointment">
     <meta name="keywords" content="HTML,CSS,JavaScript">
     <meta name="author" content="AJAY AND HARMAN">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/style.css">

</head>




<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>

     <?php
$CONNECTION=mysqli_connect("localhost","root","","my_db");
$error1=$error2=$error3=$error4=$error5=$error6= "";

if(!$CONNECTION)
{
 die(" Couldn't connect to server"); 
}

 
 if (!mysqli_select_db($CONNECTION,'my_db'))
 {
	 die("Database not selected");
 }

 
if(isset($_POST['submit'])){

     $name =  trim($_POST["name"]);
     $age  = trim($_POST["age"]);
     $email =  trim($_POST["email"]);
     $date = $_POST["date"];
     $SelectDepartment = $_POST["dep"];
     $phone = trim($_POST["phone"]);
     $message = trim($_POST["message"]); 
     $apptno = rand()*5;
     //INSERT A RECORD INTO TABLE
     $presentdate = date('Y-m-d');

     if(empty($name)){
          $error1 = "Name is required";
     }
     else if($age=="0" || empty($age)){

          $error2 = "Invalid Age";
     }
     else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $error3 = "Invalid Email";
     }

     else  if($date<$presentdate){
          $error4 = "Invalid Date";
     }
     else if(empty($phone)||strlen($phone)>12){
          $error5 = "Invalid Phone Number";
     }
     else if(empty($message)){
           $error6 = "Message cannot be empty";    

     }
     else{
          $query = "Select date,time from patient where date = '$date' order by time desc limit 1 ";
          $run1 = mysqli_query($CONNECTION,$query);
          $rows = mysqli_num_rows($run1);

          if($rows=="0"){
              $time = "10:00 am";
               bookappoint($name,$age,$email,$date,$SelectDepartment,$phone,$message,$apptno,$time);
          }
          else{
               $data = mysqli_fetch_assoc($run1);
               $dbtime = $data['time'];
               $timest = strtotime($dbtime)+3600;
               $time = date("H:i",$timest);
               
               
               if($time=="11:00"){
                    $time = "11:00 am";
                    bookappoint($name,$age,$email,$date,$SelectDepartment,$phone,$message,$apptno,$time);
               }
               else if($time =="12:00"){
                    $time = "12:00 Noon";
                    bookappoint($name,$age,$email,$date,$SelectDepartment,$phone,$message,$apptno,$time);
               }
               else if($time == "18:00"){
                    echo "<script>alert('Appointment not available for this date, Try with another date')</script>";
                   
               }
               else{
                    bookappoint($name,$age,$email,$date,$SelectDepartment,$phone,$message,$apptno,$time);
               }
               


          }
         
          
     }




}

function bookappoint($name,$age,$email,$date,$SelectDepartment,$phone,$message,$apptno,$time){
                              
     $query2 = "insert into patient values(NULL,'$name','$age','$email','$date','$SelectDepartment','$phone','$message','$apptno','$time')";
     $r = mysqli_query($GLOBALS['CONNECTION'],$query2);
     if($r){
          $timestmp = strtotime($time);
          ?>
          <script>swal("Status","Your Appointment Is Booked. Your Appointment-Number is <?=$apptno?>. Apointment Date <?=$date?>. Appointment Time <?=date("h:i:a",$timestmp)?>","success");</script>


      <?php         
     }
     else{
          echo mysqli_error($CONNECTION);
     }

}



?>


     <!-- HEADER -->
     <header>
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-5">
                         <p>Welcome to a Professional Health Care</p>
                    </div>
                         
                    <div class="col-md-8 col-sm-7 text-align-right">
              



			  <span class="phone-icon"><i class="fa fa-phone"></i> 1720-0000-3641</span>
                         <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 8:00 AM - 11:00 PM (Mon-Fri)</span>
                         <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="http://www.gmail.com">katnoria.ak@gmail.com</a></span>
                    </div>

               </div>
          </div>
     </header>


     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                        <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ealth Center</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="#top" class="smoothScroll">Home</a></li>
                         <li><a href="#about" class="smoothScroll">About Us</a></li>
                         <li><a href="#team" class="smoothScroll">Doctors</a></li>
                         <li><a href="#news" class="smoothScroll">News</a></li>
                         <li><a href="#contact" class="smoothScroll">Contact</a></li>
                         <li><a href="login.php" class="smoothScroll">Doctor Login</a></li>
                         <li class="appointment-btn"><a href="#appointment">Make an appointment</a></li>
                    </ul>
               </div>

          </div>
     </section>


     <!-- HOME -->
     <section id="home" class="slider" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                         <div class="owl-carousel owl-theme">
                              <div class="item item-first">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3>Let's make your life happier</h3>
                                             <h1>Healthy Living</h1>
                                             <a href="#team" class="section-btn btn btn-default smoothScroll">Meet Our Doctors</a>
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-second">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3>  </h3>
                                             <h1>New Lifestyle</h1>
                                             <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">More About Us</a>
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-third">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3> </h3>
                                             <h1>Your Health Benefits</h1>
                                             <a href="#news" class="section-btn btn btn-default btn-blue smoothScroll">Read Stories</a>
                                        </div>
                                   </div>
                              </div>
                         </div>

               </div>
          </div>
     </section>


     <!-- ABOUT -->
     <section id="about">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to Your <i class="fa fa-h-square"></i>ealth Center</h2>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <p>Dr. AJAY did his MBBS from the Government Medical College in 1980. He joined the Postgraduate Institute of Medical Education and Research, as Junior Resident (MS Ophthalmology) on 1st July, 1982 and rose to become Professor (Ophthalmology) in 2001 and Head of Ophthalmology in 1 April, 2015.
                                     </p>
                               </div>
                              <figure class="profile wow fadeInUp" data-wow-delay="1s">
                                   <img src="images/author-image.jpg" class="img-responsive" alt="">
                                   <figcaption>
                                        <h3>Dr. AJAY</h3>
                                        <p>General Principal</p>
                                   </figcaption>
                              </figure>
                         </div>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- TEAM -->
     <section id="team" data-stellar-background-ratio="1">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.1s">Our Doctors</h2>
                         </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                              <img src="images/team-image1.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Dr. Masur Gulati </h3>
                                        <p>Vice Principal</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 010-020-0120</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="http://www.gmail.com">katnoria.ak@gmail.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="http://www.facebook.com" class="fa fa-facebook-square"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                              <img src="images/team-image2.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Dr. HARMAN</h3>
                                        <p>Dental</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 0172-7777-8966</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="http://www.gmail.com/">singhharman3397@gmail.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="http://www.facebook.com/" class="fa fa-facebook-square"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.6s">
                              <img src="images/team-image3.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Dr. ANKITA</h3>
                                        <p>Cardiology</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 7898-456-456</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="http://www.gmail.com/">katnoria.ak@gmail.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                         <li><a href="https://www.twitter.com/katnoria_ajay04" class="fa fa-twitter"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- NEWS -->
     <section id="news" data-stellar-background-ratio="2.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Latest News</h2>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                              
                                   <img src="images/news-image1.jpg" class="img-responsive" alt="">
                              
                              <div class="news-info">
                                   <span>March 08, 2020</span>
                                   <h3>About Amazing Technology</h3>
                                   <p>.</p>
                                   <div class="author">
                                        <img src="images/author-image.jpg" class="img-responsive" alt="">
                                        <div class="author-info">
                                             <h5></h5>
                                             <p>CEO / Founder</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.6s">
                              
                                   <img src="images/news-image2.jpg" class="img-responsive" alt="">
                              
                              <div class="news-info">
                                   <span>February 20, 2020</span>
                                   <h3>Introducing a new healing process</h3>
                                   <p></p>
                                   <div class="author">
                                        <img src="images/author-image.jpg" class="img-responsive" alt="">
                                        <div class="author-info">
                                             <h5></h5>
                                             <p>General Director</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.8s">
                             
                                   <img src="images/news-image3.jpg" class="img-responsive" alt="">
                              
                              <div class="news-info">
                                   <span>January 27, 2020</span>
                                   <h3>Review Annual Medical Research</h3>
                                   <p></p>
                                   <div class="author">
                                        <img src="images/author-image.jpg" class="img-responsive" alt="">
                                        <div class="author-info">
                                             <h5></h5>
                                             <p>Online Advertising</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <!-- MAKE AN APPOINTMENT -->
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <img src="images/appointment-image.jpg" class="img-responsive" alt="">
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="">

                              <!-- SECTION TITLE -->
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2>Make an appointment</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="Name" name="name"  required placeholder="Full Name">
                                        <span style = "color:red"><?php if(!empty($error1)) echo $error1;?></span>
                                   </div>
								   <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-6 col-sm-6">
                                        <label for="age">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" required placeholder="years">
                                        <span style = "color:red"><?php if(!empty($error2)) echo $error2;?></span>
                                   </div>
								   
	                             									
                                   <div class="col-md-6 col-sm-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required placeholder="Your Email">
                                        <span style = "color:red"><?php if(!empty($error3)) echo $error3;?></span>
                                   </div>
								 
								   

                                   <div class="col-md-6 col-sm-6">
                                        <label for="date">Select Date</label>
                                        <input type="date" name="date" required value="<?=date('Y-m-d')?>" class="form-control">
                                        <span style = "color:red"><?php if(!empty($error4)) echo $error4;?></span>
                                   </div>

                                   <div class="col-md-6 col-sm-6">
                                        <label for="select">Select Department</label>
                                        <select class="form-control" required name="dep"  >
                                             <option>General Health</option>
                                             <option>Cardiology</option>
									<option>Ophthalmology</option>
                                             <option>Dental</option>
                                             
                                        </select>
                                   </div>

                                   <div class="col-md-12 col-sm-12">
                                        <label for="telephone">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required placeholder="Phone">
                                        <span style = "color:red"><?php if(!empty($error5)) echo $error5;?></span>
                                        <label for="Message">Additional Message</label>
                                        <textarea class="form-control" rows="5" id="message" name="message" required placeholder="Message"></textarea>
                                        <span style = "color:red"><?php if(!empty($error6)) echo $error6;?></span>
                                        <button type="submit" class="form-control" id="cf-submit" name="submit">APPOINTMENT</button>
                                   </div>
                              </div>
                        </form>
                    </div>

               </div>
          </div>
     </section>

     <!-- FOOTER -->
     <footer data-stellar-background-ratio="5">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-4">
                         <div class="footer-thumb"> 
                              <h4 class="wow fadeInUp" data-wow-delay="0.4s">Contact Info</h4>
                              <p></p>

                              <div class="contact-info">
                                   <p><i class="fa fa-phone"></i>1720-0000-3641</p>
                                   <p><i class="fa fa-envelope-o"></i> <a href="http://www.gmail.com/">singhharman3397@gmail.com</a></p>
                              </div>
                         </div>
                    </div>



                    <div class="col-md-4 col-sm-4"> 
                         <div class="footer-thumb">
                              <div class="opening-hours">
                                   <h4 class="wow fadeInUp" data-wow-delay="0.4s">Opening Hours</h4>
                                   <p>Monday - Friday <span>08:00 AM - 11:00 PM</span></p>
                                   <p>Saturday <span>09:00 AM - 09:00 PM</span></p>
                                   <p>Sunday <span>Closed</span></p>
                              </div> 

                              <ul class="social-icon">
                                   <li><a href="http://www.facebook.com/" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="http://www.twitter.com/" class="fa fa-twitter"></a></li>
                                   <li><a href="http://www.instagram.com/" class="fa fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12 border-top">
                         <div class="col-md-4 col-sm-6">
                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2020 ajayharman </p>
                              </div>
                         </div>
                           <div class="col-md-2 col-sm-2 text-align-center">
                              <div class="angle-up-btn"> 
                                  <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                              </div>
                         </div>   
                    </div>
                    
               </div>
          </div>
     </footer>

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>