console.log("homeLoginSignin.js chargé");

function openLogInPopUp() {
    document.getElementById("login-popup").style.display = "flex";
    document.getElementById("signin-popup").style.display = "none";    
}
  
function openSignInPopUp() {
    document.getElementById("signin-popup").style.display = "flex";    
    document.getElementById("login-popup").style.display = "none";
}

function closePopUp() {
    document.getElementById("login-popup").style.display = "none";
    document.getElementById("signin-popup").style.display = "none";    
}

// Afficher/masquer les exigences du mot de passe

const passwordInput = document.querySelector('#signin-popup #password');
const requirementsTooltip = document.getElementById('password-requirements-tooltip');

document.addEventListener('DOMContentLoaded', function() {
    if (passwordInput && requirementsTooltip) {
        // Afficher quand on focus sur l'input
        passwordInput.addEventListener('focus', function() {
            requirementsTooltip.classList.add('show');
        });
        
        // Masquer quand on quitte l'input
        passwordInput.addEventListener('blur', function() {
            requirementsTooltip.classList.remove('show');
        });
    }
});

// Validation visuelle en temps réel
passwordInput.addEventListener('input', function() {
    const password = this.value;
    const requirements = requirementsTooltip.querySelectorAll('li');
    
    const checks = [
        password.length >= 8,
        /[a-z]/.test(password),
        /[A-Z]/.test(password),
        /\d/.test(password),
        /[@$!%*?&#^()_+\-=\[\]{};:,.<>]/.test(password)
    ];
    
    requirements.forEach((li, index) => {
        if (checks[index]) {
            li.style.color = '#4CAF50';
            li.style.textDecoration = 'line-through';
        } else {
            li.style.color = '#bbb';
            li.style.textDecoration = 'none';
        }
    });
});