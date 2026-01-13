//Upload Image button direction to file explorer
document.getElementById('upload-thumbnail-btn').addEventListener('click', function() {
    document.getElementById('thumbnail-input').click(); // Open file explorer
});

//Preview uploaded image
const fileInput = document.getElementById('thumbnail-input');
const uploadArea = document.querySelector('.media-item:first-child .upload-area');

// Create a text element for the file name
const fileNameDisplay = document.createElement('p');
fileNameDisplay.id = 'thumbnail-name';
fileNameDisplay.style.marginTop = '1rem';
fileNameDisplay.style.color = '#374151';
fileNameDisplay.style.display = 'none';
uploadArea.appendChild(fileNameDisplay);

fileInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const fileIcon = '🖼️';
        fileNameDisplay.textContent = `${fileIcon} Selected: ${file.name}`;
        fileNameDisplay.style.display = 'block';
        document.getElementById('thumbnail-preview').style.display = 'none'; 
    }
});

// --- Upload Video button ---
const videoBtn = document.getElementById('upload-video-btn');
const videoInput = document.getElementById('video-input');
const videoName = document.getElementById('video-name');

// Open file explorer
videoBtn.addEventListener('click', function() {
    videoInput.click();
});

// Show selected file name
videoInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        videoName.textContent = `🎬 Selected: ${file.name}`;
        videoName.style.display = 'block';
    }
});

// Direct to Find a Teacher page
document.getElementById('edit_teacher-btn').addEventListener('click', function() {
    window.location.href = '../view/editClassFindTeacher.php';
});

// --- Save Changes button (mock test) ---
document.getElementById('save_changes_btn').addEventListener('click', function () {
    // Collect form data
    const days = Array.from(document.querySelectorAll('input[name="days[]"]:checked')).map(el => el.value);
    const startTime = document.getElementById('start-time').value;
    const endTime = document.getElementById('end-time').value;
    const maxStudents = document.getElementById('max-students').value;
    const monthlyFee = document.getElementById('monthly-fee').value;
    const welcomeMessage = document.getElementById('public-message').value;
    const congratsMessage = document.getElementById('congrats-message').value;

    const thumbnailFile = document.getElementById('thumbnail-input').files[0];
    const videoFile = document.getElementById('video-input').files[0];

    // Prepare mock data object
    const mockData = {
        days,
        startTime,
        endTime,
        maxStudents,
        monthlyFee,
        welcomeMessage,
        congratsMessage,
        thumbnailFileName: thumbnailFile ? thumbnailFile.name : null,
        videoFileName: videoFile ? videoFile.name : null
    };

    // Simulate saving by logging to console
    console.log("📝 Data that would be sent to backend:", mockData);

    // Show success message
    alert('✅ Changes saved successfully! (Mock test, no backend yet)');
});
