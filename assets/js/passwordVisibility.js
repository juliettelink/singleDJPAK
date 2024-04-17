function passwordVisibility() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.innerHTML = "👁️";
    } else {
        passwordInput.type = "password";
        eyeIcon.innerHTML = "👁️‍🗨️";
    }
}