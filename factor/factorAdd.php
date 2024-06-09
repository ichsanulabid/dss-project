<?php
include '../tools/connection.php';

if (isset($_POST['save'])) {
    $altKode = $_POST['altKode'];
    $kriKode = $_POST['kriKode'];
    $nilaiFaktor = $_POST['nilaiFaktor'];

    if ($altKode == 'Choose Alternative...') {
        echo "<script>
                alert('Alternative has not been Selected');
                window.location='factorview.php'
                </script>";
    } else {
        // Insert Data
        $inputBanyak = count($kriKode);
        for ($x = 0; $x < $inputBanyak; $x++) {
            $query = $conn->query("INSERT INTO tb_nilai(alternatif_kode, kriteria_kode, nilai_faktor) VALUES('$altKode','$kriKode[$x]','$nilaiFaktor[$x]')");
            if ($query == True) {
                echo "<script>
                        alert('Data Saved Successfully');
                        window.location='factorView.php'
                        </script>";
            } else {
                die('MySQL error : ' . mysqli_errno($conn));
            }
        }
    }
}
