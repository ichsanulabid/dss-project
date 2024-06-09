<?php
//login
session_start();

if (!isset($_SESSION["login_admin"])) {
    header("location: ../login/adminLogin.php");
    exit();
}
?>

<?php
// koneksi
include '../tools/connection.php';
// header
include '../includes/header.php';
// header
include '../includes/navAdmin.php';
?>


<style>
    body {
        background-color: #f8f9fa;
    }

    .card-body {
        background-color: #fff;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        margin-top: 50px; 
        padding: 0 88px; 
    }

    .card-header {
        background-color: #17a2b8;
        color: #fff;
        border-bottom: none;
    }

    .card-title {
        font-size: 20px;
        margin-top: 40px;
        text-align: left; 
        margin-bottom: 20px; 
    }

    .card-content {
        text-align: justify; 
        line-height: 1.6; 
    }

    .card-content p {
        margin-bottom: 15px; 
    }

    .card-content ul, .card-content ol {
        padding-left: 20px; 
    }

    .card-content ul li, .card-content ol li {
        margin-bottom: 5px; 
    }

    .card-content h3 {
        font-size: 20px;
        margin-top: 50px; 
        margin-bottom: 20px;
        text-align: center;
    }

    .hero-banner {
        background-image: url('../img/unram.jpg');
        background-size: cover;
        background-position: center;
        height: 300px; 
        position: relative; 
        display: flex;
        justify-content: center; 
        align-items: center; 
    }

    .hero-banner::before {
        content: ''; 
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); 
    }

    .hero-content {
        padding: 20px;
        text-align: center;
        color: #fff;
        position: relative; 
        z-index: 1;
    }

    .mission-box {
        display: flex;
        align-items: center;
        padding: 20px;
        background-color: #f0f0f0;
        border-radius: 5px;
        margin-top: 50px;
        margin-bottom: 20px;
    }

    .mission-text {
        margin-left: 30px;
        flex: 1;
    }

    .mission-text h2 {
        padding-top: 20px;
        font-size: 20px;
    }

    .mission-image {
        flex: 1;
        text-align: center;
    }

    .mission-image img {
        max-width: 100%;
        height: 200px;
    }

    .selection-process {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px;
    }

    .process-step {
        flex-basis: calc(25% - 20px); 
        background-color: #f0f0f0;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: center;
    }

    .step-header {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .step-illustration {
        max-width: 150px; 
        margin-bottom: 10px;
    }

    .step-content p {
        margin: 0;
    }

    .criteria-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .criteria-item {
        flex-basis: calc(33.33% - 20px);
        margin: 0 10px;
        padding: 20px;
        background-color: #f0f0f0;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    .criteria-content {
        display: flex;
        align-items: center;
    }

    .criteria-content p {
        padding-top: 10px;
    }

    .criteria-icon {
        width: 50px;
        margin-right: 10px;
    }

    .criteria-description {
        margin-top: 10px;
        font-size: 14px;
        color: #6c757d;
    }

    .process-step:hover, .criteria-item:hover {
        transform: translateY(-5px); 
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.5); 
        background-color: #fff; 
        border: 0.5px solid #000; 
        transition: all 0.3s ease;
    }
</style>

<?php include '../includes/footer.php' ?>