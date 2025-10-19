// الكلمات التي سيتم ترجمتها
const translations = {
  en: { 
    about: "About",
    notification: "Notification - Announcement",
    events: "Events Section",
    activities: "Activities",
    colleges: "Colleges Categories Event Section",
    showAll: "Show All",
    searchPlaceholder: "Search here...",
    signUp: "Sign up",
    profile: "Profile"
  },
  ar: {
    about: "عن الصفحة",
    notification: "الإشعارات - الإعلانات",
    events: "قسم الأحداث",
    activities: "الفعاليات",
    colleges: "أحداث الكليات",
    showAll: "عرض الجميع",
    searchPlaceholder: "ابحث هنا...",
    signUp: "تسجيل الدخول",
    profile: "الحساب"
  }
};

let currentLang = "en"; // اللغة الافتراضية

function toggleLanguage() {
  // تبديل اللغة
  currentLang = currentLang === "ar" ? "en" : "ar";
  document.documentElement.setAttribute("lang", currentLang);

  // تحديث نص الزر En/عربي
  const langButton = document.querySelector('button[onclick="toggleLanguage()"]');
  if (langButton) langButton.textContent = currentLang === "ar" ? "En" : "عربي";

  // تحديث الأزرار الرئيسية
  const aboutBtn = document.getElementById("about-btn");
  if (aboutBtn) aboutBtn.textContent = translations[currentLang].about;

  const signupBtn = document.getElementById("signup-btn");
  if (signupBtn) signupBtn.textContent = translations[currentLang].signUp;

  const profileBtn = document.getElementById("profile-btn");
  if (profileBtn) profileBtn.textContent = translations[currentLang].profile;

  // تحديث الأقسام (Events / Activities / Colleges)
  const sections = document.querySelectorAll('.section span');
  if (sections[0]) sections[0].textContent = translations[currentLang].notification;
  if (sections[1]) sections[1].textContent = translations[currentLang].events;
  if (sections[2]) sections[2].textContent = translations[currentLang].activities;
  if (sections[3]) sections[3].textContent = translations[currentLang].colleges;

  // تحديث أزرار "Show All"
  document.querySelectorAll('.show-all').forEach(button => {
    button.textContent = translations[currentLang].showAll;
  });

  // تحديث مربع البحث (لو موجود)
  const searchInput = document.getElementById('search-input');
  if (searchInput) searchInput.placeholder = translations[currentLang].searchPlaceholder;
}

 //------------------------------------------------صفحه عائمه--------------------------------------------------
function openLoginModal() {
  document.getElementById("loginModalOverlay").style.display = "flex";
}

function closeLoginModal() {
  document.getElementById("loginModalOverlay").style.display = "none";
}

// إغلاق النافذة عند الضغط على الخلفية
document.addEventListener("click", function (e) {
  const overlay = document.getElementById("loginModalOverlay");
  if (e.target === overlay) {
    closeLoginModal();
  }
});

