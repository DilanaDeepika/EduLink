<?php
    $class_data = $class ?? (object)[]; 
    $objectives_data = $objectives ?? [];
?>

<div class="form-card">
    <div class="form-header">
        <h2>Intended Learners</h2>
    </div>
    <p class="form-description">
        The following descriptions will be publicly visible on your course landing page and will have a direct impact on your course performance. These descriptions will help learners decide if your course is right for them.
    </p>
    <div class="form-group">
        <label class="form-label">What will students learn in your class?</label>
        <p class="form-help">
            You must enter at least 4 learning objectives or outcomes that learners can expect to achieve after completing your course.
        </p>
        <div class="input-group" id="objectives-container">
            
            <?php 
            // Loop through existing objectives and print an input for each
            if (!empty($objectives_data)) {
                foreach ($objectives_data as $objective) {
                    echo '<input type="text" class="form-input" name="learning_objectives[]" value="' . htmlspecialchars($objective->objective_text) . '">';
                }
            } else {
                // If no objectives exist, show the 4 default placeholders
                echo '<input type="text" class="form-input" name="learning_objectives[]" placeholder="Ex: Learn the fundamentals of Physics">';
                echo '<input type="text" class="form-input" name="learning_objectives[]" placeholder="Objective">';
                echo '<input type="text" class="form-input" name="learning_objectives[]" placeholder="Objective">';
                echo '<input type="text" class="form-input" name="learning_objectives[]" placeholder="Objective">';
            }
            ?>

        </div>
        <span class="add-button" id="add-objective-btn">+ Add more to your response</span>
    </div>

    <div class="form-group">
        <label class="form-label">Who is this class for?</label>
        <p class="form-help">
            Write a clear description of the <strong>intended learners</strong> for your course who will find your course content valuable. This will help you attract the right learners to your course.
        </p>
        <textarea class="form-textarea" name="target_audience"><?= htmlspecialchars($class_data->target_audience ?? '') ?></textarea>
    </div>

    <div class="form-group">
        <label class="form-label">What are the requirements or prerequisites for taking your class?</label>
        <p class="form-help">
            List the required skills, experience, tools or equipment learners should have prior to taking your course. If there are no requirements, use this space to lower the barrier for beginners.
        </p>
        <textarea class="form-textarea" name="prerequisites"><?= htmlspecialchars($class_data->prerequisites ?? '') ?></textarea>
    </div>

    <div class="form-actions">
        <button type="button" class="btn-next" data-target="view-core">Next<i class="fa-solid fa-chevron-right"></i></button>
    </div>

</div>
<script src="<?php  echo ROOT ?>/assets/js/component/createClassIntendedLearners.js"></script>