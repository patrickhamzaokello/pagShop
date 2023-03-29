<?php
session_start();
$conn = null;

include("ajaxResponse/config.php");
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit;
} else {
    $user_check = $_SESSION['login_user'];

    $ses_sql = mysqli_query($conn, "select name from staff where email = '$user_check' ");

    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

    if ($row) {
        $login_session = $row['name'];
    } else {
       return;
    }
}
