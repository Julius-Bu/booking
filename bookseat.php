<?php   
include('functions.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
?> 
<!DOCTYPE html> 
<html> 
    <head>
    <link rel="icon" href="image/favicon.png" size="16x16" type="image/x-icon"/>  
        <title>Home</title>  
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<!--        <link rel="stylesheet" type="text/css" href="style.css">-->
       <link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css">
        <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    </head> 
    <body>  
       <nav class="navbar navbar-expand-md navbar-light bg-light">
    <a href="home.php" class="navbar-brand">FINE BOOKINGS</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="home.php" class="nav-item nav-link active">Home</a>
            <a href="#" class="nav-item nav-link">Profile</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Buses</a>
                <div class="dropdown-menu">
                   <?php foreach ($buses as $key => $value): ?>
                    <a href="#" class="dropdown-item"><?php echo $value['name'] ?></a>
                    <?php endforeach ?>
                </div>
            </div>
              <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Routes</a>
                <div class="dropdown-menu">
                   <?php foreach ($routes as $key => $value): ?>
                    <a href="#" class="dropdown-item"><?php echo $value['name'] ?></a>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <form class="form-inline">
            <div class="input-group">                    
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <div class="navbar-nav">
           <a href="javascript:void(0)" class="nav-item nav-link">       <?php  if (isset($_SESSION['user'])) : ?>
       <strong class="text-primary"><i class="fas fa-user"></i> Hi, 
       <?php echo $_SESSION['user']['username']; ?></strong>
 
    <?php endif ?></a>
            <a href="index.php?logout='1'" class="nav-item nav-link">Logout</a>
        </div>
    </div>
</nav>
<main class="container-fluid">
    <div class="row mt-2">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card shadow">
                <div class="card-header py-1">
                <div class="row justify-content-between">
                    <?php foreach ($bus_details as $key => $value): ?>
                <h5 class="font-weight-bold">Bus Name: <?php echo $value['busName']; ?></h5> <?php endforeach ?>
                    <h5 class="font-weight-bold">Available Seats <span class="bagde badge-primary rounded"> <?php echo $no_of_seats; ?></span> </h5>
                </div>
                 </div>
                <div class="card-body">
                <table class="table table-borderless">
                    <thead>
                        <th>Number Plate</th>
                         <th>Route</th>
                          <th>Departure</th>
                           <th>Charge</th>
                    </thead>
                    <tbody>
                       <?php foreach ($bus_details as $key => $value): ?>
                       <tr>
                           <td><h5 class="text-muted"><?php echo $value['number']; ?></h5></td>
                            <td><h5 class="text-muted"><?php echo $value['routeName']; ?></h5></td>
                            <td><h5 class="text-muted"><?php echo $value['time']; ?></h5></td>
                             <td>  <h5 class="text-muted"><?php echo number_format($value['amount']); ?></h5></td>
                       </tr> 
                               <?php endforeach ?>
                    </tbody>
                </table>
                <h3 class="font-weight-bold">Book For a seat in this bus</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <label for="seatNumber">SEAT NUMBER</label>
                                <select name="seatNo" class="custom-select">
                                   <option>select a seat number</option>
                                    <?php foreach ($seats as $key => $seat): ?>
                                    <option><?php echo $seat['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <label for="contact">Phone Number</label>
                                <input type="number" name="contact" class="form-control" max="">
                            </div>
                        </div>
                    </div>
                    <?php foreach ($bus_details as $key => $value): ?>
                    <input type="hidden" name="amount" value="<?php echo $value['amount'] ?>">
                     <input type="hidden" name="bus" value="<?php echo $value['number'] ?>">
                      <input type="hidden" name="route" value="<?php echo $value['routeName'] ?>">
                    <input type="hidden" name="departure" value="<?php echo $value['time'] ?>">
                    <?php endforeach ?>
                    <div class="form-group">
                        <div class="row justify-content-between">
                            <button type="submit" name="book" class="btn btn-success">Book for a seat</button>
                            <button type="reset" class="btn btn-danger">CLEAR</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
       <?php if ($status == 0): ?>
        <div class="alert alert-warning alert-dismissible fade show">
    <strong>NOTE!</strong> <?php echo $notification ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
  <?php endif ?>
  <?php if ($status == 1): ?>
   <div class="alert alert-success alert-dismissible fade show">
    <strong>Success!</strong> <?php echo $notification ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
   <?php endif ?>
    </div>
</main>
 
        <script type="text/javascript" src="assets/js/popper.min.js"></script>
           <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    </body> 
</html>
