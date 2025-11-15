<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Find the Perfect Teacher</title>
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/createClassFindTeacher.css">
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/component/createClassHeader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <?php include __DIR__ . '/Component/createClassHeader.php';?>

    <main class="container">
        <section class="hero-section">
            <h1 class="hero-title">Find the Perfect Teacher</h1>
            <p class="hero-subtitle">Browse our qualified educators and request them for your class</p>
        </section>

        <section class="search-section">
            <div class="search-bar">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M9 17A8 8 0 1 0 9 1a8 8 0 0 0 0 16zM19 19l-4.35-4.35" stroke="#666" stroke-width="2" stroke-linecap="round"/>
                </svg>
                <input type="text" placeholder="Search by name or specialization..." class="search-input">
            </div>
            <div class="filter-dropdown">
                <select class="subject-select">
                    <option>All Subjects</option>
                    <option>Mathematics</option>
                    <option>Biology</option>
                    <option>Economics</option>
                    <option>Physics</option>
                    <option>ICT</option>
                </select>
            </div>
        </section>

        <section class="teachers-box">
            <div class="teacher-card">
                <div class="teacher-header">
                    <div class="teacher-avatar avatar-1">👩‍🏫</div>
                    <div class="teacher-info">
                        <h3 class="teacher-name">Mr. Sujith Liyanagama</h3>
                        <div class="teacher-subject">
                            <span>Physics</span>
                            <span class="rating">⭐ 4.9</span>
                        </div>
                    </div>
                </div>
                <div class="teacher-details">
                    <p class="detail-item">🎓 Bsc.Hons.Engineering</p>
                </div>
                <div class="specializations">
                    <p class="spec-label">Specializations:</p>
                    <div class="spec-tags">
                        <span class="tag">Theory</span>
                        <span class="tag">Paper</span>
                        <span class="tag">Revision</span>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="btn-primary">Request</button>
                    <button class="btn-cancel">Cancel</button>
                </div>
            </div>
        </section>
        <!-- Action Button Section -->
        <section class="actionBtn-section">
            <button type="button" class="btnSaveDraft" id="save-draft-btn"> Save as Draft</button>
            <button type="submit" class="btnCreateClass" id="create-class-btn"> Create Class</button>
        </section>
    </main>
    <script src="<?php  echo ROOT ?>/assets/js/createClassFindTeacher.js"></script>
</body>
</html>