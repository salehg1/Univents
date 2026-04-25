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
    paragraph: "Univents is a smart event communication platform designed for Taibah University. It solves the problem of scattered and unorganized event announcements by providing one centralized, easy-to-use system. With Univents, students can discover upcoming university events, get real-time updates, and register with ease. Organizers can also post event details, manage participation, and connect directly with students. The platform helps build a more connected, active, and engaging campus life — where no event goes unnoticed.",
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
    adminApprovalNote: "(Attendance must be approved by an Admin)",
    
    // --- Errors ---
loginErrorEmpty: "Please enter Student ID and password.",
loginErrorInvalid: "Invalid Student ID or password.",

resetErrorEmpty: "Please enter both Student ID and Email.",
resetErrorNotFound: "No account found with that Student ID and Email combination.",
resetErrorGenerate: "Error generating reset key. Please contact support.",

resetLinkExpired: "This reset link has expired. Please try again.",
resetLinkInvalid: "Invalid password reset link.",
resetPasswordEmpty: "Please enter a password.",
resetPasswordMismatch: "Passwords do not match.",

signupNameRequired: "Please enter your full name.",
signupNameTooLong: "Name is too long. Maximum is 60 characters.",
signupStudentIdRequired: "Please enter your Student ID.",
signupStudentIdExists: "This Student ID is already registered.",
signupEmailRequired: "Please enter your email.",
signupEmailInvalid: "Invalid email format.",
signupEmailNotUniversity: "Please use your university email only.",
signupEmailExists: "This email is already in use.",
signupPasswordRequired: "Please enter a password.",
signupConfirmRequired: "Please confirm your password.",
signupPasswordMismatch: "Passwords do not match.",
signupGenericError: "An error occurred while creating the account. Please try again.",
confirmLogout: "Are you sure you want to log out?",
eventInfo: "Event Information",
eventPicture: "Event Picture",
eventName: "Event Name:",
major: "Major:",
eventDetails: "Event Details",
location: "Location:",
time: "Time:",
back: "Go Back",
viewAttendees: "View Attendees",
deleteEvent: "Delete Event",
deleteConfirm: "Are you sure you want to delete this event?",
registered: "Registered",
register: "Register",
attendeesList: "Attendees List",
event: "Event",
printList: "Print List",
noRegistrations: "No registrations yet",
studentName: "Student Name",
studentId: "Student ID",
status: "Status",
action: "Action",
attended: "Attended",
pending: "Pending",
verified: "Verified",
approveAttendance: "Approve Attendance",
back: "Go Back",





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
    paragraph: "Univents هو نظام ذكي للتواصل وإدارة الفعاليات صُمم خصيصًا لجامعة طيبة. يهدف إلى حل مشكلة تشتت الإعلانات وعدم تنظيمها من خلال توفير منصة موحدة وسهلة الاستخدام. يتيح Univents للطلاب اكتشاف الفعاليات الجامعية القادمة، والحصول على تحديثات فورية، والتسجيل بكل سهولة. كما يمكّن منظمي الفعاليات من نشر تفاصيل الفعاليات، وإدارة المشاركات، والتواصل المباشر مع الطلاب. تسهم المنصة في بناء بيئة جامعية أكثر تفاعلًا وترابطًا، حيث لا تمر أي فعالية دون اهتمام.",
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
    adminApprovalNote: "(يجب اعتماد الحضور من قبل المسؤول)",
      // --- Errors ---

  resetErrorEmpty: "يرجى إدخال الرقم الجامعي والبريد الإلكتروني",
resetErrorNotFound: "لا يوجد حساب مطابق للرقم الجامعي والبريد الإلكتروني",
resetErrorGenerate: "حدث خطأ أثناء إنشاء رابط إعادة التعيين، يرجى التواصل مع الدعم",

resetLinkExpired: "انتهت صلاحية رابط إعادة التعيين، يرجى المحاولة مرة أخرى",
resetLinkInvalid: "رابط إعادة تعيين كلمة المرور غير صالح",
resetPasswordEmpty: "يرجى إدخال كلمة المرور",
resetPasswordMismatch: "كلمتا المرور غير متطابقتين",

signupNameRequired: "يرجى إدخال الاسم الكامل",
signupNameTooLong: "الاسم طويل جدًا، الحد الأقصى 60 حرفًا",
signupStudentIdRequired: "يرجى إدخال الرقم الجامعي",
signupStudentIdExists: "الرقم الجامعي مسجل بالفعل",
signupEmailRequired: "يرجى إدخال البريد الإلكتروني",
signupEmailInvalid: "البريد الإلكتروني غير صالح",
signupEmailNotUniversity: "يرجى استخدام البريد الجامعي فقط",
signupEmailExists: "البريد الإلكتروني مستخدم بالفعل",
signupPasswordRequired: "يرجى إدخال كلمة المرور",
signupConfirmRequired: "يرجى تأكيد كلمة المرور",
signupPasswordMismatch: "كلمتا المرور غير متطابقتين",
signupGenericError: "حدث خطأ أثناء إنشاء الحساب، يرجى المحاولة مرة أخرى",
confirmLogout: "هل أنت متأكد من تسجيل الخروج؟",
eventInfo: "معلومات الفعالية",
eventPicture: "صورة الفعالية",
eventName: "اسم الفعالية:",
major: "التخصص:",
eventDetails: "تفاصيل الفعالية",
location: "الموقع:",
time: "الوقت:",
back: "رجوع",
viewAttendees: "عرض المسجلين",
deleteEvent: "حذف الفعالية",
deleteConfirm: "هل أنت متأكد من حذف هذه الفعالية؟",
registered: "تم التسجيل",
register: "تسجيل",
attendeesList: "قائمة الحضور",
event: "الفعالية",
printList: "طباعة القائمة",
noRegistrations: "لا توجد تسجيلات حتى الآن",
studentName: "اسم الطالب",
studentId: "الرقم الجامعي",
status: "الحالة",
action: "الإجراء",
attended: "حضر",
pending: "قيد الانتظار",
verified: "تم التحقق",
approveAttendance: "اعتماد الحضور",
back: "رجوع",

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

  // Swap dynamic event content (data-en / data-ar attributes)
  document.querySelectorAll("[data-en]").forEach(el => {
    el.textContent = (lang === 'ar' && el.dataset.ar) ? el.dataset.ar : el.dataset.en;
  });

  // Re-render any tracked sliders directly
  (window._sliderRenders || []).forEach(fn => fn());

  // Also dispatch event for any other components listening
  document.dispatchEvent(new CustomEvent('languageChanged', { detail: { lang } }));
}