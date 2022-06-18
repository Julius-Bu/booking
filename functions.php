<?php  
session_start();

// connect to database 
$db = mysqli_connect('localhost', 'root', '', 'busbooking');

// variable declaration 
$username = ""; 
$email    = ""; 
$errors   = array();
$notification = "";
$status = 2;

// call the register() function if register_btn is click 
if (isset($_POST['register_btn'])) {  
    register(); 
}
//username form session
$session_key = "";
if (isset($_SESSION['user'])) {
    $session_key = $_SESSION['user']['username'];
}
// REGISTER USER 
function register(){ 
    // call these variables with the global keyword to make them available in function
    global $db, $errors, $username, $email; 
 
 // receive all input values from the form. Call the e() function   
    // defined below to escape form values 
    $username    =  e($_POST['username']);  
    $email       =  e($_POST['email']);  
    $password_1  =  e($_POST['password_1']);  
    $password_2  =  e($_POST['password_2']); 
 
 // form validation: ensure that the form is correctly filled 
    if (empty($username)) {    
        array_push($errors, "Username is required");   
    }  
    if (empty($email)) {
        array_push($errors, "Email is required");
    }  
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
 } 
 
 // register user if there are no errors in the form 
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
 
  if (isset($_POST['user_type'])) {
      $user_type = e($_POST['user_type']);
      $query = "INSERT INTO users (username, email, user_type, password)       VALUES('$username', '$email', '$user_type', '$password')";
      mysqli_query($db, $query);    
      $_SESSION['success']  = "New user successfully created!!";
      header('location: header-admin.php');
  }else{
      $query = "INSERT INTO users (username, email, user_type, password)       VALUES('$username', '$email', 'user', '$password')"; 
      mysqli_query($db, $query); 
 
   // get id of the created user   
      $logged_in_user_id = mysqli_insert_id($db); 
 
   $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
      $_SESSION['success']  = "You are now logged in";
      header('location: home.php');  
  } 
    } 
}
// return user array from their id 
function getUserById($id){  
    global $db;  
    $query = "SELECT * FROM users WHERE id=" . $id;  
    $result = mysqli_query($db, $query); 
 
 $user = mysqli_fetch_assoc($result);
    return $user;
}

// escape string 
function e($val){ 
 global $db;
    return mysqli_real_escape_string($db, trim($val));
} 
 
function display_error() { 
    global $errors; 
 
 if (count($errors) > 0){ 
     echo '<div class="error">';
     foreach ($errors as $error){
         echo $error .'<br>';
     }  
     echo '</div>';
 } 
}
function isLoggedIn()
{  
    if (isset($_SESSION['user'])) {
        return true;
    }else{
        return false;
    }
}
// log user out if logout button clicked 
if (isset($_GET['logout'])) {  
    session_destroy();  
    unset($_SESSION['user']);  
    header("location: index.php"); 
    exit;
}

// call the login() function if register_btn is clicked 
if (isset($_POST['login_btn'])) {
    login();
}

// LOGIN USER
function login(){
    global $db, $username, $errors; 
 
 // grap form values 
    $username = e($_POST['username']);  
    $password = e($_POST['password']); 
 
 // make sure form is filled properly 
    if (empty(trim($username))) {
        array_push($errors, "Username is required");
    }
    if (empty(trim($password))) {
        array_push($errors, "Password is required");
    } 
 
 // attempt login if no errors on form
    if (count($errors) == 0) {
        $password = md5($password); 
 
  $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($db, $query); 
 
  if (mysqli_num_rows($results) == 1) { // user found
      // check if user is admin or user
      $logged_in_user = mysqli_fetch_assoc($results);
      if ($logged_in_user['user_type'] == 'admin') {
 
    $_SESSION['user'] = $logged_in_user;     
          $_SESSION['success']  = "You are now logged in";
          header('location: admin/header-admin.php');
      }else{
          $_SESSION['user'] = $logged_in_user;
          $_SESSION['success']  = "You are now logged in";
    header('location: home.php');
      }
  }else {
      array_push($errors, "Wrong username/password combination");
  }
    }
}

