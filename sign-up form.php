<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up/Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db="userdata";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);


//Getting the form datas
if (isset($_POST['signup'])) {
$name=$_REQUEST['name'];
$pass=$_REQUEST['pass'];
$email=$_REQUEST['email'];
$r_pass=$_REQUEST['re_pass'];
$sql1 = "SELECT r_no,pwd,mail FROM info WHERE r_no='$name'";
$result1 = mysqli_query($conn, $sql1);
$sql2="SELECT r_no,pwd,mail FROM info WHERE mail='$email'";
$result2 = mysqli_query($conn, $sql2);
$new_pass=strval(trim($pass," "));
$bol=ctype_alnum($new_pass);
if (mysqli_num_rows($result1) > 0) {
   $name_error = "Username already taken"; 
}
else if(mysqli_num_rows($result2) > 0) {
   $mail_error = "Email already exists in logs"; 
}
//check empty confirm password field  
else if($r_pass == "") {  
      $r_pwd_error="Confirm the password.";
    }   
    //minimum password length validation  
else if(strlen($new_pass) < 8 || strlen($new_pass) > 12) {  
      $pwd_error="Password range must be 8-12 characters";
    }
else if(!$bol) {  
      $pwd_error="Password must consist character and digits.";
}
    //Confirm password doesnt match with password
    else if($pass!==$r_pass){
   $r_pwd_error="Password doesn't match.";
    }      
     

else
{
  $sql="INSERT INTO info VALUES('$name','$pass','$email')";
  $result=mysqli_query($conn, $sql);
  $_SESSION['name']=$name;
  $_SESSION['pass']=$pass;
 }  
mysqli_close($conn);
}
?>
<style>
.form-group .exists {
  width: 80%;
  height: 20px;
  margin: 3px 10%;
  font-size: 0.9em;
  color: #cd3131; 
  
  
}
</style>
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Quick Sign Up</h2>
                        <form method="POST" class="register-form" id="register-form" action="sign-up form.php">
                            <div class="form-group">
                                
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="User Name" required/>
                                <?php if (isset($name_error)): ?>
	  	                <span class="exists"><?php echo $name_error; ?></span>
	                        <?php endif ?>
                                
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                                <?php if (isset($mail_error)): ?>
	  	                <span class="exists"><?php echo $mail_error; ?></span>
	                        <?php endif ?>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" maxlength="12" required/>
                                <?php if (isset($pwd_error)): ?>
	  	                <span class="exists"><?php echo $pwd_error; ?></span>
	                        <?php endif ?>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Re-enter password" />
                                <?php if (isset($r_pwd_error)): ?>
	  	                <span class="exists"><?php echo $r_pwd_error; ?></span>
	                        <?php endif ?>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" onchange=validate() />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="sign-in form.php" class="signup-image-link">I am already member</a>
               
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script>
    rno=document.getElementById("name").value;
    pwd=document.getElementById("pass").value;
    mail=document.getElementById("email").value;
    r_pwd=document.getElementById("re_pass").value;
   
    </script>
</body>
</html>