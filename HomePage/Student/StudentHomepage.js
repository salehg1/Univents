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
      
      // Assign class based on type to keep CSS styling
      if (typeKey === "events") card.className = "event";
      else if (typeKey === "activities") card.className = "Activities";
      else if (typeKey === "studentClubs") card.className = "Student";
      else if (typeKey === "colleges") card.className = "Colleg";

      card.style.cursor = "pointer";

      card.innerHTML = `
        <img src="${event.image}" alt="${event.name}">
        <p class="desc title">${event.name}</p>
        <p class="desc date">${event.time}</p>
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
}

// Initialize Sliders
createSlider("events", "eventsContainer", "evLeft", "evRight");
createSlider("activities", "activitiesSlider", "actLeft", "actRight");
createSlider("studentClubs", "studentSlider", "stuLeft", "stuRight");
createSlider("colleges", "collegesSlider", "colLeft", "colRight");