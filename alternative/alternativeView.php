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
            <h2 class="text-center fw-bold mb-0">Alternative Data</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3 text-end">
                        <!-- Button to trigger modal for adding new data -->
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
                    </div>
                    <!-- Table to display the alternative data -->
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-info">
                                <th>No</th>
                                <th>Alternative Code</th>
                                <th>Alternative Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieving and displaying alternative data from the database
                            $data = $conn->query("SELECT * FROM ta_alternatif");
                            $no = 1;
                            while ($alternatif = $data->fetch_assoc()) { ?>
                                <tr>
                                    <!-- Displaying the alternative data in table rows -->
                                    <td><?= $no++; ?></td>
                                    <td><?= $alternatif['alternatif_kode'] ?></td>
                                    <td><?= $alternatif['alternatif_nama'] ?></td>
                                    <td>
                                        <!-- Buttons for editing and deleting alternative data -->
                                        <div class="btn-group">
                                            <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $alternatif['alternatif_id'] ?>">Edit</a>
                                            <a href="alternativeDelete.php?id=<?= $alternatif['alternatif_id']; ?>" class="btn btn-outline-danger" onclick=" return confirm('Delete this data ?')">Delete</a>
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

<!-- Modal for adding new alternative data -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Title for the modal -->
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Alternative Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding new alternative data -->
                <form method="post" action="alternativeAdd.php">
                    <div class="row mb-3">
                        <label for="altKode" class="col-sm-2 col-form-label">Code</label>
                        <div class="col-sm-10">
                            <!-- Input field for entering alternative code -->
                            <?php
                            // Generating alternative code based on the existing data in the database
                            $data = $conn->query("SELECT * FROM ta_alternatif ORDER BY alternatif_id DESC LIMIT 1");
                            $total_row = mysqli_num_rows($data);
                            if ($total_row == 0) { ?>
                                <input type="text" class="form-control" id="altKode" name="altKode" value="<?= 'A01' ?>" required>
                            <?php } ?>
                            <?php while ($alternatif = $data->fetch_assoc()) { ?>
                                <?php
                                $row_terakhir = $alternatif['alternatif_id'];
                                if ($row_terakhir < 9) { ?>
                                    <input type="text" class="form-control" id="altKode" name="altKode" value="<?= 'A0' . ((int)$alternatif['alternatif_id'] + 1); ?>" required>
                                <?php } elseif ($row_terakhir >= 9) { ?>
                                    <input type="text" class="form-control" id="altKode" name="altKode" value="<?= 'A' . ((int)$alternatif['alternatif_id'] + 1); ?>" required>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="altNama" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <!-- Input field for entering alternative name -->
                            <input type="text" class="form-control" id="altNama" name="altNama" required>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <!-- Button to submit the form and save the new alternative data -->
                        <button type="submit" class="btn btn-outline-primary" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing alternative data -->
<?php
$data = $conn->query("SELECT * FROM ta_alternatif ORDER by alternatif_id");
while ($alternatif = mysqli_fetch_array($data)) { ?>
    <div class="modal fade" id="modalEdit<?= $alternatif['alternatif_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Title for the modal -->
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Alternative Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing alternative data -->
                    <form method="post" action="alternativeEdit.php">
                        <!-- Input field for storing alternative ID -->
                        <input type="hidden" class="form-control" id="altId" name="altId" value="<?= $alternatif['alternatif_id'] ?>">
                        <div class="row mb-3">
                            <label for="altKode" class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <!-- Input field for editing alternative code -->
                                <input type="text" class="form-control" id="altKode" name="altKode" value="<?= $alternatif['alternatif_kode'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="altNama" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <!-- Input field for editing alternative name -->
                                <input type="text" class="form-control" id="altNama" name="altNama" required value="<?= $alternatif['alternatif_nama'] ?>">
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <!-- Button to submit the form and update the alternative data -->
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
