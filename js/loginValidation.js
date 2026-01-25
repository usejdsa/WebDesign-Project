document.addEventListener("DOMContentLoaded", function () {

    // ----------------- SIGN IN -----------------
    const signInForm = document.getElementById("signin-form");
    if (signInForm) {
        const emailInput = signInForm.querySelector("input[type='email']");
        const passwordInput = signInForm.querySelector("input[type='password']");

        signInForm.addEventListener("submit", function (e) {
            // e.preventDefault();

            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();

            const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;

            if (email === "") { alert("Shkruani email-in"); emailInput.focus(); return; }
            if (!emailRegex.test(email.toLowerCase())) { alert("Email i pavlefshëm"); emailInput.focus(); return; }
            if (password === "") { alert("Shkruani fjalëkalimin"); passwordInput.focus(); return; }
            if (!passwordRegex.test(password)) { alert("Fjalëkalimi duhet të ketë 6+ karaktere dhe shkronja + numra"); passwordInput.focus(); return; }

            alert("Hyrja e suksesshme!");
            // window.location.href = "Home.html";
        });
    }

    // ----------------- SIGN UP -----------------
    const signUpForm = document.getElementById("signup-form");
    if (signUpForm) {
        const usernameInput = signUpForm.querySelector("#username");
        const emailInput = signUpForm.querySelector("#email");
        const passwordInput = signUpForm.querySelector("#password");
        const confirmPasswordInput = signUpForm.querySelector("#confirm-password");

        signUpForm.addEventListener("submit", function (e) {
            // e.preventDefault();

            const username = usernameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();

            const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;

            if (username.length < 3) { alert("Username duhet të ketë të paktën 3 karaktere"); usernameInput.focus(); return; }
            if (!emailRegex.test(email.toLowerCase())) { alert("Email i pavlefshëm"); emailInput.focus(); return; }
            if (!passwordRegex.test(password)) { alert("Fjalëkalimi duhet të ketë 6+ karaktere dhe shkronja + numra"); passwordInput.focus(); return; }
            if (password !== confirmPassword) { alert("Fjalëkalimet nuk përputhen"); confirmPasswordInput.focus(); return; }

            alert("Regjistrimi u krye me sukses!");
            // window.location.href = "Home.html";
        
        });
    }

});

const roleButtons = document.querySelectorAll('.role-btn');
const roleInput = document.getElementById('selected-role');

roleButtons.forEach(button => {
    button.addEventListener('click', () => {
        roleButtons.forEach(btn => btn.classList.remove('btn-red'));
        button.classList.add('btn-red');
        roleInput.value = button.dataset.role;
    });
});
