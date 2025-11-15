<!-- Curriculum -->

    <div class="advanced-info-container">
        <h1 class="section-title">Advanced Information</h1>
        
        
        <!-- Course Media Section -->
        <div class="media-section">
            <div class="media-item">
                <h3>Course Thumbnail</h3>
                <p class="media-description">Upload your course Thumbnail max thumbnail size limit: Supported format: png, jpg, jpeg, svg</p>
                <div class="upload-area">
                    <div class="upload-icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <rect x="6" y="10" width="28" height="20" rx="2" stroke="#ccc" stroke-width="2" fill="none"/>
                            <circle cx="14" cy="18" r="3" stroke="#ccc" stroke-width="2" fill="none"/>
                            <path d="M24 24l-4-4-6 6" stroke="#ccc" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <button class="upload-btn">Upload Image</button>
                    <input type="file" id="thumbnail-input" accept=".png,.jpg,.jpeg,.svg" style="display:none;">
                    <p id="thumbnail-name" style="margin-top: 1rem; color: #374151; display: none;"></p>

                </div>
            </div>
            
            <div class="media-item">
                <h3>Course Trailer</h3>
                <p class="media-description">Students see a video preview before enrolling. Upload a 60–90 seconds high-quality trailer to showcase your class</p>
                <div class="upload-area">
                    <div class="upload-icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <circle cx="20" cy="20" r="15" stroke="#ccc" stroke-width="2" fill="none"/>
                            <path d="M17 14l8 6-8 6V14z" fill="#ccc"/>
                        </svg>
                    </div>
                    <button class="upload-btn">Upload Video</button>
                    <input type="file" id="video-input" accept="video/*" style="display:none;">
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
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="mon">
                    <span class="day-label">Mon</span>
                </label>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="tue">
                    <span class="day-label">Tue</span>
                </label>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="wed">
                    <span class="day-label">Wed</span>
                </label>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="thu">
                    <span class="day-label">Thu</span>
                </label>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="fri">
                    <span class="day-label">Fri</span>
                </label>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="sat">
                    <span class="day-label">Sat</span>
                </label>
                <label class="day-option">
                    <input type="checkbox" name="days[]" value="sun">
                    <span class="day-label">Sun</span>
                </label>
            </div>
        </div>

        <div id="time-slots-container">
            <div class="time-slot" data-day="mon" hidden>
                <label>Monday Time</label>
                <input type="time" name="start_time_mon" value="09:00">
                <span>to</span>
                <input type="time" name="end_time_mon" value="17:00">
            </div>
            <div class="time-slot" data-day="tue" hidden>
                <label>Tuesday Time</label>
                <input type="time" name="start_time_tue" value="09:00">
                <span>to</span>
                <input type="time" name="end_time_tue" value="17:00">
            </div>
            <div class="time-slot" data-day="wed" hidden>
                <label>Wednesday Time</label>
                <input type="time" name="start_time_wed" value="09:00">
                <span>to</span>
                <input type="time" name="end_time_wed" value="17:00">
            </div>
            <div class="time-slot" data-day="thu" hidden>
                <label>Thursday Time</label>
                <input type="time" name="start_time_thu" value="09:00">
                <span>to</span>
                <input type="time" name="end_time_thu" value="17:00">
            </div>
             <div class="time-slot" data-day="fri" hidden>
                <label>Friday Time</label>
                <input type="time" name="start_time_fri" value="09:00">
                <span>to</span>
                <input type="time" name="end_time_fri" value="17:00">
            </div>
             <div class="time-slot" data-day="sat" hidden>
                <label>Saturday Time</label>
                <input type="time" name="start_time_sat" value="09:00">
                <span>to</span>
                <input type="time" name="end_time_sat" value="17:00">
            </div>
             <div class="time-slot" data-day="sun" hidden>
                <label>Sunday Time</label>
                <input type="time" name="start_time_sun" value="09:00">
                <span>to</span>
                <input type="time" name="end_time_sun" value="17:00">
            </div>
        </div>

        <div class="capacity-section">
            <h4>👥 Maximum Students</h4>
            <input type="number" id="max-students" name="max_students" placeholder="50" min="1" max="1000">
            
            <h4 style="margin-top: 1rem;">💰 Monthly Fee</h4>
            <input type="number" id="monthly-fee" name="monthly_fee" placeholder="5000" min="0" step="100">
        </div>
    </div>
</div>

        <!-- Publish Class Section -->
        <div class="publish-section">
            <div class="section-header">
                <h2>🚀 Publish Class</h2>
            </div>
            
            <div class="publish-content">
                <div class="publish-item">
                    <h4>Welcome Message</h4>
                    <textarea id="public-message" name="public_message" rows="4" placeholder="Enter course starting message here..."></textarea>
                </div>
                
                <div class="publish-item">
                    <h4>Congratulations Message</h4>
                    <textarea id="congrats-message" name="congrats_message" rows="4" placeholder="Why not tell students something encouraging message here..."></textarea>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
    
    </div>
    <script src="<?php  echo ROOT ?>/assets/js/component/createClassAdvancedInfo.js"></script>
