<?php
include '../tools/connection.php';

if (isset($_POST['update'])) {
    $userId = $_POST['userId'];
    $userNama = $_POST['userNama'];
    $userPassword = password_hash($_POST['userPassword'], PASSWORD_DEFAULT); // Hash the password

    $stmt = $conn->prepare("UPDATE ta_user SET user_nama = ?, user_password = ? WHERE user_id = ?");
    $stmt->bind_param("ssi", $userNama, $userPassword, $userId);

    if ($stmt->execute()) {
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
