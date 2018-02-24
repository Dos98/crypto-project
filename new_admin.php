<?php
    require_once ("functions.php");
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "login");

    // 1. Create a database connection
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // Test if connection succeeded
    if(mysqli_connect_errno()) {
        die("Database connection failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
        );
    }

?>
<?php session_start();?>
<?php require_once("functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Free Bulma template</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.6.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css" integrity="sha256-HEtF7HLJZSC3Le1HcsWbz1hDYFPZCqDhZa9QsCgVUdw=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<?php
    $username="";
    $_SESSION["message"]="";
    if (isset($_POST['submit'])) {
        // Process the form

        // validations
        $required_fields = array("username", "password");

        if (empty($errors)) {
            // Perform Create

            $username = mysql_prep($_POST["username"]);
            $hashed_password = password_encrypt($_POST["password"]);

            $query  = "INSERT INTO admins (";
            $query .= "  username, password";
            $query .= ") VALUES (";
            $query .= "  '{$username}', '{$hashed_password}'";
            $query .= ")";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Success
                $_SESSION["message"] = "Admin created.";
                redirect_to("user_created.php");
            } else {
                // Failure
                $_SESSION["message"] = "Admin creation failed.";
            }
        }
    } else {
        // This is probably a GET request

    } // end: if (isset($_POST['submit']))

?>

<body>
<section class="hero is-success is-fullheight">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">CREATE USER</h3>
                <p class="subtitle has-text-grey">Please enter your credentials.</p>
                <div class="box">

                    <form action="new_admin.php" method="post">
                        <p>create user</p>
                        <br>
                        <div class="field">
                            <div class="control">
                                <input class="input is-large" type="text" name="username" placeholder="Your Email" autofocus="">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input class="input is-large" type="password" name="password" placeholder="Your Password">
                            </div>
                        </div>
                        <div class="field is-grouped is-grouped-centered">
                            <p class="control">
                                <button class="button is-primary" type="submit" name="submit" value="Create Admin" >
                                    Create User
                                </button>
                            </p>
                            <p class="control">
                                <a href="new_admin.php" class="button is-light">
                                    Cancel
                                </a>
                            </p>
                            <br>
                            <p><?php echo $_SESSION["message"];?></p>
                            <p><?php echo form_errors($errors); ?></p>
                        </div>
                    </form>
                </div>s
            </div>
        </div>
    </div>
</section>
<script async type="text/javascript" src="js/bulma.js"></script>
</body>
</html>

