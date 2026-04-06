<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Find the Perfect Teacher</title>
    <link rel="stylesheet" href="../../Public/assets/css/editClassFindTeacher.css?v=1.1">
    <link rel="stylesheet" href="../../Public/assets/css/component/editClassHeader-institute.css?v=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <?php include __DIR__ . '/Component/editClassHeader-institute.view.php';?>

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
                    <p class="detail-item">📚 15 years experience • 1250 students</p>
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
                    <button class="btn-outline">View Profile</button>
                    <button class="btn-primary">Request</button>
                </div>
                <div class="card-actions">
                    <button class="btn-cancel">Cancel</button>
                    <button class="btn-assign">Assign</button>
                </div>
            </div>

            <div class="teacher-card">
                <div class="teacher-header">
                    <div class="teacher-avatar avatar-4">👨‍💻</div>
                    <div class="teacher-info">
                        <h3 class="teacher-name">Mr. James Wilson</h3>
                        <div class="teacher-subject">
                            <span>ICT</span>
                            <span class="rating">⭐ 4.9</span>
                        </div>
                    </div>
                </div>
                <div class="teacher-details">
                    <p class="detail-item">🎓 PhD in Computer Science</p>
                    <p class="detail-item">📚 10 years experience • 1500 students</p>
                </div>
                <div class="specializations">
                    <p class="spec-label">Specializations:</p>
                    <div class="spec-tags">
                        <span class="tag">Python</span>
                        <span class="tag">JavaScript</span>
                        <span class="tag">Data Science</span>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="btn-outline">View Profile</button>
                    <button class="btn-primary">Request</button>
                </div>
                <div class="card-actions">
                    <button class="btn-cancel">Cancel</button>
                    <button class="btn-assign">Assign</button>
                </div>
            </div>

        </section>
        <!-- Action Button Section -->
        <section class="actionBtn-section">
            <button type="button" class="btnSaveChanges" id="save-changes-btn"> Save Changes</button>
            <button type="submit" class="btnUpdateClass" id="update-class-btn">Update</button>
        </section>
    </main>
    <script src="../../Public/assets/js/editClassFindTeacher.view.js"></script>
</body>
</html>