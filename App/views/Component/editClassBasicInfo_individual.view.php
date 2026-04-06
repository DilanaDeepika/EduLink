<div class="form-container">
    <div class="form-header">
        <h2>📋 Basic Information</h2>
        <p class="form-subtitle">Enter the fundamental details about your class</p>
    </div>

    <form class="basic-info-form" id="basic-info-form">
        <div class="form-row">
            <div class="form-group">
                <label for="class-name">Class Name</label>
                <input type="text" id="class-name" value="Advanced Physics">
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <select id="subject">
                    <option value="" disabled>Select Subject</option>
                    <option selected>Physics</option>
                    <option>Chemistry</option>
                    <option>Combined Mathematics</option>
                    <option>Biology</option>
                    <option>ICT</option>
                    <option>Accounting</option>
                    <option>Economics</option>
                    <option>Business Studies</option>
                    <option>Media</option>
                    <option>Political Science</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="grade-level">Grade/Level</label>
                <select id="grade-level">
                    <option value="" disabled>Select Grade Level</option>
                    <option value="yr_25" selected>2025 A/L</option>
                    <option value="yr_26">2026 A/L</option>
                    <option value="yr_27">2027 A/L</option>
                    <option value="yr_28">2028 A/L</option>
                </select>
            </div>
            <div class="form-group">
                <label for="duration">Duration (hours)</label>
                <input type="number" id="duration" value="60" min="1" max="300">
            </div>
        </div>

        <div class="form-group full-width">
            <label for="subject-name">Subject Name</label>
            <input type="text" id="subject-name" value="Advanced Physics: Mechanics & Thermodynamics">
        </div>

        <div class="form-group full-width">
            <label for="class-category">Class Category</label>
            <select id="class-category">
                <option value="">Select...</option>
                <option value="theory" selected>Theory</option>
                <option value="revision">Revision</option>
                <option value="paper">Paper</option>
                <option value="practical">Practical</option>
            </select>
        </div>

        <div class="form-group full-width">
            <label for="course-description">Course Description</label>
            <textarea id="course-description" rows="4">This course covers advanced physics concepts including mechanics, thermodynamics, and practical applications suitable for high school students preparing for A/L exams.</textarea>
        </div>

        <div class="form-group full-width">
            <label for="course-language">Class Conducting Language</label>
            <select id="course-language">
                <option value="" disabled>Select Language</option>
                <option value="english" selected>English</option>
                <option value="sinhala">Sinhala</option>
                <option value="tamil">Tamil</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="button" class="btn-save-draft-core" id="btn_save-basic">Save Changes</button>
            <button type="button" id="btn-next-core" class="btn-next-core">Next <i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </form>
</div>
<script src="../../../Public/assets/js/component/editClassBasicInfo_individual.view.js"></script>