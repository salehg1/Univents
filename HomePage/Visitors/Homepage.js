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

let currentSlide = 0;
let autoSlideInterval;

const slides = document.querySelectorAll(".Notificaion-slide .slide");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.toggle("active", i === index);
  });
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
  resetAutoSlide();
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(currentSlide);
  resetAutoSlide();
}

function startAutoSlide() {
  autoSlideInterval = setInterval(() => {
    nextSlide();
  }, 5000);
}

function resetAutoSlide() {
  clearInterval(autoSlideInterval);
  startAutoSlide();
}

window.addEventListener("load", () => {
  showSlide(currentSlide);
  startAutoSlide();
});

//---------------------------------------------------------------------------------------------
//event1 test 
async function updateEventInfo() {
  const events = [
    { id: "event1", url: "Notificaion/Notificaion1.html" },
  ];

  for (const event of events) {
    try {
      const response = await fetch(event.url);
      const text = await response.text();
      const match = text.match(/window\.eventData\s*=\s*(\{[\s\S]*?\});/);

      if (match) {
        const eventData = eval("(" + match[1] + ")");
        const container = document.getElementById(event.id);
        if (container) {
          container.querySelector(".title").textContent = eventData.title;
          container.querySelector(".date").textContent = eventData.date;
          container.querySelector("img").src = eventData.image;
        }
      }
    } catch (err) {
      console.error("Error loading event info for", event.id, err);
    }
  }
}

document.addEventListener("DOMContentLoaded", updateEventInfo);
//---------------------------------------------------------------------------------------------
