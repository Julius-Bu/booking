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
    <title>Bookings</title>
	<!-- Bootstrap Styles-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../assets/fontawesome/css/all.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="custom-styles.css" rel="stylesheet" />    <style type="text/css">
             #page-wrapper{
                background-image: green url("bus.jpg") !important;
                 background-repeat: round;
                 background-attachment: fixed;
            }
        </style>
</head>
    
    
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="header-admin.php">FINE BOOKINGS</a>
            </div> 
        </nav>
        <!--/. NAV TOP  -->
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
                             
                            <small> 
                            <div>
                               <?php  if (isset($_SESSION['user'])) : ?>
                                <strong><?php echo $_SESSION['user']['username']; ?> <small style="font-family: serif;" class="text-muted">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</small></strong>
                                <a href="../index.php?logout='1'" class="btn btn-danger btn-sm">logout</a>
                                <?php endif ?>
                </div>
                            </small>
                        </h1>
                     
                    </div>
                  </div> 
                
           

               <div class="card mt-2">
                   <div class="card-header py-1">
                       <h5>ALL BUSES AND THEIR ROUTES</h5>
                   </div>
                   <div class="card-body">
                       <table class="table table-borderless shadow">
                           <thead>
                            <th>BUS NAME</th>
                            <th>NUMBER PLATE</th>
                            <th>ROUTE NAME</th>
                            <th>DEPARTURE</th>
                            <th>CHARGE</th>
                            <th>ACTION</th>
                           </thead>
                           <tbody>
                               <?php foreach ($buses_and_routes as $key => $detail): ?>
                               <tr>
                                   <td><?php echo $detail['busName'] ?></td>
                                   <td><?php echo $detail['number'] ?></td>
                                   <td><?php echo $detail['routeName'] ?></td>
                                   <td><?php echo $detail['time'] ?></td>
                                   <td><?php echo number_format($detail['amount']) ?></td>
                                   <td>
                                       <div class="row justify-content-between">
                                           <form action="" method="get">
                                               <input type="hidden" name="action" value="delete">
                                               <input type="hidden" name="bus" value="<?php echo $detail['number'] ?>">
                                               <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete Bus? \n Action cannot be undone!!')"><h5><i class="fas fa-trash"></i></h5></button>
                                           </form>
                                           <a href="update-bus.php?action=update&bus=<?php echo $detail['number'] ?>" class="btn btn-success btn-sm"><h5><i class="fas fa-edit"></i></h5></a>
                                       </div>
                                   </td>
                               </tr>
                               <?php endforeach ?>
                           </tbody>
                       </table>
                   </div>
               </div>
                
                 <!-- /. ROW  -->
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
                         <center>Bus online Booking System. Developed By: Buwembo Julius.
                              
                     </center> 
                         </p>
                     </strong>
                </footer>
				</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
   <script type="text/javascript" src="../assets/js/popper.min.js"></script>
   <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    </body>
</html>
