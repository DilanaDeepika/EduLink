document.addEventListener('DOMContentLoaded', function() {

    // ---------- Upload Thumbnail ----------
    const imageBtn = document.getElementById('upload-thumbnail-btn');
    const thumbnailInput = document.getElementById('thumbnail-input');
    const thumbnailName = document.getElementById('thumbnail-name');

    imageBtn.addEventListener('click', () => thumbnailInput.click());

    thumbnailInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            thumbnailName.textContent = `🖼️ Selected: ${file.name}`;
            thumbnailName.style.display = 'block';
        } else {
            thumbnailName.textContent = '';
            thumbnailName.style.display = 'none';
        }
    });

    // ---------- Upload Video ----------
    const videoBtn = document.getElementById('upload-video-btn');
    const videoInput = document.getElementById('video-input');
    const videoName = document.getElementById('video-name');

    videoBtn.addEventListener('click', () => videoInput.click());

    videoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            videoName.textContent = `🎬 Selected: ${file.name}`;
            videoName.style.display = 'block';
        } else {
            videoName.textContent = '';
            videoName.style.display = 'none';
        }
    });

    // ---------- Save Changes Button ----------
    const saveBtn = document.getElementById('save_change');
    saveBtn.addEventListener('click', function() {
        // Collect media files
        const thumbnailFile = thumbnailInput.files[0] ? thumbnailInput.files[0].name : thumbnailName.textContent;
        const videoFile = videoInput.files[0] ? videoInput.files[0].name : videoName.textContent;

        // Collect schedule
        const daysChecked = Array.from(document.querySelectorAll('.days-selector input[type="checkbox"]:checked')).map(el => el.value);
        const startTime = document.getElementById('start-time').value;
        const endTime = document.getElementById('end-time').value;

        // Collect capacity
        const maxStudents = document.getElementById('max-students').value;
        const monthlyFee = document.getElementById('monthly-fee').value;

        // Collect messages
        const welcomeMsg = document.getElementById('public-message').value.trim();
        const congratsMsg = document.getElementById('congrats-message').value.trim();

        const advancedInfoData = {
            thumbnailFile,
            videoFile,
            schedule: {
                days: daysChecked,
                startTime,
                endTime
            },
            capacity: {
                maxStudents,
                monthlyFee
            },
            messages: {
                welcomeMsg,
                congratsMsg
            }
        };

        console.log("✅ Advanced Info Saved:", advancedInfoData);
        alert("✅ Advanced Information saved successfully (mock).");
    });

});
