const fullname = document.getElementById("fullname");
const studentId = document.getElementById("student_id");
const email = document.getElementById("uni-email");
const password = document.getElementById("password");
const confirm = document.getElementById("confirm");
const form = document.querySelector(".login-form");
const errorBox = document.querySelector(".error-box");

form.addEventListener("submit", (e) => {
    let errorMessage = "";

    if (!fullname.value.trim()) errorMessage = "يرجى إدخال الاسم";
    else if (fullname.value.length > 60) errorMessage = "الاسم طويل جدًا، الحد الأقصى 60 حرفًا";
    else if (!studentId.value.trim()) errorMessage = "يرجى إدخال الرقم الجامعي";
    else if (!email.value.trim()) errorMessage = "يرجى إدخال البريد الإلكتروني الجامعي";
    else if (!password.value.trim()) errorMessage = "يرجى إدخال كلمة المرور";
    else if (!confirm.value.trim()) errorMessage = "يرجى تأكيد كلمة المرور";
    else if (password.value !== confirm.value) errorMessage = "كلمات المرور غير متطابقة";

    if (errorMessage) {
        e.preventDefault();
        if (errorBox) errorBox.textContent = errorMessage;
    }
});