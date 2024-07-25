<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT users.*, blokir.id AS id_blokir 
        FROM users 
        LEFT JOIN blokir ON (blokir.user_id_blocked = users.unique_id 
                        AND blokir.user_id = $outgoing_id) OR (blokir.user_id = users.unique_id 
                        AND blokir.user_id_blocked = $outgoing_id)
        WHERE users.unique_id != $outgoing_id 
          AND blokir.id IS NULL 
        ORDER BY users.unique_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>