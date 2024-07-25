<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $user_id = $_SESSION['unique_id'];
    $user_id_blocked = $_GET["id"];

    $check_query = mysqli_query($conn, "SELECT * FROM blokir WHERE user_id = {$user_id} AND user_id_blocked = {$user_id_blocked}");

    if (mysqli_num_rows($check_query) == 0) {
        $sql = mysqli_query($conn, "INSERT INTO blokir (user_id, user_id_blocked)
                                        VALUES ({$user_id}, {$user_id_blocked})") or die();
    }

    header("location: ../users.php");

} else {
    header("location: ../login.php");

}
