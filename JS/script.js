document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.querySelector('input[type="password"]');
    const togglePasswordBtn = document.createElement('span');
    togglePasswordBtn.className = 'toggle-password fas fa-eye';
    passwordInput.parentNode.appendChild(togglePasswordBtn);

    togglePasswordBtn.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      togglePasswordBtn.classList.toggle('fa-eye-slash');
    });
  });