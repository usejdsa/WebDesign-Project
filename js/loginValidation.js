document.addEventListener("DOMContentLoaded", function() {
    // Merr formën dhe butonin Sign In
    const form = document.querySelector(".signin-box form");
    const emailInput = form.querySelector("input[type='email']");
    const passwordInput = form.querySelector("input[type='password']");
    const signinBtn = form.querySelector(".signin-btn");

    const emailValid = (email) => {
        const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
        return emailRegex.test(email.toLowerCase());
    }

    signinBtn.addEventListener("click", function(e) {
        e.preventDefault(); // ndalon dërgimin automatik

        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        if(email === "") {
            alert("Ju lutem shkruani email-in");
            emailInput.focus();
            return;
        }

        if(!emailValid(email)) {
            alert("Ju lutem shkruani një email të vlefshëm");
            emailInput.focus();
            return;
        }

        if(password === "") {
            alert("Ju lutem shkruani fjalëkalimin");
            passwordInput.focus();
            return;
        }

        if(password.length < 6) {
            alert("Fjalëkalimi duhet të ketë të paktën 6 karaktere");
            passwordInput.focus();
            return;
        }

        alert("Hyrja e suksesshme!");
        window.location.href = "Home.html"; // ridrejton tek Home.html
    });
});
