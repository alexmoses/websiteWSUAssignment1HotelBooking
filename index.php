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
$userType ="a";
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
                                                    <a class="page-scroll" href="#about">Browse Tables</a>
                                                </li>
                                                <li>
                                                    <a href="creg.php">Change Room Price</a>
                                                </li>
                                                <li>
                                                    <a href="logout.php">Logout</a>
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
                                            if($loggedIn==1 && (isset($_SESSION['userType'])) && $_SESSION['userType'] == 'c' ){
                                              $menu = $customer_menu;
                                            }
                                            elseif($loggedIn==1 && (isset($_SESSION['userType'])) && $_SESSION['userType'] == 'a' ){
                                              $menu = $admin_menu;
                                            }
                                            else{
                                              $menu = $parent_menu;
                                            }

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
                echo $menu;
                 ?>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Western Sydney Hotel</h1>
                        <p class="intro-text">Revolutionising Relaxation.<br>Evolving Comfort</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About Western Sydney Hotel </h2>
                <p> Since our establishment in the late 80's, WSH has strived for excellence in remedial relaxation therapies, and peaceful accomodation that seeks not only to give individuals a place to stay, but a room in which they can reenergize and refresh their entirity. <br> SO bring on a new day, and wake up with WSH, your next stop in relaxation excellence.</p>

            </div>
        </div>
    </section>

    <section id="download" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>BECOMING A WSH MEMBER</h2>
                    <p>You can search our available rooms, create and manage your bookings, and keep connected with WSH over email!</p>
                    <a href="register.php" class="btn btn-default btn-lg">Register Now</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Map Section -->
    <div id="map"></div>


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
