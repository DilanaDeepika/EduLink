<?php
    // Set up helper variables to avoid errors
    $class_data = $class ?? (object)[]; 
    $schedules_data = $schedules ?? [];

    // Create a simple lookup array for schedules
    // This makes it easy to find a schedule by day (e.g., $schedule_lookup['mon'])
    $schedule_lookup = [];
    foreach ($schedules_data as $schedule) {
        $day_key = strtolower($schedule->day_of_week);
        $schedule_lookup[$day_key] = $schedule;
    }
?>

<div class="advanced-info-container">
    <h1 class="section-title">Advanced Information</h1>

    <div class="media-section">
        <div class="media-item">
            <h3>Course Thumbnail</h3>
            <p class="media-description">Upload a new thumbnail to replace the current one. Supported format: png, jpg, jpeg, svg</p>
            
            <?php if (!empty($class_data->class_thumbnail)): ?>
                <div class="current-media">
                    <p><strong>Current Thumbnail:</strong></p>
                    <img src="<?= ROOT ?>/<?= htmlspecialchars($class_data->class_thumbnail) ?>" alt="Current Thumbnail" style="width: 200px; height: auto; border-radius: 8px; margin-bottom: 10px;">
                </div>
            <?php endif; ?>

            <div class="upload-area">
                <button type="button" class="upload-btn" onclick="document.getElementById('thumbnail-input').click()">Upload Image</button>
                <input type="file" id="thumbnail-input" name="class_thumbnail" accept=".png,.jpg,.jpeg,.svg" style="display:none;">
                <p id="thumbnail-name" style="margin-top: 1rem; color: #374151; display: none;"></p>
            </div>
        </div>
        
        <div class="media-item">
            <h3>Course Trailer</h3>
            <p class="media-description">Upload a new 60–90 second trailer to replace the current one.</p>

            <?php if (!empty($class_data->class_trailer)): ?>
                <div class="current-media">
                    <p><strong>Current Trailer:</strong></p>
                    <video width="320" height="240" controls style="border-radius: 8px; margin-bottom: 10px;">
                        <source src="<?= ROOT ?>/<?= htmlspecialchars($class_data->class_trailer) ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php endif; ?>

            <div class="upload-area">
                <button type="button" class="upload-btn" onclick="document.getElementById('video-input').click()">Upload Video</button>
                <input type="file" id="video-input" name="class_trailer" accept="video/*" style="display:none;">
                <p id="video-name" style="margin-top: 1rem; color: #374151; display: none;"></p>
            </div>
        </div>
    </div>

