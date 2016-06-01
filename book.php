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
                              <a class="page-scroll" href="adminlogin.php">Admin Login</a>
                          </li>
                      </ul>';

                      $admin_menu = '<ul class="nav navbar-nav">
                          <!-- Hidden li included to remove active class from about link when scrolled up past about section -->

                      <li class="hidden">
                                                    <a href="#page-top"></a>
                                                </li>
                                                <li>
                                                    <a class="page-scroll" href="browse.php">Browse Tables</a>
                                                </li>
                                                <li>
                                                    <a href="pricing.php">Change Room Price</a>
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
                                                    <a class="page-scroll" href="index.php">Home</a>
                                                </li>
                                                <li>
                                                    <a class="page-scroll" href="search.php">Rooms</a>
                                                </li>
                                                <li>
                                                    <a href="book.php">Bookings</a>
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
                else if($loggedIn==1 && $usertype == "a" ){
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

  function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}


  $link = mysqli_connect("localhost", "twa012", "twa0124y", "westernhotel012");
  if ( !$link ) {
  die("Link failed: " . mysqli_connect_error());}

  if(isset($_POST['submit'])){
    $errors = array();
    $rid=$_POST['rid'];

    $chin=$_POST['chin'];
    $chou=$_POST['chou'];
    $date1= new DateTime ($chin);
          $date2 = new DateTime ($chou);

    $user="";
    $user=$_SESSION['user'];
    $roomcost="";
  //sqlhere: select * from customer where username = $_POST[username] AND password = $_POST[password]
  if($rid==''){
    $errors[]=  'Please select number of beds';
    $code= "2";
  }
  if ($user == ''){
    $errors[]=  ' login issue.';
    $code= "3" ;

  }
  if (!validateDate($chin)){
    $errors[]=  'Please enter a checkin date in the correct format';
    $code= "2";
  }
  if (!validateDate($chou)){
    $errors[]=  'Please enter a check out date in the correct format';
    $code= "2";
  }
  else{
   $sql3 = "SELECT rooms.rid
    FROM rooms
    WHERE rooms.rid = '$rid' AND  rooms.rid IN(
        SELECT rid
      FROM bookings  WHERE checkin >= '$chin' AND checkout <= '$chou') ";
 $results3 = mysqli_query($link, $sql3)
 or die ('Problem with query' . mysqli_error($link));
 if ($row3 = mysqli_fetch_array($results3)){
   $errors[] = 'Sorry that room is already booked those days';
   $code= "4";
 }

  if (count($errors) > 0 ) {
  echo "<p class='message'> There were some errors with your submission: <ul><li>" .implode('</li><li>', $errors). "</li></ul></p>";

  }  else{
    $sql4 = "SELECT DISTINCT price FROM rooms WHERE rid = '$rid'";
    $results4 = mysqli_query($link, $sql4)

    or die ('Problem with query' . mysqli_error($link));
      $resultarr = mysqli_fetch_row($results4);
      $basecost = $resultarr[0];

$roomcost = $basecost;

    $datediff = $date2->diff($date1);
    $rest =  $datediff->format('%a');

  $cost = $rest * $roomcost;

    //Inserting record in table using INSERT query
    $insqDbtb="INSERT INTO bookings (rid, username, checkin, checkout, cost)
    VALUES ('$rid', '$user', '$chin', '$chou', '$cost')";
    mysqli_query($link,$insqDbtb) or die(mysqli_error($link));
   echo "booking successfully created    cost: ";
   echo $cost;
   echo "   Stay is from  ";
   echo $chin;
   echo "  until  ";
   echo $chou;
}
}
}
  ?>
  <div class="container">
  <h1>Book a Rooom <br /></h1>
  <?php

  $sql2 = "SELECT * FROM rooms";
  $results2 = mysqli_query($link, $sql2)
  or die ('Problem with query' . mysqli_error());

 ?>
  <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form" >
    <div class="form-group">
    <label for="rid">Room Number: </label>
    <div class="col-sm-12">
      <select name="rid" id="rid" value="" required>
      <?php while($row2 = mysqli_fetch_array($results2))  { ?>

      <option value = "<?php echo $row2["rid"]?>">
      <?php echo $row2["rid"] ?>
       </option>
        <?php }
      mysqli_close($link); ?>

                                 </select>


  </div>
    </div>


<div class="form-group">
<label for="chin">Check in Date: </label>
<div class="col-sm-12">
<input type="text" class="form-control"  id="chin" name="chin" placeholder="YYYY-MM-DD" required/>
</div>
</div>

<div class="form-group">
<label for="chou">Check Out Date: </label>
<div class="col-sm-12">
<input type="text" class="form-control"  id="chou" name="chou" placeholder="YYYY-MM-DD" required />
</div>
</div>

   <br> <br>
   <br>
        <input class="btn btn-default" type="submit" name="submit" value="Book Room"/>

  </form>

</div>



    </section>






    <!-- Footer -->


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
