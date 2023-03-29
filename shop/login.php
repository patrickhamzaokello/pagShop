<?php
session_start();
$conn = null;

include("ajaxResponse/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,400i,600,700" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="loginassets/stylesheet/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="loginassets/javascript/main.js"></script>
    <title>PAG HOSPITAL BILLING</title>

</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = null;
    try {
// Check if the connection is established
        if ($conn == null) {
            $error = "Connection Problems, Check your Connection and Try again";
            throw new Exception("Connection Problems, Check your Connection and Try again");
        }

// Get the user email and password
        $myuseremail = mysqli_real_escape_string($conn, $_POST['useremail']);
        $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

// Prepare the SQL statement
        $stmt = $conn->prepare("SELECT name, email, contact_no, password FROM staff WHERE email = ?");

// Bind the parameters
        $stmt->bind_param("s", $myuseremail);

// Execute the query
        $stmt->execute();

// Get the result set
        $result = $stmt->get_result();

// Check if the user exists
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

// Verify the password
            if (password_verify($mypassword, $row['password'])) {

                // Store the user details in the session
                $_SESSION['login_user'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['contact_no'] = $row['contact_no'];

                // Redirect the user to the desired page
                header("Location: index.php");
                exit();
            } else {
// Password is incorrect
                $error = "Passwords Do not Match";
                echo "<script>showerror();</script>";
            }

        } else {
            //if the user not found
            $error = "User not Found";
            echo "<script>showerror();</script>";
        }

    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }

    if ($error != null) {

        ?>

        <div id="erroshow" class="erroshow">
            <div class="errorinnerdiv">
                <p class="errotext"><?php echo $error; ?></p>
            </div>
        </div>
        <div id="erroroverlay"
             style="height: 100%; opacity: 0.4; position: absolute; top: 0px; left: 0px; background-color: black; width: 100%; z-index: 5000;"></div>


        <?php

    }
}

?>

<body>


<section class="ftco-section">
    <div class="container">
        <div class="cardcomponent">

            <div class="designview " style="display: none;">
                <img src="loginassets/images/mwonyaapattern.svg" alt="mwonyaapattern">

            </div>

            <div class="loginpagesite align-self-stretch">

                <div class="formtitle">

                    <!-- <img class="zodongologinlogo" src="pages/assets/zodongo_logo.png" alt=""> -->
                    <p class="logintext">PAG HOSPITAL POINT OF SALE</p>

                </div>

                <form action="" method="post">

                    <label for="useremailid" class="labeltext">Email</label>
                    <input id="useremailid" style="margin-bottom: 2em;" type="email" name="useremail" class="inputbox"
                           placeholder="Email address" required/>
                    <label for="userpasswordid" class="labeltext">Password</label>
                    <input id="userpasswordid" type="password" name="password" class="inputbox" placeholder="Password"
                           required/>

                    <input class="inputsubmit" type="submit" value="LOGIN"/><br/>

                </form>

            </div>

        </div>


    </div>
</section>

</body>

</html>