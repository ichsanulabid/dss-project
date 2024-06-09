<?php
include '../tools/connection.php';

if (isset($_POST['save'])) {
    $altKode = $_POST['altKode'];
    $altNama = $_POST['altNama'];

    $query = $conn->query("INSERT INTO ta_alternatif(alternatif_kode,alternatif_nama) VALUES('$altKode','$altNama')");

    if ($query == True) {
        echo "<script>
                alert('Data Saved Successfully');
                window.location='alternativeView.php'
                </script>";
    } else {
        die('MySQL error : ' . mysqli_errno($conn));
    }
}
