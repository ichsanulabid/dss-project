<?php
// Connection
include '../tools/connection.php';
// Header
include '../includes/header.php';
// Navbar
include '../includes/navbar.php';
?>

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        background-color: #fff;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #17a2b8;
        color: #fff;
        border-bottom: none;
    }
    .table th, .table td {
        vertical-align: middle;
    }
</style>

<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center fw-bold mb-0">Final Results and Ranking</h2>
        </div>
        <!-- body -->
        <div class="card-body">

            <!-- array ranks untuk menampung hasil perangkingan -->
            <?php $ranks = array(); ?>

            <!-- button trigger cetak PDF -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <button type="button" class="btn btn-outline-primary" onclick="window.open('../report/printPDF.php', '_blank')">
                    Print PDF
                </button>
            </div>

            <!-- tabel matrix -->
            <h3 class="text-center fw-bold mb-3">Decision Matrix Table</h3>
            <table class="table table-striped table-bordered mb-5">
                <thead>
                    <tr class="table-info">
                        <th rowspan="2">No</th>
                        <th rowspan="2">Alternative Name</th>
                        <?php
                        $data = $conn->query("SELECT * FROM ta_kriteria");
                        $kriteriaRows = mysqli_num_rows($data);
                        ?>
                        <th colspan="<?= $kriteriaRows; ?>">Criteria Name</th>
                    </tr>
                    <tr class="table-info">
                        <?php
                        $data = $conn->query("SELECT * FROM ta_kriteria");
                        while ($kriteria = $data->fetch_assoc()) { ?>
                            <td><?= htmlspecialchars($kriteria['kriteria_nama']); ?></td>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
                    $no = 1;
                    while ($alternatif = $data->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($alternatif['alternatif_nama']); ?></td>
                            <?php
                            $alternatifKode = $alternatif['alternatif_kode'];
                            $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alternatifKode' ORDER BY kriteria_kode");
                            while ($data_nilai = $sql->fetch_assoc()) { ?>
                                <td><?= htmlspecialchars($data_nilai['nilai_faktor']); ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- tabel normalisasi -->
            <h3 class="text-center fw-bold mb-3">Normalized Matrix Table</h3>
            <table class="table table-striped table-bordered mb-5">
                <thead>
                    <tr class="table-info">
                        <th rowspan="2">No</th>
                        <th rowspan="2">Alternative Name</th>
                        <?php
                        $data = $conn->query("SELECT * FROM ta_kriteria");
                        $kriteriaRows = mysqli_num_rows($data);
                        ?>
                        <th colspan="<?= $kriteriaRows; ?>">Criteria Name</th>
                    </tr>
                    <tr class="table-info">
                        <?php
                        $data = $conn->query("SELECT * FROM ta_kriteria");
                        while ($kriteria = $data->fetch_assoc()) { ?>
                            <td><?= htmlspecialchars($kriteria['kriteria_nama']); ?></td>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
                    $no = 1;
                    while ($alternatif = $data->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($alternatif['alternatif_nama']); ?></td>
                            <?php
                            $alternatifKode = $alternatif['alternatif_kode'];
                            $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alternatifKode' ORDER BY kriteria_kode");
                            while ($data_nilai = $sql->fetch_assoc()) { ?>
                                <?php
                                $kriteriaKode = $data_nilai['kriteria_kode'];
                                $sqli = $conn->query("SELECT * FROM ta_kriteria WHERE kriteria_kode='$kriteriaKode' ORDER BY kriteria_kode");
                                while ($kriteria = $sqli->fetch_assoc()) {
                                ?>
                                    <?php if ($kriteria['kriteria_kategori'] == "cost") { ?>
                                        <?php
                                        $sqlMin =  $conn->query("SELECT kriteria_kode, MIN(nilai_faktor) AS min FROM tb_nilai WHERE kriteria_kode='$kriteriaKode' GROUP BY kriteria_kode");
                                        while ($nilai_Min = $sqlMin->fetch_assoc()) {
                                        ?>
                                            <td><?= number_format($hasil = $nilai_Min['min'] / $data_nilai['nilai_faktor'], 2); ?></td>
                                        <?php } ?>
                                    <?php } elseif ($kriteria['kriteria_kategori'] == "benefit") { ?>
                                        <?php
                                        $sqlMax =  $conn->query("SELECT kriteria_kode, MAX(nilai_faktor) AS max FROM tb_nilai WHERE kriteria_kode='$kriteriaKode' GROUP BY kriteria_kode");
                                        while ($nilai_Max = $sqlMax->fetch_assoc()) {
                                        ?>
                                            <td><?= number_format($hasil = $data_nilai['nilai_faktor'] / $nilai_Max['max'], 2); ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- tabel pemfaktoran -->
            <h3 class="text-center fw-bold mb-3">Preference Value Table</h3>
            <table class="table table-striped table-bordered mb-5">
                <thead>
                    <tr class="table-info">
                        <th rowspan="2">No</th>
                        <th rowspan="2">Alternative Name</th>
                        <?php
                        $data = $conn->query("SELECT * FROM ta_kriteria");
                        $kriteriaRows = mysqli_num_rows($data);
                        ?>
                        <th colspan="<?= $kriteriaRows; ?>">Criteria Name</th>
                        <th rowspan="2">Final Score</th>
                    </tr>
                    <tr class="table-info">
                        <?php
                        $data = $conn->query("SELECT * FROM ta_kriteria");
                        while ($kriteria = $data->fetch_assoc()) { ?>
                            <td><?= htmlspecialchars($kriteria['kriteria_nama']); ?></td>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
                    $no = 1;
                    while ($alternatif = $data->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($alternatif['alternatif_nama']); ?></td>
                            <?php $hasilSum = 0; //variabel hasilSum untuk proses sum nanti ?>
                            <?php
                            $alternatifKode = $alternatif['alternatif_kode'];
                            $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alternatifKode' ORDER BY kriteria_kode");
                            while ($data_nilai = $sql->fetch_assoc()) { ?>
                                <?php
                                $kriteriaKode = $data_nilai['kriteria_kode'];
                                $sqli = $conn->query("SELECT * FROM ta_kriteria WHERE kriteria_kode='$kriteriaKode' ORDER BY kriteria_kode");
                                while ($kriteria = $sqli->fetch_assoc()) {
                                ?>
                                    <?php if ($kriteria['kriteria_kategori'] == "cost") { ?>
                                        <?php
                                        $sqlMin =  $conn->query("SELECT kriteria_kode, MIN(nilai_faktor) AS min FROM tb_nilai WHERE kriteria_kode='$kriteriaKode' GROUP BY kriteria_kode");
                                        while ($nilai_Min = $sqlMin->fetch_assoc()) {
                                        ?>
                                            <?php $hasil = $nilai_Min['min'] / $data_nilai['nilai_faktor']; ?>
                                            <td><?= number_format($min_dikali_kriteria = $hasil * $kriteria['kriteria_bobot'], 2); ?></td>
                                            <?php $hasilSum = $hasilSum + $min_dikali_kriteria; ?>
                                        <?php } ?>
                                    <?php } elseif ($kriteria['kriteria_kategori'] == "benefit") { ?>
                                        <?php
                                        $sqlMax =  $conn->query("SELECT kriteria_kode, MAX(nilai_faktor) AS max FROM tb_nilai WHERE kriteria_kode='$kriteriaKode' GROUP BY kriteria_kode");
                                        while ($nilai_Max = $sqlMax->fetch_assoc()) {
                                        ?>
                                            <?php $hasil = $data_nilai['nilai_faktor'] / $nilai_Max['max']; ?>
                                            <td><?= number_format($max_dikali_kriteria = $hasil * $kriteria['kriteria_bobot'], 2); ?></td>
                                            <?php $hasilSum = $hasilSum + $max_dikali_kriteria; ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <td><?= number_format($hasilSum, 2);  //hasil sum ?></td>
                            <?php
                            //masukan  nilai hasil-sum, nama-alternatif, kode-alternatif ke dalam variabel $ranks(baris 26)
                            $rank['hasilSum'] = $hasilSum;
                            $rank['alternatifNama'] = $alternatif['alternatif_nama'];
                            $rank['alternatifKode'] = $alternatif['alternatif_kode'];
                            array_push($ranks, $rank);
                            ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- tabel ranking -->
            <h3 class="text-center fw-bold mb-3">Ranking Table</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="table-warning">
                        <th>Ranking</th>
                        <th>Alternative Code</th>
                        <th>Alternative Name</th>
                        <th>Final Score</th>
                        <th>Decision</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ranking = 1;
                    rsort($ranks);
                    foreach ($ranks as $r) {
                    ?>
                        <tr>
                            <td><?= $ranking++; ?></td>
                            <td><?= htmlspecialchars($r['alternatifKode']); ?></td>
                            <td><?= htmlspecialchars($r['alternatifNama']); ?></td>
                            <td><?= number_format($r['hasilSum'], 2); ?></td>
                            <td><?= ($r['hasilSum'] > 0.70) ? 'Recommended' : 'Not-Recommended'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Footer -->
<?php include '../includes/footer.php' ?>
