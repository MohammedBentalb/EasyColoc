document.addEventListener('DOMContentLoaded', function() {
    const profileUpload = document.getElementById('profile-upload');
    if (profileUpload) {
        profileUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');
            const error = document.getElementById('image-error');

            if (error) error.classList.add('hidden');

            if (file) {
                if (file.size > 10 * 1024 * 1024) {
                    if (error) {
                        error.textContent = 'Image size exceeds 10MB';
                        error.classList.remove('hidden');
                    }
                    this.value = '';
                    return;
                }

                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                if (preview) {
                    preview.src = '';
                    preview.classList.add('hidden');
                }
                if (placeholder) placeholder.classList.remove('hidden');
            }
        });
    }

    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            let hasError = false;
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');

            if (emailError) emailError.classList.add('hidden');
            if (passwordError) passwordError.classList.add('hidden');
            if (email) email.classList.remove('border-red-500');
            if (password) password.classList.remove('border-red-500');

            if (email && !email.value) {
                if (emailError) {
                    emailError.textContent = 'Email is required';
                    emailError.classList.remove('hidden');
                }
                email.classList.add('border-red-500');
                hasError = true;
            } else if (email && !/\S+@\S+\.\S+/.test(email.value)) {
                if (emailError) {
                    emailError.textContent = 'Please enter a valid email address';
                    emailError.classList.remove('hidden');
                }
                email.classList.add('border-red-500');
                hasError = true;
            }

            if (password && !password.value) {
                if (passwordError) {
                    passwordError.textContent = 'Password is required';
                    passwordError.classList.remove('hidden');
                }
                password.classList.add('border-red-500');
                hasError = true;
            } else if (password && password.value.length < 8) {
                if (passwordError) {
                    passwordError.textContent = 'Password must be at least 8 characters';
                    passwordError.classList.remove('hidden');
                }
                password.classList.add('border-red-500');
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
            }
        });
    }

    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            let hasError = false;
            const fields = ['username', 'email', 'password', 'confirm-password'];
            
            fields.forEach(field => {
                const input = document.getElementById(field);
                const error = document.getElementById(field + '-error');
                
                if (error) error.classList.add('hidden');
                if (input) input.classList.remove('border-red-500');

                if (input && !input.value) {
                    if (error) {
                        error.textContent = 'This field is required';
                        error.classList.remove('hidden');
                    }
                    input.classList.add('border-red-500');
                    hasError = true;
                }
            });

            const email = document.getElementById('email');
            if (email && email.value && !/\S+@\S+\.\S+/.test(email.value)) {
                const error = document.getElementById('email-error');
                if (error) {
                    error.textContent = 'Please enter a valid email address';
                    error.classList.remove('hidden');
                }
                email.classList.add('border-red-500');
                hasError = true;
            }

            const username = document.getElementById('username');
            if (username && username.value && username.value.length < 3) {
                const error = document.getElementById('username-error');
                if (error) {
                    error.textContent = 'Username must be at least 3 characters';
                    error.classList.remove('hidden');
                }
                username.classList.add('border-red-500');
                hasError = true;
            }

            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm-password');
            if (password && password.value && password.value.length < 8) {
                const error = document.getElementById('password-error');
                if (error) {
                    error.textContent = 'Password must be at least 8 characters';
                    error.classList.remove('hidden');
                }
                password.classList.add('border-red-500');
                hasError = true;
            }

            if (password && confirmPassword && password.value && confirmPassword.value && password.value !== confirmPassword.value) {
                const error = document.getElementById('confirm-password-error');
                if (error) {
                    error.textContent = 'Passwords do not match';
                    error.classList.remove('hidden');
                }
                confirmPassword.classList.add('border-red-500');
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
            }
        });
    }
});
