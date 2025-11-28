// =========================
// Profile Picture Upload/Delete
// =========================
document.addEventListener("DOMContentLoaded", function () {
    const defaultPfp = "./Images/taibah_logo.png";

    const profileContainer = document.querySelector(".profile-picture-container");
    if (profileContainer) {
        profileContainer.addEventListener("click", function () {
            document.getElementById("profileInput").click();
        });
    }

    const profileInput = document.getElementById("profileInput");
    if (profileInput) {
        profileInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("profilePicture").src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    const deletePfpBtn = document.getElementById("deletePfp");
    if (deletePfpBtn) {
        deletePfpBtn.addEventListener("click", function () {
            document.getElementById("profilePicture").src = defaultPfp;
        });
    }
});

// =========================
// DOB Restriction (Min Age 18)
// =========================
let today = new Date();
let minAge = 18;
let maxDate = new Date(today.getFullYear() - minAge, today.getMonth(), today.getDate());
const dobInput = document.getElementById('dob');
if (dobInput) {
    dobInput.setAttribute('max', maxDate.toISOString().split('T')[0]);
}

// =========================
// Go Back Function
// =========================
function goBack() {
    window.history.back();
}

// =========================
// Logout Function
// =========================
function logoutUser() {
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = "logout.php";
    }
}

// =========================
// Personalized Settings Menu
// =========================
document.addEventListener("DOMContentLoaded", () => {
    const settingsMenu = document.getElementById("settings-menu");
    if (!settingsMenu) return;

    // Only show extra options for logged-in users
    if (typeof userRole !== "undefined" && (userRole === 'administrator' || userRole === 'student')) {

        const personalInfo = document.createElement("div");
        personalInfo.className = "settings-item";
        personalInfo.textContent = "Personal Information";
        personalInfo.onclick = () => window.location.href = "../Profile/profile.html";

        const pastEvents = document.createElement("div");
        pastEvents.className = "settings-item";
        pastEvents.textContent = "Past Events";
        pastEvents.onclick = () => window.location.href = "../History/history.html";

        const logout = document.createElement("div");
        logout.className = "settings-item logout";
        logout.textContent = "Logout";
        logout.onclick = logoutUser; 

        const languageButton = settingsMenu.querySelector('[data-translate="language"]');
        if (languageButton) {
            settingsMenu.insertBefore(personalInfo, languageButton);
            settingsMenu.insertBefore(pastEvents, languageButton);
            settingsMenu.insertBefore(logout, languageButton);
        }
    }
});

// =========================
// Navbar Login/Profile/Logout Visibility
// =========================
document.addEventListener("DOMContentLoaded", () => {
    const loginBtn = document.querySelector(".openModalBtn-Wrapper"); // Login button
    const profileBtn = document.getElementById("profile-btn");        // Profile/settings button
    const logoutBtns = document.querySelectorAll(".logout");          // Logout buttons

    if (!userRole) {
        // Guest: show only login
        if (profileBtn) profileBtn.style.display = "none";
        if (logoutBtns) logoutBtns.forEach(btn => btn.style.display = "none");
        if (loginBtn) loginBtn.style.display = "block";
    } else {
        // Logged-in: show profile & logout, hide login
        if (profileBtn) profileBtn.style.display = "block";
        if (logoutBtns) logoutBtns.forEach(btn => btn.style.display = "block");
        if (loginBtn) loginBtn.style.display = "none";
    }
});
