// ========================
// 📘 مترجماتي الترجومي
// ========================

// الكلمات التي  حتترجمتها
const translations = {
  en: { 
    about: "About",
    events: "Events Section",
    activities: "Activities Section",
    colleges: "Colleges Categories Event Section",
    student: "Student Clubs Section",
    showAll: "Show All",
    searchPlaceholder: "Search here...",
    signUp: "Log In",
    settings: "Settings",
    language: "Change Language",
    logout: "Logout",
    home: "Home Page",
    back: "Go Back",
    notifications: "Notifications",
    personalInfo: "Personal Information",
    pastEvents: "Past Events",
    footer: "All rights reserved © FS WebDev Univents",
    MainPage: "Main Page",
    profileTitle: "Profile Information",
    studentName: "Full Name",
    email: "Email",
    major: "Major",
    studentId: "Student ID",
    loginTitle: "Login",
    welcomeBack: "Welcome back!",
    usernamePlaceholder: "Username",
    passwordPlaceholder: "Password",
    loginButton: "Login",
    forgotPassword: "Forgot Password?",
    createAccount: "Create Account",
    createAccountTitle: "Create New Account",
    signupDesc: "Please fill in the following information to create your university account",
    usernamePlaceholder: "Username",
    emailPlaceholder: "University Email",
    passwordPlaceholder: "Password",
    confirmPasswordPlaceholder: "Confirm Password",
    createAccountButton: "Create Account",
    backToLogin: "Back to Login",
    resetTitle: "Reset Password",
    resetDesc: "A 4-digit verification code will be sent to the entered phone number",
    enterPhone: "Enter your phone number",
    enterStudentId: "Enter your Student ID",
    enterNewPassword: "Enter new password",
    confirmNewPassword: "Re-enter new password",
    sendButton: "Send",
    Add: "Add", 
    paragraph: "Univents is a smart event communication platform designed for Taibah University. It solves the problem of scattered and unorganized event announcements by providing one centralized, easy-to-use system. With Univents, students can discover upcoming university events, get real-time updates, and register with ease. Organizers can also post event details, manage participation, and connect directly with students. The platform helps build a more connected, active, and engaging campus life — where no event goes unnoticed.",
    head: "What is Univents?" ,
    subtitle: "Your Gateway to University Events" ,
    title: "Welcome to Univents" ,





  },
  ar: {
    about: "عن الصفحة",
    events: "قسم الفعاليات",
    activities: "قسم الأنشطة",
    colleges: "قسم فعاليات الكليات",
    student: "قسم النوادي الطلابية",
    showAll: "عرض الجميع",
    searchPlaceholder: "ابحث هنا...",
    signUp: "تسجيل الدخول",
    settings: "الإعدادات",
    language: "تغيير اللغة",
    logout: "تسجيل الخروج",
    home: "الصفحة الرئيسية",
    back: "رجوع",
    notifications: "الإشعارات",
    personalInfo: "المعلومات الشخصية",
    pastEvents: "الفعاليات السابقة",
    footer: "جميع الحقوق محفوظة © FS WebDev Univents",
    MainPage: "الصفحة الرئيسية",
    profileTitle: "الملف الشخصي",
    studentName: "الاسم الكامل",
    email: "البريد الإلكتروني",
    major: "التخصص",
    studentId: "الرقم الجامعي",
    loginTitle: "تسجيل الدخول",
    welcomeBack: "مرحبًا بعودتك!",
    usernamePlaceholder: "اسم المستخدم",
    passwordPlaceholder: "كلمة المرور",
    loginButton: "تسجيل الدخول",
    forgotPassword: "نسيت كلمة المرور؟",
    createAccount: "إنشاء حساب",
    createAccountTitle: "إنشاء حساب جديد",
    signupDesc: "يرجى تعبئة البيانات التالية لإنشاء حسابك الجامعي",
    usernamePlaceholder: "اسم المستخدم",
    emailPlaceholder: "البريد الإلكتروني الجامعي",
    passwordPlaceholder: "كلمة المرور",
    confirmPasswordPlaceholder: "تأكيد كلمة المرور",
    createAccountButton: "إنشاء الحساب",
    backToLogin: "عودة لتسجيل الدخول",
    resetTitle: "إعادة تعيين كلمة المرور",
    resetDesc: "سيتم إرسال رمز تأكيد مكون من 4 أرقام إلى رقم الجوال المدخل",
    enterPhone: "أدخل رقم الجوال",
    enterStudentId: "أدخل رقمك الجامعي",
    enterNewPassword: "أدخل كلمة المرور الجديدة",
    confirmNewPassword: "أعد إدخال كلمة المرور الجديدة",
    sendButton: "إرسال",
    Add: "اضافة",
    paragraph: "Univents هو نظام ذكي للتواصل الخاص بالفعاليات صُمم لجامعة طيبة، ويحل مشكلة تشتت الإعلانات وضياع المعلومات من خلال منصة واحدة مركزية وسهلة الاستخدام. يمكن للطلاب من خلالها اكتشاف الفعاليات الجامعية القادمة، واستقبال التحديثات لحظيًا، والتسجيل بسهولة، بينما يستطيع المنظمون نشر تفاصيل الفعاليات وإدارة المشاركين والتواصل مباشرة مع الطلاب. تساعد المنصة في بناء حياة جامعية أكثر ترابطًا ونشاطًا وتفاعلًا، حيث لا تمر أي فعالية دون أن تصل للجميع. " ,
    head: "ماهو Univents ? " ,
    subtitle: "بوابتك لفعاليات الجامعة" ,
    title: "مرحبا بك في Univents " ,
  }
};



// اللغة الافتراضية أو المحفوظة
let currentLang = localStorage.getItem("preferredLang") || "en";

// تطبيق اللغة عند تحميل الصفحة
document.addEventListener("DOMContentLoaded", () => {
  applyLanguage(currentLang);
});

// دالة لتبديل اللغة
function toggleLanguage() {
  currentLang = currentLang === "ar" ? "en" : "ar";
  localStorage.setItem("preferredLang", currentLang);
  applyLanguage(currentLang);
}

// دالة لتطبيق اللغة على الصفحة الحالية
function applyLanguage(lang) {
  if (!lang) lang = localStorage.getItem("preferredLang") || "en";

  document.documentElement.setAttribute("lang", lang);
  document.body.dir = lang === "ar" ? "rtl" : "ltr";

  // ترجمة النصوص حسب data-translate
  document.querySelectorAll("[data-translate]").forEach(el => {
    const key = el.getAttribute("data-translate");
    if (translations[lang] && translations[lang][key]) {
      if (el.placeholder !== undefined && el.tagName === "INPUT") {
        el.placeholder = translations[lang][key];
      } else {
        el.textContent = translations[lang][key];
      }
    }
  });

 // بليس هولدر
  document.querySelectorAll("[data-translate-placeholder]").forEach(input => {
    const key = input.getAttribute("data-translate-placeholder");
    if (translations[lang] && translations[lang][key]) {
      input.placeholder = translations[lang][key];
    }
  });
}

