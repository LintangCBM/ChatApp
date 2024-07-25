<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "SELECT * FROM blokir 
        where (blokir.user_id_blocked = $incoming_id AND blokir.user_id = $outgoing_id)";
    $sql2 = "SELECT * FROM blokir 
        where (blokir.user_id = $incoming_id AND blokir.user_id_blocked = $outgoing_id)";

    $query = mysqli_query($conn, $sql);
    $query2 = mysqli_query($conn, $sql2);
    $output = "";
    if (mysqli_num_rows($query) != 0) {
        echo "1";
    }else if (mysqli_num_rows($query2) != 0) {
        echo "2";
    }else {
        if (!empty($message)) {
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                            VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }
} else {
    header("location: ../login.php");
}
