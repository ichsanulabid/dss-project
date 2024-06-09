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
            <h2 class="text-center fw-bold mb-0">Sub-Criteria Data</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3 text-end">
                        <!-- Button to trigger modal for adding new data -->
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
                    </div>
                    <!-- Table to display the sub-criteria data -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th>No</th>
                                <th>Criteria Name</th>
                                <th>Sub-Criteria Code</th>
                                <th>Sub-Criteria Name</th>
                                <th>Sub-Criteria Weight</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieving and displaying sub-criteria data from the database
                            $data = $conn->query("SELECT * FROM ta_subkriteria INNER JOIN ta_kriteria ON ta_subkriteria.kriteria_kode = ta_kriteria.kriteria_kode");
                            $no = 1;
                            while ($subKriteria = $data->fetch_assoc()) { ?>
                                <tr>
                                    <!-- Displaying the sub-criteria data in table rows -->
                                    <td><?= $no++; ?></td>
                                    <td><?= $subKriteria['kriteria_nama']; ?></td>
                                    <td><?= $subKriteria['subkriteria_kode'] ?></td>
                                    <td><?= $subKriteria['subkriteria_keterangan'] ?></td>
                                    <td><?= $subKriteria['subkriteria_bobot'] ?></td>
                                    <td>
                                        <!-- Buttons for editing and deleting sub-criteria data -->
                                        <div class="btn-group">
                                            <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $subKriteria['subkriteria_id'] ?>">Edit</a>
                                            <a href="subCriteriaDelete.php?id=<?= $subKriteria['subkriteria_id']; ?>" class="btn btn-outline-danger" onclick=" return confirm('Hapus data ini ?')">Delete</a>
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


<!-- Modal for adding new sub-criteria data -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Title for the modal -->
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sub-Criteria Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding new sub-criteria data -->
                <form method="post" action="subCriteriaAdd.php">
                    <div class="row mb-3">
                        <label for="subkriKode" class="col-sm-3 col-form-label">Code</label>
                        <div class="col-sm-9">
                            <!-- Creating sub-criteria code -->
                            <?php
                            $data = $conn->query("SELECT * FROM ta_subkriteria ORDER BY subkriteria_id DESC LIMIT 1");
                            $total_row = mysqli_num_rows($data);
                            if ($total_row == 0) { ?>
                                <input type="text" class="form-control" id="subkriKode" name="subkriKode" value="<?= 'S01' ?>" required>
                            <?php } ?>
                            <?php while ($subkriteria = $data->fetch_assoc()) { ?>
                                <?php
                                $row_terakhir = $subkriteria['subkriteria_id'];
                                if ($row_terakhir < 9) { ?>
                                    <input type="text" class="form-control" id="subkriKode" name="subkriKode" value="<?= 'S0' . ((int)$subkriteria['subkriteria_id'] + 1); ?>" required>
                                <?php } elseif ($row_terakhir >= 9) { ?>
                                    <input type="text" class="form-control" id="subkriKode" name="subkriKode" value="<?= 'S' . ((int)$subkriteria['subkriteria_id'] + 1); ?>" required>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kriKode" class="col-sm-3 col-form-label">Criteria</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="kriKode">
                                <!-- Dropdown for selecting criteria -->
                                <option selected>Choose Criteria...</option>
                                <?php
                                $data = $conn->query("SELECT * FROM ta_kriteria");
                                while ($kriteria = $data->fetch_assoc()) { ?>
                                    <option value="<?= $kriteria['kriteria_kode']; ?>"><?= $kriteria['kriteria_kode'] . ' - ' . $kriteria['kriteria_nama'] . ' (' . $kriteria['kriteria_kategori'] . ')'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="subkriBobot" class="col-sm-3 col-form-label">Weight</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="subkriBobot">
                                <!-- Dropdown for entering sub-criteria weight -->
                                <option selected>Choose...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="subkriKeterangan" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <!-- Input field for entering sub-criteria name -->
                            <input type="text" class="form-control" id="subkriKeterangan" name="subkriKeterangan" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <!-- Button to submit the form and save the new sub-criteria data -->
                        <button type="submit" class="btn btn-outline-primary" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal for editing sub-criteria data -->
<?php
$data = $conn->query("SELECT * FROM ta_subkriteria ORDER by subkriteria_id");
while ($subkriteria = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?= $subkriteria['subkriteria_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Title for the modal -->
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Sub-Criteria Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing sub-criteria data -->
                    <form method="post" action="subCriteriaEdit.php">
                        <!-- Input field for storing sub-criteria ID -->
                        <input type="hidden" class="form-control" id="subkriId" name="subkriId" value="<?= $subkriteria['subkriteria_id'] ?>">
                        <div class="row mb-3">
                            <label for="kriKode" class="col-sm-3 col-form-label">Code</label>
                            <div class="col-sm-9">
                                <!-- Input field for editing sub-criteria code -->
                                <input type="text" class="form-control" id="subkriKode" name="subkriKode" value="<?= $subkriteria['subkriteria_kode'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kriKode" class="col-sm-3 col-form-label">Criteria</label>
                            <div class="col-sm-9">
                                <!-- Dropdown for editing criteria category -->
                                <select class="form-select d-inline" name="kriKode" id="kriKode">
                                    <?php
                                    $sql = $conn->query("SELECT * FROM ta_kriteria ORDER BY kriteria_kode");
                                    while ($kriteria = mysqli_fetch_array($sql)) { ?>
                                        <option value="<?= $kriteria['kriteria_kode']; ?>" <?php if ($kriteria['kriteria_kode'] == $subkriteria['kriteria_kode']) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $kriteria['kriteria_kode'] . ' - ' . $kriteria['kriteria_nama'] . ' (' . $kriteria['kriteria_kategori'] . ')'; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subkriKeterangan" class="col-sm-3 col-form-label">Sub-Criteria</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="subkriKeterangan" name="subkriKeterangan" value="<?= $subkriteria['subkriteria_keterangan'] ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="subkriBobot" class="col-sm-3 col-form-label">Weight</label>
                            <div class="col-sm-9">
                                <select class="form-select d-inline" name="subkriBobot">
                                    <option value="1" <?php if ($subkriteria['subkriteria_bobot'] == '1') {
                                                            echo "selected";
                                                        } ?>>1</option>
                                    <option value="2" <?php if ($subkriteria['subkriteria_bobot'] == '2') {
                                                            echo "selected";
                                                        } ?>>2</option>
                                    <option value="3" <?php if ($subkriteria['subkriteria_bobot'] == '3') {
                                                            echo "selected";
                                                        } ?>>3</option>
                                    <option value="4" <?php if ($subkriteria['subkriteria_bobot'] == '4') {
                                                            echo "selected";
                                                        } ?>>4</option>
                                    <option value="5" <?php if ($subkriteria['subkriteria_bobot'] == '5') {
                                                            echo "selected";
                                                        } ?>>5</option>
                                </select>
                            </div>
                        </div>

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