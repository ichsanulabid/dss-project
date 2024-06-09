<?php
session_start();
include '../tools/connection.php';

if (isset($_SESSION["login_user"])) {
	header("location: ../home/home.php");
	exit();
}

if (isset($_POST['login_user'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = $conn->query("SELECT * FROM ta_user WHERE user_nama = '$username'");

	// Check Username
	if (mysqli_num_rows($query) === 1) {
		// Check Password
		$row = mysqli_fetch_assoc($query);
		if ($password === $row["user_password"]) {
			// Set Session
			$_SESSION["login_user"] = true;
			header("location: ../home/home.php");
			exit();
		}
	}
	$error = true;
}
?>

<?php include '../includes/header.php' ?>

<style>
    .background-container {
        position: relative;
        height: 100vh;
        width: 100%;
        background: url('../img/unram.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 56, 0.7); 
        z-index: 1;
    }
    .content-container {
        position: relative;
        z-index: 2;
        width: 90%;
        max-width: 900px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .illustration-container {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f2f2f2; 
    }
</style>

<div class="background-container">
    <div class="background-overlay"></div>
    <div class="content-container">
        <div class="row no-gutters">
            <div class="col-md-6 illustration-container">
                <img src="../img/login.png" alt="Illustration" class="img-fluid" style="height: 300px; width: 300px; object-fit: contain;">
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center p-4">
                <div class="text-center mb-4">
                    <img src="../img/logo-unram.png" alt="Logo" style="max-width: 110px; height: auto;">
                </div>
                <h3 class="text-center text-primary mb-4">Indonesia Pintar Scholarship Program Recipient Recommendation</h3>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        Username atau Password salah!
                    </div>
                <?php endif; ?>

                <form action="" method="post" class="w-100 px-3">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" autocomplete="off" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login_user">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

