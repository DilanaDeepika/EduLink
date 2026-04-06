<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Welcome</title>
    <link rel="stylesheet" href="../../Public/assets/css/editClassLanding.css?v=1.1">
    <link rel="stylesheet" href="../../Public/assets/css/component/editClassHeader-institute.css?v=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include __DIR__ . '/Component/editClassHeader-institute.view.php';?>


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Welcome to EduLink</h1>
            <p class="hero-description">
                Plan your classes, connect with qualified teachers, and deliver exceptional educational experiences.
            </p>
            <div class="hero-buttons">
                <button id="btn-edit-class" class="btn btn-primary">Edit  Class</button>
                <button id="btn-edit-teacher" class="btn btn-secondary">Edit Teacher</button>
            </div>
        </div>
    </section>

    <!-- Picture Section -->
    <section class="pic-section">
        <div class="pic-container">
            <div class="pic-card">
                <img src="../../Public/assets/images/createClassLandingLeft_institute.png" alt="left-img">
            </div>

            <div class="pic-card">
                <img src="../../Public/assets/images/createClassLandingMiddle_institute.jpg" alt="middle-img">
            </div>
            <div class="pic-card">
                <img src="../../Public/assets/images/createClassLandingRight_institute.jpg" alt="right-img">
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section">
        <div class="section-header">
            <h2 class="section-title">How EduLink Works</h2>
            <p class="section-subtitle">Three simple steps to create and conduct your perfect class</p>
        </div>

        <div class="steps-container">
            <div class="step-card">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3 class="step-title">Plan Your Class</h3>
                    <p class="step-description">
                        Define your class details, learning objectives, and requirements.
                    </p>
                </div>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3 class="step-title">Find a Teacher</h3>
                    <p class="step-description">
                        Browse qualified educators and review their profiles and credentials.
                    </p>
                </div>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3 class="step-title">Start Teaching</h3>
                    <p class="step-description">
                        Request your chosen teacher and begin your educational journey.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Get Started?</h2>
            <p class="cta-description">
                Join thousands of educators and students creating meaningful learning experiences.
            </p>
            <button class="btn btn-cta">Create Your First Class</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        
    </footer>
    <script src="../../Public/assets/js/editClassLanding.view.js"></script>
</body>
</html>