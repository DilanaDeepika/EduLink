    //Upload Photo Button
    const uploadBtn = document.getElementById('upload-btn');
    if (uploadBtn) {
        uploadBtn.addEventListener('click', () => {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.onchange = (e) => {
                const file = e.target.files[0];
                if (file) {
                    uploadBtn.textContent = `Selected: ${file.name}`;
                    uploadBtn.style.display = 'block';
                    alert(`Selected image: ${file.name}`);
                }
            };
            fileInput.click();
        });
    }


    // Save Changes Button
    const profileForm = document.querySelector('.profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();
        
            const firstName = document.getElementById('st_first_name').value;
            const lastName = document.getElementById('st_last_name').value;
            const username = document.getElementById('st_username').value;
            const email = document.getElementById('st_email').value;
            const phone = document.getElementById('st_phone_no').value;
            const address = document.getElementById('st_address').value;

            alert(`Saved!\n\nName: ${firstName} ${lastName}\nUsername: ${username}\nEmail: ${email}\nPhone: ${phone}\nAddress: ${address}`);
        });
    }

    //Toggle Password Visibility
    const toggleBtns = document.querySelectorAll('.toggle-password');
    toggleBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M1 1L19 19" stroke="#666" stroke-width="2"/>
                        <path d="M10 4C5 4 1.73 7.11 0 10C1.73 12.89 5 16 10 16C15 16 18.27 12.89 20 10C18.27 7.11 15 4 10 4Z" stroke="#666" stroke-width="2" fill="none"/>
                    </svg>
                `;
            } else {
                input.type = 'password';
                btn.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4C5 4 1.73 7.11 0 10C1.73 12.89 5 16 10 16C15 16 18.27 12.89 20 10C18.27 7.11 15 4 10 4ZM10 14C7.79 14 6 12.21 6 10C6 7.79 7.79 6 10 6C12.21 6 14 7.79 14 10C14 12.21 12.21 14 10 14ZM10 8C8.9 8 8 8.9 8 10C8 11.1 8.9 12 10 12C11.1 12 12 11.1 12 10C12 8.9 11.1 8 10 8Z" fill="#666"/>
                    </svg>
                `;
            }
        });
    });

    //Change Password Button
    const passwordForm = document.querySelector('.password-form');
    if (passwordForm) {
        passwordForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const current = passwordForm.querySelector('input[placeholder="Enter current password"]').value;
            const newPass = passwordForm.querySelector('input[placeholder="Enter new password"]').value;
            const confirm = passwordForm.querySelector('input[placeholder="Confirm new password"]').value;

            if (newPass !== confirm) {
                alert('New password and confirmation do not match!!!');
                return;
            }

            alert(`Password changed!\nCurrent: ${current}\nNew: ${newPass}`);
        });
    }

