// ========================
// 📘 مترجماتي الترجومي
// ========================

const translations = {
  en: { 
    // --- Existing Keys ---
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
    emailPlaceholder: "University Email",
    confirmPasswordPlaceholder: "Confirm Password",
    createAccountButton: "Create Account",
    backToLogin: "Back to Login",
    resetTitle: "Reset Password",
    resetDesc: "A Reset Password Form Will Be Sent To Your Email",
    enterPhone: "Enter your phone number",
    enterStudentId: "Enter your Student ID",
    enterNewPassword: "Enter new password",
    confirmNewPassword: "Re-enter new password",
    sendButton: "Send",
    Add: "Add", 
    paragraph: "Univents is a smart event communication platform designed for Taibah University...",
    head: "What is Univents?",
    subtitle: "Your Gateway to University Events",
    title: "Welcome to Univents",

    // --- 🆕 NEW KEYS FOR EVENT SYSTEM ---
    eventInfo: "Event Information",
    eventDetails: "Event Details",
    eventName: "Event Name",
    location: "Location",
    time: "Time",
    register: "Register",
    registered: "Registered",
    openEvent: "Open Event (No Registration Needed)",
    deleteEvent: "Delete Event",
    viewAttendees: "View Attendees",
    
    // --- 🆕 NEW KEYS FOR ATTENDEES LIST ---
    attendeesList: "Attendees List",
    event: "Event",
    totalRegistered: "Total Registered",
    printList: "Print List",
    noRegistrations: "No students have registered for this event yet.",
    status: "Status",
    action: "Action",
    attended: "Attended",
    pending: "Pending",
    verified: "Verified",
    approveAttendance: "Approve Attendance",
    saving: "Saving...",

    // --- 🆕 NEW KEYS FOR HISTORY ---
    historyTitle: "My Event History",
    noHistory: "You haven't attended any events yet.",
    adminApprovalNote: "(Attendance must be approved by an Admin)"
  },
  ar: {
    // --- Existing Keys ---
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
    emailPlaceholder: "البريد الإلكتروني الجامعي",
    confirmPasswordPlaceholder: "تأكيد كلمة المرور",
    createAccountButton: "إنشاء الحساب",
    backToLogin: "عودة لتسجيل الدخول",
    resetTitle: "إعادة تعيين كلمة المرور",
    resetDesc: "سيتم إرسال نموذج إعادة تعيين كلمة المرور إلى بريدك الإلكتروني",
    enterPhone: "أدخل رقم الجوال",
    enterStudentId: "أدخل رقمك الجامعي",
    enterNewPassword: "أدخل كلمة المرور الجديدة",
    confirmNewPassword: "أعد إدخال كلمة المرور الجديدة",
    sendButton: "إرسال",
    Add: "اضافة",
    paragraph: "Univents هو نظام ذكي للتواصل الخاص بالفعاليات...",
    head: "ماهو Univents ?",
    subtitle: "بوابتك لفعاليات الجامعة",
    title: "مرحبا بك في Univents",

    // --- 🆕 NEW KEYS FOR EVENT SYSTEM ---
    eventInfo: "معلومات الفعالية",
    eventDetails: "تفاصيل الفعالية",
    eventName: "اسم الفعالية",
    location: "الموقع",
    time: "الوقت",
    register: "تسجيل",
    registered: "تم التسجيل",
    openEvent: "فعالية مفتوحة (لا تتطلب تسجيل)",
    deleteEvent: "حذف الفعالية",
    viewAttendees: "عرض الحضور",

    // --- 🆕 NEW KEYS FOR ATTENDEES LIST ---
    attendeesList: "قائمة الحضور",
    event: "الفعالية",
    totalRegistered: "إجمالي المسجلين",
    printList: "طباعة القائمة",
    noRegistrations: "لم يسجل أي طالب في هذه الفعالية بعد.",
    status: "الحالة",
    action: "الإجراء",
    attended: "حضر",
    pending: "قيد الانتظار",
    verified: "تم التحقق",
    approveAttendance: "تأكيد الحضور",
    saving: "جاري الحفظ...",

    // --- 🆕 NEW KEYS FOR HISTORY ---
    historyTitle: "سجل فعالياتي",
    noHistory: "لم تحضر أي فعاليات بعد.",
    adminApprovalNote: "(يجب اعتماد الحضور من قبل المسؤول)"
  }
};

// --- LOGIC (UNCHANGED) ---
let currentLang = localStorage.getItem("preferredLang") || "en";

document.addEventListener("DOMContentLoaded", () => {
  applyLanguage(currentLang);
});

function toggleLanguage() {
  currentLang = currentLang === "ar" ? "en" : "ar";
  localStorage.setItem("preferredLang", currentLang);
  applyLanguage(currentLang);
}

function applyLanguage(lang) {
  if (!lang) lang = localStorage.getItem("preferredLang") || "en";

  document.documentElement.setAttribute("lang", lang);
  document.body.dir = lang === "ar" ? "rtl" : "ltr";

  // Translate text content
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

  // Translate Placeholders
  document.querySelectorAll("[data-translate-placeholder]").forEach(input => {
    const key = input.getAttribute("data-translate-placeholder");
    if (translations[lang] && translations[lang][key]) {
      input.placeholder = translations[lang][key];
    }
  });
}