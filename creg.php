<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WSH</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php
session_start();
$loggedIn = 0;
$userType ="";
if (!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1)) {
$loggedIn = 1;

}
if ($loggedIn = 1) {
$usertype = (isset($_SESSION['userType']));
}

 ?>
</head>
<?php


$parent_menu = '<ul class="nav navbar-nav">
    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->

<li class="hidden">
                              <a href="#page-top"></a>
                          </li>
                          <li>
                              <a class="page-scroll" href="#about">About</a>
                          </li>
                          <li>
                              <a href="register.php">Customer Registration</a>
                          </li>
                          <li>
                              <a class="page-scroll" href="customerlogin.php">Customer Login</a>
                          </li>
                <li>
                              <a class="page-scroll" href="#">Admin Login</a>
                          </li>
                      </ul>';

                      $admin_menu = '<ul class="nav navbar-nav">
                          <!-- Hidden li included to remove active class from about link when scrolled up past about section -->

                      <li class="hidden">
                                                    <a href="#page-top"></a>
                                                </li>
                                                <li>
                                                    <a class="page-scroll" href="#about">Browse Tables</a>
                                                </li>
                                                <li>
                                                    <a href="creg.php">Change Room Price</a>
                                                </li>
                                                <li>
                                                    <a class="logout.php" href="#">Logout</a>
                                                </li>

                                            </ul>';

                      $customer_menu = '<ul class="nav navbar-nav">
                          <!-- Hidden li included to remove active class from about link when scrolled up past about section -->

                      <li class="hidden">
                                                    <a href="#page-top"></a>
                                                </li>
                                                <li>
                                                    <a class="page-scroll" href="#about">Rooms</a>
                                                </li>
                                                <li>
                                                    <a href="creg.php">Bookings</a>
                                                </li>
                                                <li>
                                                    <a class="page-scroll" href="logout.php">Logout</a>
                                                </li>

                                            </ul>';
 ?>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">Western Sydney</span> Hotel
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <?php
                if($loggedIn==1 && $usertype == "c" ){
                	echo $customer_menu;
                }
                if($loggedIn==1 && $usertype == "a" ){
                  echo $admin_menu;
                }
                else{
                	echo $parent_menu;
                }
                 ?>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- About Section -->
    <section id="regform" class="container content-section text-center">

