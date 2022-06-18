<?php  
include('../functions.php'); 
 
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
} 
 
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
 
<link rel="icon" href="../image/favicon.png" size="16x16" type="image/x-icon"/>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookings Admin</title>
	
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
     
    <link href="../assets/fontawesome/css/all.css" rel="stylesheet" />
        
    <link href="custom-styles.css" rel="stylesheet" />
   
</head>
    
    
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar sticky-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="header-admin.php">FINE BOOKINGS</a>
            </div> 
        </nav>
        
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu" style="display: block; padding: 10px; z-index: 1;">

                    <li>
                        <a href="header-admin.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="buses_view.php"><i class="fa fa-truck"></i>Buses</a>
                    </li>
                    <li>
                        <a href="report_view.php"><i class="fa fa-chart-line"></i> Report</a>
                    </li>    

                        </ul>
                  
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Welcome 
                            
                            <small> 
                            <div>
       <?php  if (isset($_SESSION['user'])) : ?>
       <strong><?php echo $_SESSION['user']['username']; ?>(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</strong>

         <a href="../index.php?logout='1'" class="btn btn-danger btn-sm">logout</a>&nbsp; <a href="create_user.php"> + add user</a>
 
    <?php endif ?>
                </div>
                            </small>
                        </h1>
                     
                    </div>
                  </div> 
                
                <!--user widgets-->
 <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-users fa-5x"></i>
<!--                                <h3>number of customers to go here</h3>-->
                            </div>
                            <div class="panel-footer back-footer-red">
                                <a href="create_user.php" style="text-decoration: none;color: white"><strong><i class="fas fa-plus"></i> Customers</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="fas fa-dollar-sign fa-5x"></i>
<!--                                <h3>number of bookings to go here</h3>-->
                            </div>
                            <div class="panel-footer back-footer-brown">
                                <a href="bookings_view.php" style="text-decoration: none;color: white"><strong>Bookings</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boader bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa fa-calendar fa-5x"></i>
                                <h3><?php $today=date('D/M/d/Y'); echo $today; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                <strong>Date</strong>

                            </div>
                        </div>
                    </div>
                </div>
                
<!--admin widgets row-->
 <div class="row mt-3">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-truck fa-5x"></i>
                                <h3></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                <a href="buses_view.php" style="text-decoration: none;color: white"><strong>Buses</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-sitemap fa-5x"></i>
                                <h3> </h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                <a href="seats_view.php" style="text-decoration: none;color: white"><strong>Seats</strong></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="fa fa-road fa-5x"></i>
                                <h3> </h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
                               <a href="routes_view.php" style="text-decoration: none;color: white"> <strong>Routes</strong></a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="cl-md-12 col-lg-12 col-xl-12">
                        <div class="card mt-2">
                            <div class="card-header py-1">
                                <h5><i class="fas fa-plus"></i> ADD BUSES</h5>
                            </div>
                            <div class="card-body">
                                <form class="form-inline" action="" method="post">
                                    <label for="numberPlate" class="sr-only">Number Plate</label>
                                    <input type="text" name="numberPlate" class="form-control" autocomplete="off" placeholder="enter the bus's number plate" required> &nbsp;&nbsp;&nbsp;
                                    <label for="busName" class="sr-only">Bus Name</label>
                                    <input type="text" class="form-control" name="busName" autocomplete="off" placeholder="enter the bus's name" required>&nbsp;&nbsp;&nbsp;
                                    <button name="addBus" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>ADD BUS</button>
                                    
                                </form>
                            </div>
                        </div>
<!--                        routes-->
                            <div class="card mt-2">
                            <div class="card-header py-1">
                                <h5><i class="fas fa-plus"></i> ADD ROUTES</h5>
                            </div>
                            <div class="card-body">
                                <form class="" action="" method="post">
                                   <div class="form-group">
                                       <div class="row">
                                           <div class="col-md-12 col-lg-6 col-xl-6">
                                    <label for="routeName">Route Name</label>
                                    <input type="text" name="routeName" class="form-control" autocomplete="off" required>
                                           </div>
                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                    <label for="departure">Departure Date and Time</label>
                                    <input type="text" class="form-control" name="departure" autocomplete="off" required>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <div class="row">
                                           <div class="col-md-12 col-lg-6 col-xl-6">
                                              <label for="amount">Charge</label>
                                              <input type="text" name="amount" class="form-control" autocomplete="off" maxlength="5" required> 
                                           </div>
                                              <div class="col-md-12 col-lg-6 col-xl-6">
                                               <label for="numberPlate">Bus</label>
                                               <input type="text" name="numberPlate" class="form-control" list="buses" autocomplete="off" required>
                                           </div>
                                       </div>
                                   </div>
                                    <button name="addRoutes" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>ADD ROUTE</button>
                                    
                                </form>
                            </div>
                        </div>
                            <div class="card mt-2">
                            <div class="card-header py-1">
                                <h5><i class="fas fa-plus"></i> ADD SEATS</h5>
                            </div>
                            <div class="card-body">
                                <form class="form-inline" action="" method="post">
                                    <label for="seatNumber" class="sr-only">Seat Number</label>
                                    <input type="text" name="seatNumber" class="form-control" autocomplete="off" placeholder="enter the seat number" required> &nbsp;&nbsp;&nbsp;
                                    <label for="numberPlate" class="sr-only">Number Plate</label>
                                    <input type="text" class="form-control" name="numberPlate" list="buses" autocomplete="off" placeholder="enter the bus's number plate" required>&nbsp;&nbsp;&nbsp;
                                    <button name="addSeats" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>ADD SEATS</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="fixed-bottom">
                    <?php if ($busStatus == 0): ?>
                        <div class="alert alert-warning alert-dismissible fade show"><strong>NOTE!</strong> <?php echo $busNotification ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                        <?php endif ?>
                        <?php if ($busStatus == 1): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                    <strong>Success!</strong> <?php echo $busNotification?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
   <?php endif ?>
    </div>
				 <footer>
                     <strong>
                     <p>
                         <center>Bus online Booking System. Developed By: Buwembo Julius
                              
                     </center> 
                         </p>
                     </strong>
                </footer>
				</div>
            </div>
        </div>
        <datalist id="buses">
            <?php foreach ($buses as $key => $bus): ?>
            <option><?php echo $bus['number'] ?></option>
            <?php endforeach ?>
        </datalist>
   <script type="text/javascript" src="../assets/js/popper.min.js"></script>
   <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>
</html>
