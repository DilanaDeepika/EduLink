<?php $class_data = $class ?? (object)[]; ?>

<div class="form-container">
    <div class="form-header">
        <h2>Basic Information</h2>
        <p class="form-subtitle">Enter the fundamental details about your class</p>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="class-name">Class Name</label>
            <input type="text" id="class-name" name="class_name" placeholder="e.g., Advanced Mathematics" 
                   value="<?= htmlspecialchars($class_data->class_name ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <select id="subject" name="subject_name">
                <option value="" disabled>Select Subject</option>
                <?php $current_subject = $class_data->subject_name ?? ''; ?>
                <option value="Physics" <?= $current_subject === 'Physics' ? 'selected' : '' ?>>Physics</option>
                <option value="Chemistry" <?= $current_subject === 'Chemistry' ? 'selected' : '' ?>>Chemistry</option>
                <option value="Combined Mathematics" <?= $current_subject === 'Combined Mathematics' ? 'selected' : '' ?>>Combined Mathematics</option>
                </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="grade-level">Grade/Level</label>
            <select id="grade-level" name="grade_level_name">
                <option value="" disabled>Select Grade Level</option>
                <?php $current_grade = $class_data->grade_level_name ?? ''; ?>
                <option value="yr_25" <?= $current_grade === 'yr_25' ? 'selected' : '' ?>>2025 A/L</option>
                <option value="yr_26" <?= $current_grade === 'yr_26' ? 'selected' : '' ?>>2026 A/L</option>
                </select>
        </div>
        <div class="form-group">
            <label for="duration">Duration (hours)</label>
            <input type="number" id="duration" name="duration_hours" placeholder="60" min="1" max="300" 
                   value="<?= htmlspecialchars($class_data->duration_hours ?? '') ?>">
        </div>
    </div>

    <div class="form-group full-width">
        <label for="class-category">Class Category</label>
        <select id="class-category" name="category_name">
            <option value="">Select...</option>
            <?php $current_category = $class_data->category_name ?? ''; ?>
            <option value="theory" <?= $current_category === 'theory' ? 'selected' : '' ?>>Theory</option>
            <option value="revision" <?= $current_category === 'revision' ? 'selected' : '' ?>>Revision</option>
            <option value="paper" <?= $current_category === 'paper' ? 'selected' : '' ?>>Paper</option>
            <option value="practical" <?= $current_category === 'practical' ? 'selected' : '' ?>>Practical</option>
        </select>
    </div>

    <div class="form-group full-width">
        <label for="course-description">Course Description</label>
        <textarea id="course-description" name="description" rows="4" placeholder="What is primarily taught in your course?"><?= htmlspecialchars($class_data->description ?? '') ?></textarea>
    </div>

    <div class="form-group full-width">
        <label for="course-language">Class Conducting Language</label>
        <select id="course-language" name="language_name">
            <option value="" disabled>Select Language</option>
            <?php $current_lang = $class_data->language_name ?? ''; ?>
            <option value="english" <?= $current_lang === 'english' ? 'selected' : '' ?>>English</option>
            <option value="sinhala" <?= $current_lang === 'sinhala' ? 'selected' : '' ?>>Sinhala</option>
            <option value="tamil" <?= $current_lang === 'tamil' ? 'selected' : '' ?>>Tamil</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="button" class="btn-next-core" data-target="view-advance">
            Next<i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
</div>

<script src="<?php echo ROOT ?>/assets/js/component/createClassBasicInfo.js"></script>