<?php include('functions.php') ?> 
<!DOCTYPE html> 
<html> 
    <head>  
    <link rel="icon" href="image/favicon.png" size="16x16" type="image/x-icon"/>
        <title>register</title>
        <link rel="stylesheet" href="style.css">
    </head> 
    <body> 
        <div class="header">  
            <h2>Register</h2> 
        </div> 
        <form method="post" action="register.php">
            <?php echo display_error(); ?> 
            <div class="input-group">   
                <label>Username</label>   
                <input type="text" name="username" id="username" autocomplete="off" value="<?php echo $username; ?>" onblur="validateUsername()" >  
            </div>  
            <div class="input-group">   
                <label>Email</label>   
                <input type="email" autocomplete="off" id="email" name="email" value="<?php echo $email; ?>" onblur="validateEmail()">  
            </div>  
            <div class="input-group">   
                <label>Password</label>   
                <input type="password" id="password" autocomplete="off" name="password_1" onblur="validatePassword()">  
            </div>  
            <div class="input-group">   
                <label>Confirm password</label>   
                <input type="password" id="password_2" autocomplete="off" name="password_2" onblur="confirmPassword()" >  
            </div>  
            <div class="input-group">   
                <button type="submit" class="btn" name="register_btn">Register</button> 
            </div>  
            <p>   
                Already a member? <a href="login.php">Sign in</a> 
            </p> 
        </form> 
        <script type="text/javascript">
        function validateUsername() {
           const username = document.getElementById('username');
            const reg = /^[a-z0-9]+$/;
            if(!username.value.match(reg)) {
                username.style.border = '5px solid red';
                username.focus();
                return false;
            }else {
                username.style.border = '5px solid green';
                return true;
            }
        }
            function validateEmail() {
                const email = document.getElementById('email');
                const reg = /^([a-z0-9_.])+@+([a-z])+([.])+([a-z]){2,}/;
                if (!email.value.match(reg)) {
                    email.style.border = '5px solid red';
                    email.focus();
                    return false;
                }else {
                    email.style.border = '5px solid green';
                    return true;
                }
            }
            function validatePassword() {
                const password = document.getElementById('password');
                const reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)/;
                if (!password.value.match(reg)) {
                    password.style.border = '5px solid red';
                    password.focus();
                    return false;
                }else {
                    password.style.border = '5px solid green';
                    return true;
                }
            }
            function confirmPassword() {
                const password = document.getElementById('password');
                const password_2 = document.getElementById('password_2');
                if(password_2.value !== password.value) {
                    password_2.style.border = '5px solid red';
                    password_2.focus();
                    return false;
                }else {
                    password_2.style.border = '5px solid green';
                    return true;
                }
            }
        </script>
    </body> 
</html>
