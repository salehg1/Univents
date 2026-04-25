//------------------------------------------------ Notification Slider --------------------------------------------------
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
  if(slides.length > 0) {
      showSlide(currentSlide);
      startAutoSlide();
  }
});

//------------------------------------------------ Event Sliders (DB Connected) --------------------------------------------------

function createSlider(typeKey, containerId, leftBtnId, rightBtnId) {
  // FIX: Read from PHP window.dbData instead of LocalStorage
  let list = window.dbData[typeKey] || [];
  let index = 0;

  const container = document.getElementById(containerId);
  const leftBtn = document.getElementById(leftBtnId);
  const rightBtn = document.getElementById(rightBtnId);

  if (!container) return;

  function render() {
    container.innerHTML = "";

    // Show 3 items per slide
    let slice = list.slice(index, index + 3);

    if (slice.length === 0) {
        container.innerHTML = "<p style='text-align:center; width:100%; color:#888;'>No events available.</p>";
        return;
    }

    slice.forEach(event => {
      const card = document.createElement("div");

      if (typeKey === "events") card.className = "event";
      else if (typeKey === "activities") card.className = "Activities";
      else if (typeKey === "studentClubs") card.className = "Student";
      else if (typeKey === "colleges") card.className = "Colleg";

      card.style.cursor = "pointer";

      const lang = document.documentElement.lang || localStorage.getItem('preferredLang') || 'en';
      const name = (lang === 'ar' && event.name_ar) ? event.name_ar : event.name;
      const time = (lang === 'ar' && event.time_ar) ? event.time_ar : event.time;

      card.innerHTML = `
        <img src="${event.image}" alt="${name}">
        <p class="desc title">${name}</p>
        <p class="desc date">${time}</p>
      `;

      // FIX: Correct path to event-card.php using ID
      card.onclick = () => {
        window.location.href = `../event/event-card.php?id=${event.id}&type=${typeKey}`;
      };

      container.appendChild(card);
    });
  }

  rightBtn.addEventListener("click", () => {
    if (index + 3 < list.length) {
      index++;
      render();
    }
  });

  leftBtn.addEventListener("click", () => {
    if (index > 0) {
      index--;
      render();
    }
  });

  render();
  return render;
}

// Initialize Sliders — store render functions for language re-render
window._sliderRenders = window._sliderRenders || [];
function createSliderAndTrack(typeKey, containerId, leftBtnId, rightBtnId) {
  const render = createSlider(typeKey, containerId, leftBtnId, rightBtnId);
  if (render) window._sliderRenders.push(render);
}
createSliderAndTrack("events",       "eventsContainer", "evLeft",  "evRight");
createSliderAndTrack("activities",   "activitiesSlider","actLeft", "actRight");
createSliderAndTrack("studentClubs", "studentSlider",   "stuLeft", "stuRight");
createSliderAndTrack("colleges",     "collegesSlider",  "colLeft", "colRight");

document.addEventListener('languageChanged', () => {
  (window._sliderRenders || []).forEach(fn => fn());
});