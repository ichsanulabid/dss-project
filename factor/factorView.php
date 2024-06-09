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
            <!-- Title for the card -->
            <h2 class="text-center fw-bold mb-0">Factor Value Data</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3 text-end">
                        <!-- Button to trigger modal for adding new data -->
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
                    </div>
                    <!-- Table to display the factor value -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th>No</th>
                                <th>Alternative Name</th>
                                <?php
                                $data = $conn->query("SELECT * FROM ta_kriteria");
                                while ($kriteria = $data->fetch_assoc()) { ?>
                                    <th><?= $kriteria['kriteria_nama']; ?></th>
                                <?php } ?>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieving and displaying alternative data from the database
                            $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_kode");
                            $no = 1;
                            while ($alternatif = $data->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $alternatif['alternatif_nama'] ?></td>
                                    <?php
                                    $alt_kode = $alternatif['alternatif_kode'];
                                    $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alt_kode' ORDER BY kriteria_kode");
                                    while ($data_nilai = $sql->fetch_assoc()) { ?>
                                        <td><?= $data_nilai['nilai_faktor']; ?></td>
                                    <?php } ?>
                                    <td>
                                        <!-- Buttons for editing and deleting factor value -->
                                        <div class="btn-group">
                                            <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $alternatif['alternatif_kode'] ?>">Edit</a>
                                            <a href="factorDelete.php?id=<?= $alternatif['alternatif_kode']; ?>" class="btn btn-outline-danger" onclick="return confirm('Hapus data ini ?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for adding new factor value -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Title for the modal -->
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Factor Value Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding new factor value -->
                <form method="post" action="factorAdd.php">
                    <div class="row mb-3">
                        <label for="altKode" class="col-sm-3 col-form-label">Alternative</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="altKode">
                                <option selected>Select Alternative...</option>
                                <?php
                                $data = $conn->query("SELECT * FROM ta_alternatif");
                                while ($alternatif = $data->fetch_assoc()) { ?>
                                    <option value="<?= $alternatif['alternatif_kode']; ?>"><?= $alternatif['alternatif_nama'] . ' (' . $alternatif['alternatif_kode'] . ')'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col text-center">Fill in the Factor Values Below !!</label>
                    </div>

                    <?php
                    $data = $conn->query("SELECT * FROM ta_kriteria");
                    while ($kriteria = $data->fetch_assoc()) { ?>
                        <div class="row mb-3">
                            <label for="nilaiFaktor" class="col-sm-3 col-form-label"><?= $kriteria['kriteria_kode'] . ' - ' . $kriteria['kriteria_nama']; ?></label>

                            <div class="col-sm-9">
                                <input type="hidden" name="kriKode[]" value="<?= $kriteria['kriteria_kode']; ?>">
                                <select class="form-select" name="nilaiFaktor[]">
                                    <option selected>Choose...</option>
                                    <?php
                                    $kri_kode = $kriteria['kriteria_kode'];
                                    $sql = $conn->query("SELECT * FROM ta_subkriteria WHERE kriteria_kode='$kri_kode' ORDER BY kriteria_kode");
                                    while ($subKriteria = $sql->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $subKriteria['subkriteria_bobot']; ?>"><?= $subKriteria['subkriteria_keterangan'] . ' (Bobot : ' . $subKriteria['subkriteria_bobot'] . ')'; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-outline-primary" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing factor value -->
<?php
$data = $conn->query("SELECT * FROM ta_alternatif ORDER by alternatif_kode");
while ($alternatif = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?= $alternatif['alternatif_kode']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Title for the modal -->
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Factor Value of <?= $alternatif['alternatif_nama']; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing factor value -->
                    <form method="post" action="factorEdit.php">
                        <?php
                        $alt_kode = $alternatif['alternatif_kode'];
                        $sql = $conn->query("SELECT * FROM tb_nilai WHERE alternatif_kode='$alt_kode'");
                        while ($data_nilai = $sql->fetch_assoc()) { ?>
                            <div class="row mb-3">
                                <input type="hidden" id="nilaiId" name="nilaiId[]" value="<?= $data_nilai['nilai_id']; ?>">
                                <input type="hidden" id="altKode" name="altKode[]" value="<?= $data_nilai['alternatif_kode']; ?>">
                                <input type="hidden" id="kriKode" name="kriKode[]" value="<?= $data_nilai['kriteria_kode']; ?>">

                                <?php
                                $kri_kode = $data_nilai['kriteria_kode'];
                                $sqli = $conn->query("SELECT * FROM ta_kriteria WHERE kriteria_kode='$kri_kode'");
                                while ($data_kriteria = $sqli->fetch_assoc()) {
                                ?>
                                    <label for="kriNama" class="col-sm-3 col-form-label"><?= $data_kriteria['kriteria_kode'] . ' - ' . $data_kriteria['kriteria_nama']; ?></label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="nilaiFaktor[]">
                                            <?php
                                            $data_subkriteria = $conn->query("SELECT * FROM ta_subkriteria WHERE kriteria_kode='$kri_kode' ORDER BY kriteria_kode");
                                            while ($subKriteria = $data_subkriteria->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $subKriteria['subkriteria_bobot']; ?>" <?php if ($subKriteria['subkriteria_bobot'] == $data_nilai['nilai_faktor']) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?= $subKriteria['subkriteria_keterangan'] . ' (Bobot : ' . $subKriteria['subkriteria_bobot'] . ')'; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-outline-warning" name="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Footer -->
<?php include '../includes/footer.php' ?>