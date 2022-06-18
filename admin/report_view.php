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
<link rel="icon" href="image/favicon.png" size="16x16" type="image/x-icon"/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookings Admin</title>
	<!-- Bootstrap Styles-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../assets/fontawesome/css/all.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="custom-styles.css" rel="stylesheet" />
</head>
    
    
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
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
                                <strong><?php echo $_SESSION['user']['username']; ?> <small style="font-family: serif;" class="text-muted">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</small></strong>
         <a href="../index.php?logout='1'" class="btn btn-danger btn-sm">logout</a>
    <?php endif ?>
               
                </div>
                            </small>
                        </h1>
                     <div class="card mt-2">
                   <div class="card-header py-1">
                       <h5>Report</h5>
                   </div>
                   <div class="card-body">
                       <table class="table table-borderless shadow">
                           <thead>
                            <th>BUS (No. Plate)</th>
                            <th>SEAT NUMBER</th>
                            <th>CUSTOMER</th>
                            <th>PHONE NUMBER</th>
                            <th>CHARGE</th>
                            <th>DEPARTURE</th>
                            <th>BOOKED <ON></ON></th>
                           </thead>
                           <tbody>
                               <?php foreach ($report as $key => $detail): ?>
                               <tr>
                                   <td><?php echo $detail['bus'] ?></td>
                                   <td><?php echo $detail['seat'] ?></td>
                                   <td><?php echo $detail['booked_by'] ?></td>
                                   <td><?php echo $detail['phone'] ?></td>
                                   <td><?php echo number_format($detail['amount']) ?></td>
                                   <td><?php echo $detail['departure'] ?></td>
                                   <td><?php echo $detail['date_booked'] ?></td>
                               </tr>
                               <?php endforeach ?>
                           </tbody>
                       </table>
                       <button onclick="window.print()">PRINT THE REPORT</button>
                   </div>
               </div>
                    </div>
                  </div> 
                
                <!--user widgets-->

                  
                  
                    </div>
                </div>
                
<!--admin widgets row-->
 
                <!--row ends here-->

               
                
                 <!-- /. ROW  -->
                
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