<div class="schedule-section">
    <div class="section-header">
        <h2>📅 Schedule & Capacity</h2>
        <p class="section-subtitle">Set when your class is available and how many students can join</p>
    </div>
    
    <div class="schedule-content">
        <div class="class-days">
            <h4>Class Days</h4>
            <div class="days-selector">
                
                <?php $day_key = 'mon'; $is_checked = isset($schedule_lookup[$day_key]); ?>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="mon" <?= $is_checked ? 'checked' : '' ?>>
                    <span class="day-label">Mon</span>
                </label>
                <?php $day_key = 'tue'; $is_checked = isset($schedule_lookup[$day_key]); ?>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="tue" <?= $is_checked ? 'checked' : '' ?>>
                    <span class="day-label">Tue</span>
                </label>
                <?php $day_key = 'wed'; $is_checked = isset($schedule_lookup[$day_key]); ?>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="wed" <?= $is_checked ? 'checked' : '' ?>>
                    <span class="day-label">Wed</span>
                </label>
                <?php $day_key = 'thu'; $is_checked = isset($schedule_lookup[$day_key]); ?>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="thu" <?= $is_checked ? 'checked' : '' ?>>
                    <span class="day-label">Thu</span>
                </label>
                <?php $day_key = 'fri'; $is_checked = isset($schedule_lookup[$day_key]); ?>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="fri" <?= $is_checked ? 'checked' : '' ?>>
                    <span class="day-label">Fri</span>
                </label>
                <?php $day_key = 'sat'; $is_checked = isset($schedule_lookup[$day_key]); ?>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="sat" <?= $is_checked ? 'checked' : '' ?>>
                    <span class="day-label">Sat</span>
                </label>
                <?php $day_key = 'sun'; $is_checked = isset($schedule_lookup[$day_key]); ?>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="sun" <?= $is_checked ? 'checked' : '' ?>>
                    <span class="day-label">Sun</span>
                </label>

            </div>
        </div>

        <div id="time-slots-container">
            <?php $day_key = 'mon'; $schedule = $schedule_lookup[$day_key] ?? null; ?>
            <div class="time-slot" data-day="mon" <?= $schedule ? '' : 'hidden' ?>>
                <label>Monday Time</label>
                <input type="time" name="start_time_mon" value="<?= $schedule ? htmlspecialchars($schedule->start_time) : '09:00' ?>">
                <span>to</span>
                <input type="time" name="end_time_mon" value="<?= $schedule ? htmlspecialchars($schedule->end_time) : '17:00' ?>">
            </div>
            <?php $day_key = 'tue'; $schedule = $schedule_lookup[$day_key] ?? null; ?>
            <div class="time-slot" data-day="tue" <?= $schedule ? '' : 'hidden' ?>>
                <label>Tuesday Time</label>
                <input type="time" name="start_time_tue" value="<?= $schedule ? htmlspecialchars($schedule->start_time) : '09:00' ?>">
                <span>to</span>
                <input type="time" name="end_time_tue" value="<?= $schedule ? htmlspecialchars($schedule->end_time) : '17:00' ?>">
            </div>
            <?php $day_key = 'wed'; $schedule = $schedule_lookup[$day_key] ?? null; ?>
            <div class="time-slot" data-day="wed" <?= $schedule ? '' : 'hidden' ?>>
                <label>Wednesday Time</label>
                <input type="time" name="start_time_wed" value="<?= $schedule ? htmlspecialchars($schedule->start_time) : '09:00' ?>">
                <span>to</span>
                <input type="time" name="end_time_wed" value="<?= $schedule ? htmlspecialchars($schedule->end_time) : '17:00' ?>">
            </div>
            <?php $day_key = 'thu'; $schedule = $schedule_lookup[$day_key] ?? null; ?>
            <div class="time-slot" data-day="thu" <?= $schedule ? '' : 'hidden' ?>>
                <label>Thursday Time</label>
                <input type="time" name="start_time_thu" value="<?= $schedule ? htmlspecialchars($schedule->start_time) : '09:00' ?>">
                <span>to</span>
                <input type="time" name="end_time_thu" value="<?= $schedule ? htmlspecialchars($schedule->end_time) : '17:00' ?>">
            </div>
            <?php $day_key = 'fri'; $schedule = $schedule_lookup[$day_key] ?? null; ?>
            <div class="time-slot" data-day="fri" <?= $schedule ? '' : 'hidden' ?>>
                <label>Friday Time</label>
                <input type="time" name="start_time_fri" value="<?= $schedule ? htmlspecialchars($schedule->start_time) : '09:00' ?>">
                <span>to</span>
                <input type="time" name="end_time_fri" value="<?= $schedule ? htmlspecialchars($schedule->end_time) : '17:00' ?>">
            </div>
            <?php $day_key = 'sat'; $schedule = $schedule_lookup[$day_key] ?? null; ?>
            <div class="time-slot" data-day="sat" <?= $schedule ? '' : 'hidden' ?>>
                <label>Saturday Time</label>
                <input type="time" name="start_time_sat" value="<?= $schedule ? htmlspecialchars($schedule->start_time) : '09:00' ?>">
                <span>to</span>
                <input type="time" name="end_time_sat" value="<?= $schedule ? htmlspecialchars($schedule->end_time) : '17:00' ?>">
            </div>
            <?php $day_key = 'sun'; $schedule = $schedule_lookup[$day_key] ?? null; ?>
            <div class="time-slot" data-day="sun" <?= $schedule ? '' : 'hidden' ?>>
                <label>Sunday Time</label>
                <input type="time" name="start_time_sun" value="<?= $schedule ? htmlspecialchars($schedule->start_time) : '09:00' ?>">
                <span>to</span>
                <input type="time" name="end_time_sun" value="<?= $schedule ? htmlspecialchars($schedule->end_time) : '17:00' ?>">
            </div>
        </div>

        <div class="capacity-section">
            <h4>👥 Maximum Students</h4>
            <input type="number" id="max-students" name="max_students" placeholder="50" min="1" max="1000"
                   value="<?= htmlspecialchars($class_data->max_students ?? '50') ?>">
            
            <h4 style="margin-top: 1rem;">💰 Monthly Fee</h4>
            <input type="number" id="monthly-fee" name="monthly_fee" placeholder="5000" min="0" step="100"
                   value="<?= htmlspecialchars($class_data->monthly_fee ?? '5000') ?>">
        </div>
    </div>
</div>

<div class="publish-section">
    <div class="section-header">
        <h2>🚀 Publish Class</h2>
    </div>
    
    <div class="publish-content">
        <div class="publish-item">
            <h4>Welcome Message</h4>
            <textarea id="public-message" name="public_message" rows="4" placeholder="Enter course starting message here..."><?= htmlspecialchars($class_data->welcome_message ?? '') ?></textarea>
        </div>
        
        <div class="publish-item">
            <h4>Congratulations Message</h4>
            <textarea id="congrats-message" name="congrats_message" rows="4" placeholder="Why not tell students something encouraging message here..."><?= htmlspecialchars($class_data->congrats_message ?? '') ?></textarea>
        </div>
    </div>
</div>

</div>
<script src="<?php  echo ROOT ?>/assets/js/component/createClassAdvancedInfo.js"></script>

<script>
    document.getElementById('thumbnail-input').addEventListener('change', function() {
        const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
        const nameElement = document.getElementById('thumbnail-name');
        nameElement.textContent = fileName;
        nameElement.style.display = 'block';
    });

    document.getElementById('video-input').addEventListener('change', function() {
        const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
        const nameElement = document.getElementById('video-name');
        nameElement.textContent = fileName;
        nameElement.style.display = 'block';
    });
</script>