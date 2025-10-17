    //Handle "Edit Profile" button
    const editBtn = document.getElementById('btn_edit');
    if (editBtn) {
        editBtn.addEventListener('click', () => {
            // Redirect to edit profile page
            window.location.href = "studentEditProfile.view.php";
        });
    }

    //Handle "View Courses" button
    const viewCoursesBtn = document.querySelector('.action-card:nth-child(1) .btn-action');
    if (viewCoursesBtn) {
        viewCoursesBtn.addEventListener('click', () => {
            window.location.href = "studentMyCourses.view.php";
        });
    }

    //Handle "View Payments" button
    const viewPaymentsBtn = document.querySelector('.action-card:nth-child(2) .btn-action');
    if (viewPaymentsBtn) {
        viewPaymentsBtn.addEventListener('click', () => {
            window.location.href = "studentMyPayments.view.php";
        });
    }

    //Handle "View Calendar" button
    const viewCalendarBtn = document.querySelector('.action-card:nth-child(3) .btn-action');
    if (viewCalendarBtn) {
        viewCalendarBtn.addEventListener('click', () => {
            window.location.href = "studentMyCalendar.view.php";
        });
    }