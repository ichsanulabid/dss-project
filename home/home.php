<!-- Header -->
<?php include '../includes/header.php'; ?>
<!-- Navbar -->
<?php include '../includes/navbar.php'; ?>

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

<div class="container-fluid p-0">
    <!-- Hero Banner -->
    <div class="hero-banner">
        <div class="hero-content">
            <h1>Welcome to our Decision Support System</h1>
            <p>We help you choose the best candidates for the Indonesia Pintar Scholarship Program</p>
            <a href="../alternative/alternativeView.php" class="btn btn-outline-light">Start</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card">
        <div class="card-body">
            <!-- Introduction to the portal -->
            <h6 class="card-title">Welcome to the Decision Support System Portal for the Indonesia Pintar Scholarship Program at Mataram University</h6>
            <div class="card-content">
                <p>We welcome you to the official portal of the Decision Support System (DSS) for the Indonesia Pintar Program at Mataram University. This portal is dedicated to supporting the vision of the Indonesian Ministry of Education in providing better educational opportunities for Indonesian students through the Indonesia Pintar Program.</p>

                <!-- Mission Section -->
                <div class="mission-box">
                    <div class="mission-text">
                        <h2>Our Mission</h2>
                        <p>Our mission is to support the initiatives of the Indonesian Ministry of Education in providing equal educational opportunities for all Indonesian students. We believe that through the Indonesia Pintar Program, we can assist high-achieving students who need financial support to achieve their dreams in higher education.</p>
                    </div>
                    <div class="mission-image">
                        <img src="../img/illustration.png" alt="Illustration of lamp">
                    </div>
                </div>

                <!-- Selection Process Section -->
                <h3>Selection Process</h3>
                <div class="selection-process">
                    <!-- Registration -->
                    <div class="process-step">
                        <div class="step-header">Registration</div>
                        <div class="step-content">
                            <img src="../img/step1.png" alt="Step 1 Illustration" class="step-illustration">
                            <p>Prospective scholarship recipients are expected to fill out the registration form completely and accurately.</p>
                        </div>
                    </div>
                    <!-- Document Verification -->
                    <div class="process-step">
                        <div class="step-header">Document Verification</div>
                        <div class="step-content">
                            <img src="../img/step2.png" alt="Step 2 Illustration" class="step-illustration">
                            <p>Each application will be verified to ensure the authenticity and completeness of documents.</p>
                        </div>
                    </div>
                    <!-- Selection -->
                    <div class="process-step">
                        <div class="step-header">Selection</div>
                        <div class="step-content">
                            <img src="../img/step3.png" alt="Step 3 Illustration" class="step-illustration">
                            <p>Applications will be evaluated based on predefined criteria, including academic achievements, family economic conditions, and participation in social activities.</p>
                        </div>
                    </div>
                    <!-- Interview -->
                    <div class="process-step">
                        <div class="step-header">Interview</div>
                        <div class="step-content">
                            <img src="../img/step4.png" alt="Step 4 Illustration" class="step-illustration">
                            <p>Selected students will be invited for an interview as the final stage of the selection process.</p>
                        </div>
                    </div>
                </div>

                <!-- Decision Making Method Section -->
                <h3>Decision Making Method: Simple Additive Weighting (SAW)</h3>
                <p>In determining scholarship recipients, Mataram University uses the Simple Additive Weighting (SAW) method, which is one of the techniques in decision support systems. The SAW method allows us to evaluate and select the best students based on a number of predefined criteria. With this approach, we can ensure that selection decisions are made objectively and based on data.</p>

                <!-- Scholarship Recipient Criteria Section -->
                <h3>Scholarship Recipient Criteria</h3>
                <div class="criteria-row">
                    <!-- KIP Recipients -->
                    <div class="criteria-item">
                        <div class="criteria-content">
                            <img src="../img/1.png" alt="KIP Icon" class="criteria-icon">
                            <p>Kartu Indonesia Pintar (KIP) Recipients</p>
                        </div>
                        <p class="criteria-description">Priority for students who have KIP.</p>
                    </div>
                    <!-- Parents Income -->
                    <div class="criteria-item">
                        <div class="criteria-content">
                            <img src="../img/2.png" alt="Income Icon" class="criteria-icon">
                            <p>Parents Income</p>
                        </div>
                        <p class="criteria-description">Monthly income of parents as the main consideration.</p>
                    </div>
                    <!-- Parental Dependents -->
                    <div class="criteria-item">
                        <div class="criteria-content">
                            <img src="../img/3.png" alt="Family Icon" class="criteria-icon">
                            <p>Parental Dependents</p>
                        </div>
                        <p class="criteria-description">Number of family dependents affecting the need for assistance.</p>
                    </div>
                </div>
                <div class="criteria-row">
                    <!-- PKH Participants -->
                    <div class="criteria-item">
                        <div class="criteria-content">
                            <img src="../img/4.png" alt="PKH Icon" class="criteria-icon">
                            <p>Program Keluarga Harapan (PKH) Participants</p>
                        </div>
                        <p class="criteria-description">Provides more opportunities for PKH participant students.</p>
                    </div>
                    <!-- KKS Holder -->
                    <div class="criteria-item">
                        <div class="criteria-content">
                            <img src="../img/5.png" alt="KKS Icon" class="criteria-icon">
                            <p>Kartu Keluarga Sejahtera (KKS) Holder</p>
                        </div>
                        <p class="criteria-description">Families receiving KKS have priority.</p>
                    </div>
                    <!-- Orphan Status -->
                    <div class="criteria-item">
                        <div class="criteria-content">
                            <img src="../img/6.png" alt="Orphan Icon" class="criteria-icon">
                            <p>Orphan Status</p>
                        </div>
                        <p class="criteria-description">Students who are orphans are given special attention in determining scholarship recipients.</p>
                    </div>
                </div>

                <!-- Call to Action Section -->
                <h3 style="font-size: 20px; text-align: left;">Join Us</h3>
                <p>We invite Mataram University students to be part of positive change in Indonesian education. Let's together create a brighter future for Indonesian students. You can apply as a scholarship recipient candidate or recommend high-achieving students you know. Together, let's unleash the full potential of Indonesian students through the Indonesia Pintar Program at Mataram University.</p>
                <br><br>    
            </div>
        </div>
    </div>
</div>

<br>
<!-- Footer -->
<?php include '../includes/footer.php'; ?>
