// Interactive star rating
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.stars-interactive .star');
    let selectedRating = 0;
    const starsContainer = document.querySelector('.stars-interactive');
    const classId = starsContainer.dataset.classId;
    
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.getAttribute('data-rating'));
            updateStars(selectedRating);
            console.log('User rated: ' + selectedRating + ' stars');

            const formData = new FormData();
            formData.append("rating", selectedRating);
            formData.append("class_id", classId); // echo in your view

            fetch("http://localhost/EDULINK/public/ClassPage/save_rating", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                console.log("AJAX Response:", data);
                })
              .catch(err => console.error(err));
            

        });
        
        star.addEventListener('mouseenter', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            updateStars(rating);
        });
    });
    
    document.querySelector('.stars-interactive').addEventListener('mouseleave', function() {
        updateStars(selectedRating);
    });
    
    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('filled');
            } else {
                star.classList.remove('filled');
            }
        });
    }
});

// Review Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    const writeReviewLink = document.querySelector('.write-review-link');
    const reviewModal = document.getElementById('reviewModal');
    const closeModalBtn = document.getElementById('closeReviewModal');
    const reviewTextarea = document.getElementById('reviewTextarea');

    
    // Open modal
    if (writeReviewLink && reviewModal) {
        writeReviewLink.addEventListener('click', function(e) {
            e.preventDefault();
            reviewModal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        });
    }
    
    // Close modal function
    function closeModal() {
        reviewModal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
        reviewTextarea.value = ''; // Clear textarea
        modalSelectedRating = 0;
        updateModalStars(0);
        selectedRatingText.textContent = '';
    }
    
    // Close modal on close button click
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }
    
    // Close modal when clicking outside
    reviewModal.addEventListener('click', function(e) {
        if (e.target === reviewModal) {
            closeModal();
        }
    });
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && reviewModal.classList.contains('active')) {
            closeModal();
        }
    });
    
    
    
});
   