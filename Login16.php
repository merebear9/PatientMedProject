<?php

require_once "config.php";
require_once "session.php";


$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

  $email = trim($_POST['email'])
  $password = trim($_POST['password']);

  //validate if email is empty
  if (empty($email)) {
     $error .= '<p class="error">Please enter email.</p>;
}


  //validate if password empty
  if (empty($error)) {
      if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
     $query->bind_parm('s', '$email);
     $query->execute();
     $row = $query->fetch()
     if ($row) {
         if (passowrd_verify($password, $row['password'])) {
             $_SESSION["userid"] = $row['id'];
             $_SESSION["user"] = $row;

             //redirect user to main menu
             header("location: welcome.php");
             exit;
            } else{
              $error .= '<p class="error">The password is not valid.</p>';
}
}
$query->close();
}
//close connection
mysqli_close($db);
}
?>             

<!DOCTYPE html>
<html lang="en">
   <head>
       <meta charset="UTF-8">
       <title>Sign Up</title>
       <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   </head>
   <body>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2>Register</h2> 
              <p> Please fill this form to create a new user account. </p>
              <form action="" method="post">
                <div class="form-group">
                   <label>Full Name</label>
                   <input type="text" name="name" class="form-control" required>
                 </div>
                 <div class="form-group">
                 <label>Email Address</label>
                 <input type="email" name="email" class="form-control" required />
                 </div>   
                 <div class="form-group"> 
                 <label>Password</label> 
                 <inpit type="password" name="password" class="form-control" required />  
                 </div> 
                 <div class="form-group"> 
                 <label>Confirm Password</label>   '
                 <inpit type="password" name="confirm_password" class="form-control" /> 
                  </div> 
                  <div class="form-group">     
                  <inpit type="submit" name="submit" class="btn btn-primary" value="Submit"/>  
                  </div> 
                </form>
            </div> 
        </div> 
    </div> 
  </body> 
</html> 
 
