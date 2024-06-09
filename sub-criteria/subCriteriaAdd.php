<?php
include '../tools/connection.php';

if (isset($_POST['save'])) {
    $subkriKode = $_POST['subkriKode'];
    $kriKode = $_POST['kriKode'];
    $subkriBobot = $_POST['subkriBobot'];
    $subkriKeterangan = $_POST['subkriKeterangan'];

    if ($kriKode == 'Choose Criteria...' || $subkriBobot == 'Choose...') {
        echo "<script>
                alert('Criteria or Sub-Criteria Weight has not been Selected');
                window.location='subCriteriaView.php'
                </script>";
    } else {
        $query = $conn->query("INSERT INTO ta_subkriteria(subkriteria_kode,kriteria_kode,subkriteria_bobot,subkriteria_keterangan) VALUES('$subkriKode','$kriKode', '$subkriBobot','$subkriKeterangan')");
        if ($query == true) {
            echo "<script>
                        alert('Data Successfully Saved');
                        window.location='subCriteriaView.php'
                        </script>";
        } else {
            die('MySQL error : ' . mysqli_errno($conn));
        }
    }
}
?>
