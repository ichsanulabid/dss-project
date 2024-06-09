<?php
include '../tools/connection.php';

$altKode = $_GET['id'];
$query = $conn->query("DELETE FROM tb_nilai WHERE alternatif_kode='$altKode'");

if ($query == True) {
    echo "<script>
        alert('Data Deleted Successfully');
        window.location='factorView.php'
        </script>";
} else {
    die('MySQL error : ' . mysqli_errno($conn));
}
