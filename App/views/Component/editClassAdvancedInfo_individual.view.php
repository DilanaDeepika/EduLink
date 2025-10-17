<div class="advanced-info-container">
    <h1 class="section-title">Advanced Information</h1>
    
    <!-- Course Media Section -->
    <div class="media-section">
        <div class="media-item">
            <h3>Course Thumbnail</h3>
            <p class="media-description">Upload your course Thumbnail max thumbnail size limit: Supported format: png, jpg, jpeg, svg</p>
            <div class="upload-area" id="thumbnail-area">
                <div class="upload-icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <rect x="6" y="10" width="28" height="20" rx="2" stroke="#ccc" stroke-width="2" fill="none"/>
                        <circle cx="14" cy="18" r="3" stroke="#ccc" stroke-width="2" fill="none"/>
                        <path d="M24 24l-4-4-6 6" stroke="#ccc" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <button type="button" class="upload-btn" id="upload-thumbnail-btn">Upload Image</button>
                <input type="file" id="thumbnail-input" accept=".png,.jpg,.jpeg,.svg" style="display:none;">
                <p id="thumbnail-name" style="margin-top:1rem;color:#374151;">current-thumbnail.png</p>
            </div>
        </div>
        
        <div class="media-item">
            <h3>Course Trailer</h3>
            <p class="media-description">Students see a video preview before enrolling. Upload a 60–90 seconds high-quality trailer to showcase your class</p>
            <div class="upload-area" id="video-area">
                <div class="upload-icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <circle cx="20" cy="20" r="15" stroke="#ccc" stroke-width="2" fill="none"/>
                        <path d="M17 14l8 6-8 6V14z" fill="#ccc"/>
                    </svg>
                </div>
                <button type="button" class="upload-btn" id="upload-video-btn">Upload Video</button>
                <input type="file" id="video-input" accept="video/*" style="display:none;">
                <p id="video-name" style="margin-top:1rem;color:#374151;">current-trailer.mp4</p>
            </div>
        </div>
    </div>

    <!-- Schedule & Capacity Section -->
    <div class="schedule-section">
        <div class="section-header">
            <h2>📅 Schedule & Capacity</h2>
            <p class="section-subtitle">Set when your class is available and how many students can join</p>
        </div>
        
        <div class="schedule-content">
            <div class="class-days">
                <h4>Class Days</h4>
                <div class="days-selector">
                    <label class="day-option"><input type="checkbox" value="mon" checked><span class="day-label">Mon</span></label>
                    <label class="day-option"><input type="checkbox" value="tue"><span class="day-label">Tue</span></label>
                    <label class="day-option"><input type="checkbox" value="wed" checked><span class="day-label">Wed</span></label>
                    <label class="day-option"><input type="checkbox" value="thu"><span class="day-label">Thu</span></label>
                    <label class="day-option"><input type="checkbox" value="fri" checked><span class="day-label">Fri</span></label>
                    <label class="day-option"><input type="checkbox" value="sat"><span class="day-label">Sat</span></label>
                    <label class="day-option"><input type="checkbox" value="sun"><span class="day-label">Sun</span></label>
                </div>
            </div>

            <div class="time-capacity">
                <div class="time-section">
                    <h4>Start Time</h4>
                    <div class="time-input">
                        <input type="time" id="start-time" value="09:00">
                    </div>
                    <h4 style="margin-top:1rem;">End Time</h4>
                    <div class="time-input">
                        <input type="time" id="end-time" value="17:00">
                    </div>
                </div>

                <div class="capacity-section">
                    <h4>👥 Maximum Students</h4>
                    <input type="number" id="max-students" value="50" min="1" max="1000">
                    
                    <h4 style="margin-top:1rem;">💰 Monthly Fee</h4>
                    <input type="number" id="monthly-fee" value="5000" min="0" step="100">
                </div>
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
                <textarea id="public-message" rows="4">Welcome to this Advanced Physics class! We are excited to start learning together.</textarea>
            </div>
            
            <div class="publish-item">
                <h4>Congratulations Message</h4>
                <textarea id="congrats-message" rows="4">Congratulations on completing the course! Keep practicing and stay curious.</textarea>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="form-actions">
        <button type="button" class="btn-secondary" id="save_change">Save Changes</button>
        <button type="submit" class="btn-primary" id="create-class">Update Class</button>
    </div>
</div>
<script src="../../../Public/assets/js/component/editClassAdvancedInfo_individual.view.js"></script>
