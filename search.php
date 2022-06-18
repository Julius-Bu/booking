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
        <title>Home page</title>  
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<!--        <link rel="stylesheet" type="text/css" href="style.css">-->
       <link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css">
        <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    </head> 
    <body>  
       <nav class="navbar navbar-expand-md navbar-light bg-light">
    <a href="#" class="navbar-brand">FINE BOOKINGS</a>
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
        <form class="form-inline" action="" method="get">
            <div class="input-group">                    
                <input type="text" class="form-control" placeholder="Search" name="q">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
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
        <?php foreach ($searched_buses as $key => $value): ?>
        <div class="col-md-12 col-lg-4 col-xl-4">
            <div class="card shadow">
                <div class="card-body">
                <h5 class="font-weight-bold">Bus Name: <?php echo $value['busName']; ?></h5>  
                <h5 class="text-muted">Number Plate: <?php echo $value['number']; ?></h5>
                <h5 class="text-muted">Route: <?php echo $value['routeName']; ?></h5>
                <h5 class="text-muted">Departure: <?php echo $value['time']; ?></h5>
                <h5 class="text-muted">Charge: <?php echo number_format($value['amount']); ?></h5>
                    <a href="bookseat.php?bus=<?php echo $value['number']; ?>" class="btn btn-primary btn-sm">Book For a Seat</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</main>
 
        <script type="text/javascript" src="assets/js/popper.min.js"></script>
           <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    </body> 
</html>