<div id="section">
  <?php
  $link = mysqli_connect("localhost", "twa012", "twa0124y", "westernhotel012");
  if ( !$link ) {
  die("Link failed: " . mysqli_connect_error());}
  mysqli_select_db($link,"customers");
  if(isset($_REQUEST['submit']))
  {
  $errors = array();
  $errorMsg = "";
  $username=$_POST['username'];
  $pwd=$_POST['password'];
  $pwdc=$_POST['password2'];
  $firstname=$_POST['customerfname'];
  $lastname=$_POST['customerlname'];
  $address=$_POST['customeraddress'];
  $email=$_POST['email'];
  $state=$_POST['state'];
  $postcode=$_POST['postcode'];
  $mobile=$_POST['phone'];

  //check if the number field is numeric


  if($username==''){
    $errors[]=  'Please enter a username.';
    $code= "2";
  }
  elseif(strlen($username)>20){
    $errors[]=  ' Username should be less than 20 characters.';
    $code= "2";
  }
   else{
    $sql = "SELECT username FROM customers WHERE username = '$username'";
  $results = mysqli_query($link, $sql)
  or die ('Problem with query' . mysqli_error($link));
  if ($row = mysqli_fetch_array($results)){
    $errors[] = 'Sorry that Customer ID is already in use';
    $code= "4";
  }
  }

  if($pwd==''){
    $errors[]=  'Please enter a password.';
    $code= "2";
  }
  elseif(strlen($pwd)>20){
    $errors[]=  ' password should be less than 20 characters.';
    $code= "2";
  }
  elseif(strlen($pwd)<6){
    $errors[]=  ' password should be more than 6 characters.';
    $code= "2";

  }

elseif ($pwd =! $pwdc) {
  $errors[]=  'Passsword did not match';
  $code= "67" ;
}

  if($firstname =="") {
    $errors[]=  'You did not enter a first name.';
    $code= "1" ;
  }
  elseif(strlen($firstname)>20){
    $errors[]=  ' first name should be less than 20 characters.';
    $code= "2";
  }


   if($lastname =="") {
    $errors[]=  ' You did not enter a last name.';
    $code= "3" ;
  }
  elseif(strlen($lastname)>20){
    $errors[]=  ' last name should be less than 20 characters.';
    $code= "2";
  }
  if(strlen($address)>40){
    $errors[]=  ' address msut be less than 40 characters.';
    $code= "2";
  }
  if(strlen($postcode)>4){
    $errors[]=  ' Please enter a valid postcode';
    $code= "2";
  }
  elseif(strlen($postcode)<4){
    $errors[]=  ' Please enter a valid postcode';
    $code= "2";
  }
  if(strlen($email)>40){
    $errors[]=  ' email must be less than 40 characters';
    $code= "2";
  }


  if (count($errors) > 0 ) {
  echo "<p class='message'> There were some errors with your submission: <ul><li>" .implode('</li><li>', $errors). "</li></ul></p>";

  }  else{
 echo $pwd;
  //Inserting record in table using INSERT query
  $insqDbtb="INSERT INTO customers (username, password, gname, sname, address, state, postcode, mobile, email)
  VALUES ('$username', '$pwdc', '$firstname', '$lastname', '$address', '$state', '$postcode', '$mobile', '$email')";
  mysqli_query($link,$insqDbtb) or die(mysqli_error($link));
 echo "successfully registered";
  }
  }

  ?>
  <div class="container">
  <h1>Customer Registration<br /></h1>
  <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form" >
    <div class="form-group">
    <label for="username">Username: </label>
    <div class="col-sm-12">
    <input type="text" class="form-control"  id="username" name="username" />
  </div>
    </div>

    <div class="form-group">
    <label for="pwd">Password </label>
    <div class="col-sm-12">
    <input type="password" class="form-control"    id="password" name="password" />
  </div>
    </div>
    <div class="form-group">
    <label for="pwdc">Repeat Password: </label>
    <div class="col-sm-12">
    <input type="password" class="form-control"  id="password2" name="password2" />
  </div>
    </div>
    <div class="form-group">
    <label for="customerfname">Customer First Name: </label>
        <div class="col-sm-12">
    <input type="text" class="form-control"  id="customerfname" name="customerfname"/>
  </div>
    </div>
    <div class="form-group">
    <label for="customerlname">Customer Last Name: </label>
    <div class="col-sm-12">
    <input type="text" class="form-control" id="customerlname" name="customerlname" />
  </div>
    </div>
    <div class="form-group">
   <label for="customeraddress">Customer Address: </label>
   <div class="col-sm-12">
    <input type="text" class="form-control" id="customeraddress" name="customeraddress" />
  </div>
    </div>
<br>
    <label for="state">	State: </label>
      <select name="state" id="state">
        <option value="--">--</option>
          <option value="ACT">ACT</option>
          <option value="NSW">NSW</option>
          <option value="NT">NT</option>
          <option value="QLD">QLD</option>
          <option value="SA">SA</option>
          <option value="TAS">TAS</option>
          <option value="VIC">VIC</option>
           <option value="WA">WA</option>
      </select><br><br>
<div class="form-group">
    <label for="postcode"> Postcode : </label>
    <div class="col-sm-12">
    <input type="text" class="form-control" name="postcode" id="postcode" />
  </div>
  </div>
  <div class="form-group">
     <label class="control-label col-sm-2" for="email">Email:</label>
     <div class="col-sm-10">
       <input type="email" class="form-control" id="email" name="email" placeholder="Must be actual email.">
     </div>
   </div>
   <div class="form-group">
     <label class="control-label col-sm-2" for="email">Mobile:</label>
     <div class="col-sm-10">
       <input type="tel" class="form-control" id="phone" name="phone" placeholder="">
     </div>
   </div>
   <br>
        <input class="btn btn-default" type="submit" name="submit" value="Submit"/>
     <input class="btn btn-default" type="reset" value="Clear" />
  </form>
              </div>

    </section>






    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; 2016 <br> Alexander Moses 17453947</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
