<?php 
    session_start(); 
    require_once 'db_connect.php';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header("location: index.php");
        exit;
    }
    $email = $password = "";
    $email_err = $password_err = $login_err = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(empty(trim($_POST['email']))) {
            $email_err = "Email Can't Be Empty.";
        } else {
            $email = trim($_POST['email']);
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        if(empty($email_err) && empty($password_err)) {
            $sql = "SELECT * FROM account INNER JOIN user ON account.id = user.accountID WHERE email = ?";
            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                $param_email = $email;
                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $id, $username, $passwd, $email, $accountID, $firstName, $lastName, $joindSince);
                        if(mysqli_stmt_fetch($stmt)) {
                            if(strcmp($passwd, $password) == 0) {
                                session_start();
                                $_SESSION['loggedin'] = true;
                                $_Session['id'] = $id;
                                $_SESSION['username'] = $username;
                                $_SESSION['admin'] = false;
                                $_SESSION['firstName'] = $firstName;
                                $_SESSION['lastName'] = $lastName;
                                header("location: index.php");
                            } else {
                                $login_err = "password.";
                            }
                        }
                    } else {
                        $login_err = "Invalid username or password.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($stmt);
            }
        }

        closeConnection();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="generalStyle.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Unireels</title>
</head>
<body class="generalBody">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <div class="container">
        <a href="index.php" class="navbar-brand">UniReels</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav me-auto">
            <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
            <li class="nav-item"><a href="searchActor.php" class="nav-link">Actors</a></li>
            <li class="nav-item"><a href="searchStudio.php" class="nav-link">Studios</a></li>
            <?php if(isset($_SESSION['loggedin']) && isset($_SESSION['admin']) && $_SESSION['admin'] == true) echo '<li class="nav-item"><a href="maintenance.php" class="nav-link">Maintinance</a></li>'?>
            <li class="nav-item"><a href="imprint.php" class="nav-link">Imprint</a></li>
          </ul>
          <form action="searchTitle.php" method="GET" class="d-flex">
            <input type="text" class="form-control me-2" placeholder="Search Titles" name="searchbar">
            <input class="btn btn-primary" type="submit" value="Search">
          </form>
        </div>
      </div>
    </nav>

    <div class="container text-white" style="width: 360px; padding: 20px; padding-top:200px;">
        <h2>Login</h2>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="login.php" method="POST">
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
    </body>
</html>
