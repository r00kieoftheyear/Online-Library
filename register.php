<?php
include 'header.php';
include 'db.php';

$username = $role = $password = $confirm_password = "";
$username_err = $role_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){ #if server is asked to use POST

# USERNAME FIELD 🙎#

  if(empty(trim($_POST["username"]))){ #if username field is empty -> error is displayed
    $username_err = "Please enter a username.";
  } else{
    $sql = "SELECT id FROM users WHERE username =?"; #otherwise if username is provided, prepare a select statement

    if($stmt = mysqli_prepare($conn, $sql)){
      mysqli_stmt_bind_param($stmt, "s", $param_username); #bind vars to prepared statement
      $param_username = trim($_POST["username"]);

      if(mysqli_stmt_execute($stmt)){ #bind vars to preped statement
        mysqli_stmt_store_result($stmt); #store result

        if(mysqli_stmt_num_rows($stmt) == 1){ #if username data already exists -> error is displayed
          $username_err = "Username already taken.";
        } else{
          $username = htmlspecialchars(trim($_POST["username"]));
          }
        } else{
          echo "Oops! Something went wrong with adding username. Please try again later.";
      }
    }
    mysqli_stmt_close($stmt);
  }

# ROLE FIELD 👮#

  if(empty(trim($_POST["role"]))){
    $role_err = "Please select a role.";
  } else{
    $sql = "SELECT id FROM users WHERE role =?";

    if($stmt = mysqli_prepare($conn, $sql)){
      mysqli_stmt_bind_param($stmt, "s", $param_role);
      $param_role = trim($_POST["role"]);

      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 5){ #there can only be 5 of each category
          $role_err = "Too many roles in this category";
        } else{
          $role = htmlspecialchars(trim($_POST["role"]));
        }
      } else{
        echo "Oops! Something went wrong with adding your role. Please try again later.";
      }
    }
    mysqli_stmt_close($stmt);
  }

# PASSWORD FIELD 🔒#

  if(empty(trim($_POST["password"]))){
    $password_err = "Please enter a password.";
  } elseif(strlen(trim($_POST["password"])) <6){
      $password_err = "Password must have at least 6 characters.";
  } else{
      $password = htmlspecialchars(trim($_POST["password"]));
  }

  if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Please confirm password.";
  } else{
    $confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));

    if(empty($password_err) && ($password != $confirm_password)){
      $confirm_password_err = "Password doesn't match.";
    }
  }


  # Check there are no input errors before inserting in database
  if(empty($username_err) && empty($role_err) && empty($password_err) &&
  empty($confirm_password_err)){

    $sql = "INSERT INTO users (username, role, password) VALUES (?, ?, ?)";

    if($stmt = mysqli_prepare($conn, $sql)){
      mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_role, $param_password);

      $param_username = $username;
      $param_role = $role;
      $param_password = password_hash($password, PASSWORD_DEFAULT); #Create a password hash

      if(mysqli_stmt_execute($stmt)){
      header("location: login.php"); #if statement is executed, return user to login
    } else{
      echo "Something went wrong executing statement. Please try again later.";
    }
  }
  mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}
?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> <!-- sg var that returns file name -->
          <div class="registerformdiv">
                <h1>Register an account today!</h1>
            <div class="loginform <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="rformcontrol" value="<?php echo $username; ?>">
                <span class="helpspan"><?php echo $username_err; ?></span>
            </div>
            <div class="loginform <?php echo (!empty($role_err)) ? 'has-error' : ''; ?>">
                <label>Role</label>
                <input type="text" name="role" class="rformcontrol" value="<?php echo $role; ?>">
                <span class="helpspan"><?php echo $role_err; ?></span>
            </div>
            <div class="loginform <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="rformcontrol" value="<?php echo $password; ?>">
                <span class="helpspan"><?php echo $password_err; ?></span>
            </div>
            <div class="loginform <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="rformcontrol" value="<?php echo $confirm_password; ?>">
                <span class="helpspan"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="loginform">
                <input type="submit" class="submitbtn" value="Register Account">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
          </div>
        </form>

<?php
include 'footer.php'
?>
