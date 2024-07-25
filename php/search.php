<?php
session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

$sql = "SELECT * FROM users 
         LEFT JOIN blokir ON (blokir.user_id_blocked = users.unique_id 
                        AND blokir.user_id = $outgoing_id) OR (blokir.user_id = users.unique_id 
                        AND blokir.user_id_blocked = $outgoing_id)
    WHERE NOT unique_id = {$outgoing_id} AND blokir.id IS NULL AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
$output = "";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    include_once "data.php";
} else {
    $output .= 'No user found related to your search term';
}
echo $output;
