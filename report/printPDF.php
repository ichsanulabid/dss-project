<?php
// Connection
include '../tools/connection.php';
// Header
include '../includes/header.php';
?>

<style>
    body {
        font-family: 'Times New Roman', Times, serif;
    }
    .label {
        display: inline-block;
        width: 80px; 
    }
</style>

<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <!-- Kop Surat -->
        <div class="d-flex align-items-center justify-content-center">
            <div>
                <img src="../img/logo-unram.png" alt="Logo" style="width:115px;height:auto; margin-right: 20px;">
            </div>
            <div class="text-center">
                <h5 class="fw-bold m-0">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h5>
                <h5 class="fw-bold m-0">UNIVERSITAS MATARAM</h5>
                <p class="m-0">Jalan Majapahit Nomor 62 Mataram, Nusa Tenggara Barat, 83125</p>
                <p class="m-0">Telepon : (0370) 633007, 633116 Fax. (0370) 636041</p>
                <p class="m-0">Laman : www.unram.ac.id</p>
            </div>
        </div>
        <hr>
        <br>
        <!-- Isi Surat -->
        <p class="m-0"><span class="label">Nomor</span>: 001/Beasiswa/VI/2024</p>
        <p class="m-0"><span class="label">Lampiran</span>: -</p>
        <p class="m-0"><span class="label">Perihal</span>: Rekomendasi Penerima Program Beasiswa Indonesia Pintar</p>
        <br>
        <p class="text-justify">Kepada Yth,<br>Rektor Universitas Mataram<br>Jl. Majapahit No. 62, Mataram, NTB<br>di Tempat<br><br>Dengan Hormat,</p>
        <p class="text-justify">Bersama ini kami sampaikan laporan rekomendasi penerima Program Beasiswa Indonesia Pintar di Universitas Mataram untuk tahun akademik 2024/2025. Rekomendasi ini berdasarkan hasil seleksi yang dilakukan menggunakan metode Simple Additive Weighting (SAW).</p>
        <p class="text-justify">Setelah melalui proses seleksi yang ketat dan pengolahan data menggunakan metode SAW, berikut adalah nama-nama mahasiswa yang direkomendasikan untuk menerima Beasiswa Indonesia Pintar:</p>

        <?php $ranks = array(); ?>
        <!-- <p class="text-center fw-bold">Tabel Matrix Keputusan</p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="table-info">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Alternatif</th>
                    <?php
                    $data = $conn->query("SELECT * FROM ta_kriteria");
                    $kriteriaRows = mysqli_num_rows($data);
                    ?>
                    <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>
                </tr>
                <tr class="table-info">

                    <?php
                    $data = $conn->query("SELECT * FROM ta_kriteria");
                    while ($kriteria = $data->fetch_assoc()) { ?>
                        <td><?= $kriteria['kriteria_nama']; ?></td>
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
                        <td><?= $alternatif['alternatif_nama'] ?></td>
                        <?php
                        $alternatifKode = $alternatif['alternatif_kode'];
                        $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alternatifKode' ORDER BY kriteria_kode");
                        while ($data_nilai = $sql->fetch_assoc()) { ?>
                            <td><?= $data_nilai['nilai_faktor'] ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <p class="text-center fw-bold">Tabel Normalisasi</p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="table-info">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Alternatif</th>
                    <?php
                    $data = $conn->query("SELECT * FROM ta_kriteria");
                    $kriteriaRows = mysqli_num_rows($data);
                    ?>
                    <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>

                </tr>
                <tr class="table-info">
                    <?php
                    $data = $conn->query("SELECT * FROM ta_kriteria");
                    while ($kriteria = $data->fetch_assoc()) { ?>
                        <td><?= $kriteria['kriteria_nama']; ?></td>
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
                        <td><?= $alternatif['alternatif_nama'] ?></td>
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

        <p class="text-center fw-bold">Tabel Hasil Preferensi</p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="table-info">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Nama Alternatif</th>
                    <?php
                    $data = $conn->query("SELECT * FROM ta_kriteria");
                    $kriteriaRows = mysqli_num_rows($data);
                    ?>
                    <th colspan="<?= $kriteriaRows; ?>">Nama Kriteria</th>
                    <th rowspan="2">Nilai Akhir</th>

                </tr>
                <tr class="table-info">
                    <?php
                    $data = $conn->query("SELECT * FROM ta_kriteria");
                    while ($kriteria = $data->fetch_assoc()) { ?>
                        <td><?= $kriteria['kriteria_nama']; ?></td>
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
                        <td><?= $alternatif['alternatif_nama'] ?></td>
                        <?php $hasilSum = 0; //variabel hasilSum untuk proses sum nanti
                        ?>

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

                        <td><?= number_format($hasilSum, 2);  //hasil sum
                            ?></td>

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
        </table> -->



        <div class="row mt-3">
            <div class="col-1"></div>
            <div class="col-10">
                <table class="table table-bordered">
                    <thead>
                        <tr">
                            <th>Ranking</th>
                            <th>Kode Alternatif</th>
                            <th>Nama Alternatif</th>
                            <th>Skor Akhir</th>
                            <th>Keputusan</th>
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
                                <td><?= $r['alternatifKode']; ?></td>
                                <td><?= $r['alternatifNama']; ?></td>
                                <td><?= number_format($r['hasilSum'], 2); ?></td>
                                <td><?= ($ranking <= 4) ? 'Direkomendasikan' : 'Tidak Direkomendasikan'; ?></td>
                            </tr>
                        <?php
                            //jika hanya menampilkan 3 nilai teratas
                            if ($ranking > 3) {
                                break;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
        </div>

        <p class="text-justify">Demikian surat laporan ini kami sampaikan. Kami berharap rekomendasi ini dapat diterima dan diproses lebih lanjut sesuai dengan prosedur yang berlaku di Universitas Mataram. Kami siap memberikan informasi tambahan yang mungkin diperlukan.</p>
        <p class="text-justify">Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
        <p style=" text-align: right;">Mataram, <?php echo date("d/m/Y") ?></p><br><br>
        <p style=" text-align: right;">Tim Seleksi Beasiswa</p>

    </div>
    <div class="col-lg-1"></div>
</div>

<script>
    window.print();
</script>