<?php
include '../tools/connection.php';

$altId = $_GET['id'];
$query = $conn->query("DELETE FROM ta_alternatif WHERE alternatif_id='$altId'");

if ($query == True) {
    echo "<script>
        alert('Data Deleted Successfully');
        window.location='alternativeView.php'
        </script>";
} else {
    die('MySQL error : ' . mysqli_errno($conn));
}
