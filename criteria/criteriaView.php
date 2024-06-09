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
            <h2 class="text-center fw-bold mb-0">Criteria Data</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3 text-end">
                        <!-- Button to trigger modal for adding new data -->
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
                    </div>
                    <!-- Table to display the criteria data -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th>No</th>
                                <th>Criteria Name</th>
                                <th>Criteria Code</th>
                                <th>Criteria Category</th>
                                <th>Criteria Weight</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieving and displaying criteria data from the database
                            $data = $conn->query("SELECT * FROM ta_kriteria");
                            $no = 1;
                            while ($kriteria = $data->fetch_assoc()) { ?>
                                <tr>
                                    <!-- Displaying the criteria data in table rows -->
                                    <td><?= $no++; ?></td>
                                    <td><?= $kriteria['kriteria_nama'] ?></td>
                                    <td><?= $kriteria['kriteria_kode'] ?></td>
                                    <td><?= $kriteria['kriteria_kategori'] ?></td>
                                    <td><?= $kriteria['kriteria_bobot'] ?></td>
                                    <td>
                                        <!-- Buttons for editing and deleting criteria data -->
                                        <div class="btn-group">
                                            <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $kriteria['kriteria_id'] ?>">Edit</a>
                                            <a href="criteriaDelete.php?id=<?= $kriteria['kriteria_id']; ?>" class="btn btn-outline-danger" onclick=" return confirm('Delete this data ?')">Delete</a>
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

<!-- Modal for adding new criteria data -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Title for the modal -->
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Criteria Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding new criteria data -->
                <form method="post" action="criteriaAdd.php">
                    <div class="row mb-3">
                        <label for="kriKode" class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <!-- Creating criteria code -->
                            <?php
                            $data = $conn->query("SELECT * FROM ta_kriteria ORDER BY kriteria_id DESC LIMIT 1");
                            $total_row = mysqli_num_rows($data);
                            if ($total_row == 0) { ?>
                                <input type="text" class="form-control" id="kriKode" name="kriKode" value="<?= 'C01' ?>" required>
                            <?php } ?>

                            <?php while ($kriteria = $data->fetch_assoc()) { ?>
                                <?php
                                $row_terakhir = $kriteria['kriteria_id'];
                                if ($row_terakhir < 9) { ?>
                                    <input type="text" class="form-control" id="kriKode" name="kriKode" value="<?= 'C0' . ((int)$kriteria['kriteria_id'] + 1); ?>" required>
                                <?php } elseif ($row_terakhir >= 9) { ?>
                                    <input type="text" class="form-control" id="kriKode" name="kriKode" value="<?= 'C' . ((int)$kriteria['kriteria_id'] + 1); ?>" required>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kriNama" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <!-- Input field for entering criteria name -->
                            <input type="text" class="form-control" id="kriNama" name="kriNama" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kriBobot" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <!-- Dropdown for selecting criteria category -->
                            <select class="form-select" name="kriKategori">
                                <option selected>Choose Category...</option>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kriBobot" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10">
                            <!-- Input field for entering criteria weight -->
                            <input type="text" class="form-control" id="kriBobot" name="kriBobot" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <!-- Button to submit the form and save the new criteria data -->
                        <button type="submit" class="btn btn-outline-primary" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing criteria data -->
<?php
$data = $conn->query("SELECT * FROM ta_kriteria ORDER by kriteria_id");
while ($kriteria = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?= $kriteria['kriteria_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Title for the modal -->
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Criteria Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing criteria data -->
                    <form method="post" action="criteriaEdit.php">
                        <!-- Input field for storing criteria ID -->
                        <input type="hidden" class="form-control" id="kriId" name="kriId" value="<?= $kriteria['kriteria_id'] ?>">
                        <div class="row mb-3">
                            <label for="kriKode" class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <!-- Input field for editing criteria code -->
                                <input type="text" class="form-control" id="kriKode" name="kriKode" value="<?= $kriteria['kriteria_kode'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kriNama" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <!-- Input field for editing criteria name -->
                                <input type="text" class="form-control" id="kriNama" name="kriNama" required value="<?= $kriteria['kriteria_nama'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kriNama" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <!-- Dropdown for editing criteria category -->
                                <select class="form-select d-inline" name="kriKategori">
                                    <option value="benefit" <?php if ($kriteria['kriteria_kategori'] == 'benefit') {
                                                                echo "selected";
                                                            } ?>>Benefit</option>
                                    <option value="cost" <?php if ($kriteria['kriteria_kategori'] == 'cost') {
                                                                echo "selected";
                                                            } ?>>Cost</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kriBobot" class="col-sm-2 col-form-label">Weight</label>
                            <div class="col-sm-10">
                                <!-- Input field for editing criteria weight -->
                                <input type="text" class="form-control" id="kriBobot" name="kriBobot" required value="<?= $kriteria['kriteria_bobot'] ?>">
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <!-- Button to submit the form and update the criteria data -->
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
