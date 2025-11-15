<div class="form-container">
    <div class="form-header">
        <h2>Basic Information</h2>
        <p class="form-subtitle">Enter the fundamental details about your class</p>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="class-name">Class Name</label>
            <input type="text" id="class-name" name="class_name" placeholder="e.g., Advanced Mathematics">
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <select id="subject" name="subject_name">
                <option value="" disabled selected>Select Subject</option>
                <option value="Physics">Physics</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Combined Mathematics">Combined Mathematics</option>
                <option value="Biology">Biology</option>
                <option value="ICT">ICT</option>
                <option value="Accounting">Accounting</option>
                <option value="Economics">Economics</option>
                <option value="Business Studies">Business Studies</option>
                <option value="Media">Media</option>
                <option value="Political Science">Political Science</option>
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="grade-level">Grade/Level</label>
            <select id="grade-level" name="grade_level_name">
                <option value="" disabled selected>Select Grade Level</option>
                <option value="yr_25">2025 A/L</option>
                <option value="yr_26">2026 A/L</option>
                <option value="yr_27">2027 A/L</option>
                <option value="yr_28">2028 A/L</option>
            </select>
        </div>
        <div class="form-group">
            <label for="duration">Duration (hours)</label>
            <input type="number" id="duration" name="duration_hours" placeholder="60" min="1" max="300">
        </div>
    </div>

    <div class="form-group full-width">
        <label for="class-category">Class Category</label>
        <select id="class-category" name="category_name">
            <option value="">Select...</option>
            <option value="theory">Theory</option>
            <option value="revision">Revision</option>
            <option value="paper">Paper</option>
            <option value="practical">Practical</option>
        </select>
    </div>

    <div class="form-group full-width">
        <label for="course-description">Course Description</label>
        <textarea id="course-description" name="description" rows="4" placeholder="What is primarily taught in your course?"></textarea>
    </div>

    <div class="form-group full-width">
        <label for="course-language">Class Conducting Language</label>
        <select id="course-language" name="language_name">
            <option value="" disabled selected>Select Language</option>
            <option value="english">English</option>
            <option value="sinhala">Sinhala</option>
            <option value="tamil">Tamil</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="button" class="btn-next-core" data-target="view-advance">
            Next<i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
</div>

<script src="<?php echo ROOT ?>/assets/js/component/createClassBasicInfo.js"></script>
