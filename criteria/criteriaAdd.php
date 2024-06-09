<?php
include '../tools/connection.php';

if (isset($_POST['save'])) {
    $kriKode = $_POST['kriKode'];
    $kriNama = $_POST['kriNama'];
    $kriKategori = $_POST['kriKategori'];
    $kriBobot = $_POST['kriBobot'];

    if ($kriKategori == 'benefit' || $kriKategori == 'cost') {
        $query = $conn->query("INSERT INTO ta_kriteria(kriteria_kode,kriteria_nama,kriteria_kategori,kriteria_bobot) VALUES('$kriKode','$kriNama', '$kriKategori','$kriBobot')");
        if ($query == True) {
            echo "<script>
                    alert('Data Saved Successfully');
                    window.location='criteriaView.php'
                    </script>";
        } else {
            die('MySQL error : ' . mysqli_errno($conn));
        }
    } else {
        echo "<script>
                alert('Category has not been Selected');
                window.location='criteriaView.php'
                </script>";
    }
}