<?php 
include('functions.php') 
?> 
<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" href="image/favicon.png" size="16x16" type="image/x-icon"/>
        <title>login user</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
            <h1>Login</h1>
        </div>
        <form method="post" action="login.php"> 
 
  <?php echo display_error(); ?> 
 
  <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" >
            </div>
            <div class="input-group">
            <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="login_btn">Login</button>
            </div>   <p>    Not yet a member? <a href="register.php">signup</a>
            </p>
        </form>
    </body>
</html>