// ... 
function isAdmin() 
{
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin'){
        return true;
    }else{
        return false;
    }
}
function get_routes() {
    global $db;
    $routes = array();
    $sql = "SELECT * FROM routes";
    $result = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $routes[] = $row;
    }
    return $routes;
}
$routes = get_routes();
function get_buses() {
    global $db;
    $buses = array();
    $sql = "SELECT * FROM buses";
    $result = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $buses[] = $row;
    }
    return $buses;
}
$buses = get_buses();
function get_buses_and_routes() {
    global $db;
    $data = array();
    $sql = "SELECT buses.name as busName, number, routes.name as routeName, time, amount FROM buses
     INNER JOIN routes ON buses.number = routes.bus";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
$buses_and_routes = get_buses_and_routes();
function get_seats($id) {
    global $db;
    $data = array();
    $busID = strip_tags($id);
    $sql = "SELECT name FROM seats WHERE bus ='$busID' AND status = 0";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
function get_number_of_seats($id) {
    global $db;
    $busID = strip_tags($id);
    $sql = "SELECT COUNT(name) FROM seats WHERE bus = '$busID' AND status = 0";
    $result = mysqli_query($db, $sql);
    $no = mysqli_fetch_assoc($result);
    return $no['COUNT(name)'];
}
function all_seats() {
    if (isset($_REQUEST['bus'])) {
        $busID = strip_tags($_GET['bus']);
        return get_seats($busID);
    }
}
$seats = all_seats();
function no_of_seats() {
    if (isset($_REQUEST['bus'])) {
        $busID = strip_tags($_GET['bus']);
        return get_number_of_seats($busID);
    }
}
$no_of_seats = no_of_seats();
function get_bus_details($id) {
    global $db;
    $busID = strip_tags($id);
    $data = array();
    $sql = "SELECT buses.name as busName, number, routes.name as routeName, time, amount FROM buses
     INNER JOIN routes ON buses.number = routes.bus WHERE buses.number = '$busID'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
function get_details() {
    if (isset($_REQUEST['bus'])) {
        return get_bus_details(strip_tags($_GET['bus']));
    }
}
$bus_details = get_details();
function store_bookings($phone, $bus, $seat, $departure, $amount, $route) {
    global $db;
    global $status;
    global $notification;
    global $session_key;
    $checkbookingSql = "SELECT * FROM seats WHERE name = '$seat' AND bus = '$bus' AND status = 1";
    $result = mysqli_query($db, $checkbookingSql);
    if (mysqli_num_rows($result)) {
        $status = 0;
        $notification = "Seat Number $seat For bus $bus is already booked. Please book another seat.";
        return false;
    }
    $sql = "INSERT INTO bookings(phone, bus, seat, departure, amount, route, booked_by) VALUES
        ('$phone', '$bus', '$seat', '$departure', '$amount', '$route', '$session_key')";
        mysqli_query($db, $sql);
    if (mysqli_affected_rows($db) > 0) {
        $status = 1;
        $notification = "Your seat has been booked successfully. We shall contact you shortly on $phone";
        //mark seat as booked
        $bookedSql = "UPDATE seats SET status = 1 WHERE bus = '$bus' && name = '$seat'";
        mysqli_query($db, $bookedSql);
    }else {
        $status = 0;
        $notification = "Oops, something went wrong. Please try again later!";
    }
}
if (isset($_POST['book'])) {
    global $db;
    $phone = mysqli_real_escape_string($db, $_POST['contact']);
    $bus = $_POST['bus'];
    $seat = mysqli_real_escape_string($db, $_POST['seatNo']);
    $amount = $_POST['amount'];
    $departure = $_POST['departure'];
    $route = $_POST['route'];
    if (!empty(trim($seat)) && !empty(trim($phone))) {
     store_bookings($phone, $bus, $seat, $departure, $amount, $route);   
    }
}
//get search result
function get_searched_buses($key) {
    global $db;
    $data = array();
    $sql = "SELECT buses.name as busName, number, routes.name as routeName, time, amount FROM buses
     INNER JOIN routes ON buses.number = routes.bus WHERE routes.name LIKE '%$key%'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
//declare variable to access the results from the function
$searched_buses;
if (isset($_REQUEST['q'])) {
    $key = $_GET['q'];
    $searched_buses = get_searched_buses($key); 
}
function get_report() {
    global $db;
    $data = array();
    $reportSql = "SELECT * FROM bookings";
    $result = mysqli_query($db, $reportSql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
$report = get_report();
$busStatus = 2;
$busNotification = "";
//add buses
function addBuses($number, $name) {
    global $db;
    $sql = "INSERT INTO buses(number, name) VALUES ('$number', '$name')";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}
if (isset($_POST['addBus'])) {
    $number = e($_POST['numberPlate']);
    $name = e($_POST['busName']);
    if (!empty(trim($number)) && !empty(trim($name))) {
        $add_buses = addBuses($number, $name);
        if ($add_buses > 0) {
            $busStatus = 1;
            $busNotification = "Bus added successfully";
        }else {
            $busStatus = 0;
            $busNotification = "Operation failed. Please try again later";
        }
    }
}
//add routes
function addRoutes($number, $name, $departure, $charge) {
    global $db;
    $sql = "INSERT INTO routes(name, time, amount, bus) VALUES
    ('$name', '$departure', '$charge', '$number')";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}
if (isset($_POST['addRoutes'])) {
    $number = e($_POST['numberPlate']);
    $name = e($_POST['routeName']);
    $departure = e($_POST['departure']);
    $charge = e($_POST['amount']);
    if (!empty(trim($number)) && !empty(trim($name)) && !empty(trim($departure)) && !empty(trim($charge))) {
        $add_Routes = addRoutes($number, $name, $departure, $charge);
        if ($add_Routes > 0) {
            $busStatus = 1;
            $busNotification = "Route added successfully";
        }else {
            $busStatus = 0;
            $busNotification = "Operation failed. Please try again later";
        }
    }
}
//add seats
function addSeats($name, $bus) {
    global $db;
    $sql = "INSERT INTO seats(name, bus) VALUES ('$name', '$bus')";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}
if (isset($_POST['addSeats'])) {
    $number = e($_POST['seatNumber']);
    $name = e($_POST['numberPlate']);
    if (!empty(trim($number)) && !empty(trim($name))) {
        $add_seats = addSeats($number, $name);
        if ($add_seats > 0) {
            $busStatus = 1;
            $busNotification = "Seat added successfully";
        }else {
            $busStatus = 0;
            $busNotification = "Operation failed. Please try again later";
        }
    }
}
//function to delete a bus
/**
 * @param $busNumber The number plate to a bus to delete from the database
 * @return int
 */
function deleteBus($busNumber) {
    global $db;
    $sql = "DELETE FROM buses WHERE number = '$busNumber'";
    mysqli_query($db, $sql);
    mysqli_query($db, "DELETE FROM routes WHERE bus ='$busNumber'");
    return mysqli_affected_rows($db);
}
if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $busNumber = strip_tags($_GET['bus']);
    $delete_bus = deleteBus($busNumber);
    if ($delete_bus > 0) {
        $busStatus = 1;
        $busNotification = "Bus Deleted Successfully";
    }else {
        $busStatus = 0;
        $busNotification = "Operation failed. Please try again later";
    }
}
//update bus
$bus_to_update;
function get_bus_to_update($key) {
    global $db;
    $data = array();
    $sql = "SELECT buses.name as busName, number, routes.name as routeName, time, amount FROM buses
     INNER JOIN routes ON buses.number = routes.bus WHERE number = '$key' AND routes.bus = '$key'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
if (isset($_REQUEST['action']) && $_GET['action'] == "update") {
    $key = strip_tags($_GET['bus']);
    $bus_to_update = get_bus_to_update($key);
}
function update_bus_details($busNumber, $busName, $routeName, $departure, $charge) {
    global $db;
    $sql = "UPDATE buses SET name ='$busName' WHERE number ='$busNumber";
    mysqli_query($db, $sql);
    if (!empty($departure) && !empty($charge) && !empty($routeName)) {
        $update_route_sql = "UPDATE routes SET name = '$routeName', time ='$departure', amount = '$charge'
        WHERE bus ='$busNumber'";
         mysqli_query($db, $update_route_sql);
    }
    return mysqli_affected_rows($db);
}
//get the data and send it to the update_bus_details function
if (isset($_POST['update'])) {
    $busNumber = e($_POST['numberPlate']);
    $busName = e($_POST['busName']);
    $routeName = e($_POST['routeName']);
    $departure = e($_POST['departure']);
    $amount = e($_POST['amount']);
    $update = update_bus_details($busNumber, $busName, $routeName, $departure, $amount);
    if ($update > 0) {
        $busStatus = 1;
        $busNotification = "Bus details updated successfully";
    }else {
        $busStatus = 0;
        $busNotification = "Operation failed. Please try again later".mysqli_error($db);
    }
}
